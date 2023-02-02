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
<div class="d-none d-md-block">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>    
    <div class="contacts-sidebar" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <?$coords = (explode(',',$arItem["DISPLAY_PROPERTIES"]["LOCATION"]["VALUE"]));?>
        <div class="contacts-sidebar__map" data-ymap='{"coords": ["<?=$coords[0]?>", "<?=$coords[1]?>"], "address": "Белогорск, ул. Нагорная,1А", "placemarkSizes": ["19", "25"]}'></div>
        <div class="contacts-sidebar__meta">
            <h5 class="contacts-sidebar__company-name"><?=$arItem["NAME"];?></h5>
            <?if ($arItem["PROPERTIES"]["ADDRESS"]["VALUE"] && $arItem["PROPERTIES"]["PHONE"]["VALUE"] && $arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]){?>
            <div class="contacts-sidebar__company-info">
                <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?> <br>
                тел: <a href="tel:<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?>"><?=htmlspecialchars_decode($arItem["PROPERTIES"]["PHONE"]["VALUE"])?></a>,<br>
                Режим работы: <?=htmlspecialchars_decode($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"])?>
            </div>
            <?}else{?>
            <div class="contacts-sidebar__company-info">
               <?=htmlspecialchars_decode($arItem["PROPERTIES"]["CONTACTS"]["VALUE"]["TEXT"]);?> 
            </div>
            <?}?>
        </div>
    </div>
    <?endforeach;?>
</div>

