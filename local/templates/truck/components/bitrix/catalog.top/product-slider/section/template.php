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
 * @var string $elementEdit
 * @var string $elementDelete
 * @var string $elementDeleteParams
 */

global $APPLICATION;

$tplData          = $arResult['TPL_DATA'];
$positionClassMap = $tplData['positionClassMap'];
$generalParams    = $tplData['generalParams'];

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($this->randString()));
$containerName = 'product-slider-box';

$sliderParamsVariant = !empty($arParams['SLIDER_VARIANT'])
    ? $arParams['SLIDER_VARIANT']
    : 1;

$hideSubTitle = isset($arParams['HIDE_SUBTITLE'])
    && $arParams['HIDE_SUBTITLE'] === 'Y';

?>
<div class="product-slider-box" data-entity="<?= $containerName ?>">

    <?php if (!empty($arParams['SLIDER_TITLE'])): ?>

        <div class="best">
            <?php if (!$hideSubTitle): ?>
                <p><?= GetMessage('CT_BCT_TPL_BEST_OFFERS_TITLE') ?></p>
            <?php endif ?>
            <p><?= $arParams['SLIDER_TITLE'] ?></p>
        </div>

    <?php endif ?>

    <?
    if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS']))
    {
        $areaIds = array();

        foreach ($arResult['ITEMS'] as $item)
        {
            $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
            $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
            $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
        }
        ?>

        <div class="product-slider">
            <?php foreach ($arResult['ITEMS'] as $item): ?>

                <div class="slide">
                    <?
                    $APPLICATION->IncludeComponent(
                        'bitrix:catalog.item',
                        'product-item',
                        array(
                            'RESULT' => array(
                                'ITEM'                 => $item,
                                'AREA_ID'              => $areaIds[$item['ID']],
                                'TYPE'                 => 'card',
                                'BIG_LABEL'            => 'N',
                                'BIG_DISCOUNT_PERCENT' => 'N',
                                'BIG_BUTTONS'          => 'N',
                                'SCALABLE'             => 'N',
                                'CITIES_LIST' => $arResult["CITIES_LIST"]
                            ),
                            'PARAMS' => $generalParams
                                + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                        ),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );
                    ?>
                </div>

            <?php endforeach ?>
        </div>

        <?
        unset($generalParams);
        ?>

        <?
    }
    else
    {
        // load css for bigData/deferred load
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.item',
            'product-item',
            array(),
            $component,
            array('HIDE_ICONS' => 'Y')
        );
    }

    $signer         = new \Bitrix\Main\Security\Sign\Signer;
    $signedTemplate = $signer->sign($templateName, 'catalog.top');
    $signedParams   = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.top');
    ?>
</div>
<script>
    BX.message({
        RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
        RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>'
    });
    var <?=$obName?> = new JCCatalogTopComponent({
        siteId             : '<?=CUtil::JSEscape(SITE_ID)?>',
        componentPath      : '<?=CUtil::JSEscape($componentPath)?>',
        deferredLoad       : false, // enable it for deferred load
        initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
        bigData            : <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
        template           : '<?=CUtil::JSEscape($signedTemplate)?>',
        ajaxId             : '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
        parameters         : '<?=CUtil::JSEscape($signedParams)?>',
        container          : '<?=$containerName?>',
        sliderContainer    : '<?= $arParams['SLIDER_CONTAINER'] ?>',
        sliderParamsVariant: <?= $sliderParamsVariant ?>
    });
</script>