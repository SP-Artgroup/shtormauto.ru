<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
    'NAME'        => GetMessage('CT_LOCAL_WRAPPER_NAME'),
    'DESCRIPTION' => GetMessage('CT_LOCAL_WRAPPER_DESCRIPTION'),
    'PATH'        => [
        'ID'    => 'local',
        'NAME'  => GetMessage('CT_LOCAL_GROUP_NAME'),
        'CHILD' => [
            'ID' => 'wrapper',
        ],
    ],
];
