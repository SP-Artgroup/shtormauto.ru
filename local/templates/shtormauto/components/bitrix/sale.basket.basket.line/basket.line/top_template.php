<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
$arResult['TOTAL_PRICE'] = str_replace('руб.', '', $arResult['TOTAL_PRICE']);
$arResult['TOTAL_PRICE'] = str_replace(' ', '', $arResult['TOTAL_PRICE']);
?>
<!--<a href="<?= $arParams['PATH_TO_BASKET'] ?>">-->
 <i class="icon i-basket"><span class="d-md-none"><?=$arResult["NUM_PRODUCTS"]?></span></i>
<? if (!$compositeStub){
/* if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
	{
		echo $arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)'];
	}*/
	if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
		<? if ($arParams['POSITION_FIXED'] == 'Y'): ?>class="hidden-xs"<?endif ?>
			<span class="header-basket__price d-none d-md-block">
				<? if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'):?>
					<strong class="count_c">&#8381;<?= $arResult['TOTAL_PRICE'] ?></strong>
				<?endif ?>
			</span>
	<?endif;?>
<?}?> 
<!--</a>-->
