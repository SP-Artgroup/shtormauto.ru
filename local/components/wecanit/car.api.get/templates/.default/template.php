<?php
/** @var $arResult */
use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc as Loc;
use Bitrix\Main\Web\Json;

Loc::loadMessages(__FILE__);

$response = Context::getCurrent()->getResponse();
//$response->addHeader('Content-Type', 'application/json');
$response->setStatus(200);

$responseArray = [
    'result' => $arResult['RESULT'],
    'error' => $arResult['ERROR'],
];

$response->flush(Json::encode($responseArray));
