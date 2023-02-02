<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-element">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
        	<td width="0%" valign="top">
                <div class="main-img">
        		<?if(is_array($arResult["PREVIEW_PICTURE"])):?>
                    <div style="background: url('<?=$arResult["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;width: 220px;height: 190px;">
                        <a class="big-img" rel="photos" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"><img border="0" src="<?=$templateFolder?>/images/detail-img-wrap.png" width="220px" height="190px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
                    </div>
                <?elseif(is_array($arResult["DETAIL_PICTURE"])):?>
                    <div style="background: url('<?=$arResult["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;width: 220px;height: 190px;">
                        <a class="big-img" rel="photos" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"><img border="0" src="<?=$templateFolder?>/images/detail-img-wrap.png" width="220px" height="190px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
                    </div>
                <?else:?>
                    <img style="border:solid 1px rgba(0,0,0,0.3); border-radius:5px;" src="<?=$templateFolder?>/images/PP.png" width="220px" height="190px" />
                <?endif?>
                <?if($arResult["PROPERTIES"]["NEWITEM"]["VALUE"] == "Y"):?>
                    <div class="new-icon"><img src="<?=$templateFolder?>/images/new-icon.png" width="70px" height="70px" /></div>
                <?endif;?>
                </div>
                <?if(count($arResult["MORE_PHOTO"])>0):?>
            		<?foreach($arResult["MORE_PHOTO"] as $cell=>$PHOTO):?>
                        <div class="more-photo <?=($cell%3==0)?"nml":""?>" style="background: url('<?=$PHOTO["MIN"]["src"]?>') center center no-repeat;width: 70px;height: 50px;">
            			    <a href="<?=$PHOTO["SRC"]?>" class="big-img" rel="photos"><img border="0" src="<?=$templateFolder?>/images/more-photo-wrap.png" width="70px" height="50px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
                        </div>
            		<?endforeach?>
            	<?endif?>
        	</td>
        	<td width="100%" valign="top" class="properties">
                <h1><?=$arResult["NAME"]?></h1>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="offers">
                        <tr>
                            <th>Цена</th>
                        </tr>
						<tr>
							<td>
                            	<?$numPrices = count($arParams["PRICE_CODE"]);
					foreach($arResult["PRICES"] as $code=>$arPrice):
						if($arPrice["CAN_ACCESS"]):?>
							<?if ($numPrices>1):?><p style="padding: 0; margin-bottom: 5px;"><?=$arResult["PRICES"][$code]["TITLE"];?>:</p><?endif?>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                <s><?=$arPrice["PRINT_VALUE"]?></s><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
    						<?else:?>
    							<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
    						<?endif;
						endif;
					endforeach;?>
                            </td>
                        </tr>
					</table>
                <?if(!empty($arResult["OFFERS"])):?>

                <?else:?>
                    <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
            			<div class="property"><span class="name"><?=$arProperty["NAME"]?>:</span>&nbsp;<?
            			if(!empty($arProperty["DISPLAY_VALUE"])):
            				echo $arProperty["DISPLAY_VALUE"];?>
            			<?endif?>
                        </div>
            		<?endforeach?>
                <?endif;?>
        	</td>
		</tr>
	</table>
    <br />
    <div class="description-title"><?=GetMessage("CATALOG_DESCRIPTION")?></div>
	<?if($arResult["DETAIL_TEXT"]):?>
		<br /><?=$arResult["DETAIL_TEXT"]?><br />
	<?elseif($arResult["PREVIEW_TEXT"]):?>
		<br /><?=$arResult["PREVIEW_TEXT"]?><br />
	<?endif;?>
    <br />
    <?if(is_array($arResult["SECTION"])):?>
		<br /><a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><<<?=GetMessage("CATALOG_BACK")?></a><br />
	<?endif?>
</div>