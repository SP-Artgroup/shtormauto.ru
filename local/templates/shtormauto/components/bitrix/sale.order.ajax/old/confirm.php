<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$msg = [
	'success' => Loc::getMessage('SOA_TEMPL_ORDER_SUC', [
		'#ORDER_DATE#' => $arResult['ORDER']['DATE_INSERT'],
		'#ORDER_ID#'   => $arResult['ORDER']['ACCOUNT_NUMBER']
	]),
	'success2' => Loc::getMessage('SOA_TEMPL_ORDER_SUC1', [
		'#LINK#' => $arParams['PATH_TO_PERSONAL']
	]),
	'fail' => Loc::getMessage('SOA_TEMPL_ERROR_ORDER_LOST', [
		'#ORDER_ID#' => $arResult['ACCOUNT_NUMBER']
	]),
	'fail2' => Loc::getMessage('SOA_TEMPL_ERROR_ORDER_LOST1'),
];
?>
<div class="confirm-page">

<? if (!empty($arResult["ORDER"])): ?>

	<div class="confirm-title">
		<b><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></b>
	</div>

	<div class="confirm-desc">
		<p><?= $msg['success'] ?></p>
		<p><?= $msg['success2'] ?></p>
	</div>

	<a class="a_button buy-btn" href="/catalog/">
		<span>В каталог</span>
	</a>

	<?
	global $USER;

	if (!empty($arResult['ORDER']['GA_DATA'])) {
		?>
		<script>
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				"ecommerce": {
					"purchase": {
						"actionField": {
							"id" : "<?= $arResult['ORDER']['ID'] ?>",
						},
						"products": <?= $arResult['ORDER']['GA_JSON'] ?>
					}
				}
			});
		</script>

		<?
	}

	if (!empty($arResult["PAY_SYSTEM"])) {
		?>
		<table class="sale_order_full_table">
			<tr>
				<td class="ps_logo">
					<div class="pay_name"><?=Loc::getMessage('SOA_TEMPL_PAY')?></div>
					<?=CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
					<div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div><br>
				</td>
			</tr>
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
				?>
				<tr>
					<td>
						<?
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script>
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
							</script>
							<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
							<?
							if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE']))
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
								<?
							}
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								try
								{
									include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
								}
								catch(\Bitrix\Main\SystemException $e)
								{
									if($e->getCode() == CSalePaySystemAction::GET_PARAM_VALUE)
										$message = GetMessage("SOA_TEMPL_ORDER_PS_ERROR");
									else
										$message = $e->getMessage();

									echo '<span style="color:red;">'.$message.'</span>';
								}
							}
						}
						?>
					</td>
				</tr>
				<?
			}
			?>
		</table>
		<?
	}?>

<? else: ?>

	<div class="confirm-title">
		<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b>
	</div>

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= $msg['fail'] ?>
				<?= $msg['fail2'] ?>
			</td>
		</tr>
	</table>

<? endif ?>
</div>