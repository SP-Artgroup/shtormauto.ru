<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>
<div class="new_zag">Товары в заказе</div>

<div class="nt_table cart">

	<div class="nt_table_zag">
		<div class="zag1">Название</div>
		<div class="zag5">Склад</div>
		<div class="zag2">Цена</div>
		<div class="zag3">Количество</div>
		<div class="zag4">Сумма</div>
	</div>

	<? foreach ($arResult['BASKET_ITEMS'] as $basket_item): ?>
		<div class="nt_table_item">

			<div class="zag1">

				<div class="img-wrap">
					<a href="<?=$basket_item['DETAIL_PAGE_URL']?>">
						<img src="<?=$basket_item['PREVIEW_PICTURE_SRC']?>" alt="<?=$basket_item['NAME']?>" title="<?=$basket_item['NAME']?>">
					</a>
				</div>

				<div class="name">
					<a href="<?=$basket_item['DETAIL_PAGE_URL']?>"><?=$basket_item['NAME']?></a>
				</div>

			</div>

			<div class="zag5">
				<?php if (!empty($basket_item['STORE'])): ?>
					<?= $basket_item['STORE']['NAME'] ?>
				<?php endif ?>
			</div>

			<div class="zag2"><?=$basket_item['PRICE_FORMATED']?></div>

			<div class="zag3">
				<div class="quan_form">
					<?=$basket_item['QUANTITY']?>
				</div>
			</div>

			<div class="zag4"><?=$basket_item['SUM']?></div>
		</div>
	<? endforeach ?>
</div>

<div class="itogo_price">ИТОГО: <?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></div>

<div style="clear:both;"></div>
<div  class="block_service">
	<strong>Хотите ли вы воспользоваться нашим сервисом:</strong>
	<div class="radioblock">
		<div class="radio <?=(!isset($_REQUEST['ORDER_PROP_22']) || $_REQUEST['ORDER_PROP_22'] == 'Y' ? 'active' : '')?>" value="Y">Да, меня интересует сервис</div>
		<div class="radio <?=($_REQUEST['ORDER_PROP_22'] == 'N' ? 'active' : '')?>" value="N">Нет, спасибо</div>

		<input class="order_prop_service" type="hidden" name="ORDER_PROP_22" value="<?=(isset($_REQUEST['ORDER_PROP_22']) ? $_REQUEST['ORDER_PROP_22'] : 'Y')?>" />
		<input class="order_prop_service" type="hidden" name="ORDER_PROP_23" value="<?=(isset($_REQUEST['ORDER_PROP_23']) ? $_REQUEST['ORDER_PROP_23'] : 'Y')?>" />
	</div>
</div>
<br /><br />
<div class="new_zag">Комментарии к заказу</div>

<textarea class="cart_textarea" name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" style="max-width:100%;min-height:120px"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>








