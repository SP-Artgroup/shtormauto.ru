<?
$APPLICATION->AddChainItem($arResult["NAME"]);

$city = $templateData['CITY'] ? ', ' . $templateData['CITY'] : '';

$APPLICATION->setTitle($arResult['NAME'] . $city);
