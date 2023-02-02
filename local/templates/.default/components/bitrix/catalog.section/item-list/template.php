<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="catalog-section">
    <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>

		<div class="catalog-item" id="<?=$this->GetEditAreaId($arElement['ID']);?>" <?=($cell%$arParams["LINE_ELEMENT_COUNT"] == 0)?"class='npl'":""?>>
			<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
				<div class="img-wrap" <?/*style="background: url('<?=$arElement["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;"*/?>>
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
						<?/* <img border="0" src="<?=$templateFolder?>/images/catalog-img-wrap.png" width="140px" height="120px" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /> */?>
						
						<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["src"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
					</a>
					<br />
				</div>
			<?else:?>
				<div class="img-wrap">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
					<img border="0" src="<?=$templateFolder?>/images/no-photo.png" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				</a>
				<br />
				</div>
			<?endif?>
			
			<?if(0 && $arElement["PROPERTIES"]["MODEL"]["VALUE"]){?>
				<a class="tov_url_fix" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=trim($arElement["PROPERTIES"]["MODEL"]["VALUE"])?></a><br />
			<?}else{?>
				<a class="tov_url_fix" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=trim($arElement["NAME"])?></a><br />
			<?}?>
			<?//if(strlen($arElement["PREVIEW_TEXT"])>0):?>
			<?//=$arElement["PREVIEW_TEXT"]?>
			<?//endif;?>
    		<?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"]))   //if product has offers
				{?>
                    <span class="catalog-price"><?=GetMessage("FROM");?><?=CurrencyFormat($arElement["PROPERTIES"]["MIN_PRICE"]["VALUE"], 'RUB');?></span>
				<?
                }
				else // if product doesn't have offers
				{
					$numPrices = count($arParams["PRICE_CODE"]);
					foreach($arElement["PRICES"] as $code=>$arPrice):
						if($arPrice["CAN_ACCESS"]):?>
							
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <s><?=$arPrice["PRINT_VALUE"]?></s><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
    						<?else:?>
    							<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
    						<?endif;
						endif;
					endforeach;?>
	      			<!-- /************************НОВОЕ*****************************/ -->

					<div class="browse_but2">
						<button type="button" class="button pokupka action_ajax" href="/local/ajax/action.php?action=add_to_basket&product_id=<?=$arElement['ID']?>&price_id=<?=$arElement["MIN_PRICE"]["ID"]?>" onclick="javascript:send_in_cart('<?=$this->GetEditAreaId($arElement['ID']);?>')" ><span>Купить</span></button>
						<?//<button type="button" class="button bron" ><span>Бронировать</span></button>?>
					</div>
					<!-- /************************НОВОЕ*****************************/ -->
				<?
				}
				?>
		</div>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
