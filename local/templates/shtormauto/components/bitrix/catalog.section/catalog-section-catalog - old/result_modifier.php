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
);
$rsSect = CIBlockSection::GetList(array('id' => 'asc'), $arFilter, false, array("ID", "UF_EX_GUARANT", "UF_FREE_REPAIR"));
while ($arSect = $rsSect->GetNext()){
    $arResult[$arSect["ID"]]["EX_GUARANT"] = ($arSect["UF_EX_GUARANT"] != '')?"Y":"N";
    $arResult[$arSect["ID"]]["FREE_REPAIR"] = ($arSect["UF_FREE_REPAIR"] != '')?"Y":"N";
}