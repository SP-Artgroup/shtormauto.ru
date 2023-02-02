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

        switch ($code) {

            case 'NAME':
            case 'SERVICE':
                $field['TYPE'] = 'input';
                break;

            case 'DATE':
                $field['TYPE'] = 'input';
                break;

            case 'COMMENT':
                $field['TYPE'] = 'textarea';
                break;

            case 'SERVICE_TYPE':

                if (!is_array($field['VALUE'])) {
                    $field['VALUE'] = [];
                }
                break;

            default:
                break;
        }

        if ($code === 'SERVICE') {
            $field['VALUE'] = $_REQUEST['serviceId'];
        }

        $field['ATTRS'] = [
            'type'  => $typeMap[$field['TYPE']],
            'name'  => $field['NAME'],
            'value' => $field['VALUE'] ?: $field['DEFAULT_VALUE'],
            'id'    => $field['NAME'],
        ];

        if (in_array($code, ['NAME', 'SERVICE'])) {
            $field['ATTRS']['type'] = 'hidden';
        }

        if (!in_array($field['TYPE'], ['checkbox', 'radio'])) {
            $field['ATTRS']['placeholder'] = $field['LABEL'];
            unset($field['LABEL']);
        }

        if ($field['REQUIRED'] === 'Y') {
            $field['ATTRS']['required'] = 'required';
        }

        if ($code === 'COMMENT') {
            $field['ATTRS']['style'] = 'height: 150px';
        }

        $fields[$code] = $field;
    }

    $arResult['VIEW'] = $fields;

    $arResult['groups'] = [
        'left' => [
            'CLIENT_NAME',
            'PHONE',
            'AUTO_INFO',
            'DATE',
        ],
        'right' => [
            'SERVICE_TYPE',
        ],
        'hidden' => [
            'NAME',
            'SERVICE',
        ]
    ];
}
