<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    app.setPageTitle({"title": "Новинки"});
</script>
<?

$arFilter = array("!PROPERTY_NEWITEM_VALUE"=>false);

$APPLICATION->IncludeComponent(
	"mobile:mobileapp.catalog.section", 
	"newitems", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $_SESSION["CATALOG"]["ID"],
		// "SECTION_ID" => "",
		// "SECTION_CODE" => "",
		// "SECTION_USER_FIELDS" => array(
			// 0 => "",
			// 1 => "",
		// ),
		// "ELEMENT_SORT_FIELD" => "sort",
		// "ELEMENT_SORT_ORDER" => "asc",
		// "ELEMENT_SORT_FIELD2" => "id",
		// "ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "Y",
		"PAGE_ELEMENT_COUNT" => "30",
		// "LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "TIRE_W",
			2 => "TIRE_H",
			3 => "TIRE_R",
			4 => "TIRE_S",
			5 => "DISK_R",
			6 => "DISK_Q",
			7 => "DISK_D",
			8 => "",
		),
		// "OFFERS_LIMIT" => "5",
		"SECTION_URL" => "",
		// "DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		// "DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "Y",
		"PRICE_CODE" => array(
			0 => "Белогорск-розница",
			1 => "Розничная",
			2 => "Свободный-розница",
			3 => "Хабаровск - розница",
			4 => "Находка-розница",
			5 => "Благовещенск-розница",
			6 => "Владивосток-розница",
			7 => "Хабаровск-розница",
			8 => "Якутск-розница",
			10 => "Уссурийск-розница",
			11 => "Комсомольск-розница",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "N",
		"CONVERT_CURRENCY" => "N",
		// "PAGER_TEMPLATE" => "",
		// "DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новинки",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		// "AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		// "COMPONENT_TEMPLATE" => ".default",
		// "BACKGROUND_IMAGE" => "-",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);

//$APPLICATION->IncludeComponent('mobile:mobileapp.novelty.list', '', $arParams);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>