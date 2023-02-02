<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
<div style="clear: both;height: 30px;"></div>
<div class="catalog-items-add">
<div class="items-add-title"><?=GetMessage("CATALOG_ITEMS_ADD")?></div>
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
						  <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img style="border:solid 1px rgba(0,0,0,0.3); border-radius:5px;" src="<?=$templateFolder?>/images/catalog-img-wrap.png" width="140px" height="120px" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
                      </div>
			<?else:?>
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img style="border:solid 1px rgba(0,0,0,0.3); border-radius:5px;" src="<?=$templateFolder?>/images/PP.png" width="140px" height="120px" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
			<?endif?>
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a><br />
            <?if(strlen($arElement["PREVIEW_TEXT"])>0):?>
            	<?=$arElement["PREVIEW_TEXT"]?><br />
        	<?endif;?>
    		<?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"]))   //if product has offers
				{
					if (count($arElement["OFFERS"]) > 1)
					{
					?>
						<span class="catalog-price">
					<?
						echo GetMessage("CR_PRICE_OT");
						echo $arElement["PRINT_MIN_OFFER_PRICE"];
					?>
						</span>
					<?
					}
					else
					{
						foreach($arElement["OFFERS"] as $arOffer):?>
							<?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
								<?if($arPrice["CAN_ACCESS"]):?>
										<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                            <s><?=$arPrice["PRINT_VALUE"]?></s><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
										<?else:?>
											<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
										<?endif?>
								<?endif;?>
							<?endforeach;?>
						<?endforeach;
					}
				}
				else // if product doesn't have offers
				{
					$numPrices = count($arParams["PRICE_CODE"]);
					foreach($arElement["PRICES"] as $code=>$arPrice):
						if($arPrice["CAN_ACCESS"]):?>
							<?if ($numPrices>1):?><p style="padding: 0; margin-bottom: 5px;"><?=$arResult["PRICES"][$code]["TITLE"];?>:</p><?endif?>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <s><?=$arPrice["PRINT_VALUE"]?></s><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
    						<?else:?>
    							<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
    						<?endif;
						endif;
					endforeach;
				}
				?>
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
<?endif;?>