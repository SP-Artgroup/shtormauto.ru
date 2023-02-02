<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arTemplateParameters = [
    'DISPLAY_PICTURE'      => [
        'NAME'    => GetMessage('T_IBLOCK_DESC_NEWS_PICTURE'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
    ],
    'DISPLAY_PREVIEW_TEXT' => [
        'NAME'    => GetMessage('T_IBLOCK_DESC_NEWS_TEXT'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
    ],
];
