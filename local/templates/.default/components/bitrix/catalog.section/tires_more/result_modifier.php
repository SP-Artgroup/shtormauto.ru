<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use SP\Shop as SPShop;

// $component = $this->getComponent();
// $arParams  = $component->applyTemplateModifications();

$productIds = [];

foreach ($arResult['ITEMS'] as $item) {

    if (!empty($item['ITEM_PRICES'])) {
        $productIds[] = $item['ID'];
    }
}

$shops   = SPShop::getShopData(SPShop::getCityShops());
$amounts = SPShop::getProductAmount($productIds);

if(is_array($arResult["PICTURE"])){
    $img = CFile::ResizeImageGet($arResult["PICTURE"], Array("width"=>220, "height"=>190), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["PREVIEW_PICTURE"] = $img;
}

foreach ($arResult['ITEMS'] as $key => $item) {

    if (in_array($item['ID'], $productIds)) {

        if (isset($amounts[$item['ID']])) {
            $arResult['ITEMS'][$key]['STORE_DATA'] = [
                'STORES'     => $shops,
                'AMOUNTS'    => $amounts[$item['ID']],
                'PRODUCT_ID' => $item['ID'],
            ];
        } else {
            $arResult['ITEMS'][$key]['CAN_BUY'] = false;
        }
    }

    if (is_array($item["PREVIEW_PICTURE"])) {

        $img = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], array("width"=>140,"height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;

    } elseif (is_array($item["DETAIL_PICTURE"])) {

        $img = CFile::ResizeImageGet($item["DETAIL_PICTURE"], array("width"=>140,"height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;
    }
}
?>