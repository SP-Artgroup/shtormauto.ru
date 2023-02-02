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

$hermitageParams = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')],
];

?>
<div class="news-list">

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

        $previewPict    = $arItem['PREVIEW_PICTURE'];

        $showPreviewPict = $arParams['DISPLAY_PICTURE'] !== 'N' && is_array($previewPict);
        $showDetailLink  = !$arParams['HIDE_LINK_WHEN_NO_DETAIL']
            || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);

        ?>

        <p class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">

            <? if ($showPreviewPict): ?>

                <? if ($showDetailLink): ?>
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                <? endif ?>

                <img
                    class="preview_picture"
                    border="0"
                    src="<?= $previewPict['SRC'] ?>"
                    width="<?= $previewPict['WIDTH'] ?>"
                    height="<?= $previewPict['HEIGHT'] ?>"
                    alt="<?= $previewPict['ALT'] ?>"
                    title="<?= $previewPict['TITLE'] ?>"
                    style="float:left"
                >

                <? if ($showDetailLink): ?>
                    </a>
                <? endif ?>

            <?endif?>

            <? if ($arParams['DISPLAY_DATE'] !== 'N' && $arItem['DISPLAY_ACTIVE_FROM']): ?>
                <span class="news-date-time"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
            <? endif ?>

            <? if ($arParams['DISPLAY_NAME'] != 'N' && $arItem['NAME']): ?>

                <? if ($showDetailLink): ?>
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                        <b><?= $arItem['NAME'] ?></b>
                    </a>
                    <br />
                <? else: ?>
                    <b><?= $arItem['NAME'] ?></b>
                    <br />
                <? endif ?>

            <? endif ?>

            <? if ($arParams['DISPLAY_PREVIEW_TEXT'] != 'N' && $arItem['PREVIEW_TEXT']): ?>
                <?= $arItem['PREVIEW_TEXT'] ?>
            <? endif ?>

            <? if ($showPreviewPict): ?>
                <div style="clear:both"></div>
            <? endif ?>

            <? foreach ($arItem['FIELDS'] as $code => $value): ?>
                <small>
                    <?= Loc::getMessage('IBLOCK_FIELD_' . $code) ?>:&nbsp;<?= $value ?>
                </small><br />
            <? endforeach ?>

            <? foreach ($arItem['DISPLAY_PROPERTIES'] as $pid => $arProperty): ?>

                <small>
                    <?= $arProperty['NAME'] ?>:&nbsp;
                    <? if (is_array($arProperty['DISPLAY_VALUE'])): ?>
                        <?= implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']) ?>
                    <? else: ?>
                        <?= $arProperty['DISPLAY_VALUE'] ?>
                    <? endif ?>
                </small>
                <br />

            <? endforeach ?>
        </p>
    <? endforeach ?>

    <?if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
        <br /><?=$arResult['NAV_STRING']?>
    <?endif?>

</div>
