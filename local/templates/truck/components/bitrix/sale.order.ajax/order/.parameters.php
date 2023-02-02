<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arTemplateParameters = [
    'ALLOW_NEW_PROFILE'           => [
        'NAME'    => GetMessage('T_ALLOW_NEW_PROFILE'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
        'PARENT'  => 'BASE',
    ],
    'SHOW_PAYMENT_SERVICES_NAMES' => [
        'NAME'    => GetMessage('T_PAYMENT_SERVICES_NAMES'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'Y',
        'PARENT'  => 'BASE',
    ],
    'SHOW_STORES_IMAGES'          => [
        'NAME'    => GetMessage('T_SHOW_STORES_IMAGES'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'N',
        'PARENT'  => 'BASE',
    ],
    'HIDE_COUPON'                 => [
        'NAME'    => GetMessage('T_HIDE_COUPON'),
        'TYPE'    => 'CHECKBOX',
        'DEFAULT' => 'N',
        'PARENT'  => 'BASE',
    ],
];
