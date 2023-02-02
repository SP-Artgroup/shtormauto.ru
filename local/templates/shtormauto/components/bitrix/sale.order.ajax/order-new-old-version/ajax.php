<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') die();
use SP\Shop as SPShop;

$shopIds = SPShop::getCityShops($_REQUEST["city_id"]); // id магазинов в данном городе
foreach($_REQUEST["product_id"] as $key => $product){
    $amounts[] = SPShop::getProductAmount($product, $shopIds); // количество товара по складам города (один адрес может иметь несколько складов)
}
foreach ($amounts as $key => $amount) {
	foreach ($amount as $x => $value) {?>
		<div data-product-id="<?=$x?>">
			<? $quantityCity = 0;
			foreach ($value as $y => $quantity) {?>
				<span data-id-shop=<?=$y?>><?=$quantity?></span>
			<?$quantityCity = $quantityCity + $quantity;
			}?>
			<span data-id-shop="all"><?=$quantityCity?></span>	
		</div>	
	<?}
}?>
