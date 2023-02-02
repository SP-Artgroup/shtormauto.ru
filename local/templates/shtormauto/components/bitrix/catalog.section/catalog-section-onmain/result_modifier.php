<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

use SP\Shop as SPShop;
use SP\City as SPCity;

$component = $this->getComponent();
$arParams  = $component->applyTemplateModifications();

$productIds = [];
$arResult["CURRENT_CITY"] = SPCity::getCurrentCityId();

foreach ($arResult['ITEMS'] as $item) {

    if (!empty($item['ITEM_PRICES'])) {
        $productIds[] = $item['ID'];
    }
    $allProductIds[] = $item['ID'];
}

$shopIds = SPShop::getCityShops(); // id магазинов в данном городе
$shops   = SPShop::getShopData($shopIds); // вся информация по магазинам города
$amounts = SPShop::getProductAmount($productIds); // количество товара по складам города (один адрес может иметь несколько складов)

foreach ($arResult['ITEMS'] as $key => $item) {

    if (!isset($amounts[$item['ID']])) {
        $arResult['ITEMS'][$key]['CAN_BUY'] = false;
    }
    
    $iblockSectionIds[$item["~IBLOCK_SECTION_ID"]] = $item["~IBLOCK_SECTION_ID"];
}
if(isset($_REQUEST['PAGEN_1']) && !empty($_REQUEST['PAGEN_1'])){
    $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] = $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"].' | Страница '.$_REQUEST['PAGEN_1'];
    $arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"] = 'Страница '.$_REQUEST['PAGEN_1'].' | '.$arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"];
    $arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"] = $arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"].' Страница '.$_REQUEST['PAGEN_1'];
}
/*получим рекламные баннеры*/
$arBanners = [];
$arBannersOrder = array("NAME"=>"ASC");
$arBannersFilter = array("IBLOCK_ID"=>IBLOCK_BANER_MAIN_PRODUCT, "ACTIVE"=>"Y");
$arBannersSelect = array("ID", "CODE", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_LINK");
$res = CIBlockElement::GetList(array(), $arBannersFilter, false, false, $arBannersSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
    $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
    $arFile2 = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
    $arBanners[] = array("PREVIEW_PICTURE"=>$arFile["SRC"], "DETAIL_PICTURE"=>$arFile2["SRC"], "LINK"=>"PROPERTY_LINK_VALUE" );
}
$arResult["BANNERS"] = $arBanners;

$allShopsByCities = SPShop::getAllShops(true);

$cityByShop = [];
$allShops   = [];

foreach ($allShopsByCities as $cityId => $shops) {
    foreach ($shops as $shopId) {
        $allShops[]          = $shopId;
        $cityByShop[$shopId] = $cityId;
    }
}

$productAmount = SPShop::getProductAmount($allProductIds, $allShops);

$cityAmounts = [];

foreach ($productAmount as $productId => $shopAmounts) {
    foreach ($shopAmounts as $shopId => $amount) {
        $cityId = $cityByShop[$shopId];

        $prevAmount                       = $cityAmounts[$productId][$cityId] ?? 0;
        $cityAmounts[$productId][$cityId] = $prevAmount + $amount;
    }
}

$arResult['CITY_AMOUNTS'] = $cityAmounts;
$arResult['CITY_LIST'] = SP\City::getAllCities();

$arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ID' => $iblockSectionIds,
); // выберет потомков без учета активности
$rsSect = CIBlockSection::GetList(
	array('id' => 'asc'), 
	$arFilter, 
	false, 
	array("ID", "UF_EX_GUARANT", "UF_FREE_REPAIR", "UF_SHOW_PRICE", "UF_BRIDGESTONE", "UF_UNCONDITIONAL_GUARANT")
);

while ($arSect = $rsSect->GetNext()){
	$arResult[$arSect["ID"]]["EX_GUARANT"] 								= ($arSect["UF_EX_GUARANT"] == 2)?"Y":"N";
	$arResult[$arSect["ID"]]["FREE_REPAIR"]								= ($arSect["UF_FREE_REPAIR"] == 1)?"Y":"N";
	$arResult[$arSect["ID"]]["UF_BRIDGESTONE"] 						= ($arSect["UF_BRIDGESTONE"] == 5)?"Y":"N";
	$arResult[$arSect["ID"]]["UF_UNCONDITIONAL_GUARANT"] 	= ($arSect["UF_UNCONDITIONAL_GUARANT"] == 7)?"Y":"N";
	$arResult[$arSect["ID"]]["SHOW_PRICE"] = ($arSect["UF_SHOW_PRICE"] == true)?"Y":"N";
}

$arSetionsId = [];
foreach ($arResult['ITEMS'] as $item) {
    array_push($arSetionsId, $item["~IBLOCK_SECTION_ID"]);
}
$arSetionsId = array_unique($arSetionsId);

foreach ($arSetionsId as $sectionId) {
    $resSection = CIBlockSection::GetNavChain(false, $sectionId);
    while ($section = $resSection->GetNext()) {
        array_push($arSetionsId, $section["ID"]);
    }
}
$arSetionsId = array_unique($arSetionsId);

$entityClass = \SP\MainClass::getHighloadBlockEntityClass(HLBLOCK_SECTIONS_DISCOUNTS);
$sectionsDiscounts = $entityClass::getList([
    'select' => ['UF_DISCOUNT', 'UF_ID_SECTION'],
    'filter' => ['UF_ID_SECTION' => $arSetionsId]
]);

while ($discount = $sectionsDiscounts->Fetch()) {
    $sectionId = (string)$discount['UF_ID_SECTION'];
    $arDisounts[$sectionId] = $discount['UF_DISCOUNT'];
}

foreach ($arResult['ITEMS'] as &$item) {
    $resSection = CIBlockSection::GetNavChain(false, $item["~IBLOCK_SECTION_ID"]);
    while ($section = $resSection->GetNext()) {
        if (array_key_exists($section["ID"], $arDisounts)) {
            $discountValuePrec = $arDisounts[$section["ID"]];
        };
    }

    if (isset($discountValuePrec)) {
        $price = $item['ITEM_PRICES'][$item['ITEM_PRICE_SELECTED']]['UNROUND_BASE_PRICE'];
        $currentPriceWithExchange = (int)$price * (100 - $discountValuePrec) / 100;
        $item['ITEM_PRICES'][$item['ITEM_PRICE_SELECTED']]["PRICE_WITH_EXCHANGE"] = $currentPriceWithExchange;
    }

    unset($discountValuePrec);
}