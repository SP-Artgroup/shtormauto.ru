<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?	
//	dump($arResult);
?>

<?/*
<div class="bx_my_order_switch">
	<a class="bx_mo_link" href="<?=$arResult["URL_TO_LIST"]?>"><?=GetMessage('SPOD_CUR_ORDERS')?></a>
</div>
*/?>
<div class="oder_page">
	<div class="oder_page_desc">
		<div class="param_name">Параметры заказа</div>
	</div>
</div>
<div class="bx_order_list">

	<?if(strlen($arResult["ERROR_MESSAGE"])):?>

		<?=ShowError($arResult["ERROR_MESSAGE"]);?>

	<?else:?>
	
		<table class="bx_order_list_table">
			<thead>
				<tr>
					<td colspan="2">
						<?=GetMessage('SPOD_ORDER')?> <?=GetMessage('SPOD_NUM_SIGN')?><?=$arResult["ACCOUNT_NUMBER"]?>
						<?if(strlen($arResult["DATE_INSERT_FORMATED"])):?>
							<?=GetMessage("SPOD_FROM")?> <?=$arResult["DATE_INSERT_FORMATED"]?>
						<?endif?>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?=GetMessage('SPOD_ORDER_STATUS')?>:
					</td>
					<td>
						<?=$arResult["STATUS"]["NAME"]?>
						<?if(strlen($arResult["DATE_STATUS_FORMATED"])):?>
							(<?=GetMessage("SPOD_FROM")?> <?=$arResult["DATE_STATUS_FORMATED"]?>)
						<?endif?>
					</td>
				</tr>
				<tr>
					<td>
						<?=GetMessage('SPOD_ORDER_PRICE')?>:
					</td>
					<td>
						<?=$arResult["PRICE_FORMATED"]?>
						<?if(floatval($arResult["SUM_PAID"])):?>
							(<?=GetMessage('SPOD_ALREADY_PAID')?>:&nbsp;<?=$arResult["SUM_PAID_FORMATED"]?>)
						<?endif?>
					</td>
				</tr>

				<?if($arResult["CANCELED"] == "Y" || $arResult["CAN_CANCEL"] == "Y"):?>
					<tr>
						<td><?=GetMessage('SPOD_ORDER_CANCELED')?>:</td>
						<td>
							<?if($arResult["CANCELED"] == "Y"):?>
								<?=GetMessage('SPOD_YES')?>
								<?if(strlen($arResult["DATE_CANCELED_FORMATED"])):?>
									(<?=GetMessage('SPOD_FROM')?> <?=$arResult["DATE_CANCELED_FORMATED"]?>)
								<?endif?>
							<?elseif($arResult["CAN_CANCEL"] == "Y"):?>
								<?=GetMessage('SPOD_NO')?>&nbsp;&nbsp;&nbsp;[<a href="<?=$arResult["URL_TO_CANCEL"]?>"><?=GetMessage("SPOD_ORDER_CANCEL")?></a>]
							<?endif?>
						</td>
					</tr>
				<?endif?>

				<tr><td><br></td><td></td></tr>

				<?if(intval($arResult["USER_ID"])):?>

					<tr>
						<td colspan="2"><?=GetMessage('SPOD_ACCOUNT_DATA')?></td>
					</tr>
					<?if(strlen($arResult["USER_NAME"])):?>
						<tr>
							<td><?=GetMessage('SPOD_ACCOUNT')?>:</td>
							<td><?=$arResult["USER_NAME"]?></td>
						</tr>
					<?endif?>
					<tr>
						<td><?=GetMessage('SPOD_LOGIN')?>:</td>
						<td><?=$arResult["USER"]["LOGIN"]?></td>
					</tr>
					<tr>
						<td><?=GetMessage('SPOD_EMAIL')?>:</td>
						<td><a href="mailto:<?=$arResult["USER"]["EMAIL"]?>"><?=$arResult["USER"]["EMAIL"]?></a></td>
					</tr>

					<tr><td><br></td><td></td></tr>

				<?endif?>

				<tr>
					<td colspan="2"><?=GetMessage('SPOD_ORDER_PROPERTIES')?></td>
				</tr>
				<tr>
					<td><?=GetMessage('SPOD_ORDER_PERS_TYPE')?>:</td>
					<td><?=$arResult["PERSON_TYPE"]["NAME"]?></td>
				</tr>
				<?/*				
				<tr>
					<td><?=GetMessage('SPOD_ORDER_COMPLETE_SET')?>:</td>
					<td></td>
				</tr>
				*/?>

				<?foreach($arResult["ORDER_PROPS"] as $prop):?>

					<?if($prop["SHOW_GROUP_NAME"] == "Y"):?>

						<tr><td><br></td><td></td></tr>
						<tr>
							<td colspan="2"><?=$prop["GROUP_NAME"]?></td>
						</tr>

					<?endif?>

					<tr>
						<td><?=$prop['NAME']?>:</td>
						<td>

							<?if($prop["TYPE"] == "CHECKBOX"):?>
								<?=GetMessage('SPOD_'.($prop["VALUE"] == "Y" ? 'YES' : 'NO'))?>
							<?else:?>
								<?=$prop["VALUE"]?>
							<?endif?>

						</td>
					</tr>

				<?endforeach?>

				<?if(!empty($arResult["USER_DESCRIPTION"])):?>

					<tr>
						<td><?=GetMessage('SPOD_ORDER_USER_COMMENT')?>:</td>
						<td><?=$arResult["USER_DESCRIPTION"]?></td>
					</tr>

				<?endif?>

				<tr><td><br></td><td></td></tr>

				<tr>
					<td colspan="2"><?=GetMessage("SPOD_ORDER_PAYMENT")?></td>
				</tr>
				<tr>
					<td><?=GetMessage('SPOD_PAY_SYSTEM')?>:</td>
					<td>
						<?if(intval($arResult["PAY_SYSTEM_ID"])):?>
							<?=$arResult["PAY_SYSTEM"]["NAME"]?>
						<?else:?>
							<?=GetMessage("SPOD_NONE")?>
						<?endif?>
					</td>
				</tr>
				<tr>
					<td><?=GetMessage('SPOD_ORDER_PAYED')?>:</td>
					<td>
						<?if($arResult["PAYED"] == "Y"):?>
							<?=GetMessage('SPOD_YES')?>
							<?if(strlen($arResult["DATE_PAYED_FORMATED"])):?>
								(<?=GetMessage('SPOD_FROM')?> <?=$arResult["DATE_PAYED_FORMATED"]?>)
							<?endif?>
						<?else:?>
							<?=GetMessage('SPOD_NO')?>
							<?if($arResult["CAN_REPAY"]=="Y" && $arResult["PAY_SYSTEM"]["PSA_NEW_WINDOW"] == "Y"):?>
								&nbsp;&nbsp;&nbsp;[<a href="<?=$arResult["PAY_SYSTEM"]["PSA_ACTION_FILE"]?>" target="_blank"><?=GetMessage("SPOD_REPEAT_PAY")?></a>]
							<?endif?>
						<?endif?>
					</td>
				</tr>

				<tr>
					<td><?=GetMessage("SPOD_ORDER_DELIVERY")?>:</td>
					<td>
						<?if(strpos($arResult["DELIVERY_ID"], ":") !== false || intval($arResult["DELIVERY_ID"])):?>
							<?=$arResult["DELIVERY"]["NAME"]?>

							<?if(intval($arResult['STORE_ID']) && !empty($arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']])):?>

								<?$store = $arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']];?>
								<div class="bx_ol_store">
									<div class="bx_old_s_row_title">
										<?=GetMessage('SPOD_TAKE_FROM_STORE')?>: <b><?=$store['TITLE']?></b>

										<?if(!empty($store['DESCRIPTION'])):?>
											<div class="bx_ild_s_desc">
												<?=$store['DESCRIPTION']?>
											</div>
										<?endif?>

									</div>
									
									<?if(!empty($store['ADDRESS'])):?>
										<div class="bx_old_s_row">
											<b><?=GetMessage('SPOD_STORE_ADDRESS')?></b>: <?=$store['ADDRESS']?>
										</div>
									<?endif?>

									<?if(!empty($store['SCHEDULE'])):?>
										<div class="bx_old_s_row">
											<b><?=GetMessage('SPOD_STORE_WORKTIME')?></b>: <?=$store['SCHEDULE']?>
										</div>
									<?endif?>

									<?if(!empty($store['PHONE'])):?>
										<div class="bx_old_s_row">
											<b><?=GetMessage('SPOD_STORE_PHONE')?></b>: <?=$store['PHONE']?>
										</div>
									<?endif?>

									<?if(!empty($store['EMAIL'])):?>
										<div class="bx_old_s_row">
											<b><?=GetMessage('SPOD_STORE_EMAIL')?></b>: <a href="mailto:<?=$store['EMAIL']?>"><?=$store['EMAIL']?></a>
										</div>
									<?endif?>

									<?if(($store['GPS_N'] = floatval($store['GPS_N'])) && ($store['GPS_S'] = floatval($store['GPS_S']))):?>
										
										<div id="bx_old_s_map">

											<div class="bx_map_buttons">
												<a href="javascript:void(0)" class="bx_big bx_bt_button_type_2 bx_cart" id="map-show">
													<?=GetMessage('SPOD_SHOW_MAP')?>
												</a>

												<a href="javascript:void(0)" class="bx_big bx_bt_button_type_2 bx_cart" id="map-hide">
													<?=GetMessage('SPOD_HIDE_MAP')?>
												</a>
											</div>

											<?ob_start();?>
												<div><?$mg = $arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']]['IMAGE'];?>
													<?if(!empty($mg['SRC'])):?><img src="<?=$mg['SRC']?>" width="<?=$mg['WIDTH']?>" height="<?=$mg['HEIGHT']?>"><br /><br /><?endif?>
													<?=$store['TITLE']?></div>
											<?$ballon = ob_get_contents();?>
											<?ob_end_clean();?>

											<?
												$mapId = '__store_map';

												$mapParams = array(
												'yandex_lat' => $store['GPS_N'],
												'yandex_lon' => $store['GPS_S'],
												'yandex_scale' => 16,
												'PLACEMARKS' => array(
													array(
														'LON' => $store['GPS_S'],
														'LAT' => $store['GPS_N'],
														'TEXT' => $ballon
													)
												));
											?>

											<div id="map-container">

												<?$APPLICATION->IncludeComponent("bitrix:map.yandex.view", ".default", array(
													"INIT_MAP_TYPE" => "MAP",
													"MAP_DATA" => serialize($mapParams),
													"MAP_WIDTH" => "100%",
													"MAP_HEIGHT" => "200",
													"CONTROLS" => array(
														0 => "SMALLZOOM",
													),
													"OPTIONS" => array(
														0 => "ENABLE_SCROLL_ZOOM",
														1 => "ENABLE_DBLCLICK_ZOOM",
														2 => "ENABLE_DRAGGING",
													),
													"MAP_ID" => $mapId
													),
													false
												);?>

											</div>

											<?CJSCore::Init();?>
											<script>
												new CStoreMap({mapId:"<?=$mapId?>", area: '.bx_old_s_map'});
											</script>

										</div>

									<?endif?>

								</div>

							<?endif?>

						<?else:?>
							<?=GetMessage("SPOD_NONE")?>
						<?endif?>
					</td>
				</tr>

				<?if($arResult["TRACKING_NUMBER"]):?>

					<tr>
						<td><?=GetMessage('SPOD_ORDER_TRACKING_NUMBER')?>:</td>
						<td><?=$arResult["TRACKING_NUMBER"]?></td>
					</tr>

					<tr><td><br></td><td></td></tr>

				<?endif?>

				<?if($arResult["CAN_REPAY"]=="Y" && $arResult["PAY_SYSTEM"]["PSA_NEW_WINDOW"] != "Y"):?>
					<tr>
						<td colspan="2">
							<?
								$ORDER_ID = $ID;

								try
								{
									include($arResult["PAY_SYSTEM"]["PSA_ACTION_FILE"]);
								}
								catch(\Bitrix\Main\SystemException $e)
								{
									if($e->getCode() == CSalePaySystemAction::GET_PARAM_VALUE)
										$message = GetMessage("SOA_TEMPL_ORDER_PS_ERROR");
									else
										$message = $e->getMessage();

									ShowError($message);
								}

							?>
						</td>
					</tr>
				<?endif?>

			</tbody>
		</table>
	<?endif?>

</div>
<div class="oder_page">
	<div class="new_zag">Товары в заказе</div>
	<div class="nt_table cart">
		<div class="nt_table_zag">
			<div class="zag1">Название</div>
			<div class="zag2">Цена</div>
			<div class="zag3">Количество</div>
			<div class="zag4">Сумма</div>
			<?/* <div class="zag5"> </div> */?>
		</div>
		<? foreach($arResult['BASKET'] as $basket_item) {?>
			<div class="nt_table_item">
				<div class="zag1">
					<div style="background: url('<?=$basket_item['PICTURE']['SRC']?>') center center no-repeat;" class="img-wrap">
						<a href="<?=$basket_item['DETAIL_PAGE_URL']?>"><img src="/bitrix/templates/.default/components/bitrix/catalog.section/item-list/images/catalog-img-wrap.png" alt="<?=$basket_item['NAME']?>" title="<?=$basket_item['NAME']?>" border="0" height="120px" width="140px"></a><br>
					</div>
					<div class="name">
						<a href="<?=$basket_item['DETAIL_PAGE_URL']?>"><?=$basket_item['NAME']?></a>
					</div>
					<div style="clear: both;"></div>
				</div>
				<div class="zag2">
					<?=$basket_item['PRICE_FORMATED']?>
				</div>
				<div class="zag3">
					<div class="quan_form">
						<?=$basket_item['QUANTITY']?>
					</div>
					<div style="clear: both;"></div>
				</div>
				<div class="zag4">
					<?=CurrencyFormat($basket_item['PRICE'] * $basket_item['QUANTITY'], 'RUB');?>
				</div>
				<?/*
	<div class="zag5">
					<a href="/" class="but_delete"></a>
				</div>
	*/?>
			</div>
		<? } ?>
	</div>
	<div class="itogo_price">ИТОГО: <?=$arResult["PRICE_FORMATED"]?></div>
</div>
	
<table class="bx_control_table" style="width: 100%;">
	<tr>
		<td>  <a href="<?=$arResult["URL_TO_LIST"]?>" class="bx_big bx_bt_button_type_2 bx_cart"><?=GetMessage('SPOD_GO_BACK')?></a></td>
	</tr>
</table>