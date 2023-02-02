<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    "basket",
    array(
        "ACTION_VARIABLE" => "basketAction",
        "ADDITIONAL_PICT_PROP_26" => "-",
        "AUTO_CALCULATION" => "Y",
        "BASKET_IMAGES_SCALING" => "adaptive",
        "COLUMNS_LIST_EXT" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DISCOUNT",
            2 => "DELETE",
            3 => "DELAY",
            4 => "SUM",
        ),
        "COLUMNS_LIST_MOBILE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DISCOUNT",
            2 => "DELETE",
            3 => "DELAY",
            4 => "SUM",
        ),
        "COMPATIBLE_MODE" => "N",
        "CORRECT_RATIO" => "Y",
        "DEFERRED_REFRESH" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_MODE" => "extended",
        "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
        "GIFTS_CONVERT_CURRENCY" => "N",
        "GIFTS_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_HIDE_NOT_AVAILABLE" => "N",
        "GIFTS_MESS_BTN_BUY" => "Выбрать",
        "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
        "GIFTS_PAGE_ELEMENT_COUNT" => "4",
        "GIFTS_PLACE" => "BOTTOM",
        "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
        "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
        "GIFTS_SHOW_IMAGE" => "Y",
        "GIFTS_SHOW_NAME" => "Y",
        "GIFTS_SHOW_OLD_PRICE" => "N",
        "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
        "HIDE_COUPON" => $arParams['HIDE_COUPON'],
        "LABEL_PROP" => array(
        ),
        "LABEL_PROP_MOBILE" => "",
        "LABEL_PROP_POSITION" => "",
        "PATH_TO_ORDER" => "/personal/order/",
        "PRICE_DISPLAY_MODE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
        "QUANTITY_FLOAT" => "N",
        "SET_TITLE" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_FILTER" => "N",
        "SHOW_RESTORE" => "N",
        "TEMPLATE_THEME" => "blue",
        "TOTAL_BLOCK_DISPLAY" => array(
            0 => "bottom",
        ),
        "USE_DYNAMIC_SCROLL" => "Y",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "USE_GIFTS" => "N",
        "USE_PREPAYMENT" => "N",
        "USE_PRICE_ANIMATION" => "N",
        "COMPONENT_TEMPLATE" => "basket",
        'ORDER_INTEGRATED' => 'Y',
    ),
    false
);
