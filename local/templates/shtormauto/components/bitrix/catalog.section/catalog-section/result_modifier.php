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
}
if(isset($_REQUEST['PAGEN_1']) && !empty($_REQUEST['PAGEN_1'])){
    $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] = $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"].' | Страница '.$_REQUEST['PAGEN_1'];
    $arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"] = 'Страница '.$_REQUEST['PAGEN_1'].' | '.$arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"];
    $arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"] = $arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"].' Страница '.$_REQUEST['PAGEN_1'];
}