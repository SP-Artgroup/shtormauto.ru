<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$tplData            = $arResult['TPL_DATA'];
$templateData       = $tplData['templateData'];
$itemIds            = $tplData['itemIds'];
$obName             = $tplData['obName'];
$name               = $tplData['name'];
$title              = $tplData['title'];
$alt                = $tplData['alt'];
$haveOffers         = !empty($arResult['OFFERS']);
$canBuy             = $arResult['CAN_BUY'];
$strAvailableCities = $arResult['AVAILABLE_CITIES_STRING'];

if ($haveOffers) {

    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
        ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
        : reset($arResult['OFFERS']);

    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {

        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem         = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$msg        = [];
$langPrefix = 'CT_BCE_CATALOG_';

foreach ([
    'ECONOMY_INFO_MESSAGE',
    'GIFT_BLOCK_TITLE_DEFAULT',
    'RATIO_PRICE',
    'RANGE_FROM',
    'RANGE_MORE',
    'RANGE_TO',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

$skuProps     = array();
$price        = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription     = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn          = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName  = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn          = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe       = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$positionClassMap = $tplData['positionClassMap'];

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
    {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
    {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
    }
}
?>
<div class="detailed-container" id="<?=$itemIds['ID']?>"
    itemscope itemtype="http://schema.org/Product">

    <div class="head-detailed">

        <?php include 'parts/slider.php' ?>

        <div class="detailed-info">

            <?php if ($arParams['DISPLAY_NAME'] === 'Y'): ?>
                <h2><?= $name ?></h2>
            <?php endif ?>

            <?php
            if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                include 'parts/blocks/props.php';
            }
            ?>

            <?
            if ($canBuy) {
                $APPLICATION->IncludeComponent(
                    'sp-artgroup:store.list',
                    'truck-store-list',
                    $arResult['STORE_DATA'],
                    $component,
                    ['HIDE_ICONS' => 'Y']
                );
            }
            ?>

           <div class="info-footer">

                <div class="smeshariki">
                    <div class="available-cities">В наличии: <?= $strAvailableCities ?></div>
                    <?php include 'parts/blocks/price.php' ?>
                </div>
                <?php

                if ($canBuy && $arParams['USE_PRODUCT_QUANTITY']) {
                    include 'parts/blocks/quantity.php';
                }

                include 'parts/blocks/buttons.php';

                ?>
            </div>

        </div>

    </div>

    <?php if ($showDescription): ?>

        <div class="text">
            <div class="open-text" itemprop="description">
                <?
                if (
                    $arResult['PREVIEW_TEXT'] != ''
                    && (
                        $arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
                        || ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')
                    )
                )
                {
                    echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
                }

                if ($arResult['DETAIL_TEXT'] != '')
                {
                    echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
                }
                ?>
            </div>

            <div class="show-text">
                Читать дальше<i class="fas fa-angle-double-right"></i>
            </div>
        </div>

    <?php endif ?>

    <?php include 'parts/meta.php' ?>

</div>

<script>
    BX.message(<?=CUtil::PhpToJSObject($arResult['JS_LANG'])?>);

    var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($tplData['jsParams'], false, true)?>);
</script>
<?
unset($actualItem, $itemIds);