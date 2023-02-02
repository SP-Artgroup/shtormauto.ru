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

<div class="tiled-categories">
    <div class="row flex-column flex-lg-row">
        <div class="col-lg-6">
            <div class="row">
                <?$arItem = $arResult["ITEMS"][0];
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));                    
                    ?>                    
                <div class="col-md-6 col-lg-12">
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="tiled-categories__item tiled-categories__item--tires" <?=($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] == "Y")?'style="background-color: #'.$arItem["PROPERTIES"]["BGCOLOR"]["VALUE"].'; background-image: url('.$arItem["PREVIEW_PICTURE"]["SRC"].'); background-position: center; background-size: 95%;"':''?>>
                            <? if($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] != "Y"):?>
                                <h2 class="tiled-categories__item-heading"><?=$arItem["NAME"]?></h2>
                            <? endif;?>
                            <div class="tiled-categories__item-description">
                                <?=$arItem["PREVIEW_TEXT"];?>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 d-block d-lg-none">
                    <?$arItem = $arResult["ITEMS"][1];?>
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">
                        <div class="tiled-categories__item tiled-categories__item--discs" <?=($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] == "Y")?'style="background-color: #'.$arItem["PROPERTIES"]["BGCOLOR"]["VALUE"].'; background-image: url('.$arItem["PREVIEW_PICTURE"]["SRC"].'); background-position: center; background-size: 95%;"':''?>>
                            <? if($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] != "Y"):?>
                                <h2 class="tiled-categories__item-heading"><?=$arItem["NAME"]?></h2>
                            <? endif;?>
                            <div class="tiled-categories__item-description">
                                 <?=$arItem["PREVIEW_TEXT"];?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?$arItem = $arResult["ITEMS"][1];
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));                    
                    ?>                
            <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="tiled-categories__item tiled-categories__item--discs d-none d-lg-flex" <?=($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] == "Y")?'style="background-color: #'.$arItem["PROPERTIES"]["BGCOLOR"]["VALUE"].'; background-image: url('.$arItem["PREVIEW_PICTURE"]["SRC"].'); background-position: center; background-size: 95%;"':''?>>
                    <? if($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] != "Y"):?>
                        <h2 class="tiled-categories__item-heading"><?=$arItem["NAME"]?></h2>
                    <? endif;?>
                    <div class="tiled-categories__item-description">
                        <?=$arItem["PREVIEW_TEXT"];?>
                    </div>
                </div>
            </a>
            <div class="row">
                <div class="col-md-6">
                    <?$arItem = $arResult["ITEMS"][2];
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));                    
                    ?>                    
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="tiled-categories__item tiled-categories__item--accumulators" <?=($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] == "Y")?'style="background-color: #'.$arItem["PROPERTIES"]["BGCOLOR"]["VALUE"].'; background-image: url('.$arItem["PREVIEW_PICTURE"]["SRC"].'); background-position: center; background-size: 95%;"':''?>>
                            <? if($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] != "Y"):?>
                                <h2 class="tiled-categories__item-heading"><?=$arItem["NAME"]?></h2>
                            <? endif;?>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <?$arItem = $arResult["ITEMS"][3];
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));                    
                    ?>
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="tiled-categories__item tiled-categories__item--oils" <?=($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] == "Y")?'style="background-color: #'.$arItem["PROPERTIES"]["BGCOLOR"]["VALUE"].'; background-image: url('.$arItem["PREVIEW_PICTURE"]["SRC"].'); background-position: center; background-size: 95%;"':''?>>
                            <? if($arItem["PROPERTIES"]["ONLY_IMAGE"]["VALUE_XML_ID"] != "Y"):?>
                                <h2 class="tiled-categories__item-heading"><?=$arItem["NAME"]?></h2>
                            <? endif;?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

