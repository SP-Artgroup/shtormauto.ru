<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Context;
use Local\Truck\Form;

if ($USER->isAuthorized() && !$USER->isAdmin()) {
    localRedirect(SITE_DIR);
}

$this->includeLangFile('template.php');

$data   = [];
$params = [];

$langPrefix = 'AUTH_';
$msg        = [];

$params = [
    'show_forgot_pass'   => $arParams['NOT_SHOW_LINKS'] != 'Y',
    'show_register_link' => $arParams['NOT_SHOW_LINKS'] !== 'Y'
        && $arResult['NEW_USER_REGISTRATION'] === 'Y'
        && $arParams['AUTHORIZE_REGISTRATION'] !== 'Y',
    'remember_me' => $arResult['STORE_PASSWORD'] == 'Y',
];

foreach ([
    'title',
    'please_auth',
    'login',
    'password',
    'secure_note',
    'nonsecure_note',
    'captcha_promt',
    'remember_me',
    'authorize',
    'forgot_password_2',
    'register',
    'first_one',
    'caption',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . strtoupper($langCode));
}

/*

example field

'fieldName' => [
    'tag'   => 'tagName', // input, textarea
    'text'  => 'text',    // in textarea
    'attrs' => [
        'attrName' => 'attrValue',
    ],
    'label' => [
        'text' => 'text',
    ],
];

*/

$request = Context::getCurrent()->getRequest();

$fields = [
    'AUTH_FORM'     => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'  => 'hidden',
            'name'  => 'AUTH_FORM',
            'value' => 'Y',
        ],
    ],
    'TYPE'          => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'  => 'hidden',
            'name'  => 'TYPE',
            'value' => 'AUTH',
        ],
    ],
    'backurl'       => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'  => 'hidden',
            'name'  => 'backurl',
            'value' => $arResult['BACKURL'],
        ],
    ],
    'USER_LOGIN'    => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'        => 'email',
            'name'        => 'USER_LOGIN',
            'value'       => $arResult['LAST_LOGIN'] ?: $request->get('USER_LOGIN'),
            'placeholder' => $msg['login'],
        ],
    ],
    'USER_PASSWORD' => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'autocomplete' => 'off',
            'type'         => 'password',
            'name'         => 'USER_PASSWORD',
            'placeholder' => $msg['password'],
        ],
    ],
    'captcha_sid'   => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'  => 'hidden',
            'name'  => 'captcha_sid',
            'value' => $arResult['CAPTCHA_CODE'],
        ],
    ],
    'captcha_word'   => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'class'     => 'bx-auth-input form-control',
            'type'      => 'text',
            'name'      => 'captcha_word',
            'value'     => '',
            'maxlength' => 50,
            'size'      => 15,
        ],
    ],
    'USER_REMEMBER'   => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'  => 'checkbox',
            'id'    => 'USER_REMEMBER',
            'name'  => 'USER_REMEMBER',
            'value' => 'Y',
        ],
        'label' => [
            'text' => '&nbsp;' . $msg['remember_me'],
        ],
    ],
    'Login'   => [
        'tag'   => 'input',
        'text'  => '',
        'attrs' => [
            'type'  => 'submit',
            'name'  => 'Login',
            'value' =>  $msg['authorize'],
        ],
    ],
];

$data['form'] = new Form([
    'attrs'  => [
        'class'  => 'form-autorization',
        'name'   => 'form_auth',
        'method' => 'post',
        'target' => '_top',
        'action' => $arResult['AUTH_URL'],
    ],
    'fields' => $fields,
]);
$data['langPrefix'] = $langPrefix;
$data['msg']        = $msg;

$arResult['tpl'] = [
    'data'   => $data,
    'params' => $params,
];
