<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$data   = [];
$params = [];

$params = [
    'show_picture'      => $arParams['DISPLAY_PICTURE'] !== 'N' && is_array($arResult['DETAIL_PICTURE']),
    'show_date'         => $arParams['DISPLAY_DATE'] !== 'N' && $arResult['DISPLAY_ACTIVE_FROM'],
    'show_name'         => $arParams['DISPLAY_NAME'] !== 'N' && $arResult['NAME'],
    'show_preview_text' => $arParams['DISPLAY_PREVIEW_TEXT'] != 'N' && $arResult['FIELDS']['PREVIEW_TEXT'],
    'use_share'         => isset($arParams['USE_SHARE']) && $arParams['USE_SHARE'] == 'Y',

];

$arResult['tpl'] = [
    'data'   => $data,
    'params' => $params,
];
