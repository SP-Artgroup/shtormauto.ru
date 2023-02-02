<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */

$amount        = $arResult['NUM_PRODUCTS'];
$amountEnding  = $arResult['PRODUCT(S)'];
$strAmount     = $amount . ' ' . $amountEnding;
$price         = $arResult['TOTAL_PRICE'];
$data          = $arResult['tpl']['data'];
$msg           = $data['msg'];
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');

?>
<div class="bascet-text">

    <div class="basket-info">
        <?php if (!$compositeStub): ?>
            <p>В вашей корзине <i class="quantity"><?= $strAmount ?></i></p>
            <?php if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'): ?>
                <p><?= $msg['total_price'] ?> <i class="price"><?= $price ?></i> руб.</p>
            <?php endif ?>
        <?php endif ?>
    </div>

    <p class="order">
        <a href="<?= $arParams['PATH_TO_BASKET'] ?>"><?= $msg['2order'] ?></a>
    </p>

</div>

<div class="bascet-img">
    <a class="sprite sprite-basket" href="<?= $arParams['PATH_TO_BASKET'] ?>"></a>
</div>