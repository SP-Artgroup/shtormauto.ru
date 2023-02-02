<?php

$GLOBALS['RECOMENDED_FILTER'] = SP\Component::getAvailableProductsFilter();

$GLOBALS['RECOMENDED_FILTER']['PROPERTY_RECOMENDED'] = 'Y';

$priceCode = Shtormauto::getInstance()->getCurrentCityPriceName();



$APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "slider",
    Array(
        "ACTION_VARIABLE"            => "action",
        "ADD_PICT_PROP"              => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET"   => "Y",
        "ADD_TO_BASKET_ACTION"       => "ADD",
        "BASKET_URL"                 => "/personal/basket.php",
        "CACHE_FILTER"               => "Y",
        "CACHE_GROUPS"               => "N",
        "CACHE_TIME"                 => "36000000",
        "CACHE_TYPE"                 => "A",
        "COMPARE_NAME"               => "CATALOG_COMPARE_LIST",
        "COMPATIBLE_MODE"            => "N",
        "COMPONENT_TEMPLATE"         => "slider",
        "CONVERT_CURRENCY"           => "N",
        "CUSTOM_FILTER"              => "",
        "DETAIL_URL"                 => "",
        "DISPLAY_COMPARE"            => "N",
        "ELEMENT_COUNT"              => "9",
        "ELEMENT_SORT_FIELD"         => "sort",
        "ELEMENT_SORT_FIELD2"        => "id",
        "ELEMENT_SORT_ORDER"         => "asc",
        "ELEMENT_SORT_ORDER2"        => "desc",
        "ENLARGE_PRODUCT"            => "STRICT",
        "FILTER_NAME"                => "RECOMENDED_FILTER",
        "HIDE_NOT_AVAILABLE"         => "Y",
        "HIDE_NOT_AVAILABLE_OFFERS"  => "Y",
        "IBLOCK_ID"                  => "26",
        "IBLOCK_TYPE"                => "catalog",
        "LABEL_PROP"                 => array(),
        "LABEL_PROP_MOBILE"          => "",
        "LABEL_PROP_POSITION"        => "top-left",
        "LINE_ELEMENT_COUNT"         => "3",
        "MESS_BTN_ADD_TO_BASKET"     => "В корзину",
        "MESS_BTN_BUY"               => "Купить",
        "MESS_BTN_COMPARE"           => "Сравнить",
        "MESS_BTN_DETAIL"            => "Подробнее",
        "MESS_NOT_AVAILABLE"         => "Нет в наличии",
        "OFFERS_LIMIT"               => "5",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE"                 => array(0=>$priceCode),
        "PRICE_VAT_INCLUDE"          => "Y",
        "PRODUCT_BLOCKS_ORDER"       => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "PRODUCT_ID_VARIABLE"        => "id",
        "PRODUCT_PROPERTIES"         => array(),
        "PRODUCT_PROPS_VARIABLE"     => "prop",
        "PRODUCT_QUANTITY_VARIABLE"  => "quantity",
        "PRODUCT_ROW_VARIANTS"       => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION"       => "Y",
        "PROPERTY_CODE"              => array(0=>"",1=>"",),
        "PROPERTY_CODE_MOBILE"       => array(),
        "ROTATE_TIMER"               => "30",
        "SECTION_URL"                => "",
        "SEF_MODE"                   => "N",
        "SHOW_CLOSE_POPUP"           => "N",
        "SHOW_DISCOUNT_PERCENT"      => "N",
        "SHOW_MAX_QUANTITY"          => "N",
        "SHOW_OLD_PRICE"             => "Y",
        "SHOW_PAGINATION"            => "Y",
        "SHOW_PRICE_COUNT"           => "1",
        "SHOW_SLIDER"                => "N",
        "SLIDER_INTERVAL"            => "3000",
        "SLIDER_PROGRESS"            => "N",
        "TEMPLATE_THEME"             => "blue",
        "USE_ENHANCED_ECOMMERCE"     => "N",
        "USE_PRICE_COUNT"            => "N",
        "USE_PRODUCT_QUANTITY"       => "N",
        "VIEW_MODE"                  => "SECTION"
    )
);