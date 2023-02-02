<?

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\DiscountCouponsManager as DCM;

$request     = Context::getCurrent()->getRequest();
$couponError = '';

if (
    ($action = $request->get('action'))
    && Loader::includeModule('sale')
) {
    switch ($action) {

        case 'addCoupon':

            if (
                ($coupon = $request->get('coupon'))
                && !DCM::isEntered($coupon)
            ) {
                if (DCM::isExist($coupon)) {
                    DCM::add($coupon);
                } else {
                    $couponError = 'Купон ' . $coupon . ' не найден';
                }
            }
            break;

        case 'removeCoupon':
            DCM::clear(true);
            break;

        default:
            break;
    }
}

$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    "basket-new",
    array(
        "ACTION_VARIABLE" => "basket_action",
        "COLUMNS_LIST" => array(
            0 => "NAME",
            1 => "DELETE",
            2 => "PRICE",
            3 => "QUANTITY",
            4 => "SUM",
        ),
        "COMPONENT_TEMPLATE" => "basket-new",
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "HIDE_COUPON" => "N",
        "OFFERS_PROPS" => "",
        "PATH_TO_ORDER" => "/personal/order/make/",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "QUANTITY_FLOAT" => "N",
        "SET_TITLE" => "Y",
        "USE_PREPAYMENT" => "N",
        "CORRECT_RATIO" => "N",
        "AUTO_CALCULATION" => "Y",
        "USE_GIFTS" => "N",
        "COLUMNS_LIST_EXT" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DISCOUNT",
            2 => "DELETE",
            3 => "DELAY",
            4 => "TYPE",
            5 => "SUM",
        ),
        "COMPATIBLE_MODE" => "Y",
        "ADDITIONAL_PICT_PROP_26" => "-",
        "ADDITIONAL_PICT_PROP_32" => "-",
        "BASKET_IMAGES_SCALING" => "adaptive",
        // Custom
        'COUPON_ERROR' => $couponError,
    ),
    false
);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
