<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="news-list">
<div style="clear: both;height: 10px;"></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	$propCity = $arItem['DISPLAY_PROPERTIES']['CITY'];

	$city = !empty($propCity['VALUE'])
		? ' г. ' . $propCity['LINK_ELEMENT_VALUE'][$propCity['VALUE']]['NAME']
		: null;

	$displayName = explode(',', $arItem['NAME'])[0] . $city;
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                		<div style="background: url('<?=$arItem["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;" class="img-wrap">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><img border="0" src="<?=$templateFolder?>/images/news-img-wrap.png" width="140px" height="110px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
                		</div>
			<?else:?>
				<div style="background: url('<?=$arItem["PREVIEW_PICTURE"]["src"]?>') center center no-repeat; width: 140px; height: 110px; float: left;">
					<img border="0" src="<?=$templateFolder?>/images/news-img-wrap.png" width="140px" height="110px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
                		</div>
			<?endif;?>
		<?endif?>

		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><b><?= $displayName ?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?><br />
		<?endif;?>
        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>" class="more"><?=GetMessage("MORE_INFO");?></a>
        <?endif;?>

	</div>

<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
