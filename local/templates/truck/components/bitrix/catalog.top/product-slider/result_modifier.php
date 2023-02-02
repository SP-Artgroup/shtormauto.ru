<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogTopComponent $component
 */

use Bitrix\Main\Localization\Loc;
use SP\Shop as SPShop;
use SP\City;

$component = $this->getComponent();
$arParams  = $component->applyTemplateModifications();

$this->includeLangFile('template.php');

$positionClassMap = array(
    'left'   => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right'  => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top'    => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
    {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
    }
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
    {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
    }
}

$arParams['~MESS_BTN_BUY']                = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL']             = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE']            = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE']          = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET']      = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE']          = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY']      = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCT_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCT_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW']  = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCT_CATALOG_RELATIVE_QUANTITY_FEW');

$generalParams = array(
    'SHOW_DISCOUNT_PERCENT'        => $arParams['SHOW_DISCOUNT_PERCENT'],
    'PRODUCT_DISPLAY_MODE'         => $arParams['PRODUCT_DISPLAY_MODE'],
    'SHOW_MAX_QUANTITY'            => $arParams['SHOW_MAX_QUANTITY'],
    'RELATIVE_QUANTITY_FACTOR'     => $arParams['RELATIVE_QUANTITY_FACTOR'],
    'MESS_SHOW_MAX_QUANTITY'       => $arParams['~MESS_SHOW_MAX_QUANTITY'],
    'MESS_RELATIVE_QUANTITY_MANY'  => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
    'MESS_RELATIVE_QUANTITY_FEW'   => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
    'SHOW_OLD_PRICE'               => $arParams['SHOW_OLD_PRICE'],
    'USE_PRODUCT_QUANTITY'         => $arParams['USE_PRODUCT_QUANTITY'],
    'PRODUCT_QUANTITY_VARIABLE'    => $arParams['PRODUCT_QUANTITY_VARIABLE'],
    'ADD_TO_BASKET_ACTION'         => $arParams['ADD_TO_BASKET_ACTION'],
    'ADD_PROPERTIES_TO_BASKET'     => $arParams['ADD_PROPERTIES_TO_BASKET'],
    'PRODUCT_PROPS_VARIABLE'       => $arParams['PRODUCT_PROPS_VARIABLE'],
    'SHOW_CLOSE_POPUP'             => $arParams['SHOW_CLOSE_POPUP'],
    'DISPLAY_COMPARE'              => $arParams['DISPLAY_COMPARE'],
    'COMPARE_PATH'                 => $arParams['COMPARE_PATH'],
    'COMPARE_NAME'                 => $arParams['COMPARE_NAME'],
    'PRODUCT_SUBSCRIPTION'         => $arParams['PRODUCT_SUBSCRIPTION'],
    'PRODUCT_BLOCKS_ORDER'         => $arParams['PRODUCT_BLOCKS_ORDER'],
    'LABEL_POSITION_CLASS'         => $labelPositionClass,
    'DISCOUNT_POSITION_CLASS'      => $discountPositionClass,
    'SLIDER_INTERVAL'              => $arParams['SLIDER_INTERVAL'],
    'SLIDER_PROGRESS'              => $arParams['SLIDER_PROGRESS'],
    '~BASKET_URL'                  => $arParams['~BASKET_URL'],
    '~ADD_URL_TEMPLATE'            => $arResult['~ADD_URL_TEMPLATE'],
    '~BUY_URL_TEMPLATE'            => $arResult['~BUY_URL_TEMPLATE'],
    '~COMPARE_URL_TEMPLATE'        => $arResult['~COMPARE_URL_TEMPLATE'],
    '~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
    'TEMPLATE_THEME'               => $arParams['TEMPLATE_THEME'],
    'USE_ENHANCED_ECOMMERCE'       => $arParams['USE_ENHANCED_ECOMMERCE'],
    'DATA_LAYER_NAME'              => $arParams['DATA_LAYER_NAME'],
    'BRAND_PROPERTY'               => $arParams['BRAND_PROPERTY'],
    'MESS_BTN_BUY'                 => $arParams['~MESS_BTN_BUY'],
    'MESS_BTN_DETAIL'              => $arParams['~MESS_BTN_DETAIL'],
    'MESS_BTN_COMPARE'             => $arParams['~MESS_BTN_COMPARE'],
    'MESS_BTN_SUBSCRIBE'           => $arParams['~MESS_BTN_SUBSCRIBE'],
    'MESS_BTN_ADD_TO_BASKET'       => $arParams['~MESS_BTN_ADD_TO_BASKET'],
    'MESS_NOT_AVAILABLE'           => $arParams['~MESS_NOT_AVAILABLE']
);

$arResult['TPL_DATA'] = [
    'positionClassMap' => $positionClassMap,
    'generalParams'    => $generalParams,
];

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
$arResult["CITIES_LIST"] = City::getAllCities();