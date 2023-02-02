<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use SP\Shop as SPShop;

$arResult['TAGS_CHAIN'] = [];
if ($arResult['REQUEST']['~TAGS']) {
    $res = array_unique(explode(',', $arResult['REQUEST']['~TAGS']));
    $url = [];
    foreach ($res as $key => $tags) {
        $tags = trim($tags);
        if (!empty($tags)) {
            $url_without = $res;
            unset($url_without[$key]);
            $url[$tags] = $tags;
            $result     = [
                'TAG_NAME'    => htmlspecialcharsex($tags),
                'TAG_PATH'    => $APPLICATION->GetCurPageParam('tags=' . urlencode(implode(',', $url)), ['tags']),
                'TAG_WITHOUT' => $APPLICATION->GetCurPageParam((count($url_without) > 0 ? 'tags=' . urlencode(implode(',', $url_without)) : ''), ['tags']),
            ];
            $arResult['TAGS_CHAIN'][] = $result;
        }
    }
}

$productIds = [];
foreach ($arResult['SEARCH'] as $arItem) {
    if ($arItem['PARAM1'] == 'catalog' && intval($arItem['ITEM_ID'])) {
        $productIds[] = $arItem['ITEM_ID'];
    }
}
$arResult['PRODUCTS'] = [];

if (sizeof($productIds) > 0) {

    $currentPriceId = Shtormauto::getInstance()->getCurrentCityPriceId();
    $arSelect       = ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'CATALOG_GROUP_' . $currentPriceId];
    $arFilter       = ['IBLOCK_TYPE' => 'catalog', 'ID' => $productIds];
    $res            = CIBlockElement::GetList([], $arFilter, false, ['nTopCount' => 50], $arSelect);

    while ($ob = $res->GetNextElement()) {
        $arFields          = $ob->GetFields();
        $arFields['PRICE'] = $arFields['CATALOG_PRICE_' . $currentPriceId];

        $arFields['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
        $arFields['DETAIL_PICTURE']  = CFile::GetFileArray($arFields['DETAIL_PICTURE']);

        $arResult['PRODUCTS'][$arFields['ID']] = $arFields;
    }

    $allShopsByCities = SPShop::getAllShops(true);

    $cityByShop = [];
    $allShops   = [];

    foreach ($allShopsByCities as $cityId => $shops) {
        foreach ($shops as $shopId) {
            $allShops[]          = $shopId;
            $cityByShop[$shopId] = $cityId;
        }
    }

    $productAmount = SPShop::getProductAmount($productIds, $allShops);

    $cityAmounts = [];

    foreach ($productAmount as $productId => $shopAmounts) {
        foreach ($shopAmounts as $shopId => $amount) {
            $cityId = $cityByShop[$shopId];

            $prevAmount                       = $cityAmounts[$productId][$cityId] ?? 0;
            $cityAmounts[$productId][$cityId] = $prevAmount + $amount;
        }
    }

    $arResult['CITY_AMOUNTS'] = $cityAmounts;
}
