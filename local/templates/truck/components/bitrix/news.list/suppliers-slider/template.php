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

$langPrefix = 'CT_BNL_SUPPLIERS_SLIDER_';
$msg        = [];

foreach ([
    'TITLE',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

$hermitageParams = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')],
];

?>
<div class="suppliers-bg">
    <div class="container">
        <div class="suppliers">

            <h2><?= $msg['title'] ?></h2>

            <div class="product-item">
                <div class="suppliers-slider">

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
                        $displayProps = $arItem['DISPLAY_PROPERTIES'];

                        $title = $arItem['NAME'];

                        $url = !empty($displayProps['URL']['VALUE'])
                            ? $displayProps['URL']['VALUE']
                            : '';
                        ?>

                        <div class="slide" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">

                            <?php if ($url): ?>
                                <a href="<?= $url ?>">
                            <?php endif ?>

                            <img src="<?= $previewPict['SRC'] ?>" alt="<?= $title ?>" title="<?= $title ?>">

                            <?php if ($url): ?>
                                </a>
                            <?php endif ?>

                        </div>

                    <? endforeach ?>

                </div>
            </div>
        </div>
    </div>
</div>