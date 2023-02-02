<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">
<h1><?=$arResult["NAME"]?></h1>
<?if($arResult["DESCRIPTION"]):?>
    <br /><?=$arResult["DESCRIPTION"]?>
    <div style="clear: both;height: 1px;margin: 10px 0 20px 0;border-top:1px dotted #666666;"></div>
<?endif;?>
<div class="sort-block">
    <span>Сортировка по цене</span>
    <?if(isset($_REQUEST["sort"]) && $_REQUEST["sort"]=="desc"):?>
        <a href="<?=$APPLICATION->GetCurPageParam("sort=asc", array("sort"));?>" class="sort asc" title="Сортировать по возрастанию"></a>
    <?else:?>
        <a href="<?=$APPLICATION->GetCurPageParam("sort=desc", array("sort"));?>" class="sort desc" title="Сортировать по убыванию"></a>
    <?endif;?>
</div>
<table cellpadding="0" cellspacing="0" border="0">
    <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<tr>
		<?endif;?>
		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%" id="<?=$this->GetEditAreaId($arElement['ID']);?>" <?=($cell%$arParams["LINE_ELEMENT_COUNT"] == 0)?"class='npl'":""?>>
			<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
                <div style="background: url('<?=$arElement["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;width: 140px;height: 120px;">
				    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$templateFolder?>/images/catalog-img-wrap.png" width="140px" height="120px" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
                </div>
			<?else:?>
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$templateFolder?>/images/no-photo.png" style="border:solid 1px rgba(0,0,0,0.3); border-radius:5px;" width="140px" height="120px" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
			<?endif?>
			<div style="width:140px; overflow:hidden;">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=trim($arElement["NAME"])?></a><br />
			</div>
			<?//if(strlen($arElement["PREVIEW_TEXT"])>0):?>
			<?//=trim($arElement["PREVIEW_TEXT"],"\"\'\t\n\r\0\x0B")?>
			<?//endif;?>
            <?if(!empty($arElement["OFFERS"])):?>
                <span class="catalog-price"><?=GetMessage("FROM");?><?=CurrencyFormat($arElement["PROPERTIES"]["MIN_PRICE"]["VALUE"], 'RUB');?></span>
            <?else:?>
                <?foreach($arElement["PRICES"] as $code=>$arPrice):
      				if($arPrice["CAN_ACCESS"]):
      					if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                            <s><?=$arPrice["PRINT_VALUE"]?></s><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
        				<?else:?>
        					<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
        				<?endif;
      				endif;
      			endforeach;?>
            <?endif;?>
		</td>
		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif?>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
