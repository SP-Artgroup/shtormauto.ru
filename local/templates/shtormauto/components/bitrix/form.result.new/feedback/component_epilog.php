<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/validationEngine.jquery.css');
$APPLICATION->AddHeadScript('https://www.google.com/recaptcha/api.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.validationEngine.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.validationEngine-ru.js');