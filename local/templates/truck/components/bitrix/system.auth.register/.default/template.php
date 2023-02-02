<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->IncludeComponent(
    'bitrix:main.register',
    'register',
    [
        'AUTH'               => 'Y',
        'COMPONENT_TEMPLATE' => 'register',
        'REQUIRED_FIELDS'    => [
            'EMAIL',
            'NAME',
            'PERSONAL_PHONE',
        ],
        'SET_TITLE'          => 'N',
        'SHOW_FIELDS'        => [
            'EMAIL',
            'NAME',
            'PERSONAL_PHONE',
            'LOGIN',
        ],
        'SUCCESS_PAGE'       => '',
        'USER_PROPERTY'      => [],
        'USER_PROPERTY_NAME' => '',
        'USE_BACKURL'        => 'Y',
    ]
);
