<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$hermitage = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')],
];
?>
<div id="banner_slider_on_main" class="owl-carousel">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>

        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $hermitage['EDIT']);
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $hermitage['DELTE'], $hermitage['CONFIRM']);

        $props = $arItem['PROPERTIES'];
        ?>

        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">

            <? if ($props['A_HREF']['VALUE'] != ""): ?>
                <a href="<?=$props['A_HREF']['VALUE']?>" title="<?=$arItem['NAME']?>">
            <? endif ?>

            <img src="<?=$arItem["VALUE"]?>" alt="<?=$arItem["NAME"]?>" width="460" height="110">

            <? if ($props['A_HREF']['VALUE'] != ""): ?>
                </a>
            <? endif ?>
        </div>

    <? endforeach ?>
</div>