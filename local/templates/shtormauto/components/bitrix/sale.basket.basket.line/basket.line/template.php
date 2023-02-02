<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
 use SP\Component as SPComponent;
$cartStyle = 'bx-basket';
$cartId = "bx_basket".$this->randString();
$arParams['cartId'] = $cartId;

if ($arParams['POSITION_FIXED'] == 'Y')
{
	$cartStyle .= "-fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
	if ($arParams['SHOW_PRODUCTS'] == 'Y')
		$cartStyle .= ' bx-closed';
}
else
{
	$cartStyle .= ' bx-opener';
}
?><script>
var <?=$cartId?> = new BitrixSmallCart;
</script>
<div id="<?=$cartId?>" class="header-basket top_cart <?if ($arParams['SHOW_OPEN_LIST'] === 'Y'){?> active <?}?>" tabindex="0"><?
	/** @var \Bitrix\Main\Page\FrameBuffered $frame */
	$frame = $this->createFrame($cartId, false)->begin();
		require(realpath(dirname(__FILE__)).'/ajax_template.php');
	$frame->beginStub();
		$arResult['COMPOSITE_STUB'] = 'Y';
		require(realpath(dirname(__FILE__)).'/top_template.php');
		unset($arResult['COMPOSITE_STUB']);
	$frame->end();
?></div>
<script type="text/javascript">

    SP.Basket = new SP.BasketConstructor(<?= CUtil::PhpToJsObject($arResult['JS_DATA'], true, true, true) ?>);

    function basketPopupHandler() {
        $(".header-basket").hasClass("active") ? $(".header-basket").removeClass("active") : $(".header-basket").addClass("active")
    }

    $(function () {
        $(".basket-preview .counter__plus").on("click", function () {
            var countItem = $(this).prev();
            var countbasketcount = countItem.val();
            countbasketcount++;
            countItem.val(countbasketcount);
            changeQuantity(countItem);
            return false;
        });

        $(".basket-preview .counter__minus").on("click", function () {
            var countItem = $(this).next();
            var countbasketcount = countItem.val();
            if (0 < countbasketcount) {
                countbasketcount--;
                countItem.val(countbasketcount);
                changeQuantity(countItem);
            }
            return false;
        });
        function changeQuantity(countItem){
            var countbasketcount = countItem.val();
            var countbasketid = countItem.attr('data-id');
            var countproductid = countItem.attr('data-productid');
            var ajaxcount = 'ajaxbasketcountid=' + countbasketid + '&ajaxproductid=' + countproductid + '&ajaxbasketcount=' + countbasketcount + '&ajaxaction=update';
            ajaxpostshow("/ajax/basket.php", ajaxcount, ".new-basket-small");
        }

        /* Inquiry ajax at removal of the goods from a basket  */
        $('.basket-preview .basket-item__delete').on("click", function () {
            var deletebasketid = $(this).attr('data-id');
            var ajaxDelete = "ajaxdeleteid=" + deletebasketid + "&ajaxaction=delete";
            ajaxpostshow("/ajax/basket.php", ajaxDelete, ".new-basket-small");
            return false;
        });

        $(".header-basket").on("click", basketPopupHandler), $(".basket-preview, .header-basket").on("click", function (e) {
            e.stopPropagation()
        }), $("body").on("click", function () {
            $(".header-basket").hasClass("active") && basketPopupHandler()
        })
    });

</script>