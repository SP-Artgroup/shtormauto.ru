<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$shops     = $arResult['SHOPS'];
$jsonShops = $arResult['SHOPS_TO_JSON'];
$cities    = $arResult['CITIES'];

$shopId        = $arResult['SHOP_ID'];
$currentCityId = $shopId ? $jsonShops[$shopId]['CITY'] : $arResult['CURRENT_CITY_ID'];
$selectedCity  = $currentCityId ? $arResult['CITIES'][$currentCityId] : 'Выберите город:';

$delayDeliveryMessage = $arResult['DELAY_DELIVERY_MESSAGE'];

$personType = $arResult['ORDER_DATA']['PERSON_TYPE_ID'];

$orderPropIds = [
	1 => [
		'SHOP' => 20,
		'OTHER_CITY' => 26,
	],
	2 => [
		'SHOP' => 21,
		'OTHER_CITY' => 27,
	],
];

$orderProps = [];

foreach ($orderPropIds[$personType] as $propCode => $propId) {
	$orderProps[$propCode] = $arResult['ORDER_PROP']['USER_PROPS_N'][$propId];
}

?>
<div class="block_dostavka">

	<? //Свойство "Магазин" для физ. и юр. лица ?>
	<input type="hidden" value="<?=$_REQUEST['ORDER_PROP_20']?>" name="ORDER_PROP_20" id="ORDER_PROP_20" class="order_prop_shop">
	<input type="hidden" value="<?=$_REQUEST['ORDER_PROP_20']?>" name="ORDER_PROP_21" id="ORDER_PROP_21" class="order_prop_shop">

	<? //Свойство "Город" для физ. и юр. лица ?>
	<input type="hidden" value="<?=$_REQUEST['ORDER_PROP_5']?>" name="ORDER_PROP_5" id="ORDER_PROP_5" class="order_prop_city">
	<input type="hidden" value="<?=$_REQUEST['ORDER_PROP_17']?>" name="ORDER_PROP_17" id="ORDER_PROP_17" class="order_prop_city">

	<div class="new_zag">Выберите город получения заказа</div>

	<div class="select">
		<a href="#" class="slct"><?= $selectedCity ?></a>
		<ul class="drop">
			<? foreach ($arResult['CITIES'] as $cityName): ?>
				<li rel="<?= $cityName ?>"><?= $cityName ?></li>
			<? endforeach ?>
		</ul>
		<input type="hidden" value="<?= $currentCityId ?: '' ?>">
	</div>


	<?php if ($delayDeliveryMessage): ?>
		<div class="delay-delivery-message">
			<div class="buy-error-message">
				Возможно некоторых товаров из корзины нет на выбранном складе.<br>
				Они появятся на нём в течении 2-3 дней,
				либо вы можете забрать товары с выбранных складов самостоятельно.
			</div>
		</div>
	<?php endif ?>

	<div class="radioblock">

		<? foreach ($arResult['CITIES'] as $cityId => $cityName): ?>

			<?
			$isCurrentCity = $currentCityId == $cityId;
			$firstShop = true;
			?>

			<div class="city_wrap" rel="<?= $cityName ?>" <?= $isCurrentCity ? 'style="display:block"' : '' ?>>

				<? foreach ($arResult['SHOPS'][$cityName] as $shop): ?>

					<?
					$addCond = $shopId ? $shopId === $shop['ID'] : $firstShop;
					$activeRadio = $isCurrentCity && $addCond;
					?>

					<div class="radio <?= $activeRadio ? 'active' : '' ?>" rel="<?=$shop['ID']?>">

						<strong><?=$shop['NAME']?></strong>

						<? if ($cityName == 'Другой город') { ?>
							<?
							$arProperties = $orderProps['OTHER_CITY'];
							?>
							<br/>
							<input
								style="margin:10px 0;"
								type="text"
								size="30"
								size="<?=$arProperties['SIZE1']?>"
								value="<?=$arProperties['VALUE']?>"
								name="<?=$arProperties['FIELD_NAME']?>"
								id="<?=$arProperties['FIELD_NAME']?>"
								placeholder="Введите название города"
							>
						<? } ?>

						<div class="desc">
							<?= $shop['PROPERTY_CONTACTS_VALUE']['TEXT'] ?>
						</div>
					</div>

					<? $firstShop = false ?>

				<? endforeach ?>

			</div>

		<? endforeach ?>

		&nbsp;
		<input type="hidden" name="SHOP_ID" value="<?=$_REQUEST['SHOP_ID']?>">
	</div>

	<div class="map">
		<div id="map" style="width:100%;height:250px;"></div>
	</div>

</div>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>">

<? /*
<script type="text/javascript">
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

		var storeForm = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': formWidth,
			'height':450,
			'resizable':false,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'crmOk',
				'action': function ()
				{
					GetBuyerStore();
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};

		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});

		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}
</script>

<div class="bx_section">
	<?
	if(!empty($arResult["DELIVERY"]))
	{
		$width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
		?>
		<h4><?=GetMessage("SOA_TEMPL_DELIVERY")?></h4>
		<?

		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
		{
			if ($delivery_id !== 0 && intval($delivery_id) <= 0)
			{
				foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
				{
					?>
					<div class="bx_block w100 vertical">
						<div class="bx_element">

							<input
								type="radio"
								id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
								name="<?=htmlspecialcharsbx($arProfile["FIELD_NAME"])?>"
								value="<?=$delivery_id.":".$profile_id;?>"
								<?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?>
								onclick="submitForm();"
								/>

							<label for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">

								<?
								if (count($arDelivery["LOGOTIP"]) > 0):

									$arFileTmp = CFile::ResizeImageGet(
										$arDelivery["LOGOTIP"]["ID"],
										array("width" => "95", "height" =>"55"),
										BX_RESIZE_IMAGE_PROPORTIONAL,
										true
									);

									$deliveryImgURL = $arFileTmp["src"];
								else:
									$deliveryImgURL = $templateFolder."/images/logo-default-d.gif";
								endif;

								if($arDelivery["ISNEEDEXTRAINFO"] == "Y")
									$extraParams = "showExtraParamsDialog('".$delivery_id.":".$profile_id."');";
								else
									$extraParams = "";

								?>
								<div class="bx_logotype" onclick="BX('ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>').checked=true;<?=$extraParams?>submitForm();">
									<span style='background-image:url(<?=$deliveryImgURL?>);'></span>
								</div>

								<div class="bx_description">

									<strong onclick="BX('ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>').checked=true;<?=$extraParams?>submitForm();">
										<?=htmlspecialcharsbx($arDelivery["TITLE"])." (".htmlspecialcharsbx($arProfile["TITLE"]).")";?>
									</strong>

									<span class="bx_result_price"><!-- click on this should not cause form submit -->
										<?
										if($arProfile["CHECKED"] == "Y" && doubleval($arResult["DELIVERY_PRICE"]) > 0):
										?>
											<div><?=GetMessage("SALE_DELIV_PRICE")?>:&nbsp;<b><?=$arResult["DELIVERY_PRICE_FORMATED"]?></b></div>
										<?
											if ((isset($arResult["PACKS_COUNT"]) && $arResult["PACKS_COUNT"]) > 1):
												echo GetMessage('SALE_PACKS_COUNT').': <b>'.$arResult["PACKS_COUNT"].'</b>';
											endif;

										else:
											$APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
												"NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
												"DELIVERY" => $delivery_id,
												"PROFILE" => $profile_id,
												"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
												"ORDER_PRICE" => $arResult["ORDER_PRICE"],
												"LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
												"LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
												"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
												"ITEMS" => $arResult["BASKET_ITEMS"],
												"EXTRA_PARAMS_CALLBACK" => $extraParams
											), null, array('HIDE_ICONS' => 'Y'));
										endif;
										?>
									</span>

									<p onclick="BX('ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>').checked=true;submitForm();">
										<?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
											<?=nl2br($arProfile["DESCRIPTION"])?>
										<?else:?>
											<?=nl2br($arDelivery["DESCRIPTION"])?>
										<?endif;?>
									</p>
								</div>

							</label>

						</div>
					</div>
					<?
				} // endforeach
			}
			else // stores and courier
			{
				if (count($arDelivery["STORE"]) > 0)
					$clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
				else
					$clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;submitForm();\"";
				?>
					<div class="bx_block w100 vertical">

						<div class="bx_element">

							<input type="radio"
								id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
								name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
								value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
								onclick="submitForm();"
								/>

							<label for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>" <?=$clickHandler?>>

								<?
								if (count($arDelivery["LOGOTIP"]) > 0):

									$arFileTmp = CFile::ResizeImageGet(
										$arDelivery["LOGOTIP"]["ID"],
										array("width" => "95", "height" =>"55"),
										BX_RESIZE_IMAGE_PROPORTIONAL,
										true
									);

									$deliveryImgURL = $arFileTmp["src"];
								else:
									$deliveryImgURL = $templateFolder."/images/logo-default-d.gif";
								endif;
								?>

								<div class="bx_logotype"><span style='background-image:url(<?=$deliveryImgURL?>);'></span></div>

								<div class="bx_description">
									<div class="name"><strong><?= htmlspecialcharsbx($arDelivery["NAME"])?></strong></div>
									<span class="bx_result_price">
										<?
										if (strlen($arDelivery["PERIOD_TEXT"])>0)
										{
											echo $arDelivery["PERIOD_TEXT"];
											?><br /><?
										}
										?>
										<?=GetMessage("SALE_DELIV_PRICE");?>: <b><?=$arDelivery["PRICE_FORMATED"]?></b><br />
									</span>
									<p>
										<?
										if (strlen($arDelivery["DESCRIPTION"])>0)
											echo $arDelivery["DESCRIPTION"]."<br />";

										if (count($arDelivery["STORE"]) > 0):
										?>
											<span id="select_store"<?if(strlen($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"]) <= 0) echo " style=\"display:none;\"";?>>
												<span class="select_store"><?=GetMessage('SOA_ORDER_GIVE_TITLE');?>: </span>
												<span class="ora-store" id="store_desc"><?=htmlspecialcharsbx($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"])?></span>
											</span>
										<?
									endif;
									?>
									</p>
								</div>

							</label>

						<div class="clear"></div>
					</div>
				</div>
				<?
			}
		}
	}
	?>
	<div class="clear"></div>
</div>
*/ ?>