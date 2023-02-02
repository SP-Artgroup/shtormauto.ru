<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="banner" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if($arItem["TYPE"] == "image"):?>
            <?if($arItem['PROPERTIES']['A_HREF']['VALUE'] != ""):?><a href="<?=$arItem['PROPERTIES']['A_HREF']['VALUE']?>" style="position:relative;display:block;width:100%;height:100%;"><?endif;?><img src="<?=$arItem["VALUE"]?>" alt="<?=$arItem["NAME"]?>" width="460px" height="110px" /><?if($arItem['PROPERTIES']['A_HREF']['VALUE'] != ""):?></a><?endif;?>
        <?elseif($arItem["TYPE"] == "flash"):?>
            <object type="application/x-shockwave-flash" data="<?=$arItem["VALUE"]?>" width="460" height="110" id="banner" align="middle">
                <param name="movie" value="<?=$arItem["VALUE"]?>" />
                <param name=quality value=high>
            </object>
        <?endif;?>
	</div>
<?endforeach;?>