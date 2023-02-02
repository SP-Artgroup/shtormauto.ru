<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

$catalogItemTemplate = 'catalog-item-new';

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$generalParams = array(
	'SHOW_DISCOUNT_PERCENT'        => $arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE'         => $arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY'            => $arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR'     => $arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY'       => $arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY'  => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW'   => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE'               => $arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY'         => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE'    => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION'         => $arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET'     => $arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE'       => $arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP'             => $arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE'              => $arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH'                 => $arParams['COMPARE_PATH'],
	'COMPARE_NAME'                 => $arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION'         => $arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER'         => $arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS'         => $labelPositionClass,
	'DISCOUNT_POSITION_CLASS'      => $discountPositionClass,
	'SLIDER_INTERVAL'              => $arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS'              => $arParams['SLIDER_PROGRESS'],
	'~BASKET_URL'                  => $arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE'            => $arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE'            => $arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE'        => $arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME'               => $arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE'       => $arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME'              => $arParams['DATA_LAYER_NAME'],
	'BRAND_PROPERTY'               => $arParams['BRAND_PROPERTY'],
	'MESS_BTN_BUY'                 => $arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL'              => $arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE'             => $arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE'           => $arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET'       => $arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE'           => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];

$showSort = isset($arParams['SHOW_SORT']) && $arParams['SHOW_SORT'] === 'Y';

if ($showSort) {
	$sortOrder = isset($_REQUEST['sort']) && in_array($_REQUEST['sort'], ['asc', 'desc'])
		? $_REQUEST['sort']
		: 'desc';
	$sortMsg = [
		'asc'  => Loc::getMessage('CT_BCS_CATALOG_SORT_ASC'),
		'desc' => Loc::getMessage('CT_BCS_CATALOG_SORT_DESC'),
	];
	$sortUrl   = $APPLICATION->GetCurPageParam('sort=' . $sortOrder, ['sort']);
	$sortClass = $sortOrder === 'asc' ? 'desc' : 'asc';
}

$propsFiltered     = !empty($arParams['PROPS_FILTERED']) ? $arParams['PROPS_FILTERED'] : false;
$otherCityFiltered = !empty($arParams['OTHER_CITY_FILTERED']) ? $arParams['OTHER_CITY_FILTERED'] : false;
$otherCityUrl      = $APPLICATION->GetCurPageParam('show_in_other_city=1');

$sectionTitle = $APPLICATION->getPageProperty('page_header') ?: $arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] ?? null;
$description  = $APPLICATION->GetPageProperty('additional_text') ?: $arResult['DESCRIPTION'];

$hasItems = !empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS']);
?>
    <div class="additional-products">
      <h2 class="additional-products__heading"><?=$arParams["TITLE_BLOCK"];?></h2>
      <div class="row">
	<?
	if ($hasItems) {

		$areaIds = array();

		foreach ($arResult['ITEMS'] as $item)
		{
			$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
			$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
		}
		?>
		<!-- items-container -->
           	<!-- горизонтальные рекламные блоки после 6 элемента -->
           	<!-- вертикальные рекламные блоки после 4 элемента -->

		<?
                $numberElement = 0;
		foreach ($arResult['ITEM_ROWS'] as $rowData)
		{
                        
			$rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
			?>
                        <?php
                        foreach ($rowItems as $item) {
                            ?>
                            <div class="product-item-col col-6 col-md-4 col-xl-3">
                                <?
                                $APPLICATION->IncludeComponent(
                                'bitrix:catalog.item',
                                $catalogItemTemplate,
                                array(
                                'RESULT' => array(
                                'ITEM' => $item,
                                'AREA_ID' => $areaIds[$item['ID']],
                                'TYPE' => $rowData['TYPE'],
                                'BIG_LABEL' => 'N',
                                'BIG_DISCOUNT_PERCENT' => 'N',
                                'BIG_BUTTONS' => 'Y',
                                'SCALABLE' => 'N'
                                ),
                                'PARAMS' => $generalParams
                                			+ array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']],
                                				'EX_GUARANT' => ($item["PROPERTIES"]["REMOVE_EX_GUARANT"]["VALUE_XML_ID"] == "Y")?"N":$arResult[$item["~IBLOCK_SECTION_ID"]]["EX_GUARANT"],
												'FREE_REPAIR' => ($item["PROPERTIES"]["REMOVE_FREE_REPAIR"]["VALUE_XML_ID"] == "Y")?"N":$arResult[$item["~IBLOCK_SECTION_ID"]]["FREE_REPAIR"],
												'SHOW_PRICE' => $arResult[$item["~IBLOCK_SECTION_ID"]]["SHOW_PRICE"]
											),
                                'CITY_AMOUNTS' => $arResult['CITY_AMOUNTS'][$item['ID']],
                               	'CITY_LIST' => $arResult['CITY_LIST'],
                                'MESS_NOT_AVAILABLE' => 'В выбранном городе данный товар отсутствует!'
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                                );
                                ?>
                            </div>
<?
                        }
		}
		unset($generalParams, $rowItems);
		?>
		<!-- items-container -->
		<?

	} else {

			// load css for bigData/deferred load
			$APPLICATION->IncludeComponent(
				'bitrix:catalog.item',
				$catalogItemTemplate,
				array(),
				$component,
				array('HIDE_ICONS' => 'Y')
			);
	} ?>

	<?php if ($propsFiltered): ?>

		<div class="col-xs-12">
			<div class="not-found-box">
				<?php if (!$hasItems): ?>
					<div class="not-found-msg"><?= Loc::getMessage('CT_BCS_CATALOG_SEARCH_NOT_FOUND') ?></div>
				<?php endif ?>

				<?php /* ?>
				<?php if (!$otherCityFiltered): ?>
					<button
						onclick="location.href='<?= $otherCityUrl ?>'"
						class="buy-btn show-in-other-city"
					><?= Loc::getMessage('CT_BCS_CATALOG_IN_OTHER_CITY') ?></button>

				<?php endif ?>
				<?php */ ?>

				<?php if (!$hasItems): ?>
					<div class="feedback-msg"><?= Loc::getMessage('CT_BCS_CATALOG_FEEDBACK') ?></div>
				<?php endif ?>
			</div>
		</div>

	<?php endif ?>
	<?

	if ($showBottomPager)
	{
		?>
		<div data-pagination-num="<?=$navParams['NavNum']?>">
			<!-- pagination-container -->
			<?=$arResult['NAV_STRING']?>
			<!-- pagination-container -->
		</div>
		<?
	}

	if ($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y' && $hasItems && !isset($_REQUEST['PAGEN_1'])) {
		?>
		<div class="bx-section-desc">
			<div class="bx-section-desc-post"><?= $description ?></div>
		</div>
		<?
	}

	?>

<?

if ($showLazyLoad)
{
	?>
	<div class="row bx-<?=$arParams['TEMPLATE_THEME']?>">
		<div class="btn btn-default btn-lg center-block" style="margin: 15px;"
			data-use="show-more-<?=$navParams['NavNum']?>">
			<?=$arParams['MESS_BTN_LAZY_LOAD']?>
		</div>
	</div>
	<?
}

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
    </div>
</div>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT : '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BASKET_URL                  : '<?=$arParams['BASKET_URL']?>',
		ADD_TO_BASKET_OK            : '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		TITLE_ERROR                 : '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS          : '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS')?>',
		TITLE_SUCCESSFUL            : '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		BASKET_UNKNOWN_ERROR        : '<?=GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_MESSAGE_SEND_PROPS      : '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		BTN_MESSAGE_CLOSE           : '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP     : '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		COMPARE_MESSAGE_OK          : '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR       : '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE               : '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE')?>',
		PRICE_TOTAL_PREFIX          : '<?=GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY      : '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW       : '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		BTN_MESSAGE_LAZY_LOAD       : '<?=$arParams['MESS_BTN_LAZY_LOAD']?>',
		BTN_MESSAGE_LAZY_LOAD_WAITER: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER')?>',
		SITE_ID: '<?=SITE_ID?>'
	});
	/*var <?=$obName?> = new JCCatalogSectionComponent({
		siteId             : '<?=CUtil::JSEscape(SITE_ID)?>',
		componentPath      : '<?=CUtil::JSEscape($componentPath)?>',
		navParams          : <?=CUtil::PhpToJSObject($navParams)?>,
		deferredLoad       : false, // enable it for deferred load
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		bigData            : <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
		lazyLoad           : !!'<?=$showLazyLoad?>',
		loadOnScroll       : !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
		template           : '<?=CUtil::JSEscape($signedTemplate)?>',
		ajaxId             : '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
		parameters         : '<?=CUtil::JSEscape($signedParams)?>',
		container          : '<?=$containerName?>'
	});*/
</script>