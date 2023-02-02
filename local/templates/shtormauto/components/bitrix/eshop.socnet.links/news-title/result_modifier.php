<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if(isset($arParams['TELEGRAM']))
{
	$arResult['SOCSERV']['TELEGRAM']['LINK'] = $arParams['TELEGRAM'];
}