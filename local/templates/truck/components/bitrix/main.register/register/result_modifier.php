<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Local\Truck\Form;

$this->includeLangFile('template.php');

$data   = [
    'errors' => [],
];
$params     = [];
$langPrefix = 'CT_MAINREG_';
$msg        = [];

if (!$arResult['TIME_ZONE_ENABLED']) {

    $key = array_search('AUTO_TIME_ZONE', $arResult['SHOW_FIELDS']);

    if ($key) {
        unset($arResult['SHOW_FIELDS'][$key]);
    }

} elseif (in_array('AUTO_TIME_ZONE', $arResult['SHOW_FIELDS'])) {
    $arResult['SHOW_FIELDS'][] = 'TIME_ZONE';
}

foreach ([
    'reg_success',
    'registration',
    'reg_btn',
    'user_dont_know',
    'user_male',
    'user_female',
    'tmz_auto',
    'tmz_auto_def',
    'tmz_auto_yes',
    'tmz_auto_no',
    'tmz_zones',
    'captcha_title',
    'captcha_word',
    'req_fields',
    'secure_note',
    'nonsecure_note',
    'email_will_be_sent',
    'first_visit',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . strtoupper($langCode));
}

if (!empty($arResult['SHOW_FIELDS'])) {

    foreach ($arResult['SHOW_FIELDS'] as $field) {

        $langCode       = 'field_' . strtolower($field);
        $msg[$langCode] = Loc::getMessage($langPrefix . strtoupper($langCode));
    }
}

if (!empty($arResult['ERRORS'])) {

    foreach ($arResult['ERRORS'] as $key => $error) {

        if ($error === 'Неверно введено слово с картинки') {
            continue;
        }

        if ($key !== 0) {

            $langCode = 'field_' . strtolower($key);

            if (!isset($msg[$langCode])) {
                $msg[$langCode] = Loc::getMessage($langPrefix . strtoupper($langCode));
            }

            $error = str_replace(
                '#FIELD_NAME#',
                '&quot;' . $msg[$langCode] . '&quot;',
                $error
            );
        }

        $data['errors'][$key] = $error;
    }
}

/*$captcha = new CCaptcha;

$captcha->setCode();
$captchaSid  = $captcha->GetSID();
$captchaCode = $captcha->code;*/

/*

example field

'fieldName' => [
    'tag'   => 'tagName', // input, textarea
    'hide'  => $condition,
    'text'  => 'text',    // in textarea
    'attrs' => [
        'attrName' => 'attrValue',
    ],
    'label' => [
        'text' => 'text',
    ],
];

*/

$data['fields'] = [
    'backurl' => [
        'tag'  => 'input',
        'hide' => !$arResult['BACKURL'],
        'attrs' => [
            'type'  => 'hidden',
            'name'  => 'backurl',
            'value' => $arResult['BACKURL'],
        ],
    ],
    /*'captcha_code' => [
        'tag'  => 'input',
        'attrs' => [
            'type'  => 'hidden',
            'name'  => 'captcha_sid',
            'value' => $captchaSid,
        ],
    ],
    'captcha_word' => [
        'tag'  => 'input',
        'attrs' => [
            'type'      => 'text',
            'name'      => 'captcha_word',
            'maxlength' => 50,
            'value'     => '',
        ],
    ],*/
    'submit' => [
        'tag'  => 'input',
        'attrs' => [
            'type'  => 'submit',
            'name'  => 'register_submit_button',
            'value' => $msg['reg_btn'],
        ],
    ],
];

foreach ($arResult['SHOW_FIELDS'] as $fieldName) {

    $useLabel       = false;
    $useValue       = true;
    $usePlaceholder = true;
    $requireSign    = ' <span class="starrequired">*</span>';

    $field = [];
    $code  = strtolower($fieldName);

    switch ($fieldName) {

        case 'PASSWORD':
        case 'CONFIRM_PASSWORD':

            $field = [
                'tag'  => 'input',
                'attrs' => [
                    'class'        => $fieldName === 'PASSWORD'
                        ? 'bx-auth-input'
                        : '',
                    'type'         => 'password',
                    'autocomplete' => 'off',
                    'size'         => 30,
                ],
            ];

            break;

        case 'PERSONAL_PHOTO':
        case 'WORK_LOGO':

            $useValue = false;

            $field = [
                'tag'  => 'input',
                'attrs' => [
                    'type' => 'file',
                    'size' => 30,
                    'name' => 'REGISTER_FILES_' . $fieldName,
                ],
            ];

            break;

        case 'PERSONAL_GENDER':

            $useValue = false;

            $field = [
                'tag'  => 'select',
                'options' => [
                    'none' => [
                        'text' => $msg['user_dont_know'],
                    ],
                    'male' => [
                        'value' => 'M',
                        'text' => $msg['user_male'],
                    ],
                    'female' => [
                        'value' => 'F',
                        'text' => $msg['user_female'],
                    ],
                ],
            ];

            if ($arResult['VALUES'][$fieldName] === 'M') {
                $field['options']['male']['selected'] = 'selected';
            } elseif ($arResult['VALUES'][$fieldName] === 'F') {
                $field['options']['female']['selected'] = 'selected';
            }

            break;


        case 'PERSONAL_NOTES':
        case 'WORK_NOTES':

            $useValue = false;

            $field = [
                'tag'  => 'textarea',
                'text' => $arResult['VALUES'][$fieldName],
                'attrs' => [
                    'cols' => 30,
                    'rows' => 5,
                ],
            ];

            break;

        case 'PERSONAL_COUNTRY':
        case 'WORK_COUNTRY':

            $useValue = false;
            $options  = [];

            foreach ($arResult['COUNTRIES']['reference_id'] as $key => $value) {

                $option = [
                    'value' => $value,
                    'text'  => $arResult['COUNTRIES']['reference'][$key],
                ];

                if ($arResult['VALUES'][$fieldName] == $value) {
                    $option['selected'] = 'selected';
                }

                $options[] = $option;
            }

            $field = [
                'tag'     => 'select',
                'options' => $options,
            ];

            break;

        case 'AUTO_TIME_ZONE':

            $useValue = false;

            $field = [
                'tag'     => 'select',
                'attrs'   => [
                    'onchange' => 'this.form.elements[\'REGISTER[TIME_ZONE]\'].disabled=(this.value != \'N\')',
                ],
                'options' => [
                    'none' => [
                        'text' => $msg['tmz_auto_def'],
                    ],
                    'Y' => [
                        'value' => 'Y',
                        'text' => $msg['tmz_auto_yes'],
                    ],
                    'N' => [
                        'value' => 'N',
                        'text' => $msg['tmz_auto_no'],
                    ],
                ],
            ];

            if ($arResult['VALUES'][$fieldName] === 'Y') {
                $field['options']['Y']['selected'] = 'selected';
            } elseif ($arResult['VALUES'][$fieldName] === 'N') {
                $field['options']['N']['selected'] = 'selected';
            }

            break;

        case 'TIME_ZONE':

            $useValue = false;
            $options  = [];

            foreach ($arResult['TIME_ZONE_LIST'] as $tz => $tzName) {

                $option = [
                    'value' => htmlspecialcharsbx($tz),
                    'text'  => htmlspecialcharsbx($tzName),
                ];

                if ($arResult['VALUES']['TIME_ZONE'] == $tz) {
                    $option['selected'] = 'selected';
                }

                $options[] = $option;
            }

            $field = [
                'tag'     => 'select',
                'options' => $options,
            ];

            if (!isset($_REQUEST['REGISTER']['TIME_ZONE'])) {
                $field['attrs']['disabled'] = 'disabled';
            }

            break;

        default:

            $field = [
                'tag'  => 'input',
                'attrs' => [
                    'type' => 'text',
                    'size' => 30,
                ],
            ];

            if ($fieldName === 'LOGIN') {
                $field['attrs']['type'] = 'hidden';
                $field['attrs']['value'] = 'tmp';
            }

            break;
    }

    if (!isset($field['attrs']['name'])) {
        $field['attrs']['name'] = 'REGISTER[' . $fieldName . ']';
    }

    if ($useValue && !isset($field['attrs']['value'])) {
        $field['attrs']['value'] = $arResult['VALUES'][$fieldName];
    }

    if ($usePlaceholder && !isset($field['attrs']['placeholder'])) {
        $field['attrs']['placeholder'] = $msg['field_' . $code];
    }

    if ($useLabel && !isset($field['label'])) {
        $field['label'] = [
            'text' => $msg['field_' . $code] . ':',
        ];
    }

    if (isset($arResult['REQUIRED_FIELDS_FLAGS'][$fieldName])) {
        $field['attrs']['required'] = 'required';

        if ($useLabel) {
            $field['label']['text'] .= $requireSign;
        }
    }

    $data['fields'][$code] = $field;
}

$data['form'] = new Form([
    'attrs' => [
        'class'   => 'form-registration',
        'method'  => 'post',
        'action'  => POST_FORM_ACTION_URI,
        'name'    => 'regform',
        'enctype' => 'multipart/form-data',
    ],
    'fields' => $data['fields'],
]);
$data['langPrefix'] = $langPrefix;
$data['msg']        = $msg;

$arResult['tpl'] = [
    'data'   => $data,
    'params' => $params,
];

//$arResult['USE_CAPTCHA'] = 'N';
$arResult['SHOW_FIELDS'] = [];