<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table class="table">
	<thead class="d-none d-md-table-header-group">
		<tr>
			<th>Позиция</th>
			<th class="t-price d-none d-lg-table-cell">Цена</th>
			<th class="t-total-price">Сумма</th>
		</tr>
	</thead>
	<tbody>
		<?foreach(($arResult["GRID"]["ROWS"]) as $arItem){
		$arFile = CFile::ResizeImageGet($arItem["data"]["PREVIEW_PICTURE"], array('width'=>70, 'height'=>67), BX_RESIZE_IMAGE_EXACT, true); 
		?>
		<?
		$sezon = "";
		switch ($arItem["data"]["PROPERTY_SEZONNOST_VALUE"]){
			case "Лето": $sezon = "icon i-summer"; break;
			case "Зима": $sezon = "icon i-winter"; break;
		}
		?>
		<tr>
			<td>
				<div class="basket-item" data-product-id="<?=$arItem["data"]["PRODUCT_ID"]?>" data-product-quantity="<?=$arItem["data"]["QUANTITY"]?>">
					<div class="basket-item__img-wrapper">
						<a href="<?=$arItem["data"]["DETAIL_PAGE_URL"]?>" tabindex="-1"><img src="<?=$arFile["src"]?>" alt="" class="basket-item__img"></a>
					</div>
					<div class="basket-item__info">
						<a href="<?=$arItem["data"]["DETAIL_PAGE_URL"]?>" class="basket-item__name"><?=$arItem["data"]["NAME"]?> <i class="<?=$sezon?>"></i></a>
						<div class="basket-item__small-description"><?=$arItem["data"]["PREVIEW_TEXT"]?></div>
						<div class="basket-item__address"><?=$arItem["columns"]["PROPS"]?></div>
						<div class="basket-item_out-of-stock scarlet" style="display:none"><strong>Оплата стоимости доставки производится в соответствии с расценками транспортной компании.<?/*?>Доставка от 3-х дней<?*/?></strong></div>
						<div class="basket-item__info-bottom d-none d-md-flex d-lg-none">
							<div class="basket-item__price order-last order-md-first">&#8381;<?=(int)$arItem["data"]["SUM_NUM"]?></div>
						</div>
					</div>
				</div>
				<div class="table-total-price d-flex d-md-none">
					<div class="table-total-price__text">
						Сумма
					</div>
					<div class="table-total-price-value">&#8381;<?=(int)$arItem["data"]["SUM_NUM"]?></div>
				</div>
			</td>
			<td class="t-price d-none d-lg-table-cell">
				<div class="table__price">
					<?if ($arItem["data"]["BASE_PRICE"] != $arItem["data"]["PRICE"]){?>
					<span class="table__price-old">&#8381;<?=(int)$arItem["data"]["BASE_PRICE"]?></span>
					<?}?>
					<span class="table__price-current">&#8381;<?=(int)$arItem["data"]["PRICE"]?></span>
				</div>
			</td>
			<td class="t-total-price d-none d-md-table-cell">
				<div class="table-total-price-value">&#8381;<?=(int)$arItem["data"]["SUM_NUM"]?></div>
			</td>
		</tr>
		<?}?>
	</tbody>
</table>
<? if(!empty($arResult["AMOUNTS"])):?>
	<div class="amount_shop d-none">
		<?foreach ($arResult["AMOUNTS"] as $x => $amount) {?>
			<div data-product-id="<?=$x?>">
				<?$quantityCity = 0;
				foreach ($amount as $y => $quantity) {?>
					<span data-id-shop=<?=$y?>><?=$quantity?></span>
				<? $quantityCity = $quantityCity + $quantity;
				}?>
				<span data-id-shop="all"><?=$quantityCity?></span>
			</div>	
		<?}?>
	</div>
<?endif;?>              
<div class="table-total-price">
	<div class="table-total-price__text">
		Итого:
	</div>
	<div class="table-total-price-value">&#8381;<?=(int)$arResult["ORDER_PRICE"]?></div>
</div>
