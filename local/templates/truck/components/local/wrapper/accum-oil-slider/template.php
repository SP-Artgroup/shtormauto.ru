<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

$shtormauto  = Shtormauto::getInstance();
$priceId     = $shtormauto->getCurrentCityPriceId();
$priceName   = [$shtormauto->getCurrentCityPriceName()];
$sectionCode = 'akkumulyatory';

global $accumoilSliderFilter;

$accumoilSliderFilter = [
    '!PROPERTY_SHOWMAIN'         => false,
    '>CATALOG_PRICE_' . $priceId => 0,
    'SECTION_CODE'               => $sectionCode,
    'INCLUDE_SUBSECTIONS'        => 'Y',
];

?>
<div class="akum-bg accum-slider-box">
    <div class="container clearfix only-flex">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="row">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.top",
                    "product-slider",
                    Array(
                        "ACTION_VARIABLE"            => "action",
                        "ADD_PICT_PROP"              => "-",
                        "ADD_PROPERTIES_TO_BASKET"   => "Y",
                        "ADD_TO_BASKET_ACTION"       => "ADD",
                        "BASKET_URL"                 => "/personal/basket/",
                        "CACHE_FILTER"               => "Y",
                        "CACHE_GROUPS"               => "Y",
                        "CACHE_TIME"                 => "36000000",
                        "CACHE_TYPE"                 => "A",
                        "COMPARE_NAME"               => "CATALOG_COMPARE_LIST",
                        "COMPATIBLE_MODE"            => "N",
                        "COMPONENT_TEMPLATE"         => "product-slider",
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
                        "FILTER_NAME"                => 'accumoilSliderFilter',
                        "HIDE_NOT_AVAILABLE"         => "Y",
                        "HIDE_NOT_AVAILABLE_OFFERS"  => "Y",
                        "IBLOCK_ID"                  => IBLOCK_ID__TRUCK_CATALOG,
                        "IBLOCK_TYPE"                => "catalog",
                        "LABEL_PROP"                 => "VYLET_LEGKOVOGO_DISKA_ET",
                        "LINE_ELEMENT_COUNT"         => "3",
                        "MESS_BTN_ADD_TO_BASKET"     => "В корзину",
                        "MESS_BTN_BUY"               => "Купить",
                        "MESS_BTN_COMPARE"           => "Сравнить",
                        "MESS_BTN_DETAIL"            => "Подробнее",
                        "MESS_NOT_AVAILABLE"         => "Нет в наличии",
                        "OFFERS_LIMIT"               => "5",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE"                 => $priceName,
                        "PRICE_VAT_INCLUDE"          => "Y",
                        "PRODUCT_BLOCKS_ORDER"       => "price,props,sku,quantityLimit,quantity,buttons",
                        "PRODUCT_ID_VARIABLE"        => "id",
                        "PRODUCT_PROPERTIES"         => array(),
                        "PRODUCT_PROPS_VARIABLE"     => "prop",
                        "PRODUCT_QUANTITY_VARIABLE"  => "quantity",
                        "PRODUCT_ROW_VARIANTS"       => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION"       => "N",
                        "PROPERTY_CODE"              => array(0=>"",1=>"",),
                        "PROPERTY_CODE_MOBILE"       => array(),
                        "SECTION_URL"                => "",
                        "SEF_MODE"                   => "N",
                        "SHOW_CLOSE_POPUP"           => "N",
                        "SHOW_DISCOUNT_PERCENT"      => "N",
                        "SHOW_MAX_QUANTITY"          => "N",
                        "SHOW_OLD_PRICE"             => "N",
                        "SHOW_PRICE_COUNT"           => "1",
                        "SHOW_SLIDER"                => "N",
                        "SLIDER_INTERVAL"            => "3000",
                        "SLIDER_PROGRESS"            => "N",
                        "SLIDER_TITLE"               => "Аккумуляторы и масла",
                        "SLIDER_CONTAINER"           => 'accum-slider-box',
                        "SLIDER_VARIANT"             => 2,
                        "TEMPLATE_THEME"             => "blue",
                        "USE_ENHANCED_ECOMMERCE"     => "N",
                        "USE_PRICE_COUNT"            => "N",
                        "USE_PRODUCT_QUANTITY"       => "Y",
                        "VIEW_MODE"                  => "SECTION",
                    )
                );?>
            </div>
        </div>

    </div>
</div>