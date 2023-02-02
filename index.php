<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetPageProperty("title", "Штормавто-Поул Позишн. Сеть автомагазинов и автосервисов.");
	$APPLICATION->SetPageProperty("description", "Штормавто-Поул Позишн. Сеть автомагазинов и автосервисов.");
	$APPLICATION->SetTitle("Штормавто-Поул Позишн. Сеть автомагазинов.");
?>
<?
	/*баннеры*/
	/*$currentCityId = SP\City::getCurrentCityId();
	global $arFilterBanner;
	$arFilterBanner = array("PROPERTY_CITY" => $currentCityId);
	$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_banners", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"FILTER_NAME" => "arFilterBanner",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "services",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "A_HREF",
			1 => "BANNER",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_banners"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);*/
	/*Баннеры*/

?>

<!-- Баннер (баннерная реклама)-->
<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner", 
	"main_carousel", 
	array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"NOINDEX" => "Y",
		"QUANTITY" => "12",
		"TYPE" => "horizontal_banner_on_main",
		"COMPONENT_TEMPLATE" => "main_carousel",
		"DEFAULT_TEMPLATE" => "bootstrap_v4",
		"WEIGHT_SORT_ORDER" => "DESC"
	),
	false
);?>
<!-- Баннер (баннерная реклама)-->

<!--фильтры-->
<?
    $shtormauto = Shtormauto::getInstance();
    $priceId    = $shtormauto->getCurrentCityPriceId();
    $priceName  = $shtormauto->getCurrentCityPriceName();
    $storeIds   = SP\Store::getCityStore();
?>
<div class="filters">
	<?
		$dbPriceType = CCatalogGroup::GetList(
		array("SORT" => "ASC"), array("ID" => $priceId)
		);
		while ($arPriceType = $dbPriceType->Fetch()) {
			$priceFilter = $arPriceType["NAME_LANG"];
		}?>
		<h2 class="filter-item__heading d-flex justify-content-center">Подбор<span class="colon d-none">:</span></h2>
		<h2 class="filter-item__heading">
			<div class="d-flex flex-column justify-content-center align-items-start d-md-block">
			<span class="d-md-none" style="font-size: 12px;">шин/дисков/мотошин/ATV/аккумуляторов/грузовых шин/шин для спецтехники/грузовых дисков</span>
			</div>
			<img class="d-none arrow" src="/local/templates/shtormauto/images/arrow.png" alt="arrow">
			<div class="form-select filter-item__select-type d-block d-md-none">
				<select data-change-filter-type>
					<option value="tire" selected>Шин</option>
					<option value="disk">Дисков</option>
					<option value="mototire">Мотошин</option>
					<option value="shiny_atv">Шин ATV</option>	
					<option value="akb">Аккумуляторов</option>
					<option value="gruz">Грузовых шин</option>
					<option value="shiny_industrialnye">Шин для спецтехники</option>
					<option value="diski_gruzovye">Грузовых дисков</option>
				</select>
			</div>
		</h2>
		<!-- <h2 class="filter-item__heading">
			<div class="d-flex flex-column justify-content-center align-items-start d-md-block">
				Подбор
				<span class="d-md-none" style="font-size: 12px;">шин/дисков/мотошин/ATV/аккумуляторов/грузовых шин</span>
			</div>
			<div class="form-select filter-item__select-type d-block d-md-none">
				<select data-change-filter-type>
					<option value="tire" selected>Шин</option>
					<option value="disk">Дисков</option>
					<option value="mototire">Мотошин</option>
					<option value="shiny_atv">Шин ATV</option>	
					<option value="akb">Аккумуляторов</option>
					<option value="gruz">Грузовых шин</option>

				</select>
			</div>
		</h2> -->
		<div class="filter-item__select-type d-none d-md-flex">
			<input type="radio" name="filter-item" value="tire" id="filter-item-1" checked>
			<label for="filter-item-1">Шин</label>
			<input type="radio" name="filter-item" value="disk" id="filter-item-2">
			<label for="filter-item-2">Дисков</label>
			<input type="radio" name="filter-item" value="mototire" id="filter-item-3">
			<label for="filter-item-3">Мотошин</label>
			<input type="radio" name="filter-item" value="shiny_atv" id="filter-item-6">
			<label for="filter-item-6">Шин ATV</label>	
			<input type="radio" name="filter-item" value="akb" id="filter-item-4">
			<label for="filter-item-4">Аккумуляторов</label>
			<input type="radio" name="filter-item" value="gruz" id="filter-item-5">
			<label for="filter-item-5">Грузовых шин</label>



			
			<input type="radio" name="filter-item" value="diski_gruzovye" id="filter-item-7">
			<label for="filter-item-7">Грузовых дисков</label>
			<!--input type="radio" name="filter-item" value="shiny_industrialnye" id="filter-item-8">
			<label for="filter-item-8">Индустриальных шин</label-->

			<a class="square" href="/catalog/3_industrialnye_shiny_2/">Шин для спецтехники</a>
			<a class="square" href="/catalog/4_shiny_dlya_selskokhozyaystvennoy_tekhniki_1/">Шин для с/х техники</a>
		</div>
		<div class="filter-item filter-item--tire">
			<? $catalogSmartFilterTemplate = 'tyre_and_wheel' ?>
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "shiny",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'tyre', // Шины
				),
				false
				);
			?>
		</div>
		<div class="filter-item filter-item--disk" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "25897",/*ID категории Диски*/
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate, //"new_filter_disk",
                "ID_PROPERTIES" => array(395,396, 431, 390), /*свойства для второго фильтра в том порядке, в котором они должны быть выведены*/

				'TYRE_OR_WHEEL' => 'wheel', // Диски
				),
				false
				);
			?>
		</div>
		<div class="filter-item filter-item--mototire" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "26079",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'mototire', // Шины
				),
				false
				);
			?>
		</div>
		<div class="filter-item filter-item--shiny_atv" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "26245",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'shiny_atv', // Шины atv
				),
				false
				);
			?>
		</div>	
		<div class="filter-item filter-item--akb" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "25859",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'akkumulyatory', // Шины
				),
				false
				);
			?>
		</div>		
		<div class="filter-item filter-item--gruz" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "30370",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'gruz', // Шины
				),
				false
				);
			?>
		</div>	
		<div class="filter-item filter-item--diski_gruzovye" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "29270",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'diski_gruzovye', // диски грузовые
				),
				false
				);
			?>
		</div>	
				<div class="filter-item filter-item--shiny_industrialnye" style="display: none;">
			<?$APPLICATION->IncludeComponent(
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
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => "30404",
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N",
				"COMPONENT_TEMPLATE" => $catalogSmartFilterTemplate,
				'TYRE_OR_WHEEL' => 'shiny_industrialnye', // шины индустриальные
				),
				false
				);
			?>
		</div>	
</div>
<!--фильтры-->

<!-- Баннер (баннерная реклама)-->
<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"main_carousel",
	Array(
	"CACHE_TIME" => "0",
	"CACHE_TYPE" => "A",
	"NOINDEX" => "Y",
	"QUANTITY" => "",
	"TYPE" => "horizontal_banner_on_main"
	)
);?>
<!-- Баннер (баннерная реклама)-->

<?/*$APPLICATION->IncludeComponent(
	"sp-artgroup:listContacts",
	"mobile_list_stores",
	Array(
		"COMPONENT_TEMPLATE" => "mobile_list_stores",
		"IBLOCK_ID" => "15",
		"IBLOCK_TYPE_ID" => "services",
		"PROPERTY" => "PHONES"
	)
);*/
$GLOBALS["arrFilterShops"] = array(
    'PROPERTY_CITY' => SP\City::getCurrentCityId(),
);
/*
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"shops_on_main_mobile",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilterShops",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "services",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "30",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "EMAIL",
			1 => "ADDRESS",
			2 => "CONTACTS",
			3 => "SHORT_NAME",
			4 => "LOCATION",
			5 => "WORK_TIME",
			6 => "PHONE",
			7 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "shops_on_main"
	),
	false
);*/?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"banner_shops_on_main_mobile",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "banner_shops_on_main_mobile",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"XML_ID",3=>"NAME",4=>"TAGS",5=>"SORT",6=>"PREVIEW_TEXT",7=>"PREVIEW_PICTURE",8=>"DETAIL_TEXT",9=>"DETAIL_PICTURE",10=>"DATE_ACTIVE_FROM",11=>"ACTIVE_FROM",12=>"DATE_ACTIVE_TO",13=>"ACTIVE_TO",14=>"SHOW_COUNTER",15=>"SHOW_COUNTER_START",16=>"IBLOCK_TYPE_ID",17=>"IBLOCK_ID",18=>"IBLOCK_CODE",19=>"IBLOCK_NAME",20=>"IBLOCK_EXTERNAL_ID",21=>"DATE_CREATE",22=>"CREATED_BY",23=>"CREATED_USER_NAME",24=>"TIMESTAMP_X",25=>"MODIFIED_BY",26=>"USER_NAME",27=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "52",
		"IBLOCK_TYPE" => "banners",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"HEADER_MOB_BANNER",1=>"LINK_WITH_CITY",2=>"LINK_MOB_BANNER",3=>"TEXT_BUTTON",4=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"PROPERTY_CITY" => SP\City::getCurrentCityId(),
	)
);?>

<?
	/*Бренды*/
	/*
	$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main_brands",
	array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"ADD_SECTIONS_CHAIN" => "N",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"AJAX_OPTION_HISTORY" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"CACHE_TIME" => "36000000",
	"CACHE_TYPE" => "A",
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"FIELD_CODE" => array(
	0 => "NAME",
	1 => "PREVIEW_TEXT",
	2 => "PREVIEW_PICTURE",
	3 => "DETAIL_PICTURE",
	4 => "",
	),
	"FILTER_NAME" => "",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"IBLOCK_ID" => "14",
	"IBLOCK_TYPE" => "catalog",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"INCLUDE_SUBSECTIONS" => "N",
	"MESSAGE_404" => "",
	"NEWS_COUNT" => "5",
	"PAGER_BASE_LINK_ENABLE" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_TITLE" => "Новости",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"PREVIEW_TRUNCATE_LEN" => "",
	"PROPERTY_CODE" => array(
	0 => "",
	1 => "",
	2 => "",
	3 => "",
	),
	"SET_BROWSER_TITLE" => "N",
	"SET_LAST_MODIFIED" => "N",
	"SET_META_DESCRIPTION" => "N",
	"SET_META_KEYWORDS" => "N",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"SHOW_404" => "N",
	"SORT_BY1" => "SORT",
	"SORT_BY2" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_ORDER2" => "ASC",
	"STRICT_SECTION_CHECK" => "N",
	"COMPONENT_TEMPLATE" => "main_brands"
	),
	false
	);
	*/
	/*Бренды*/
?>
<?
	/*Блок категорий - 1 вариант*/
	/*$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"categories_main",
	array(
	"ADD_SECTIONS_CHAIN" => "Y",
	"CACHE_GROUPS" => "Y",
	"CACHE_TIME" => "36000000",
	"CACHE_TYPE" => "A",
	"COUNT_ELEMENTS" => "N",
	"IBLOCK_ID" => "26",
	"IBLOCK_TYPE" => "catalog",
	"SECTION_CODE" => "",
	"SECTION_FIELDS" => array(
	0 => "",
	1 => "",
	),
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_URL" => "",
	"SECTION_USER_FIELDS" => array(
	0 => "UF_ON_MAIN",
	1 => "UF_DESCRIPRION",
	2 => "",
	),
	"SHOW_PARENT_NAME" => "Y",
	"TOP_DEPTH" => "2",
	"VIEW_MODE" => "LINE",
	"COMPONENT_TEMPLATE" => "categories_main"
	),
	false
	);*/
	/*Блок категорий - 2 вариант*/
	$APPLICATION->SetTitle("test");?><?$APPLICATION->IncludeComponent("bitrix:news.list", "categories_main", Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "32",	// Код информационного блока
		"IBLOCK_TYPE" => "catalog",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "4",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
		0 => "LINK",
		1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ID",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		),
		false
	);
	/*Блок категорий*/
?>
<!--Баннер 848x100 и 343х100-->
<div class="d-block d-lg-none">


</div>
<!--Баннер 848x100 и 343х100-->
<!--Левое меню-->
<div class="row">
    <aside class="sidebar col-md-4 col-xl-3 d-none d-md-flex">
        <?$APPLICATION->SetTitle("");?><?$APPLICATION->IncludeComponent("bitrix:menu", "main_left_catalog", Array(
			"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
			"CHILD_MENU_TYPE" => "catalog",	// Тип меню для остальных уровней
			"DELAY" => "N",	// Откладывать выполнение шаблона меню
			"MAX_LEVEL" => "2",	// Уровень вложенности меню
			"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
			"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
			"MENU_CACHE_TYPE" => "A",	// Тип кеширования
			"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
			"MENU_THEME" => "site",
			"ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
			"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
			"COMPONENT_TEMPLATE" => "left-catalog"
			),
			false
		);?>
        <!--Новости-->
        <div class="news-sidebar d-none d-lg-block">
            <?
				$APPLICATION->SetTitle("");?><?$APPLICATION->IncludeComponent("bitrix:news.list", "news_main", Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
				"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				"AJAX_MODE" => "N",	// Включить режим AJAX
				"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
				"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
				"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
				"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
				"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
				"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				"CACHE_TIME" => "36000",	// Время кеширования (сек.)
				"CACHE_TYPE" => "A",	// Тип кеширования
				"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
				"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
				"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
				"DISPLAY_DATE" => "Y",	// Выводить дату элемента
				"DISPLAY_NAME" => "Y",	// Выводить название элемента
				"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
				"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
				"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
				"FIELD_CODE" => array(	// Поля
				0 => "",
				1 => "",
				),
				"FILTER_NAME" => "",	// Фильтр
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
				"IBLOCK_ID" => "1",	// Код информационного блока
				"IBLOCK_TYPE" => "news",	// Тип информационного блока (используется только для проверки)
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
				"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
				"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
				"NEWS_COUNT" => "3",	// Количество новостей на странице
				"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
				"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
				"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
				"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
				"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
				"PAGER_TITLE" => "Новости",	// Название категорий
				"PARENT_SECTION" => "",	// ID раздела
				"PARENT_SECTION_CODE" => "",	// Код раздела
				"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
				"PROPERTY_CODE" => array(	// Свойства
				0 => "",
				1 => "",
				),
				"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
				"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
				"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
				"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
				"SET_STATUS_404" => "N",	// Устанавливать статус 404
				"SET_TITLE" => "N",	// Устанавливать заголовок страницы
				"SHOW_404" => "N",	// Показ специальной страницы
				"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
				"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
				"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
				"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
				"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
				),
				false
				);
			?>
            <div class="subscription">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
					"PATH" => "/include/main_subscribe.php"
					)
				);?>
			</div>
		</div>
        <!--Новости-->
        <!--Магазины-->
        <?
        $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"shops_on_main",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "arrFilterShops",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "7",
				"IBLOCK_TYPE" => "services",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "30",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "EMAIL",
					1 => "ADDRESS",
					2 => "CONTACTS",
					3 => "SHORT_NAME",
					4 => "LOCATION",
					5 => "WORK_TIME",
					6 => "PHONE",
					7 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => "shops_on_main"
			),
			false
		);?>
        <!--Магазины-->
        <!--Форма обратной связи-->
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
			Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/include/main_feedback.php"
			)
		);?>
		<!--Форма обратной связи-->
	</aside>
    <!--Центральный блок - каталог-->
    <div class="col-md-8 col-xl-9">
        <div class="row">
            <?php
				use SP\City as SPCity;
				$currentCity = SPCity::getCurrentCityData();
				echo "<pre style='display:none'>"; print_r($currentCity); echo "</pre>";
				//$store_filter = ['LOGIC' => 'OR'];
				/*foreach ($currentCity['PROPERTY_STORE_ID_VALUE'] as $store_id) {
					$store_filter[] = ['>CATALOG_STORE_AMOUNT_' . $store_id => 0];
				}*/
				//$GLOBALS["arrFilter"] = ["IBLOCK_ID"=>26, "ACTIVE"=>"Y", $store_filter];
				$GLOBALS["arrFilter"] = [
					"IBLOCK_ID"=>26, 
					"ACTIVE"=>"Y", 
					array(
						"LOGIC" => "OR",
						array("PROPERTY_SHOWMAIN_VALUE" => "Да"),
						array("PROPERTY_SHOW_IN_CITY" => $currentCity["ID"])
					),
					'!ID' => CIBlockElement::SubQuery("ID", array(
						"IBLOCK_ID"=>26, 
						"PROPERTY_HIDE_IN_CITY" => $currentCity["ID"]
					))
				];
				$catalogFilter = "arrFilter";
			?>
<?if ($currentCity["ID"] !== '506029' && $currentCity["ID"] !== '560928'): ?>
	
            <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"catalog-section-onmain", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "BUY",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "catalog-section-onmain",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => /*"{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:26:402\",\"DATA\":{\"logic\":\"Equal\",\"value\":33003}}]}"*/"{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "26",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			$priceName,
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "SEZONNOST",
			1 => "SHIRINA",
			2 => "DIAMETR",
			3 => "FREE_REPAIR",
			4 => "EX_GUARANT",
			5 => "TIRE_W",
			6 => "TIRE_H",
			7 => "TIRE_R",
			8 => "TIRE_S",
			9 => "DISK_R",
			10 => "DISK_Q",
			11 => "DISK_D",
			12 => "",
		),
		"PROPERTY_CODE_MOBILE" => array(
			0 => "SEZONNOST",
			1 => "SHIRINA",
			2 => "DIAMETR",
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?>

<?endif ?>

		</div>
		<!--Подписка-->
        <div class="subscription subscription--after-catalog d-block d-lg-none">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
                Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/main_subscribe_mobile.php"
                )
			);?>
		</div>
		<!--Подписка-->
	</div>
    <!--Центральный блок - каталог-->
</div>

<!--Форма обратной связи мобильные-->
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "inc",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/include/main_feedback_mini.php"
    )
);?>
<!--Форма обратной связи мобильные-->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>