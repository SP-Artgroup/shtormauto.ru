<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Context;
use Bitrix\Main\Web\Cookie;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */?>
<? /*$APPLICATION->IncludeComponent(
    'bitrix:catalog.section.list',
    'catalog-section-list',
    [
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
		"SHOW_PARENT_NAME" => "N",
		"HIDE_SECTION_NAME" => "N",
		"ADD_SECTIONS_CHAIN" => 'N',
		'HIDE_CATALOG_TEXT' => "Y",
    ],
    $component,
    ($arParams['SHOW_TOP_ELEMENTS'] !== 'N' ? ['HIDE_ICONS' => 'Y'] : [])
);*/?>
<? $context    = Context::getCurrent();
$request    = $context->getRequest();
$response   = $context->getResponse();
$cookieName = 'catalog_showby';
$queryName  = 'showby';

$showByParams = [6, 10, 25, 50, 100];

if ($showBy = $request->getQuery($queryName)) {

    if (!in_array($showBy, $showByParams)) {
        $showBy = $showByParams[0];
    }

    $response->addCookie(new Cookie($cookieName, $showBy));

} else {
    $showBy = $request->getCookie($cookieName) ?: $showByParams[0];
}

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y') {
	$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
} else {
	$basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}

if ($isFilter || $isSidebar): ?>

	<div class="left <?=(isset($arParams['FILTER_HIDE_ON_MOBILE']) && $arParams['FILTER_HIDE_ON_MOBILE'] === 'Y' ? 'hidden-xs' : '')?>">

		<? if ($isFilter): ?>
			<div class="bx-sidebar-block">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"catalog-filter",
					array(
						"IBLOCK_TYPE"            => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID"              => $arParams["IBLOCK_ID"],
						"SECTION_ID"             => $arCurSection['ID'],
						"FILTER_NAME"            => $arParams["FILTER_NAME"],
						// "PRICE_CODE"          => $arParams["~PRICE_CODE"],
						"CACHE_TYPE"             => $arParams["CACHE_TYPE"],
						"CACHE_TIME"             => $arParams["CACHE_TIME"],
						"CACHE_GROUPS"           => $arParams["CACHE_GROUPS"],
						"SAVE_IN_SESSION"        => "N",
						"FILTER_VIEW_MODE"       => $arParams["FILTER_VIEW_MODE"],
						"XML_EXPORT"             => "N",
						"SECTION_TITLE"          => "NAME",
						"SECTION_DESCRIPTION"    => "DESCRIPTION",
						'HIDE_NOT_AVAILABLE'     => $arParams["HIDE_NOT_AVAILABLE"],
						"TEMPLATE_THEME"         => $arParams["TEMPLATE_THEME"],
						'CONVERT_CURRENCY'       => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID'            => $arParams['CURRENCY_ID'],
						"SEF_MODE"               => $arParams["SEF_MODE"],
						"SEF_RULE"               => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
						"SMART_FILTER_PATH"      => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
						"PAGER_PARAMS_NAME"      => $arParams["PAGER_PARAMS_NAME"],
						"INSTANT_RELOAD"         => $arParams["INSTANT_RELOAD"],
						"POPUP_POSITION"         => 'right',
						// "AJAX_MODE"              => "Y",
						// 'COMPONENT_CONTAINER_ID' => 'catalog-section',
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<? endif ?>
		<? /*if(empty($GLOBALS[$arParams["FILTER_NAME"]])){
			global $catalogFilter;
			$catalogFilter = SP\Component::getAvailableProductsFilter();
		}*/?>
		
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"catalog-banners",
			Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => IBLOCK_ID__TRUCK_CATALOG_BANNERS,
				"IBLOCK_TYPE" => "services",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "20",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array("URL", ""),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
			),
			$component
		);?>

	</div>

<? endif ?>

<div class="right">

	<?php /*
	<div class="col-xs-12">
		<?
		if (ModuleManager::isModuleInstalled("sale"))
		{
			$arRecomData = array();
			$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
			$obCache = new CPHPCache();
			if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
			{
				$arRecomData = $obCache->GetVars();
			}
			elseif ($obCache->StartDataCache())
			{
				if (Loader::includeModule("catalog"))
				{
					$arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
					$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
				}
				$obCache->EndDataCache($arRecomData);
			}

			if (!empty($arRecomData) && $arParams['USE_GIFTS_SECTION'] === 'Y')
			{
				?>
				<div data-entity="parent-container">
					<?
					if (!isset($arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE'] !== 'Y')
					{
						?>
						<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
							<?=($arParams['GIFTS_SECTION_LIST_BLOCK_TITLE'] ?: \Bitrix\Main\Localization\Loc::getMessage('CT_GIFTS_SECTION_LIST_BLOCK_TITLE_DEFAULT'))?>
						</div>
						<?
					}

					CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.section');
					$APPLICATION->IncludeComponent(
						'bitrix:sale.products.gift.section',
						'.default',
						array(
							'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
							'IBLOCK_ID' => $arParams['IBLOCK_ID'],

							'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
							'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
							'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

							'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
							'ACTION_VARIABLE' => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : 'action').'_spgs',

							'PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
								SaleProductsGiftSectionComponent::predictRowVariants(
									$arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
									$arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT']
								)
							),
							'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
							'DEFERRED_PRODUCT_ROW_VARIANTS' => '',
							'DEFERRED_PAGE_ELEMENT_COUNT' => 0,

							'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
							'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
							'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
							'PRODUCT_DISPLAY_MODE' => 'Y',
							'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
							'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
							'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
							'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

							'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

							'LABEL_PROP_'.$arParams['IBLOCK_ID'] => array(),
							'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => array(),
							'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

							'ADD_TO_BASKET_ACTION' => $basketAction,
							'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
							'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
							'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
							'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

							'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
							'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
							'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],

							'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
							'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
							'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
							'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
							'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],

							'HIDE_NOT_AVAILABLE' => 'Y',
							'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
							'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
							'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
							'PRICE_CODE' => $arParams['~PRICE_CODE'],
							'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
							'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'BASKET_URL' => $arParams['BASKET_URL'],
							'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
							'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
							'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
							'USE_PRODUCT_QUANTITY' => 'N',
							'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
							'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

							'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
							'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
							'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);
					?>
				</div>
				<?
			}
		}
		?>
	</div>

	*/

	/*$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
			"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
			"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);*/

	/*if ($arParams["USE_COMPARE"]=="Y")
	{
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.compare.list",
			"",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"NAME" => $arParams["COMPARE_NAME"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
				"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
				'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);
	}*/
	?>
	<div class="filter-result">
		<?php
		$intSectionID = $APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"catalog-section",
			array(
				"IBLOCK_TYPE"               => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"                 => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD"        => $arParams["ELEMENT_SORT_FIELD"],
				"ELEMENT_SORT_ORDER"        => $arParams["ELEMENT_SORT_ORDER"],
				"ELEMENT_SORT_FIELD2"       => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2"       => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE"             => $arParams["LIST_PROPERTY_CODE"],
				"PROPERTY_CODE_MOBILE"      => $arParams["LIST_PROPERTY_CODE_MOBILE"],
				"META_KEYWORDS"             => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION"          => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE"             => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED"         => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS"       => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL"                => $arParams["BASKET_URL"],
				"ACTION_VARIABLE"           => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE"       => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE"       => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE"    => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME"               => $arParams["FILTER_NAME"],
				"CACHE_TYPE"                => $arParams["CACHE_TYPE"],
				"CACHE_TIME"                => $arParams["CACHE_TIME"],
				"CACHE_FILTER"              => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS"              => $arParams["CACHE_GROUPS"],
				"SET_TITLE"                 => $arParams["SET_TITLE"],
				"MESSAGE_404"               => $arParams["~MESSAGE_404"],
				"SET_STATUS_404"            => $arParams["SET_STATUS_404"],
				"SHOW_404"                  => $arParams["SHOW_404"],
				"FILE_404"                  => $arParams["FILE_404"],
				"DISPLAY_COMPARE"           => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT"        => $showBy,
				"LINE_ELEMENT_COUNT"        => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE"                => $arParams["~PRICE_CODE"],
				"USE_PRICE_COUNT"           => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT"          => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE"               => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY"            => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET"        => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES"      => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES"              => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER"               => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER"            => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE"                     => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS"               => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE"                  => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING"            => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL"                  => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE"          => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK"                 => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME"               => $arParams["PAGER_PARAMS_NAME"],
				"LAZY_LOAD"                       => $arParams["LAZY_LOAD"],
				"MESS_BTN_LAZY_LOAD"              => $arParams["~MESS_BTN_LAZY_LOAD"],
				"LOAD_ON_SCROLL"                  => $arParams["LOAD_ON_SCROLL"],

				"OFFERS_CART_PROPERTIES"          => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE"               => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE"            => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD"               => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER"               => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2"              => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2"              => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT"                    => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID"                      => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE"                    => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL"                     => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL"                      => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION"        => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY'                => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID'                     => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE'              => $arParams["HIDE_NOT_AVAILABLE"],
				'HIDE_NOT_AVAILABLE_OFFERS'       => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

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
				"ADD_SECTIONS_CHAIN"              => "Y",
				'ADD_TO_BASKET_ACTION'            => $basketAction,
				'SHOW_CLOSE_POPUP'                => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH'                    => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'COMPARE_NAME'                    => $arParams['COMPARE_NAME'],
				'USE_COMPARE_LIST'                => 'Y',
				'BACKGROUND_IMAGE'                => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
				'COMPATIBLE_MODE'                 => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT'    => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),

				// custom
				'SHOWBY_PARAMS'                   => $showByParams,
			),
			$component
		);
		?>
	</div>

	<?

	$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;

	if (ModuleManager::isModuleInstalled("sale"))
	{
		if (!empty($arRecomData))
		{
			if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
			{
				?>
				<div class="col-xs-12" data-entity="parent-container">
					<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
						<?=GetMessage('CATALOG_PERSONAL_RECOM')?>
					</div>
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"",
						array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
							"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
							"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
							"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
							"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
							"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
							"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
							"BASKET_URL" => $arParams["BASKET_URL"],
							"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
							"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
							"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
							"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
							"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_FILTER" => $arParams["CACHE_FILTER"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
							"PAGE_ELEMENT_COUNT" => 0,
							"PRICE_CODE" => $arParams["~PRICE_CODE"],
							"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
							"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"ADD_SECTIONS_CHAIN" => "N",

							"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
							"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
							"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
							"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
							"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

							"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
							"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
							"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
							"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
							"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
							"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
							"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
							"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

							"SECTION_ID" => $intSectionID,
							"SECTION_CODE" => "",
							"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
							"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
							"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID'],
							'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
							'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

							'LABEL_PROP' => $arParams['LABEL_PROP'],
							'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
							'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
							'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
							'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
							'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
							'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
							'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
							'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
							'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
							'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
							'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

							"DISPLAY_TOP_PAGER" => 'N',
							"DISPLAY_BOTTOM_PAGER" => 'N',
							"HIDE_SECTION_DESCRIPTION" => "Y",

							"RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
							"SHOW_FROM_SECTION" => 'Y',

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
							'ADD_TO_BASKET_ACTION' => $basketAction,
							'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
							'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
							'COMPARE_NAME' => $arParams['COMPARE_NAME'],
							'USE_COMPARE_LIST' => 'Y',
							'BACKGROUND_IMAGE' => '',
							'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
						),
						$component
					);
					?>
				</div>
				<?
			}
		}
	}
	?>
</div>