<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

use SP\Shop as SPShop;

$component = $this->getComponent();
$arParams  = $component->applyTemplateModifications();

$productIds = [];

foreach ($arResult['ITEMS'] as $item) {

    if (!empty($item['ITEM_PRICES'])) {
        $productIds[] = $item['ID'];
    }
}

$shops   = SPShop::getShopData(SPShop::getCityShops());
$amounts = SPShop::getProductAmount($productIds);

foreach ($arResult['ITEMS'] as $key => $item) {

    // Пропускаем товары, у которых нет цены
    if (in_array($item['ID'], $productIds)) {

        if (isset($amounts[$item['ID']])) {
            $arResult['ITEMS'][$key]['STORE_DATA'] = [
                'STORES'     => $shops,
                'AMOUNTS'    => $amounts[$item['ID']],
                'PRODUCT_ID' => $item['ID'],
            ];
        } else {
            $arResult['ITEMS'][$key]['CAN_BUY'] = false;
        }
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

$productAmount = SPShop::getProductAmount($productIds, $allShops);

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
$rsSect = CIBlockSection::GetList(array('id' => 'asc'), $arFilter, false, array("ID", "UF_EX_GUARANT", "UF_FREE_REPAIR"));
while ($arSect = $rsSect->GetNext()){
    $arResult[$arSect["ID"]]["EX_GUARANT"] = ($arSect["UF_EX_GUARANT"] != '')?"Y":"N";
    $arResult[$arSect["ID"]]["FREE_REPAIR"] = ($arSect["UF_FREE_REPAIR"] != '')?"Y":"N";
}