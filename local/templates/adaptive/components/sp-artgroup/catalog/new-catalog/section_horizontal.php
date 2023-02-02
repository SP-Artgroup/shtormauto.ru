<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

use Bitrix\Main\Loader;
use Bitrix\Iblock\SectionTable;
use SP\Component as SPComponent;
use SP\Catalog as SPCatalog;
use SP\City as SPCity;

Loader::includeModule('iblock');

// Является ли текущий раздел подразделом автошин

$isTireSection = in_array($arResult['VARIABLES']['SECTION_CODE'], SPCatalog::getTireSectionsCodes());

// Сортировка по цене

$sortOrder = !empty($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc'])
	? $_GET['sort']
	: null;

if ($isTireSection) {
    $arParams['ELEMENT_SORT_FIELD2'] = $arParams['ELEMENT_SORT_FIELD'];
    $arParams['ELEMENT_SORT_ORDER2'] = $arParams['ELEMENT_SORT_ORDER'];
    $arParams['ELEMENT_SORT_FIELD']  = 'PROPERTY_SEZONNOST';
    $arParams['ELEMENT_SORT_ORDER']  = 'desc';
}

if ($sortOrder) {

    if ($isTireSection) {
        $arParams['ELEMENT_SORT_ORDER2']  = $sortOrder . ',nulls';
    } else {
        $arParams['ELEMENT_SORT_ORDER']  = $sortOrder . ',nulls';
    }
}

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] === 'Y') {
    $basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
} else {
    $basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}

if (!$isTireSection && !isset($_REQUEST['FILTER'])) {

    $arParams['INCLUDE_SUBSECTIONS'] = 'N';

    $APPLICATION->IncludeComponent(
        'bitrix:catalog.section.list',
        'goods',
        [
            'IBLOCK_TYPE'        => $arParams['IBLOCK_TYPE'],
            'IBLOCK_ID'          => $arParams['IBLOCK_ID'],
            'SECTION_ID'         => $arResult['VARIABLES']['SECTION_ID'],
            'SECTION_CODE'       => $arResult['VARIABLES']['SECTION_CODE'],
            'CACHE_TYPE'         => $arParams['CACHE_TYPE'],
            'CACHE_TIME'         => $arParams['CACHE_TIME'],
            'CACHE_GROUPS'       => $arParams['CACHE_GROUPS'],
            'COUNT_ELEMENTS'     => $arParams['SECTION_COUNT_ELEMENTS'],
            'TOP_DEPTH'          => $arParams['SECTION_TOP_DEPTH'],
            'SECTION_URL'        => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
            'VIEW_MODE'          => $arParams['SECTIONS_VIEW_MODE'],
            'SHOW_PARENT_NAME'   => $arParams['SECTIONS_SHOW_PARENT_NAME'],
            'HIDE_SECTION_NAME'  => (isset($arParams['SECTIONS_HIDE_SECTION_NAME']) ? $arParams['SECTIONS_HIDE_SECTION_NAME'] : 'N'),
            'ADD_SECTIONS_CHAIN' => 'N',
            "SECTION_FIELDS"     => array("NAME", "PICTURE", "DESCRIPTION", "UF_HIDE"),
        ],
        $component,
        ['HIDE_ICONS' => 'Y']
    );
}

$catalogFilter = &$GLOBALS[$arParams['FILTER_NAME']];

if (empty($_REQUEST['show_in_other_city'])) {

    $availableFilter = SPComponent::getAvailableProductsFilter();

    $catalogFilter = is_array($catalogFilter)
        ? array_merge($catalogFilter, $availableFilter)
        : $availableFilter;
}

// $catalogFilter["ACTIVE"] = "Y";

// Фильтр показать в других городах

if (isset($_REQUEST['show_in_other_city']) && $_REQUEST['show_in_other_city'] == 1) {

    $otherCityFiltered = true;

    $cityList    = SPCity::getAllCities();
    $currentCity = SPCity::getCurrentCityData();

    foreach ($cityList as $city) {

        $store_filter = ['LOGIC' => 'OR'];

        if ($city['ID'] != $currentCity['ID']) {

            $store_filter['!CATALOG_PRICE_' . $city['PROPERTY_PRICE_ID_VALUE']] = false;

            foreach ($city['PROPERTY_STORE_ID_VALUE'] as $store_id) {
                $store_filter[] = ['>CATALOG_STORE_AMOUNT_' . $store_id => 0];
            }
        }

        $catalogFilter[] = $store_filter;
    }

}

// Фильтр по характеристикам шин и дисков

if (!empty($_GET['FILTER'])) {

    $propsFiltered = true;

    foreach ($_GET['FILTER'] as $fcode => $fvalue) {

        if (!empty($fvalue)) {
            $catalogFilter['PROPERTY_' . $fcode] = $fvalue;
        }
    }
}

$intSectionID = $APPLICATION->IncludeComponent(
    'bitrix:catalog.section',
    'catalog-section',
    [
        'IBLOCK_TYPE'                     => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID'                       => $arParams['IBLOCK_ID'],
        'ELEMENT_SORT_FIELD'              => $arParams['ELEMENT_SORT_FIELD'],
        'ELEMENT_SORT_ORDER'              => $arParams['ELEMENT_SORT_ORDER'],
        'ELEMENT_SORT_FIELD2'             => $arParams['ELEMENT_SORT_FIELD2'],
        'ELEMENT_SORT_ORDER2'             => $arParams['ELEMENT_SORT_ORDER2'],
        'PROPERTY_CODE'                   => $arParams['LIST_PROPERTY_CODE'],
        'PROPERTY_CODE_MOBILE'            => $arParams['LIST_PROPERTY_CODE_MOBILE'],
        'META_KEYWORDS'                   => $arParams['LIST_META_KEYWORDS'],
        'META_DESCRIPTION'                => $arParams['LIST_META_DESCRIPTION'],
        'BROWSER_TITLE'                   => $arParams['LIST_BROWSER_TITLE'],
        'SET_LAST_MODIFIED'               => $arParams['SET_LAST_MODIFIED'],
        'INCLUDE_SUBSECTIONS'             => $arParams['INCLUDE_SUBSECTIONS'],
        'BASKET_URL'                      => $arParams['BASKET_URL'],
        'ACTION_VARIABLE'                 => $arParams['ACTION_VARIABLE'],
        'PRODUCT_ID_VARIABLE'             => $arParams['PRODUCT_ID_VARIABLE'],
        'SECTION_ID_VARIABLE'             => $arParams['SECTION_ID_VARIABLE'],
        'PRODUCT_QUANTITY_VARIABLE'       => $arParams['PRODUCT_QUANTITY_VARIABLE'],
        'PRODUCT_PROPS_VARIABLE'          => $arParams['PRODUCT_PROPS_VARIABLE'],
        'FILTER_NAME'                     => $arParams['FILTER_NAME'],
        'CACHE_TYPE'                      => $arParams['CACHE_TYPE'],
        'CACHE_TIME'                      => $arParams['CACHE_TIME'],
        'CACHE_FILTER'                    => $arParams['CACHE_FILTER'],
        'CACHE_GROUPS'                    => $arParams['CACHE_GROUPS'],
        'SET_TITLE'                       => $arParams['SET_TITLE'],
        'MESSAGE_404'                     => $arParams['~MESSAGE_404'],
        'SET_STATUS_404'                  => $arParams['SET_STATUS_404'],
        'SHOW_404'                        => $arParams['SHOW_404'],
        'FILE_404'                        => $arParams['FILE_404'],
        'DISPLAY_COMPARE'                 => $arParams['USE_COMPARE'],
        'PAGE_ELEMENT_COUNT'              => $arParams['PAGE_ELEMENT_COUNT'],
        'LINE_ELEMENT_COUNT'              => $arParams['LINE_ELEMENT_COUNT'],
        'PRICE_CODE'                      => $arParams['PRICE_CODE'],
        'USE_PRICE_COUNT'                 => $arParams['USE_PRICE_COUNT'],
        'SHOW_PRICE_COUNT'                => $arParams['SHOW_PRICE_COUNT'],

        'PRICE_VAT_INCLUDE'               => $arParams['PRICE_VAT_INCLUDE'],
        'USE_PRODUCT_QUANTITY'            => $arParams['USE_PRODUCT_QUANTITY'],
        'ADD_PROPERTIES_TO_BASKET'        => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
        'PARTIAL_PRODUCT_PROPERTIES'      => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
        'PRODUCT_PROPERTIES'              => $arParams['PRODUCT_PROPERTIES'],

        'DISPLAY_TOP_PAGER'               => $arParams['DISPLAY_TOP_PAGER'],
        'DISPLAY_BOTTOM_PAGER'            => $arParams['DISPLAY_BOTTOM_PAGER'],
        'PAGER_TITLE'                     => $arParams['PAGER_TITLE'],
        'PAGER_SHOW_ALWAYS'               => $arParams['PAGER_SHOW_ALWAYS'],
        'PAGER_TEMPLATE'                  => $arParams['PAGER_TEMPLATE'],
        'PAGER_DESC_NUMBERING'            => $arParams['PAGER_DESC_NUMBERING'],
        'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
        'PAGER_SHOW_ALL'                  => $arParams['PAGER_SHOW_ALL'],
        'PAGER_BASE_LINK_ENABLE'          => $arParams['PAGER_BASE_LINK_ENABLE'],
        'PAGER_BASE_LINK'                 => $arParams['PAGER_BASE_LINK'],
        'PAGER_PARAMS_NAME'               => $arParams['PAGER_PARAMS_NAME'],
        'LAZY_LOAD'                       => $arParams['LAZY_LOAD'],
        'MESS_BTN_LAZY_LOAD'              => $arParams['~MESS_BTN_LAZY_LOAD'],
        'LOAD_ON_SCROLL'                  => $arParams['LOAD_ON_SCROLL'],

        'OFFERS_CART_PROPERTIES'          => $arParams['OFFERS_CART_PROPERTIES'],
        'OFFERS_FIELD_CODE'               => $arParams['LIST_OFFERS_FIELD_CODE'],
        'OFFERS_PROPERTY_CODE'            => $arParams['LIST_OFFERS_PROPERTY_CODE'],
        'OFFERS_SORT_FIELD'               => $arParams['OFFERS_SORT_FIELD'],
        'OFFERS_SORT_ORDER'               => $arParams['OFFERS_SORT_ORDER'],
        'OFFERS_SORT_FIELD2'              => $arParams['OFFERS_SORT_FIELD2'],
        'OFFERS_SORT_ORDER2'              => $arParams['OFFERS_SORT_ORDER2'],
        'OFFERS_LIMIT'                    => $arParams['LIST_OFFERS_LIMIT'],

        'SECTION_ID'                      => $arResult['VARIABLES']['SECTION_ID'],
        'SECTION_CODE'                    => $arResult['VARIABLES']['SECTION_CODE'],
        'SECTION_URL'                     => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
        'DETAIL_URL'                      => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['element'],
        'USE_MAIN_ELEMENT_SECTION'        => $arParams['USE_MAIN_ELEMENT_SECTION'],
        'CONVERT_CURRENCY'                => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID'                     => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE'              => $arParams['HIDE_NOT_AVAILABLE'],
        'HIDE_NOT_AVAILABLE_OFFERS'       => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

        'LABEL_PROP'                      => $arParams['LABEL_PROP'],
        'LABEL_PROP_MOBILE'               => $arParams['LABEL_PROP_MOBILE'],
        'LABEL_PROP_POSITION'             => $arParams['LABEL_PROP_POSITION'],
        'ADD_PICT_PROP'                   => $arParams['ADD_PICT_PROP'],
        'PRODUCT_DISPLAY_MODE'            => $arParams['PRODUCT_DISPLAY_MODE'],
        'PRODUCT_BLOCKS_ORDER'            => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
        'PRODUCT_ROW_VARIANTS'            => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
        'ENLARGE_PRODUCT'                 => $arParams['LIST_ENLARGE_PRODUCT'],
        'ENLARGE_PROP'                    => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
        'SHOW_SLIDER'                     => $arParams['LIST_SHOW_SLIDER'],
        'SLIDER_INTERVAL'                 => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
        'SLIDER_PROGRESS'                 => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

        'OFFER_ADD_PICT_PROP'             => $arParams['OFFER_ADD_PICT_PROP'],
        'OFFER_TREE_PROPS'                => $arParams['OFFER_TREE_PROPS'],
        'PRODUCT_SUBSCRIPTION'            => $arParams['PRODUCT_SUBSCRIPTION'],
        'SHOW_DISCOUNT_PERCENT'           => $arParams['SHOW_DISCOUNT_PERCENT'],
        'DISCOUNT_PERCENT_POSITION'       => $arParams['DISCOUNT_PERCENT_POSITION'],
        'SHOW_OLD_PRICE'                  => $arParams['SHOW_OLD_PRICE'],
        'SHOW_MAX_QUANTITY'               => $arParams['SHOW_MAX_QUANTITY'],
        'MESS_SHOW_MAX_QUANTITY'          => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
        'RELATIVE_QUANTITY_FACTOR'        => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
        'MESS_RELATIVE_QUANTITY_MANY'     => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
        'MESS_RELATIVE_QUANTITY_FEW'      => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
        'MESS_BTN_BUY'                    => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
        'MESS_BTN_ADD_TO_BASKET'          => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
        'MESS_BTN_SUBSCRIBE'              => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
        'MESS_BTN_DETAIL'                 => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
        'MESS_NOT_AVAILABLE'              => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
        'MESS_BTN_COMPARE'                => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

        'USE_ENHANCED_ECOMMERCE'          => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
        'DATA_LAYER_NAME'                 => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
        'BRAND_PROPERTY'                  => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

        'TEMPLATE_THEME'                  => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
        'ADD_SECTIONS_CHAIN'              => 'Y',
        'ADD_TO_BASKET_ACTION'            => $basketAction,
        'SHOW_CLOSE_POPUP'                => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
        'COMPARE_PATH'                    => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
        'COMPARE_NAME'                    => $arParams['COMPARE_NAME'],
        'BACKGROUND_IMAGE'                => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
        'COMPATIBLE_MODE'                 => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
        'DISABLE_INIT_JS_IN_COMPONENT'    => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
        'SHOW_SORT'                       => 'Y',
        'PROPS_FILTERED'                  => $propsFiltered,
        'OTHER_CITY_FILTERED'             => $otherCityFiltered,
    ],
    $component,
    ['HIDE_ICONS' => 'Y']
);

unset($basketAction);
