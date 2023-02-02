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

// Ресайз картинок

if (is_array($arResult['PREVIEW_PICTURE'])) {

    $img = CFile::ResizeImageGet(
        $arResult['PREVIEW_PICTURE'],
        ['width' => 220, 'height' => 190],
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );

    $arResult['PREVIEW_PICTURE'] = $img;
}

if (count($arResult['MORE_PHOTO']) > 0) {

    foreach ($arResult['MORE_PHOTO'] as $cell => $photo) {

        $img = CFile::ResizeImageGet(
            $photo,
            ['width' => 70, 'height' => 50],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );

        $arResult['MORE_PHOTO'][$cell]['MIN'] = $img;

    }

}

// Получение данных для вывода списка складов

$shopIds = SPShop::getCityShops();
$shops   = SPShop::getShopData($shopIds);
$amounts = SPShop::getProductAmount($productId, $shopIds);

if (isset($amounts[$productId])) {
    $arResult['STORE_DATA'] = [
        'STORES'     => $shops,
        'AMOUNTS'    => $amounts[$productId],
        'PRODUCT_ID' => $productId,
    ];
} else {
    $arResult['CAN_BUY'] = false;
}

unset($shops, $amounts);

// хз чё

$cities_list   = SPCity::getAllCities();
$cities        = [];
$citiesByShops = [];
$allShopIds    = [];

// Получение городов, в которых есть данный товар

foreach ($cities_list as $city) {

    // Если у товара пустая цена, значит текущий город недоступен

    if ($city['ID'] == $currentCityId && empty($currentPrice)) {
        continue;
    }

    $cities[$city['ID']] = $city;

    $cityShopIds = SPShop::getCityShops($city['ID']);

    array_push($allShopIds, ...$cityShopIds);

    $citiesByShops += array_fill_keys(
        $cityShopIds,
        $city['ID']
    );
}

$tmpAmounts = SPShop::getProductAmount($productId, $allShopIds);
$strAvailableCities = '';

if (!empty($tmpAmounts[$productId])) {

    $amounts = $tmpAmounts[$productId];

    $availableCities = [];

    foreach ($amounts as $shopId => $amount) {
        $cityId = $citiesByShops[$shopId];
        $availableCities[$cityId] = $cities[$cityId]['NAME'];
    }

    // Если текущего города нет среди доступных,
    // значит товар недоступен

    if (!isset($availableCities[$currentCityId])) {
        $arResult['CAN_BUY'] = false;
    }

    $arResult['AVAILABLE_CITIES'] = array_values($availableCities);

    if (!empty($availableCities)) {
        $strAvailableCities = implode(', ', $availableCities);
    }
}

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
$rsSect = CIBlockSection::GetList(array('id' => 'asc'), $arFilter, false, array("ID","UF_EX_GUARANT", "UF_FREE_REPAIR"));
while ($arSect = $rsSect->GetNext()){
    $arResult["EX_GUARANT"] = ($arSect["UF_EX_GUARANT"] != '')?"Y":"N";
    $arResult["FREE_REPAIR"] = ($arSect["UF_FREE_REPAIR"] != "")?"Y":"N";
}
$arResult["EX_GUARANT"] = ($arResult["PROPERTIES"]["REMOVE_EX_GUARANT"]["VALUE_XML_ID"] == "Y")?"N":$arResult["EX_GUARANT"];
$arResult["FREE_REPAIR"] = ($arResult["PROPERTIES"]["REMOVE_FREE_REPAIR"]["VALUE_XML_ID"] == "Y")?"N":$arResult["FREE_REPAIR"];