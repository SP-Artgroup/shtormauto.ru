<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $itemName;
global $arSimilarProductsFilter;

if (!empty($templateData['MODEL'])) {
    $arSimilarProductsFilter['PROPERTY_MODEL'] = $templateData['MODEL'];
}

$itemName = $arResult["NAME"];

// check if there was a recommendation
$productID			= $arResult['ID'];
$siteID				= SITE_ID;
$parentID			= 0;
$recommendationId 	= '';


// add record
Bitrix\Catalog\CatalogViewedProductTable::refresh(
	$productID,
	CSaleBasket::GetBasketUserID(),
	$siteID,
	$parentID,
	$recommendationId
);
?>
