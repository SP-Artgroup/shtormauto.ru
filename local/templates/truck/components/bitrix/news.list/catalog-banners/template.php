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
<div class="catalog-section-slider">
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

        $pict = $arItem['PREVIEW_PICTURE'];
        $url  = $arItem['PROPERTIES']['URL']['VALUE'];
        ?>

        <div class="slide" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">

            <? if ($url): ?>
                <a href="<?= $url ?>">
            <? endif ?>

            <img
                src="<?= $pict['SRC'] ?>"
                alt="<?= $pict['ALT'] ?>"
                title="<?= $pict['TITLE'] ?>"
            >

            <? if ($url): ?>
                </a>
            <? endif ?>

        </div>

    <? endforeach ?>
</div>