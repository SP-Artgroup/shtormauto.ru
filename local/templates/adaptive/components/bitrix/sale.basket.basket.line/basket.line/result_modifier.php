<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Basket;

Loader::includeModule('sale');

$fuser  = Fuser::getId();
$siteId = Context::getCurrent()->getSite();

$basket = Basket::loadItemsForFUser($fuser, $siteId)->getOrderableItems();

$jsData = [];

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
