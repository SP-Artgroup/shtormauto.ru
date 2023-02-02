<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Grid\Declension;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

use SP\Shop as SPShop;
use SP\City;

$component = $this->getComponent();
$arParams  = $component->applyTemplateModifications();

$productIds = [];

foreach ($arResult['ITEMS'] as $item) {

    if (!empty($item['ITEM_PRICES'])) {
        $productIds[] = $item['ID'];
    }
}

$shops   = SPShop::getShopData(SPShop::getCityShops());
$amounts = SPShop::getProductAmount($productIds);

foreach ($arResult['ITEMS'] as $key => $item) {

    // Пропускаем товары, у которых нет цены
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
}
$arResult["CITIES_LIST"] = City::getAllCities();

$productDeclension = new Declension('товар', 'товара', 'товаров');

$data['prod_in_sect']      = $arResult['NAV_RESULT']->nSelectedCount;
$data['prod_in_sect_decl'] = $productDeclension->get($data['prod_in_sect']);

$arResult['data'] = $data;
