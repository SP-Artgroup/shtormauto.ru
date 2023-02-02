<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="section">

	<script type="text/javascript">
		function changePaySystem(param)
		{
			if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
			{
				if (param == 'account')
				{
					if (BX("PAY_CURRENT_ACCOUNT"))
					{
						BX("PAY_CURRENT_ACCOUNT").checked = true;
						BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
						BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

						// deselect all other
						var el = document.getElementsByName("PAY_SYSTEM_ID");
						for(var i=0; i<el.length; i++)
							el[i].checked = false;
					}
				}
				else
				{
					BX("PAY_CURRENT_ACCOUNT").checked = false;
					BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
					BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
				}
			}
			else if (BX("account_only") && BX("account_only").value == 'N')
			{
				if (param == 'account')
				{
					if (BX("PAY_CURRENT_ACCOUNT"))
					{
						BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

						if (BX("PAY_CURRENT_ACCOUNT").checked)
						{
							BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
							BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
						}
						else
						{
							BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
							BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
						}
					}
				}
			}

			submitForm();
		}
	</script>

	<div class="block_oplata">
		<div class="new_zag">Выберите способ оплаты</div>
		<div class="radioblock">
			<?
			uasort($arResult["PAY_SYSTEM"], "cmpBySort"); // resort arrays according to SORT value
			$pay_system_checked_id = 0;
			foreach ($arResult["PAY_SYSTEM"] as $arPaySystem) {

				if (1 || strlen(trim(str_replace("<br />", "", $arPaySystem["DESCRIPTION"]))) > 0 || intval($arPaySystem["PRICE"]) > 0)
				{
					if($arPaySystem["CHECKED"] == 'Y' || $pay_system_checked_id == 0)
						$pay_system_checked_id	= $arPaySystem["ID"];
				?>

							<div class="pay_system_wrap">
								<div class="radio <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo 'active';?>" onclick="BX('ID_PAY_SYSTEM_ID').value=<?=$arPaySystem["ID"]?>;changePaySystem();">
									<?=str_replace('(Физическое лицо)', '', $arPaySystem["PSA_NAME"]);?>

								</div>
								<? if($arPaySystem['ID'] == 32) { ?>
									<img width="100" src="<?=$arPaySystem['PSA_LOGOTIP']['SRC']?>"/>
								<? } else { ?>
									<div class="pay_system_icon" style="background: url('<?=$arPaySystem['PSA_LOGOTIP']['SRC']?>') no-repeat 100% 0;"></div>
								<? } ?>
								<div style="clear:both"></div>
								<div  class="pay_system_description"><?=$arPaySystem['DESCRIPTION']?></div>
							</div>
				<?
				}
			}
			?>
			<div style="clear:both"></div>
			<input id="ID_PAY_SYSTEM_ID" type="hidden" value="<?=$pay_system_checked_id?>" name="PAY_SYSTEM_ID" />
		</div>
	</div>

	<? if ($_REQUEST['PAY_SYSTEM_ID'] != 5 && isset($_REQUEST['PAY_SYSTEM_ID'])) { ?>
		<div class="block_oplata">
			<div class="new_zag">Бонусная карта</div>
			<?
				if(is_array($arResult["ORDER_PROP"]["USER_PROPS_N"][24]))
					$arProperties = $arResult["ORDER_PROP"]["USER_PROPS_N"][24];
				elseif(is_array($arResult["ORDER_PROP"]["USER_PROPS_N"][25]))
					$arProperties = $arResult["ORDER_PROP"]["USER_PROPS_N"][25];
			?>
			<input type="text" size="51" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="<?=($arProperties['CODE'] == 'PHONE' ? 'phone' : '')?>" placeholder="Введите номер карты для начисления бонусов" />
			&nbsp;&nbsp;
			<a href="/include/bonus_card.php" class="fancybox fancybox.ajax">Как получить дисконтную карту?</a>

		</div>
	<? } ?>

	<div class="delay-delivery-message discount-msg">
		<div class="buy-error-message">
			При покупке товара со скидкой - скидка действует при оплате заказа в день оформления.
		</div>
	</div>

</div>