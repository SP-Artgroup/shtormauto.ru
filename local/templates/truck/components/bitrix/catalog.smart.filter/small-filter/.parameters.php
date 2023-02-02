<?php

use Bitrix\Main\Localization\Loc;

$langPrefix = 'ct_csf_small_filter_';
$msg        = [];

foreach ([
    'container_title',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . $langCode);
}

$arTemplateParameters = [
    'CONTAINER_TITLE' => [
        'NAME' => $msg['container_title'],
        'TYPE' => 'STRING',
    ],
];