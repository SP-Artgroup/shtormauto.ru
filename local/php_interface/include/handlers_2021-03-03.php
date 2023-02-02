<?php

use Bitrix\Main\Event;
use Bitrix\Sale\Order;
use SP\Shop as SPShop;

$eventManager = Bitrix\Main\EventManager::getInstance();

$handlers = [
	['catalog', 'OnBeforePriceUpdate', 'OnBeforePriceUpdateHandler'],
	['catalog', 'OnBeforePriceAdd', 'OnBeforePriceAddHandler'],
	['catalog', 'OnGetOptimalPrice', 'OnGetOptimalPriceHandler'],

	// Отключение ндс после выгрузки
	['catalog', 'OnBeforeProductAdd', ['Import1CClass', 'OnBeforeProductAdd']],
	['catalog', 'OnBeforeProductUpdate', ['Import1CClass', 'OnBeforeProductUpdate']],

	['main', 'OnBeforeUserRegister', ['ShtormautoEvents', 'OnBeforeUserRegisterHandler']],
	["main", "OnBeforeUserAdd", ["ShtormautoEvents", "OnBeforeUserRegisterHandler"]],
	['main', 'OnBeforeUserUpdate', ['ShtormautoEvents', 'OnBeforeUserUpdateHandler']],
	['main', 'OnAfterUserAdd', ['ShtormautoEvents', 'OnAfterUserAddHandler']],

	['main', 'OnBeforeProlog', ['SP\\City', 'checkCityOnLoad']],
	['main', 'OnGetStaticCacheProvider', ['Local\\CompositeCacheProvider', 'getSelf']],

	// Модификация данных шаблонов почтового события SALE_NEW_ORDER
	['sale', 'OnOrderNewSendEmail', ['ShtormautoEvents', 'OnOrderNewSendEmailHandler']],
	['sale', 'OnOrderPaySendEmail', ['ShtormautoEvents', 'OnOrderPaySendEmailHandler']],
	['sale', 'OnOrderCancelSendEmail', ['ShtormautoEvents', 'OnSaleCancelOrderHandler']],
];

foreach ($handlers as $handler) {
	$eventManager->addEventHandler(
		$handler[0],
		$handler[1],
		$handler[2]
	);
}

class Import1CClass
{
	function OnBeforeProductAdd(&$arFields){
		$arFields["VAT_INCLUDED"] = "Y";
		$arFields['VAT_ID'] = 4;
		return true;
	}
	function OnBeforeProductUpdate($ID, &$arFields){

		$arFields["VAT_INCLUDED"] = "Y";
		$arFields['VAT_ID'] = 4;
		return true;
	}
}

// AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);

// function _Check404Error()
// {
//     if (defined('ERROR_404') && ERROR_404 == 'Y' && !defined('ADMIN_SECTION')) {
//         global $APPLICATION;
//         $APPLICATION->RestartBuffer();
//         require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
//         require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
//         require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';
//     }
// }

function OnGetOptimalPriceHandler($intProductID, $quantity, $arUserGroups, $renewal, $arPrices, $siteID, $arDiscountCoupons)
{
	CModule::IncludeModule("sale");
	$dbBasketItems = CSaleBasket::GetList(
		array(
		       "NAME" => "ASC",
		       "ID" => "ASC"
		       ),
		array(
		       "FUSER_ID" => CSaleBasket::GetBasketUserID(),
		       "ORDER_ID" => "NULL",                            
				"PRODUCT_ID" => $intProductID
		       ),
		false,
		false,
		array(

		)
	);

	while ($arItems = $dbBasketItems->Fetch())
	{
		$newPrice['ID'] = $arItems['PRODUCT_PRICE_ID'];
		$newPrice['PRODUCT_ID'] = $arItems['PRODUCT_ID'];
		$newPrice['CATALOG_GROUP_ID'] = $arItems['PRICE_TYPE_ID'];
		$newPrice['PRICE'] = $arItems['PRICE'];
		$newPrice['CURRENCY'] = $arItems['CURRENCY'];
	}
	if(is_array($newPrice)){
		return [
			'PRICE'          => $newPrice,
			'DISCOUNT_PRICE' => false,
			'DISCOUNT'       => [],
			'DISCOUNT_LIST'  => [],
		];
	}
	else{
		$dbNewPrice = CPrice::GetListEx([], [
			'PRODUCT_ID'       => $intProductID,
			'CATALOG_GROUP_ID' => Shtormauto::getInstance()->getCurrentCityPriceId(),
		]);

		if ($newPrice = $dbNewPrice->Fetch()) {
			return [
				'PRICE'          => $newPrice,
				'DISCOUNT_PRICE' => false,
				'DISCOUNT'       => [],
				'DISCOUNT_LIST'  => [],
			];
		}
	}
	return false;
}

class ShtormautoEvents
{
	private static $inOrderNewSendEmailHandler = false;

	public function OnBeforeUserRegisterHandler(&$arFields)
	{
		if($arFields["EXTERNAL_AUTH_ID"] != "socservices" && !in_array(1, $arFields["GROUP_ID"]) && !empty($arFields['EMAIL'])){
			$arFields['LOGIN'] = $arFields['EMAIL'];
		}

		if (!empty($_REQUEST['NEW_PHONE']) && !isset($arFields['PERSONAL_MOBILE'])) {
			$arFields['PERSONAL_MOBILE'] = $_REQUEST['NEW_PHONE'];
		}

		if (isset($_REQUEST['order_register']) && $_REQUEST['order_register'] == 'Y') {
			if (!isset($_REQUEST['NEW_PHONE']) || empty($_REQUEST['NEW_PHONE'])) {
				$GLOBALS['APPLICATION']->ThrowException('Пожалуйста введите номер телефона');

				return false;
			}

			if (!isset($_REQUEST['privacy_policy']) || $_REQUEST['privacy_policy'] != 'on') {
				$GLOBALS['APPLICATION']->ThrowException('Пожалуйста примите политику конфиденциальности для регистрации на сайте!');

				return false;
			}
		}

		if (isset($_REQUEST['main_register_form']) && $_REQUEST['main_register_form'] == 'Y') {
			if (!isset($_REQUEST['privacy_policy']) || $_REQUEST['privacy_policy'] != 'on') {
				$GLOBALS['APPLICATION']->ThrowException('Пожалуйста примите политику конфиденциальности для регистрации на сайте!');

				return false;
			}
		}

		return true;
	}

	public function OnAfterUserAddHandler(&$arFields){
		if($arFields["ID"] > 0 && !in_array(1, $arFields["GROUP_ID"])){
			if(CModule::IncludeModule("subscribe")){  
				$arFields = Array(
					"FORMAT" => "html",
					"SEND_CONFIRM" => "N",
					"CONFIRMED" => "Y",
					"EMAIL" => $arFields["EMAIL"],
					"ACTIVE" => "Y",
					"RUB_ID" => ($arFields["SITE_ID"] == "s1" || $arFields["LID"] == "s1")?array(1):array(3)
				);
				$subscr = new CSubscription;
				$ID = $subscr->Add($arFields);
			}  
		}
	}

	public function OnBeforeUserUpdateHandler(&$arFields)
	{
		if (isset($_REQUEST['edit_profile'])) {
			if (strpos($arFields['LOGIN'], '@') !== false) {
				$arFields['LOGIN'] = $arFields['EMAIL'];
			}

			if (!isset($_REQUEST['PERSONAL_MOBILE']) || empty($_REQUEST['PERSONAL_MOBILE'])) {
				$GLOBALS['APPLICATION']->ThrowException('Ошибка 108');

				return false;
			}
		}
	}

	public function OnOrderNewSendEmailHandler($id, &$eventName, &$arFields)
	{
		if (self::$inOrderNewSendEmailHandler) {
			return;
		}

		self::$inOrderNewSendEmailHandler = true;

		$order      = Order::load($id);
		$orderProps = $order->getPropertyCollection();
		$shopProp = null;
		$shopId   = 0;

		foreach ($orderProps as $prop) {

			$code = strtoupper($prop->getProperty()['CODE']);

			switch ($code) {
				case 'PHONE':
				case 'DELIVERY_DATE':
				case 'CITY':
				case 'OTHER_CITY':
				case 'NOTICE':
				case 'COMPANY':
				case 'COMPANY_ADR':
				case 'CONTACT_PERSON':
				case 'INN':
				case 'KPP':
				case 'BONUS_CARD_NUMBER':
				case 'COMMENTS':
					$arFields[$code] = $prop->getValue();
					break;

				case 'SHOP':
					$shopProp = $prop;
					$shopId   = $prop->getValue();
					break;
			}
		}
		$payment = $order->getPaymentCollection()->current();
		$paymentSystemName = $payment->getPaymentSystemName();
		$paymentSystemId = $payment->getPaymentSystemId();

		$arFields['PAY_SYSTEM_NAME'] = $paymentSystemName;
		$arFields['ORDER_USER']      .= '. Дополнительная информация: ' . $order->getField('ADDITIONAL_INFO');
		if(in_array($paymentSystemId, array(33,34,35))){
			$key = explode('access=', $arFields['ORDER_PUBLIC_URL']);
			$arFields['PAY_LINK'] = 'Для оплаты заказа перейдите по <a href="http://'.SITE_SERVER_NAME.'/personal/order/payment/?ORDER_ID='.$arFields['ORDER_ID'].'&HASH='.$key[1].'">ссылке</a>';
		}

		// $phone = Bitrix\Main\UserTable::query()
		//     ->setFilter([
		//         'EMAIL' => $arFields['EMAIL'],
		//     ])
		//     ->setSelect(['PERSONAL_PHONE'])
		//     ->exec()
		//     ->fetch()['PERSONAL_PHONE'];

		// $arFields['PHONE'] = $phone;


		if ($shopId) {

			$shopData = SPShop::getShopData($shopId)[$shopId];

			if (!empty($shopData)) {

				// Добавление почты склада в получатели письма
				// и подмена айди склада на название в письме
				if($paymentSystemId == 1){
					$arFields['BCC']  = $shopData['PROPERTY_EMAIL_VALUE'];
				}
				$arFields['SHOP'] = $shopData['NAME'];

				// Подмена айди склада на его название в свойстве заказа
				$shopProp->setValue($shopData['NAME']);
				$order->save();
			}
		}

		self::$inOrderNewSendEmailHandler = false;
	}
	function OnOrderPaySendEmailHandler($id, &$eventName, &$arFields){
		$order      = Order::load($id);
		$orderProps = $order->getPropertyCollection();
		$shopId   = 0;

		foreach ($orderProps as $prop) {

			$code = strtoupper($prop->getProperty()['CODE']);

			switch ($code) {
				case 'PHONE':
				case 'DELIVERY_DATE':
				case 'CITY':
					$city = $prop->getValue();
					break;
				case 'OTHER_CITY':
				case 'NOTICE':
				case 'COMPANY':
				case 'COMPANY_ADR':
				case 'CONTACT_PERSON':
				case 'INN':
				case 'KPP':
				case 'BONUS_CARD_NUMBER':
				case 'COMMENTS':
					$arFields[$code] = $prop->getValue();
					break;

				case 'SHOP':
					$shopProp = $prop;
					$shopId   = $prop->getValue();
					
					break;
			}
		}
		$shopData = SPShop::getCityShopByName($shopId)[$shopId];
		if (!empty($shopData)) {
			// для Хабаровских отправляем и г. Благовещенск, ул. Нагорная, 1А
			if (($shopId && $city == 'Хабаровск') || $shopData["ID"] == 176756) {	
				// Добавление почты склада в получатели письма
				// и подмена айди склада на название в письме
				$arFields['BCC']  = $shopData['PROPERTY_EMAIL_VALUE'];
				$arFields['SHOP'] = $shopData['NAME'];
			}
		}
	}
	function OnSaleCancelOrderHandler($id, &$eventName, &$arFields){
		$order      = Order::load($id);
		$orderProps = $order->getPropertyCollection();
		$shopId   = 0;

		foreach ($orderProps as $prop) {

			$code = strtoupper($prop->getProperty()['CODE']);

			switch ($code) {
				case 'PHONE':
				case 'DELIVERY_DATE':
				case 'CITY':
					$city = $prop->getValue();
					break;
				case 'OTHER_CITY':
				case 'NOTICE':
				case 'COMPANY':
				case 'COMPANY_ADR':
				case 'CONTACT_PERSON':
				case 'INN':
				case 'KPP':
				case 'BONUS_CARD_NUMBER':
				case 'COMMENTS':
					$arFields[$code] = $prop->getValue();
					break;

				case 'SHOP':
					$shopProp = $prop;
					$shopId   = $prop->getValue();
					
					break;
			}
		}
		if ($shopId && $city == 'Хабаровск') {	
			// для Хабаровских отправляем
			$shopData = SPShop::getCityShopByName($shopId)[$shopId];
			if (!empty($shopData)) {
				// Добавление почты склада в получатели письма
				// и подмена айди склада на название в письме
				$arFields['BCC']  = $shopData['PROPERTY_EMAIL_VALUE'];
				$arFields['SHOP'] = $shopData['NAME'];
			}
		}
	}
}

function OnBeforePriceUpdateHandler($ID, $arFields)
{
	getMinimumPrice($arFields);
}

function OnBeforePriceAddHandler($arFields)
{
	getMinimumPrice($arFields);
}

function getMinimumPrice($arFields)
{
	$goodID    = 0;
	$dbProduct = CIBlockElement::GetByID($arFields['PRODUCT_ID']);
	if ($arItem = $dbProduct->Fetch()) {
		$dbProp = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], [], ['CODE' => 'CML2_LINK']);
		if ($arProp = $dbProp->Fetch()) {
			$goodID = $arProp['VALUE'];
			$dbItem = CIBlockElement::GetByID($goodID);
			if ($item = $dbItem->Fetch()) {
				$dbPropPrice = CIBlockElement::GetProperty($item['IBLOCK_ID'], $goodID, ['sort' => 'asc'], ['CODE' => 'MIN_PRICE']);
				if ($arPropPrice = $dbPropPrice->Fetch()) {
					if (intval($arPropPrice['VALUE'])) {
						$iNewPrice = ($arFields['PRICE'] < intval($arPropPrice['VALUE'])) ? $arFields['PRICE'] : $arPropPrice['VALUE'];
					} else {
						$iNewPrice = $arFields['PRICE'];
					}

					CIBlockElement::SetPropertyValueCode($goodID, 'MIN_PRICE', $iNewPrice);
				}
			}
		}
	}
}
