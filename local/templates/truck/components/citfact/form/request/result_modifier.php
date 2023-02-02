<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!empty($arResult['VIEW'])) {

    $fields = [];
    $typeMap = [
        'input' => 'text',
    ];

    foreach ($arResult['VIEW'] as $code => $field) {

        if ($code === 'ACTIVE') {
            continue;
        }

        $field['ATTRS'] = [
            'type'        => $typeMap[$field['TYPE']],
            'placeholder' => $field['LABEL'],
            'name'        => $field['NAME'],
            'value'       => $field['VALUE'] ?: $field['DEFAULT_VALUE'],
        ];

        if ($field['REQUIRED'] === 'Y') {
            $field['ATTRS']['required'] = 'required';
        }

        unset($field['LABEL']);

        $fields[$code] = $field;
    }

    $arResult['VIEW'] = $fields;
}
