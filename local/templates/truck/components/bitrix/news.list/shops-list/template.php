<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$msg        = [];
$langPrefix = 'CT_BNL_SHOPS_LIST_';

foreach ([
    'element_delete_confirm',
    'showby',
    'more',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . strtoupper($langCode));
}

$hermitageParams = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => $msg['element_delete_confirm']],
];

$elementQuantity = $arResult['NAV_RESULT']->nSelectedCount;

$showDetailLink  = !$arParams['HIDE_LINK_WHEN_NO_DETAIL']
    || $arResult['USER_HAVE_ACCESS'];

?>
<div class="shops-container">

    <?if ($arParams['DISPLAY_TOP_PAGER']): ?>
        <?= $arResult['NAV_STRING'] ?><br />
    <? endif ?>

    <? foreach ($arResult['ITEMS'] as $arItem): ?>

        <?
        $this->AddEditAction(
            $arItem['ID'],
            $arItem['EDIT_LINK'],
            $hermitageParams['EDIT']
        );

        $this->AddDeleteAction(
            $arItem['ID'],
            $arItem['DELETE_LINK'],
            $hermitageParams['DELETE'],
            $hermitageParams['CONFIRM']
        );

        $previewPict     = $arItem['PREVIEW_PICTURE'];
        $showPreviewPict = $arParams['DISPLAY_PICTURE'] !== 'N' && is_array($previewPict);

        $tpl = $arItem['tpl'];
        ?>

        <div class="shop-item" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">

            <? if ($showPreviewPict): ?>

                <? if ($showDetailLink): ?>
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                <? endif ?>

                <span
                    class="img"
                    title="<?= $previewPict['TITLE'] ?>"
                    style="background-image: url(<?= $previewPict['SRC'] ?>)"
                ></span>

                <? if ($showDetailLink): ?>
                    </a>
                <? endif ?>

            <?endif?>

            <div class="text-block">

                <? if ($arParams['DISPLAY_NAME'] != 'N' && $arItem['NAME']): ?>

                    <? if ($showDetailLink): ?>
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                    <? endif ?>

                    <p class="city"><?= $arItem['NAME'] ?></p>

                    <? if ($showDetailLink): ?>
                        </a>
                    <? endif ?>

                <? endif ?>

                <?php if ($tpl['address']): ?>
                    <p class="street"><?= $tpl['address'] ?></p>
                <?php endif ?>

                <?php if ($tpl['phone']): ?>
                    <p class="mobile-phone">
                        <?php foreach ($tpl['phone'] as $phone): ?>
                            <a href="tel:<?= $phone ?>">
                                <i class="fas fa-phone"></i>
                                <?= $phone ?>
                            </a>
                        <?php endforeach ?>
                    </p>
                <?php endif ?>

                <? if ($arParams['DISPLAY_PREVIEW_TEXT'] != 'N' && $tpl['desc']): ?>
                    <p class="text"><?= $tpl['desc'] ?></p>
                <? endif ?>

                <? if ($showDetailLink): ?>
                    <div class="btn2">
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее</a>
                    </div>
                <? endif ?>

            </div>
        </div>

    <? endforeach ?>

    <div class="filter-setting">
        <p class="quantity">Всего <i><?= $elementQuantity ?></i> магазинов и автосалонов</p>

        <?if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
            <br /><?=$arResult['NAV_STRING']?>
        <?endif?>

        <?php if (!empty($arParams['SHOWBY_PARAMS'])): ?>
            <div class="select-container">
                <select class="selectcustom js-showby-select">
                    <?php foreach ($arParams['SHOWBY_PARAMS'] as $showBy): ?>
                        <option
                            value="<?= $showBy ?>"
                            <?php if ($showBy === $arParams['NEWS_COUNT']): ?>
                                selected
                            <?php endif ?>
                        ><?= str_replace('#quantity#', $showBy, $msg['showby']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        <?php endif ?>

    </div>

</div>