<?php

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
use Bitrix\Iblock\Model\Section;
use SP\Component as SPComponent;
use SP\Catalog as SPCatalog;
use SP\City as SPCity;
use SP\Store as SPStore;
$shtormauto = Shtormauto::getInstance();

Loader::includeModule('iblock');

// Является ли текущий раздел подразделом автошин
$isTireSection = (in_array($arResult['VARIABLES']['SECTION_CODE'], SPCatalog::getTireSectionsCodes()) || $GLOBALS["page"][2] == "shiny");

if ($isTireSection) {
    if (1) {
        // Сначала летние
        $arParams['ELEMENT_SORT_FIELD'] = 'PROPERTY_SEZONNOST';
        $arParams['ELEMENT_SORT_ORDER'] = 'desc';        
    } else {
        // Сначала зимние
        $arParams['ELEMENT_SORT_FIELD'] = 'propertysort_SEZONNOST';     // лето - PROPERTY_SEZONNOST, зима - propertysort_SEZONNOST
        $arParams['ELEMENT_SORT_ORDER'] = 'asc, nulls';   // лето - desc, зима - asc, nulls
    }
    $arParams['ELEMENT_SORT_FIELD2'] = 'SORT';
    $arParams['ELEMENT_SORT_ORDER2'] = 'asc';
}
if($GLOBALS["page"][2] == "_akkumulyatory_i_soputstvuyushchee"){
    $arParams['ELEMENT_SORT_FIELD'] = 'SORT';
    $arParams['ELEMENT_SORT_ORDER'] = 'asc';
}
// Картинка раздела для фильтра

$filterImg = SPComponent::getFilterSectionImage((int) $arCurSection['ID']);

$bgImg     = $filterImg
    ? 'style="background-image: url(' . $filterImg . ')"'
    : '';

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] === 'Y') {
    $basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
} else {
    $basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}

$GLOBALS["arrFilter"] = [
    "IBLOCK_ID" => IBLOCK_ID_CATALOG,
    "ACTIVE"    => "Y",
];

$catalogFilter = "arrFilter";
?>
    <aside class="sidebar sidebar--nomargin col-md-4 col-lg-3">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "main_left_catalog", Array(
        "ALLOW_MULTI_SELECT"    => "N", // Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE"       => "catalog",   // Тип меню для остальных уровней
        "DELAY"                 => "N", // Откладывать выполнение шаблона меню
        "MAX_LEVEL"             => "2", // Уровень вложенности меню
        "MENU_CACHE_GET_VARS"   => "",  // Значимые переменные запроса
        "MENU_CACHE_TIME"       => "3600",  // Время кеширования (сек.)
        "MENU_CACHE_TYPE"       => "A", // Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
        "MENU_THEME"            => "site",
        "ROOT_MENU_TYPE"        => "catalog",   // Тип меню для первого уровня
        "USE_EXT"               => "Y", // Подключать файлы с именами вида .тип_меню.menu_ext.php
        "COMPONENT_TEMPLATE"    => "left-catalog"
        ),
        false
        );?>
    </aside>
    <div class="col-md-8 col-lg-9" id="catalog-main-block">
<h1 class="catalog-heading d-none d-sm-block"><?$APPLICATION->ShowViewContent('section_title');?></h1>
<? if (CSite::InDir('/catalog/shiny/') || CSite::InDir('/catalog/_diski/') || CSite::InDir('/catalog/_motoshiny/') || CSite::InDir('/catalog/_akkumulyatory_i_soputstvuyushchee/') || CSite::InDir('/catalog/_avtoshiny_gruzovye/') || CSite::InDir('/catalog/_shiny_atv_kvadrotsikl/') || CSite::InDir('/catalog/3_industrialnye_shiny_2/') || CSite::InDir('/catalog/diski_gruzovye/') ):?>
    <? $filterParams = array(
        "shiny" => array(
            "class" => "filter-item--tire",
            "section_id" => "25453",
            "type" => "tyre",
            "id_properties" => array(),
            "heading" => "Подбор шин"
        ),
        "_diski" => array(
            "class" => "filter-item--disk",
            "section_id" => "25897",
            "type" => "wheel",
            "id_properties" => array(395, 396, 431, 390),
            "heading" => "Подбор дисков"
        ),
        "_motoshiny" => array(
            "class" => "filter-item--mototire",
            "section_id" => "26079",
            "type" => "mototire",
            "id_properties" => array(571, 570, 569),
            "heading" => "Подбор мотошин"
        ),
        "_akkumulyatory_i_soputstvuyushchee" => array(
            "class" => "filter-item--akkumulyatory",
            "section_id" => "25859",
            "type" => "akkumulyatory",
            "id_properties" => array(596, 597, 598, 599, 600, 601, 602),
            "heading" => "Подбор аккумуляторов"
        ),
        "_avtoshiny_gruzovye" => array(
            "class" => "filter-item--tire-gruz",
            "section_id" => "30370",
            "type" => "gruz",
            "id_properties" => array(485, 488, 484),
            "heading" => "Подбор грузовых шин"
        ), 
        "_shiny_atv_kvadrotsikl" => array(
            "class" => "filter-item--tire-shiny_atv",
            "section_id" => "26245",
            "type" => "shiny_atv",
            "id_properties" => array(616,617,618),
            "heading" => "Подбор шин ATV"
        ),
        "3_industrialnye_shiny_2" => array(
            "class" => "filter-item--shiny_industrialnye",
            "section_id" => "30404",
            "type" => "shiny_industrialnye",
            "id_properties" => array(485,488,484),
            "heading" => "Подбор шин для спецтехники"
        ),
        "diski_gruzovye" => array(
            "class" => "filter-item--diski_gruzovye",
            "section_id" => "29270",
            "type" => "diski_gruzovye",
            "id_properties" => array(484, 483, 390, 482),
            "heading" => "Подбор грузовых дисков"
        )

    ); ?>
    <div class="filter-item <?=$filterParams[$GLOBALS['page'][2]]['class']?> filter-item--catalog">
        <h2 class="filter-item__heading"><?=$filterParams[$GLOBALS['page'][2]]['heading']?></h2>
        <?
        if ($_GET["set_filter"]) {
            $catalogFilter = "catalogFilter";
        };

        $catalogSmartFilterTemplate = 'tyre_and_wheel';
$catalogFilte['SORT'] = 'DESC';
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter", 
            $catalogSmartFilterTemplate, 
            array(
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CONVERT_CURRENCY" => "N",
                "DISPLAY_ELEMENT_COUNT" => "N",
                "FILTER_NAME" => "catalogFilter",
                "FILTER_VIEW_MODE" => "vertical",
                "HIDE_NOT_AVAILABLE" => "Y",
                "IBLOCK_ID" => IBLOCK_ID_CATALOG,
                "IBLOCK_TYPE" => "catalog",
                "PAGER_PARAMS_NAME" => "arrPager",
                "POPUP_POSITION" => "",
                "PRICE_CODE" => $arParams['PRICE_CODE'],
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => "",
                "SECTION_DESCRIPTION" => "-",
                "SECTION_ID" => $filterParams[$GLOBALS['page'][2]]['section_id'],
                "SECTION_TITLE" => "-",
                "SEF_MODE" => "N",
                "TEMPLATE_THEME" => "blue",
                "XML_EXPORT" => "N",
                "COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
                "ID_PROPERTIES" => $filterParams[$GLOBALS['page'][2]]['id_properties'],
                'TYRE_OR_WHEEL' => $filterParams[$GLOBALS['page'][2]]['type'],
                'TYRE_SELECTION_FILTER' => 'TYRE_SELECTION_FILTER', // Имя глобальной переменной для результата tyre.selection (параметры для выбранного авто)
            ), false
        );
        ?>
    </div>
<? endif;?>
<? $arCatalogFilter = &$GLOBALS[ $catalogFilter ];

$tsFilter = (isset($GLOBALS['TYRE_SELECTION_FILTER'])) ? $GLOBALS['TYRE_SELECTION_FILTER'] : false;

if ($tsFilter and $tsFilter['filter']) {
    if (1) {
        $arCatalogFilter = [ $tsFilter['filter'] ];
        //SP_Log::consoleLog($arCatalogFilter, 'filter');
        //SP_Log::consoleLog($arResult['VARIABLES']['SECTION_ID']);
        //SP_Log::consoleLog($filterParams[$GLOBALS['page'][2]]['section_id']);
        
    } else {
        // Удалим лишние параметры из фильтра
        $ar = [
            390, // PCD
            395, // DIAMETR
            396, // PROFIL
            397, // SHIRINA
            431, // VYLET_LEGKOVOGO_DISKA_ET
        ];
        foreach ($ar as $value) {
            unset( $arCatalogFilter["=PROPERTY_{$value}"] );
        }
        
        // Добавим параметры
        $arCatalogFilter[] = $tsFilter['filter'];
    }
    
    if (0) {
        $arCatalogFilter = [
            [
                'LOGIC' => 'OR',
                ['PROPERTY_PCD' => '61462', 'PROPERTY_DIAMETR' => '32340'],
                ['PROPERTY_PCD' => ['31668', '36374', '61461'], 'PROPERTY_DIAMETR' => '32340'],
                ['PROPERTY_PCD' => ['31668', '36374', '61461'], 'PROPERTY_DIAMETR' => '32341'],
            ]
        ];
    }
} ?>
<?if (false and $tsFilter): ?>
    <div class="tyre-and-wheel-specification">
        <div>Заводская комплектация и размеры:</div>
        <?foreach ($tsFilter['specification_formatted'] as $ar): ?>
            <?if ($tsFilter['tyreOrWheel'] == 'tyre'): ?>
                <div class="item"><?= $ar['UF_WIDTH'] ?>/<?= $ar['UF_PROFILE'] ?> R<?= $ar['UF_DIAMETER'] ?></div>
            <?else: ?>
                <div class="item"><?= $ar['UF_WIDTH'] ?>J<?= $ar['UF_DIAMETER'] ?> <?= $ar['UF_LZ'] ?>*<?= $ar['UF_PCD'] ?> ET <?= $ar['UF_ET'] ?></div>
            <?endif ?>
        <?endforeach ?>
    </div>
<?endif ?>

<?
$sort = $arParams["ELEMENT_SORT_FIELD"];
$sort_order = $arParams["ELEMENT_SORT_ORDER"];
$sort2 = $arParams["ELEMENT_SORT_FIELD2"];
$sort_order2 = $arParams["ELEMENT_SORT_ORDER2"];

if ($isTireSection && (array_key_exists("sort", $_REQUEST) || array_key_exists("sort", $_SESSION))){
    if ($_REQUEST["sort"]) { //если гет
        if($_REQUEST["sort"] == 'available'){
            $arFilter = Array(
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                'SECTION_ID' => $arResult["VARIABLES"]["SECTION_ID"],
                'INCLUDE_SUBSECTIONS' => 'Y'
            );
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array('ID'));
            while($ar_fields = $res->GetNext())
            {
                $arElements[] = $ar_fields['ID'];
            }

            $sortedElementsByAvailable = SPStore::sortProductIdsByAvailableInCurrentCity($arElements);  

            $sort2 = 'ID';
            $_SESSION["sort"] = 'ID';
            $sort_order2 = $sortedElementsByAvailable;
            $_SESSION["order"] = $sortedElementsByAvailable;
        }
        else{
            $sort2 = $_REQUEST["sort"];
            $_SESSION["sort"] = $_REQUEST["sort"];
            $sort_order2 = $_REQUEST["order"];
            $_SESSION["order"] = $_REQUEST["order"];
        }
    } elseif ($_SESSION["sort"]) { //если нет гет, есть сессия
        $sort2 = $_SESSION["sort"];
        $sort_order2 = $_SESSION["order"];
    }
}?>

<div class="no-element">По вашему запросу товаров не найдено</div>
    <?$intSectionID = $APPLICATION->IncludeComponent(
        'bitrix:catalog.section', 'catalog-section-catalog', [
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ELEMENT_SORT_FIELD' => $sort,
        'ELEMENT_SORT_ORDER' => $sort_order,
        'ELEMENT_SORT_FIELD2' => $sort2,
        'ELEMENT_SORT_ORDER2' => $sort_order2,
        'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
        'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
        'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
        'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
        'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
        'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
        'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
        'BASKET_URL' => $arParams['BASKET_URL'],
        'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
        'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
        'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
        'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
        'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
        'FILTER_NAME' => $catalogFilter,
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_FILTER' => $arParams['CACHE_FILTER'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'SET_TITLE' => $arParams['SET_TITLE'],
        'MESSAGE_404' => $arParams['~MESSAGE_404'],
        'SET_STATUS_404' => $arParams['SET_STATUS_404'],
        'SHOW_404' => $arParams['SHOW_404'],
        'FILE_404' => $arParams['FILE_404'],
        'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
        'PAGE_ELEMENT_COUNT' => $arParams['PAGE_ELEMENT_COUNT'],
        'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
        'PRICE_CODE' => $arParams['PRICE_CODE'],
        'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
        'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
        'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
        'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
        'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
        'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
        'DISPLAY_TOP_PAGER' => $arParams['DISPLAY_TOP_PAGER'],
        'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],
        'PAGER_TITLE' => $arParams['PAGER_TITLE'],
        'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
        'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
        'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
        'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
        'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
        'PAGER_BASE_LINK_ENABLE' => $arParams['PAGER_BASE_LINK_ENABLE'],
        'PAGER_BASE_LINK' => $arParams['PAGER_BASE_LINK'],
        'PAGER_PARAMS_NAME' => $arParams['PAGER_PARAMS_NAME'],
        'LAZY_LOAD' => $arParams['LAZY_LOAD'],
        'MESS_BTN_LAZY_LOAD' => $arParams['~MESS_BTN_LAZY_LOAD'],
        'LOAD_ON_SCROLL' => $arParams['LOAD_ON_SCROLL'],
        'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
        'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
        'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
        'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
        'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
        'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
        'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
        'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],
        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
        'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
        'DETAIL_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['element'],
        'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
        'LABEL_PROP' => $arParams['LABEL_PROP'],
        'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
        'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
        'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
        'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',
        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
        'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
        'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),
        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
        'ADD_SECTIONS_CHAIN' => 'Y',
        'ADD_TO_BASKET_ACTION' => $basketAction,
        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
        'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
        'COMPARE_NAME' => $arParams['COMPARE_NAME'],
        'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
        'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
        'SHOW_SORT' => 'Y',
        'PROPS_FILTERED' => $propsFiltered,
        'OTHER_CITY_FILTERED' => $otherCityFiltered,
            ], $component, ['HIDE_ICONS' => 'Y']
    );

    unset($basketAction);?>
</div>
