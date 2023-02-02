<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="brands">
    <div class="brands__list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>122, 'height'=>44), BX_RESIZE_IMAGE_PROPORTIONAL, true); 
        ?>                                                        
        <div class="brands__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><img src="<?=$arFile["src"];?>" alt=""></div>
        <?endforeach;?>
        <div class="brands__item"><div class="brands__placeholder"><?=$arResult["COUNT_ELEMENTS"];?></div><a href="/brands/" class="brands__link">Просмотреть все <br> бренды</a></div>
    </div>
</div>

