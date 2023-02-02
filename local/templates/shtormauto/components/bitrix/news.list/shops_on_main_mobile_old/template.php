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
<div class="d-md-none">
    <div class="filters all_address">
        <h4><?=GetMessage("SHOPS_ON_MAIN_TITLE")?></h4>
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>    
        <div class="contacts-sidebar__meta">
            <a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="title"><?=$arItem["NAME"];?></a>
            <?if ($arItem["PROPERTIES"]["ADDRESS"]["VALUE"] && $arItem["PROPERTIES"]["PHONE"]["VALUE"] && $arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]){?>
                <span>
                    <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?> <br>
                    Телефон: <a href="tel:<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?>"><?=htmlspecialchars_decode($arItem["PROPERTIES"]["PHONE"]["VALUE"])?></a>,<br>
                    <?//Режим работы: <?=htmlspecialchars_decode($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"])?>
                </span>
            <?}else{?>
                <span>
                   <?=htmlspecialchars_decode($arItem["PROPERTIES"]["CONTACTS"]["VALUE"]["TEXT"]);?> 
                </span>
            <?}?>
        </div>
        <?endforeach;?>
    </div> 
</div>

