<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["SECTIONS"]):?>
<div class="catalog-section">
<?if(is_array($arResult["SECTION"]["PICTURE"])):?>
    <div class="brand-wrap"><img src="<?=$arResult["SECTION"]["PICTURE"]["src"]?>" width="<?=$arResult["SECTION"]["PICTURE"]["width"]?>" height="<?=$arResult["SECTION"]["PICTURE"]["height"]?>" style="margin: <?=$arResult["SECTION"]["PICTURE"]["MT"]?>px 0 0 <?=$arResult["SECTION"]["PICTURE"]["ML"]?>px;" alt="<?=$arResult["SECTION"]["NAME"]?>" title="<?=$arResult["SECTION"]["NAME"]?>" /></div>
<?endif;?>
<h1><?=$arResult["SECTION"]["NAME"]?></h1>
<?if($arResult["SECTION"]["DESCRIPTION"]):?>
    <br /><?=$arResult["SECTION"]["DESCRIPTION"]?>
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
    <?foreach($arResult["SECTIONS"] as $cell=>$arSection):?>
		<?
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<tr>
		<?endif;?>
		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%" id="<?=$this->GetEditAreaId($arSection['ID']);?>" <?=($cell%$arParams["LINE_ELEMENT_COUNT"] == 0)?"class='npl'":""?>>
			<?if(is_array($arSection["PICTURE"])):?>
                <div style="background: url('<?=$arSection["PICTURE"]["src"]?>') center center no-repeat;width: 140px;height: 120px;">
				    <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img border="0" src="<?=$templateFolder?>/images/catalog-img-wrap.png" width="140px" height="120px" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" /></a><br />
                </div>
			<?else:?>
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img border="0" src="<?=$templateFolder?>/images/no-photo.png" width="140px" height="120px" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" /></a><br />
			<?endif?>
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a><br />
            <?if(intval($arSection["UF_MIN_PRICE"])):?>
                <span class="catalog-price"><?=CurrencyFormat($arSection["UF_MIN_PRICE"], 'RUB');?></span>
            <?endif;?>
		</td>
		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif?>
	<?endforeach;?>

    <?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
    	<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
    		<td>&nbsp;</td>
    	<?endwhile;?>
    	</tr>
    <?endif?>
</table>
</div>
<?endif;?>