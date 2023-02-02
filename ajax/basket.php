<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use SP\Shop as SPShop;


function checkQuantity(int $productId, int $shopId, int $quantity, bool $isAddMode = true) {
    $shopQuantity = 0;

    if ($rawStoreAmount = SPShop::getProductAmount($productId, $shopId)) {
        $shopQuantity = $rawStoreAmount[$productId][$shopId];
    };

    if (!$shopQuantity) {
        return false;
    }

    $basket = $this->getBasket();

    $basketQuantity = 0;

    if ($isAddMode) {
        foreach ($basket as $item) {

            if ((int) $item->getProductId() !== $productId) {
                continue;
            }

            $props = $item->getPropertyCollection()->getPropertyValues();

            if (isset($props['STORE_ID']) && (int) $props['STORE_ID']['VALUE'] === $shopId) {
                $basketQuantity = intval($item->getQuantity());
            }
        }
    }

    if ($quantity > ($shopQuantity - $basketQuantity)) {
        return false;
    }

    return true;
}

if ($_POST["ajaxbasketcountid"] && $_POST["ajaxaction"] == 'add') {
    $amount  = SPShop::getProductAmount($_POST["productID"], $_POST["storeID"]);
}
/* Goods removal at pressing on to remove in a small basket */
if ($_POST["ajaxdeleteid"] && $_POST["ajaxaction"] == 'delete') {
    CSaleBasket::Delete($_POST["ajaxdeleteid"]);
}
/* Changes of quantity of the goods after receipt of inquiry from a small basket */
if ($_POST["ajaxbasketcountid"] && $_POST["ajaxbasketcount"] && $_POST["ajaxaction"] == 'update') {

    //$storeCount = SPShop::getProductAmount($productId, $shopId)

    if ($_POST["productID"] && $_POST["storeID"]){

        $storeId = (int) $_POST["storeID"];

        $storeCount = SPShop::getProductAmount($_POST["productID"], $storeId);

        if ($_POST["ajaxbasketcount"]<= $storeCount[$_POST["productID"]][$storeId]){
                $arFields = array(
                    "QUANTITY" => $_POST["ajaxbasketcount"]
                );
        }else{
                $arFields = array(
                    "QUANTITY" => $storeCount[$_POST["productID"]][$storeId]
                );
        }
    }else{
    $arFields = array(
        "QUANTITY" => $_POST["ajaxbasketcount"]
        );
    }
        CSaleBasket::Update($_POST["ajaxbasketcountid"], $arFields);
}

$showOpenList = !empty($_POST['showOpenList'])
    ? $_POST['showOpenList']
    : 'Y';
?>
<?$APPLICATION->IncludeComponent(
"bitrix:sale.basket.basket.line",
"basket.line",
Array(
"COMPONENT_TEMPLATE" => "header_basket",
"HIDE_ON_BASKET_PAGES" => "Y",
"PATH_TO_AUTHORIZE" => "",
"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
"PATH_TO_PERSONAL" => SITE_DIR."personal/",
"PATH_TO_PROFILE" => SITE_DIR."personal/",
"PATH_TO_REGISTER" => SITE_DIR."login/",
"POSITION_FIXED" => "N",
"SHOW_AUTHOR" => "N",
"SHOW_DELAY" => "N",
"SHOW_EMPTY_VALUES" => "Y",
"SHOW_IMAGE" => "Y",
"SHOW_NOTAVAIL" => "N",
"SHOW_NUM_PRODUCTS" => "Y",
"SHOW_PERSONAL_LINK" => "N",
"SHOW_PRICE" => "Y",
"SHOW_PRODUCTS" => "Y",
"SHOW_REGISTRATION" => "N",
"SHOW_SUMMARY" => "Y",
"SHOW_TOTAL_PRICE" => "Y",
"SHOW_OPEN_LIST" => $showOpenList
)
);?>