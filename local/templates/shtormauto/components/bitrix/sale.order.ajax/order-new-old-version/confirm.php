<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ORDER"]))
{
	?>
        
    <div class="content-form-body content-form-body--basket-step-end">
      <div class="basket-end">
        <i class="icon i-shopping"></i>
        <h1 class="basket-end__heading">Готово! Ваш заказ № <?=$arResult["ORDER"]["ACCOUNT_NUMBER"];?> оформлен</h1>
        <div class="basket-end__message">Подтверждение и детали заказа придут вам на почту. <br> Если остались вопросы – позвоните нам по телефону 
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					Array(
						"AREA_FILE_SHOW" => "file",
						"NAME" => "Изменить логотип",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/basket_phone.php"
					)
				);?> 
        </div>
        <div class="basket-end__message">Все товары в вашем заказе резервируются на 24 часа.<br> Заказ необходимо оплатить в течение суток,<br> по истечении 24 часов с момента заказа резерв будет снят, заказ отменен.
        </div>

      </div>
      <div class="d-flex justify-content-center">
        <a href="/catalog/" class="btn btn-dark content-form-body__button">Вернуться в магазин</a>
      </div>
    </div>        
<div class="payment-info">
	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script language="JavaScript">
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
							</script>
                                                        <div class="payment-link">
                                                            <?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
                                                        </div>
                                                        <div class="payment-link">
							<?
							if (CSalePdf::isPdfAvailable())
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
								<?
							}?>
                                                        </div>
						<?}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
							}
						}
			}
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}
?>
</div>
<script>
$(function(){
    $('.basket-full-header__step').removeClass("active");
    $('.basket-full-header__step').addClass("fulfilled");
})
</script>