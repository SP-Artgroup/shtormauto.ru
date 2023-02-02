<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$data = [
    'phone' => '',
];

$currentCity = $arResult['CURRENT'];

if (!empty($currentCity['PROPERTY_PHONES_VALUE'])) {
	$index = ($currentCity['PROPERTY_SERIAL_NUMBER_PHONE_VALUE'] != "")?$currentCity['PROPERTY_SERIAL_NUMBER_PHONE_VALUE']-1:0;
    $data['phone']        = $currentCity['PROPERTY_PHONES_VALUE'][$index];
    $data['format_phone'] = str_replace([' ', '-', '(', ')'], '', $data['phone']);
}

$arResult['tpl'] = [
    'data' => $data,
];
