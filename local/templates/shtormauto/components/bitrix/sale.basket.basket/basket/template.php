<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixBasketComponent $component
 */

$this->addExternalJs('//api-maps.yandex.ru/2.1/?lang=ru_RU');

?>
<div class="cart_page">
	<div class="status">
		<span class="name">Заказ</span>
		<span class="stat1 active">Этап 1</span>
		<span class="stat2">Этап 2</span>
		<span class="stat3">Этап 3</span>
	</div>
	<div class="new_zag">Просмотр корзины</div>

	<? if(sizeof($arResult['ITEMS']['AnDelCanBuy']) <= 0) { ?>
		<div id="basket_items_list">
			<table>
				<tbody>
					<tr>
						<td colspan="<?=$numCells?>" style="text-align:center">
							<div class=""><?=GetMessage("SALE_NO_ITEMS");?> Перейти в <a href="/catalog/">каталог</a></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	<? } ?>

	<?
	if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
	{
		?>
		<div id="warning_message">
			<?=implode('<br/> ', $arResult["WARNING_MESSAGE"])?>
		</div>

		<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">

			<? /*
			<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
			<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
			*/ ?>

			<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
			<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
			<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
			<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
			<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
			<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />

			<div class="nt_table cart">

				<div class="nt_table_zag">
					<div class="zag1">Название</div>
					<div class="zag6">Склад</div>
					<div class="zag2">Цена</div>
					<div class="zag3">Количество</div>
					<div class="zag4">Сумма</div>
					<div class="zag5"> </div>
				</div>

				<? foreach ($arResult['ITEMS']['AnDelCanBuy'] as $arItem): ?>

					<div class="nt_table_item" id="<?=$arItem['ID']?>">
						<div class="zag1">

							<a class="img-wrap" href="<?=$arItem['DETAIL_PAGE_URL']?>">
								<img
									src="<?= $arItem['PREVIEW_PICTURE_SRC'] ?>"
									alt="<?= $arItem['NAME'] ?>"
									title="<?= $arItem['NAME'] ?>"
								>
							</a>

							<div class="name">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="zag6">

							<?php if (!empty($arItem['STORE'])): ?>
								<span><?=$arItem['STORE']['NAME']?></span>
							<?php endif ?>

						</div>
						<div class="zag2">
							<?=$arItem['PRICE_FORMATED']?>
						</div>
						<div class="zag3">
							<div class="quan_form">
								<? // rel id товара ?>
								<button
									type="button"
									class="minus change_quantity_del"
									rel="minus"
									data-mode="down"
								></button>
								<input
									class="quan"
									type="text"
									id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
									name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
									size="2"
									maxlength="18"
									style="max-width: 50px"
									value="<?=$arItem["QUANTITY"]?>"
									data-id="<?= $arItem['ID'] ?>"
									data-shop-id="<?= $arItem['STORE']['VALUE'] ?>"
								>
								<button
									type="button"
									class="plus change_quantity_del"
									rel="plus"
									data-mode="up"
								></button>
								<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" class="basket_quantity" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="zag4">
							<span class="sum" id="SUM_<?=$arItem['ID']?>">
								<?=CurrencyFormat($arItem['PRICE'] * $arItem['QUANTITY'], 'RUB')?>
							</span>
						</div>
						<div class="zag5">
							<a href="/personal/cart/index.php?action=delete&id=<?=$arItem['ID']?>" class="but_delete"></a>
						</div>
					</div>

				<? endforeach ?>
			</div>

			<div class="itogo_price">ИТОГО: <?=$arResult['allSum_FORMATED']?></div>
			<div class="itogo_button">
				<a href="<?=$arParams['PATH_TO_ORDER']?>" class="button">Оформить заказ</a>
			</div>
			<input type="hidden" name="BasketOrder" value="BasketOrder" />
			<!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
		</form>
		<?
	}
	?>
</div>