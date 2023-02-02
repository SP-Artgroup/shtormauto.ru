<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */
global $APPLICATION;
if (isset($_POST['AJAX-ACTION']) && $_POST['AJAX-ACTION'] == 'FORGOT') {
    $APPLICATION->RestartBuffer();

    header('Content-type: application/json');
    $response = array(
        'STATUS' => $arParams['AUTH_RESULT']['TYPE'],
        'FORM' => 'FORGOT',
        'MESSAGES' => array(
            strip_tags($arParams['AUTH_RESULT']['MESSAGE'])
        ),
    );
    echo \Bitrix\Main\Web\Json::encode($response);
    die();
}