<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$set = [
    'address' => 'Адрес',
    'phone'   => 'Телефон',
];

foreach ($set as $code => $label) {
    $arTemplateParameters[$code] = [
        'NAME' => $label,
        'COLS' => 35,
        'ROWS' => 3,
    ];
}
