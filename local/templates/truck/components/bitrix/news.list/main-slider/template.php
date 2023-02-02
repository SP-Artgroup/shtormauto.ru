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

$langPrefix = 'CT_BNL_MAIN_SLIDER_';
$msg        = [];

foreach ([
    'MORE',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

$hermitageParams = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')],
];

?>
<div class="header-slider">

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

        $previewPict  = $arItem['PREVIEW_PICTURE'];
        $props        = $arItem['PROPERTIES'];
        $displayProps = $arItem['DISPLAY_PROPERTIES'];

        $showPreviewPict = $arParams['DISPLAY_PICTURE'] !== 'N' && is_array($previewPict);
        $showDetailLink  = !$arParams['HIDE_LINK_WHEN_NO_DETAIL']
            || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);

        $url = !empty($displayProps['URL']['VALUE'])
            ? $displayProps['URL']['VALUE']
            : '';

        $title = !empty($displayProps['TITLE']['VALUE'])
            ? $displayProps['TITLE']['VALUE']
            : '';

        $subtitle = !empty($displayProps['SUBTITLE']['VALUE'])
            ? $displayProps['SUBTITLE']['VALUE']
            : '';

        $showDescBlock = !empty($props['SHOW_DESC_BLOCK'])
            && $props['SHOW_DESC_BLOCK']['VALUE'] === 'Y';

        ?>

        <div
            class="slide"
            id="<?= $this->GetEditAreaId($arItem['ID']) ?>"
            <?php if ($previewPict): ?>
                style="background-image: url(<?= $previewPict['SRC'] ?>)"
            <?php endif ?>
        >

            <?php if ($showDescBlock): ?>
                <div class="container">
                    <div class="header-slider-text">

                        <?php if ($title): ?>
                            <h1><?= $title ?></h1>
                        <?php endif ?>

                        <?php if ($subtitle): ?>
                            <h3><?= $subtitle ?></h3>
                        <?php endif ?>

                        <p class="text"><?= $arItem['PREVIEW_TEXT'] ?></p>

                        <?php if ($url): ?>
                            <div class="btn1 link">
                                <a href="<?= $url ?>"><?= $msg['more'] ?></a>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            <?php endif ?>

        </div>

    <? endforeach ?>

</div>



