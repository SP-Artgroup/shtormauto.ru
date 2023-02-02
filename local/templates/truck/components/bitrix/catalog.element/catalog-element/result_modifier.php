<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

use Bitrix\Main\Localization\Loc;
use SP\Shop;
use SP\City;

$component = $this->getComponent();
$arParams  = $component->applyTemplateModifications();

$this->includeLangFile('template.php');

$templateLibrary = ['popup', 'fx'];
$currencyList    = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList      = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$productId     = $arResult['ID'];
$currentCityId = City::getCurrentCityId();
$currentPrice  = $arResult['ITEM_PRICES'][$arResult['ITEM_PRICE_SELECTED']];

$templateData = [
    'TEMPLATE_THEME'   => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES'       => $currencyList,
    'ITEM'             => [
        'ID'              => $arResult['ID'],
        'IBLOCK_ID'       => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS'       => $arResult['JS_OFFERS'],
    ],
];

unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID'                    => $mainId,
    'DISCOUNT_PERCENT_ID'   => $mainId . '_dsc_pict',
    'STICKER_ID'            => $mainId . '_sticker',
    'BIG_SLIDER_ID'         => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID'       => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID'        => $mainId . '_slider_cont',
    'OLD_PRICE_ID'          => $mainId . '_old_price',
    'PRICE_ID'              => $mainId . '_price',
    'DISCOUNT_PRICE_ID'     => $mainId . '_price_discount',
    'PRICE_TOTAL'           => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID'     => $mainId . '_slider_cont_',
    'QUANTITY_ID'           => $mainId . '_quantity',
    'QUANTITY_DOWN_ID'      => $mainId . '_quant_down',
    'QUANTITY_UP_ID'        => $mainId . '_quant_up',
    'QUANTITY_MEASURE'      => $mainId . '_quant_measure',
    'QUANTITY_LIMIT'        => $mainId . '_quant_limit',
    'BUY_LINK'              => $mainId . '_buy_link',
    'ADD_BASKET_LINK'       => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID'     => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS'    => $mainId . '_not_avail',
    'COMPARE_LINK'          => $mainId . '_compare_link',
    'TREE_ID'               => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV'      => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP'           => $mainId . '_set_group_',
    'BASKET_PROP_DIV'       => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK'        => $mainId . '_subscribe',
    'TABS_ID'               => $mainId . '_tabs',
    'TAB_CONTAINERS_ID'     => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID'   => $mainId . '_small_card_panel',
    'TABS_PANEL_ID'         => $mainId . '_tabs_panel',
    'SHOP_SELECT'           => '.js-shop-select',
);

$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);

$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];

$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];

$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$langPrefix = 'CT_BCE_CATALOG_';

foreach ([
    'BTN_BUY',
    'BTN_ADD_TO_BASKET',
    'NOT_AVAILABLE',
    'BTN_COMPARE',
    'PRICE_RANGES_TITLE',
    'DESCRIPTION_TAB',
    'PROPERTIES_TAB',
    'COMMENTS_TAB',
    'SHOW_MAX_QUANTITY',
    'RELATIVE_QUANTITY_MANY',
    'RELATIVE_QUANTITY_FEW',
] as $msgCode) {
    $paramCode = 'MESS_' . $msgCode;
    $arParams[$paramCode] = $arParams[$paramCode]
        ?: Loc::getMessage($langPrefix . $msgCode);
}

$positionClassMap = array(
    'left'   => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right'  => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top'    => 'product-item-label-top'
);

// =================

// Получение данных для вывода списка складов

$shopIds = Shop::getCityShops();
$shops   = Shop::getShopData($shopIds);
$amounts = Shop::getProductAmount($productId, $shopIds);

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

$cities_list   = City::getAllCities();
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

    $cityShopIds = Shop::getCityShops($city['ID']);

    array_push($allShopIds, ...$cityShopIds);

    $citiesByShops += array_fill_keys(
        $cityShopIds,
        $city['ID']
    );
}

$tmpAmounts = Shop::getProductAmount($productId, $allShopIds);
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

if ($haveOffers)
{
    $offerIds = array();
    $offerCodes = array();

    $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

    foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer)
    {
        $offerIds[] = (int)$jsOffer['ID'];
        $offerCodes[] = $jsOffer['CODE'];

        $fullOffer = $arResult['OFFERS'][$ind];
        $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

        $strAllProps = '';
        $strMainProps = '';
        $strPriceRangesRatio = '';
        $strPriceRanges = '';

        if ($arResult['SHOW_OFFERS_PROPS'])
        {
            if (!empty($jsOffer['DISPLAY_PROPERTIES']))
            {
                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property)
                {
                    $current = '<dt>'.$property['NAME'].'</dt><dd>'.(
                        is_array($property['VALUE'])
                            ? implode(' / ', $property['VALUE'])
                            : $property['VALUE']
                        ).'</dd>';
                    $strAllProps .= $current;

                    if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']]))
                    {
                        $strMainProps .= $current;
                    }
                }

                unset($current);
            }
        }

        if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1)
        {
            $strPriceRangesRatio = '('.Loc::getMessage(
                    'CT_BCE_CATALOG_RATIO_PRICE',
                    array('#RATIO#' => ($useRatio
                            ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
                            : '1'
                        ).' '.$measureName)
                ).')';

            foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range)
            {
                if ($range['HASH'] !== 'ZERO-INF')
                {
                    $itemPrice = false;

                    foreach ($jsOffer['ITEM_PRICES'] as $itemPrice)
                    {
                        if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
                        {
                            break;
                        }
                    }

                    if ($itemPrice)
                    {
                        $strPriceRanges .= '<dt>'.Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_FROM',
                                array('#FROM#' => $range['SORT_FROM'].' '.$measureName)
                            ).' ';

                        if (is_infinite($range['SORT_TO']))
                        {
                            $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                        }
                        else
                        {
                            $strPriceRanges .= Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_TO',
                                array('#TO#' => $range['SORT_TO'].' '.$measureName)
                            );
                        }

                        $strPriceRanges .= '</dt><dd>'.($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']).'</dd>';
                    }
                }
            }

            unset($range, $itemPrice);
        }

        $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
        $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
        $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
        $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
    }

    $templateData['OFFER_IDS'] = $offerIds;
    $templateData['OFFER_CODES'] = $offerCodes;
    unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'VISUAL' => $itemIds,
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'NAME' => $arResult['~NAME'],
            'CATEGORY' => $arResult['CATEGORY_PATH']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $skuProps
    );
}
else
{

    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);

    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {

        if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {

            foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                unset($arResult['PRODUCT_PROPERTIES'][$propId]);
            }
        }

        $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    }

    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null
        ),
        'VISUAL' => $itemIds,
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'PICT' => reset($arResult['MORE_PHOTO']),
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
            'ITEM_PRICES' => $arResult['ITEM_PRICES'],
            'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
            'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
            'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
            'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
            'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
            'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
            'CATEGORY' => $arResult['CATEGORY_PATH']
        ),
        'BASKET' => array(
            'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
    );
    unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE'])
{
    $jsParams['COMPARE'] = array(
        'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
        'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
        'COMPARE_PATH' => $arParams['COMPARE_PATH']
    );
}

// Формирование свойств для главного блока свойств

$mainBlockPropsCodes = [];

if (
    !empty($arResult['DISPLAY_PROPERTIES'])
    && !empty($arParams['MAIN_BLOCK_PROPERTY_CODE'])
) {
    $propCodes = array_keys($arParams['MAIN_BLOCK_PROPERTY_CODE']);

    foreach ($propCodes as $propCode) {

        // Пропускаем несуществующие свойства
        if (!isset($arResult['DISPLAY_PROPERTIES'][$propCode])) {
            continue;
        }

        $mainBlockPropsCodes[] = $propCode;
    }
}

// ====================

$arResult['TPL_DATA'] = [
    'templateData'        => $templateData,
    'itemIds'             => $itemIds,
    'obName'              => $obName,
    'name'                => $name,
    'title'               => $title,
    'alt'                 => $alt,
    'positionClassMap'    => $positionClassMap,
    'jsParams'            => $jsParams,
    'mainBlockPropsCodes' => $mainBlockPropsCodes,
];

$arResult['JS_LANG'] = [
    'RELATIVE_QUANTITY_MANY' => CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']),
    'RELATIVE_QUANTITY_FEW'  => CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']),
    'SITE_ID'                => $component->getSiteId(),
];

foreach ([
    'TITLE_ERROR',
    'TITLE_BASKET_PROPS',
    'BASKET_UNKNOWN_ERROR',
    'BTN_SEND_PROPS',
    'BTN_MESSAGE_BASKET_REDIRECT',
    'BTN_MESSAGE_CLOSE',
    'BTN_MESSAGE_CLOSE_POPUP',
    'BTN_MESSAGE_COMPARE_REDIRECT',
    'PRODUCT_GIFT_LABEL',
    'COMPARE_MESSAGE_OK',
    'TITLE_SUCCESSFUL',
    'COMPARE_UNKNOWN_ERROR',
    'ECONOMY_INFO_MESSAGE',
    'COMPARE_TITLE',
    'PRICE_TOTAL_PREFIX',
] as $langCode) {
    $arResult['JS_LANG'][$langCode] = Loc::getMessage($langPrefix . $langCode);
}
