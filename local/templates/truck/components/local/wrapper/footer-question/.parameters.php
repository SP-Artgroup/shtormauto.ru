<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$set = [
    'question'      => 'Вопрос',
    'question_desc' => 'Описание вопроса',
    'question_btn'  => 'Надпись на кнопке',
];

foreach ($set as $code => $label) {
    $arTemplateParameters[$code] = [
        'NAME' => $label,
        'COLS' => 35,
        'ROWS' => 3,
    ];
}
