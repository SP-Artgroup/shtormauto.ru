<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$msg        = [];
$langPrefix = 't_iblock_desc_news_';

foreach ([
    'date',
    'name',
    'picture',
    'text',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . $langCode);
}

$arTemplateParameters = [
    'DISPLAY_DATE'         => [
        'NAME'    => $msg['date'],
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
    ],
    'DISPLAY_NAME'         => [
        'NAME'    => $msg['name'],
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
    ],
    'DISPLAY_PICTURE'      => [
        'NAME'    => $msg['picture'],
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
    ],
    'DISPLAY_PREVIEW_TEXT' => [
        'NAME'    => $msg['text'],
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
    ],
];
