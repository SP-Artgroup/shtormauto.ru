<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$arResult['TOTAL_PRICE'] = substr($arResult['TOTAL_PRICE'], 0, -5);

$langPrefix = 'TSB1_';
$msg        = [];

Loc::loadMessages(__DIR__ . '/template.php');

foreach ([
    'TOTAL_PRICE',
    '2ORDER',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

$data = [
    'msg' => $msg,
];

$arResult['tpl'] = [
    'data'   => $data,
    'params' => $params,
];
