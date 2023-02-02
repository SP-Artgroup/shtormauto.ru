<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
//d
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use Local\Truck;
// use SP\Component as SPComponent;

Loc::loadMessages(__FILE__);

$asset = Asset::getInstance();
$app   = new Truck;

// include template css
foreach ([
    '/css/fonts/font.css',
    '/css/all.css',
    '/css/reset.css',
    '/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    '/vendor/bootstrap/dist/css/bootstrap.min.css',
    '/vendor/slick-carousel/slick/slick.css',
    '/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
    '/vendor/select2/dist/css/select2.min.css',
    '/css/slick-theme.css',
    '/css/main.css',
    '/css/global.css',
    '/css/media.css',
    '/css/ui.css',
    '/css/sprite.css',
] as $path) {
    $asset->addCss(SITE_TEMPLATE_PATH . $path);
}

// include template js
foreach ([
    '/vendor/jquery/dist/jquery.min.js',
    '/vendor/dist/js/bootstrap.min.js',
    '/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    '/vendor/slick-carousel/slick/slick.min.js',
    '/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
    '/vendor/select2/dist/js/select2.min.js',
    '/js/main.js',
    '/js/modules/catalog.js',
] as $path) {
    $asset->addJs(SITE_TEMPLATE_PATH . $path);
}

// include external js
foreach ([
    '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js',
] as $path) {
    $asset->addJs($path);
}

$msg        = [];
$langPrefix = 'tpl_truck_';


foreach ([
    'sign_in',
    'sign_up',
    'personal_page',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . $langCode);
}

// Массив разделов и текущая страница

$currentPath = explode('/', $APPLICATION->GetCurPage(false));
$lastIndex   = count($currentPath) - 1;

if (empty($currentPath[$lastIndex])) {
    unset($currentPath[$lastIndex]);
    --$lastIndex;
}

$currentPage = $currentPath[$lastIndex];
unset($lastIndex);

// Параметры показа некоторых элементов

$showBreadcrumb = true;

foreach ([
    '',  // <- /index.php
] as $excludePage) {

    if ($currentPage === $excludePage) {
        $showBreadcrumb = false;
        break;
    }
}

// Оборачивать WORK_AREA в специальный контейнер
$wrapWorkArea = true;

foreach ([
    '',  // <- /index.php
    'service',
] as $excludePage) {

    if ($currentPage === $excludePage) {
        $wrapWorkArea = false;
        break;
    }
}

if (
    isset($currentPath[1])
    && $currentPath[1] === 'shops'
    && isset($currentPath[2])
) {
    $wrapWorkArea = false;
}

// Скрыть блок с заголовком страницы

$hidePageHeader = false;

foreach ([
    $currentPage === '',
    $currentPage === 'service',
    (
        isset($currentPath[1])
        && $currentPath[1] === 'shops'
        && isset($currentPath[2])
    ),
] as $cond) {
    if ($cond) {
        $hidePageHeader = true;
        break;
    }
}

// Тип цены текущего города

$shtormauto = Shtormauto::getInstance();
$priceId    = $shtormauto->getCurrentCityPriceId();
$priceName  = $shtormauto->getCurrentCityPriceName();

include 'header.tpl.php';

unset($msg, $shtormauto, $priceId, $priceName);
