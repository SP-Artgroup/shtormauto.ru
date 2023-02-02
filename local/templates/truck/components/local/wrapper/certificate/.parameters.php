<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$langPrefix = 'LOCAL_WRAPPER_CERTIFICATE_';
$msg        = [];

foreach ([
    'TITLE',
    'MORE',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

$set = [
    'title' => $msg['title'],
    'more'  => $msg['more'],
];

foreach ($set as $code => $label) {
    $arTemplateParameters[$code] = [
        'NAME' => $label,
        'COLS' => 50,
        'ROWS' => 50,
    ];
}
