<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="status">
	<span class="name">Заказ</span>
	<span class="stat1">Этап 1</span>
	<span class="stat2">Этап 2</span>
	<span class="stat3 active">Этап 3</span>
</div>

<div class="new_zag">Оплата и доставка</div>

<div class="block_item_item">
	<?
	if (count($arResult["PERSON_TYPE"]) > 1) {
		?>
		<strong style="margin:0 0 20px 0;">Тип плательщика</strong>

		<div class="radioblock">
			<?
			$person_type_checked_id	= 0;
			foreach($arResult["PERSON_TYPE"] as $v):
				if ($person_type_checked_id	== 0 || $v["CHECKED"]=="Y")
					$person_type_checked_id = $v['ID'];

			?>
				<div class="radio <?=($v["CHECKED"]=="Y" ? 'active' : '')?>" onclick="BX('PERSON_TYPE_ID').value=<?=$v["ID"]?>;submitForm();">
					<?=$v["NAME"]?>
				</div>
			<?endforeach;?>

			<div class="clear"></div>

			<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
			<input type="hidden" name="PERSON_TYPE" id="PERSON_TYPE_ID" value="<?=$person_type_checked_id?>">
		</div>
		<?

	} else {

		if (IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0) {
			//for IE 8, problems with input hidden after ajax
			?>
			<span style="display:none;">
			<input type="text" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
			<input type="text" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
			</span>
			<?
		} else {
			foreach ($arResult["PERSON_TYPE"] as $v) {
				?>
				<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">
				<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
				<?
			}
		}
	}
	?>
</div>
