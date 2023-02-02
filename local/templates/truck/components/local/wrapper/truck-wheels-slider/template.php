<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

$shtormauto  = Shtormauto::getInstance();
$priceId     = $shtormauto->getCurrentCityPriceId();
$priceName   = [$shtormauto->getCurrentCityPriceName()];
$sectionCode = 'diski';

global $wheelsSliderFilter;

$wheelsSliderFilter = [
    '!PROPERTY_SHOWMAIN'         => false,
    '>CATALOG_PRICE_' . $priceId => 0,
    'SECTION_CODE'               => $sectionCode,
    'INCLUDE_SUBSECTIONS'        => 'Y',
];

?>
<div class="truck-disc-bg wheels-slider-box">
    <div class="container clearfix">
        <div class="disc-tires">

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="row fix-padding">
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
                            "CACHE_TIME"                 => "3600",
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
                            "FILTER_NAME"                => 'wheelsSliderFilter',
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
                            "SLIDER_TITLE"               => "Грузовые диски",
                            "TEMPLATE_THEME"             => "blue",
                            "USE_ENHANCED_ECOMMERCE"     => "N",
                            "USE_PRICE_COUNT"            => "N",
                            "USE_PRODUCT_QUANTITY"       => "Y",
                            "VIEW_MODE"                  => "SECTION",
                            'SLIDER_CONTAINER'           => 'wheels-slider-box',
                        )
                    );?>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-4 search-tires search-disc search-disc-mob">
                <?
                $APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"small-filter", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"FILTER_NAME" => "wheelsSmallFilter",
		"HIDE_NOT_AVAILABLE" => "Y",
		"IBLOCK_ID" => IBLOCK_ID__TRUCK_CATALOG,
		"IBLOCK_TYPE" => "catalog",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PRICE_CODE" => array(
		),
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => $sectionCode,
		"SECTION_DESCRIPTION" => "-",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
		"CONTAINER_TITLE" => "Поиск дисков",
		"BTN_SET_FILTER_ID" => "set_filter_disc",
		"COMPONENT_TEMPLATE" => "small-filter",
		"PREFILTER_NAME" => "smartPreFilter",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE_PATH" => "",
		"SMART_FILTER_PATH" => "",
		"XML_EXPORT" => "N"
	),
	false
);
                ?>
            </div>

        </div>
    </div>
</div>