<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Catalog\StoreProductTable;
use Bitrix\Main\Loader;
use SP\City as SPCity;
use SP\Shop as SPShop;

Loader::includeModule('catalog');

$component = $this->getComponent();
$arParams  = $component->applyTemplateModifications();

$productId     = $arResult['ID'];
$currentCityId = SPCity::getCurrentCityId();
$currentPrice  = $arResult['ITEM_PRICES'][$arResult['ITEM_PRICE_SELECTED']];
$maxQuantity = 0;

// Ресайз картинок

if (is_array($arResult['PREVIEW_PICTURE'])) {

    $img = CFile::ResizeImageGet(
        $arResult['PREVIEW_PICTURE'],
        ['width' => 500, 'height' => 500],
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );

    $arResult['PREVIEW_PICTURE'] = $img;
}

/*if (count($arResult['MORE_PHOTO']) > 0) {

    foreach ($arResult['MORE_PHOTO'] as $cell => $photo) {

        $img = CFile::ResizeImageGet(
            $photo["ID"],
            ['width' => 70, 'height' => 50],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );

        $arResult['MORE_PHOTO'][$cell]['MIN'] = $img;

    }
}*/

// Получение данных для вывода списка складов, неактуальна в случае, если используется код ниже
/*$shopIds = SPShop::getCityShops(); // id магазинов в данном городе
$shops   = SPShop::getShopData($shopIds); // вся информация по магазинам города (ИБ магазины)
$amounts = SPShop::getProductAmount($productId, $shopIds); // количество товара по складам города (один адрес может иметь несколько складов)
if (!isset($amounts[$productId])) {
    $arResult['CAN_BUY'] = false;
}
unset($shops, $amounts);*/
$cities_list   = SPCity::getAllCities(); //  вся информация по города (ИБ города)
$cities        = [];
$citiesByShops = [];
$allShopIds    = [];
foreach ($cities_list as $city) {

    // Если у товара пустая цена, значит текущий город недоступен
    if ($city['ID'] == $currentCityId && empty($currentPrice)) {
        continue;
    }

    $cities[$city['ID']] = $city;

    $cityShopIds = SPShop::getCityShops($city['ID']);
    if($city['ID'] == $currentCityId){
        $arResult['QUANTITY_CITY'] = SPShop::getProductAmount($productId, $cityShopIds);
    }

    array_push($allShopIds, ...$cityShopIds);

    $citiesByShops += array_fill_keys(
        $cityShopIds,
        $city['ID']
    );
}

$tmpAmounts = SPShop::getProductAmount($productId, $allShopIds);  // содержит кол-во товара по каждому магазину каждого id товара , $allShopIds - id всех магазинов
$strAvailableCities = '';
if (!empty($tmpAmounts[$productId])) {

    $amounts = $tmpAmounts[$productId];

    $availableCities = [];

    foreach ($amounts as $shopId => $amount) {
        $cityId = $citiesByShops[$shopId];
        $availableCities[$cityId] = '<a href="'.$APPLICATION->GetCurPageParam('chcity=' . $cityId, ['chcity']).'">'.$cities[$cityId]['NAME'].'</a>';
    }

    // Если текущего города нет среди доступных, значит товар недоступен
    if (!isset($availableCities[$currentCityId])) {
        $arResult['CAN_BUY'] = false;
    }

    $arResult['AVAILABLE_CITIES'] = array_values($availableCities);

    if (!empty($availableCities)) {
        $strAvailableCities = implode(', ', $availableCities);
    }
}
foreach ($arResult['QUANTITY_CITY'][$productId] as $key => $value) {
    $maxQuantity = $maxQuantity + $value;
}
$arResult['MAX_QUANTITY_CITY'] = $maxQuantity;
$arResult['AVAILABLE_CITIES_STRING'] = $strAvailableCities;

unset(
    $tmpAmounts,
    $availableCities,
    $strAvailableCities,
    $cities,
    $stores
);

$arResult['CURRENT_PRICE'] = $currentPrice;

$arResult['JS_DATA'] = [
    'product_id' => $arResult['ID'],
    'price_id'   => $currentPrice['ID'],
    'price'      => $currentPrice['PRICE'],
    'name'       => $arResult['NAME'],
];

unset($currentPrice);

$arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ID' => $arResult["IBLOCK_SECTION_ID"],
); // выберет потомков без учета активности
$rsSect = CIBlockSection::GetList(
	array('id' => 'asc'), 
	$arFilter, 
	false, 
	array("ID","UF_EX_GUARANT", "UF_FREE_REPAIR", "UF_SHOW_PRICE", "UF_BRIDGESTONE", "UF_UNCONDITIONAL_GUARANT")
);
while ($arSect = $rsSect->GetNext()){
    $arResult["EX_GUARANT"] 								= ($arSect["UF_EX_GUARANT"] == 2)?"Y":"N";
    $arResult["FREE_REPAIR"] 								= ($arSect["UF_FREE_REPAIR"] == 1)?"Y":"N";
		$arResult["UF_BRIDGESTONE"] 						= ($arSect["UF_BRIDGESTONE"] == 5)?"Y":"N";
		$arResult["UF_UNCONDITIONAL_GUARANT"] 	= ($arSect["UF_UNCONDITIONAL_GUARANT"] == 7)?"Y":"N";
    $arResult["SHOW_PRICE"] = ($arSect["UF_SHOW_PRICE"] == true)?"Y":"N";
}
$arResult["EX_GUARANT"] = ($arResult["PROPERTIES"]["REMOVE_EX_GUARANT"]["VALUE_XML_ID"] == "Y")?"N":$arResult["EX_GUARANT"];
$arResult["FREE_REPAIR"] = ($arResult["PROPERTIES"]["REMOVE_FREE_REPAIR"]["VALUE_XML_ID"] == "Y")?"N":$arResult["FREE_REPAIR"];
$arResult["UF_BRIDGESTONE"] = ($arResult["PROPERTIES"]["REMOVE_BRIDGESTONE"]["VALUE_XML_ID"] == "Y")?"N":$arResult["UF_BRIDGESTONE"];
$arResult["UF_UNCONDITIONAL_GUARANT"] = ($arResult["PROPERTIES"]["REMOVE_UNCONDITIONAL_GUARANT"]["VALUE_XML_ID"] == "Y")?"N":$arResult["UF_UNCONDITIONAL_GUARANT"];

// иконки
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "PROPERTY_LINK", "PROPERTY_ONLY_ADMIN");
$arFilter = Array("IBLOCK_ID"=>49, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext()){
    $arResult["ICON"][$ob["ID"]] = $ob;
    $arResult["ICON"][$ob["ID"]]["PICTURE"]["SRC"] = CFile::GetPath($ob["PREVIEW_PICTURE"]);
}

$entityClass = \SP\MainClass::getHighloadBlockEntityClass(HLBLOCK_SECTIONS_DISCOUNTS);

$resSection = CIBlockSection::GetNavChain(false, $arResult["IBLOCK_SECTION_ID"]);
$arSetionsId = [];
while ($section = $resSection->GetNext()) {
    array_push($arSetionsId, $section["ID"]);
}

$sectionDiscount = $entityClass::getList([
    'select' => ['UF_DISCOUNT'],
    'filter' => ['UF_ID_SECTION' => $arSetionsId]
])->Fetch();

if($sectionDiscount) {
    $discountValuePrec = $sectionDiscount['UF_DISCOUNT'];
};

if(isset($discountValuePrec)){
    $currentPriceWithExchange = (int)$arResult['CURRENT_PRICE']['BASE_PRICE'] * (100 - $discountValuePrec) / 100;
    $arResult['CURRENT_PRICE']["PRICE_WITH_EXCHANGE"] = $currentPriceWithExchange;
}


//использование инфоблока "Описание моделей"

$modelsSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_FILES_WITH_DESCRIPTION", "PROPERTY_VIDEO", "PROPERTY_ADDITIONAL_PHOTOS");
$modelsFilter = Array("IBLOCK_ID"=>50, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$models = CIBlockElement::GetList(Array(), $modelsFilter, false, false, $modelsSelect);


while($modelsElements = $models->GetNext()) {
	if(str_contains($arResult["NAME"], $modelsElements["NAME"]) && !str_contains($arResult["NAME"], 'BFGOODRICH')){
		$arResult["DESCRIPTION_FILE"] = $modelsElements["PROPERTY_FILES_WITH_DESCRIPTION_VALUE"];		

		if(!empty($modelsElements['PROPERTY_VIDEO_VALUE']) && $modelsElements['PROPERTY_VIDEO_VALUE'] != ''){
			$arResult["VIDEO"][] = $modelsElements['PROPERTY_VIDEO_VALUE'];
		}
		
		if(!empty($modelsElements['PROPERTY_ADDITIONAL_PHOTOS_VALUE']) && $modelsElements['PROPERTY_ADDITIONAL_PHOTOS_VALUE'] != ''){
			$arResult["ADDITIONAL_PHOTOS"][] = CFile::GetPath($modelsElements['PROPERTY_ADDITIONAL_PHOTOS_VALUE']);
		}
	}

	$arResult["VIDEO"] = array_unique($arResult["VIDEO"]);
	$arResult["ADDITIONAL_PHOTOS"] = array_unique($arResult["ADDITIONAL_PHOTOS"]);
}