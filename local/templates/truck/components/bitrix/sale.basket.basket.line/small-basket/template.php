<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */

$cartStyle          = 'small-basket';
$cartId             = 'bx_basket' . $this->randString();
$arParams['cartId'] = $cartId;

if ($arParams['POSITION_FIXED'] == 'Y') {

    $cartStyle .= "-fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";

    if ($arParams['SHOW_PRODUCTS'] == 'Y') {
        $cartStyle .= ' bx-closed';
    }

} else {
    $cartStyle .= ' bx-opener';
}

$amount        = $arResult['NUM_PRODUCTS'];
$amountEnding  = $arResult['PRODUCT(S)'];
$strAmount     = $amount . ' ' . $amountEnding;
$price         = $arResult['TOTAL_PRICE'];
$data          = $arResult['tpl']['data'];
$msg           = $data['msg'];

?><script>
var <?= $cartId ?> = new BitrixSmallCart;
</script>
<div id="<?= $cartId ?>" class="<?= $cartStyle ?>"><?

	$frame = $this->createFrame($cartId, false)->begin();

	require realpath(dirname(__FILE__)) . '/ajax_template.php';

	$frame->beginStub();

	$arResult['COMPOSITE_STUB'] = 'Y';
	require realpath(dirname(__FILE__)) . '/top_template.php';
	unset($arResult['COMPOSITE_STUB']);

	$frame->end();

?></div>
<script type="text/javascript">
	<?= $cartId ?>.siteId       = '<?= SITE_ID ?>';
	<?= $cartId ?>.cartId       = '<?= $cartId ?>';
	<?= $cartId ?>.ajaxPath     = '<?= $componentPath ?>/ajax.php';
	<?= $cartId ?>.templateName = '<?= $templateName ?>';
	<?= $cartId ?>.arParams     =  <?= CUtil::PhpToJSObject($arParams) ?>;
	<?= $cartId ?>.closeMessage = '<?= GetMessage('TSB1_COLLAPSE') ?>';
	<?= $cartId ?>.openMessage  = '<?= GetMessage('TSB1_EXPAND') ?>';
	<?= $cartId ?>.activate();
</script>

<?php $this->setViewTarget('mobile-basket') ?>

<a href="<?= $arParams['PATH_TO_BASKET'] ?>">
    <div class="bascet-mobile">
        <p>
            <i class="quantity"><?= $amount ?></i>
            <?= ' ' . $amountEnding . ' ' . $msg['total_price'] . ' ' ?>
            <i class="sum"><?= $price ?></i> руб
        </p>
    </div>
    <i class="fas fa-shopping-cart"></i>
</a>

<?php $this->endViewTarget() ?>