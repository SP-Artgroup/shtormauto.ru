<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Basket;
use SP\City as SPCity;
use SP\Shop as SPShop;

Loader::includeModule('sale');

$fuser  = Fuser::getId();
$siteId = Context::getCurrent()->getSite();

$basket = Basket::loadItemsForFUser($fuser, $siteId)->getOrderableItems();

$jsData = [];
$currentCityId = SPCity::getCurrentCityId();

// if (!empty($arResult['CATEGORIES']['READY'])) {

    foreach ($basket as $item) {

        $props = $item->getPropertyCollection()->getPropertyValues();

        $jsProps = [];
        foreach ($props as $code => $prop) {
            if (!in_array($code, ['CATALOG.XML_ID', 'PRODUCT.XML_ID'])) {
                $jsProps[strtolower($code)] = is_numeric($prop['VALUE'])
                    ? intval($prop['VALUE'])
                    : $prop['VALUE'];
            }
        }

        $jsData[] = [
            'basketId'  => (int) $item->getId(),
            'productId' => (int) $item->getProductid(),
            'quantity'  => (int) $item->getQuantity(),
            'props'     => $jsProps,
        ];
    }
// }

$arResult['JS_DATA'] = $jsData;

unset($jsData);

foreach ($arResult["CATEGORIES"] as $category => $items) {
    if (empty($items))
        continue;
    foreach ($items as $key=>$v) {
        $db_props = CIBlockElement::GetProperty(IBLOCK_ID_CATALOG, $v["PRODUCT_ID"], array("sort" => "asc"), Array("CODE" => "SEZONNOST"));
        if ($ar_props = $db_props->Fetch()){
            $arResult["CATEGORIES"][$category][$key]["SEZON"] = $ar_props["VALUE_XML_ID"];
        }
        $db_props = CIBlockElement::GetById($v["PRODUCT_ID"]);
        if ($ar_props = $db_props->Fetch()){
            $arResult["CATEGORIES"][$category][$key]["DESCRIPTION"] = $ar_props["PREVIEW_TEXT"];
        }    
        $cityShopIds = SPShop::getCityShops($currentCityId);    
        $quanCities[] = SPShop::getProductAmount($v["PRODUCT_ID"], $cityShopIds);
    }
}
foreach ($quanCities as $key => $quanCity) {
    $maxQuantity = 0;
    foreach ($quanCity as $key_2 => $shops) {
        foreach ($shops as $key_3 => $quan) {
            $maxQuantity = $maxQuantity + $quan;
        }
        $arResult["MAX_QUANTITY_CITY"][$key_2] = $maxQuantity;
    }   
}

                    

