<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-line">
	<? //dump($arResult["ITEMS"]) ?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<? if(!empty($arItem['PROPERTY_LINK_VALUE'])) { ?>
			<a href="<?=$arItem['PROPERTY_LINK_VALUE']?>" title="<?$atItem['LINK']?>">
		<? } ?>
	        <img style="margin-top: 20px; float: right;" id="<?=$this->GetEditAreaId($arItem['ID']);?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" />
		<? if(!empty($arItem['PROPERTY_LINK_VALUE'])) { ?>
			</a>
		<? } ?>
	<?endforeach;?>
    <div style="clear: both;"></div>
</div>
