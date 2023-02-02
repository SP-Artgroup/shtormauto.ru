<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div onclick="window.location='/personal/cart/'" class="top_cart">
	<div class="zag hidmobile">Корзина</div>

    <div class="count basket_small_count">
        <span class="hidmobile">Товаров:</span> <span class="count_c"><?=$arResult['NUM_PRODUCTS']?></span>
    </div>

    <div class="count basket_small_price hidmobile">
        <span class="count_c"><?=$arResult['TOTAL_PRICE']?></span>
    </div>
</div>

<script>
    SP.Basket = new SP.BasketConstructor(<?= CUtil::PhpToJsObject($arResult['JS_DATA'], true, true, true) ?>);
</script>