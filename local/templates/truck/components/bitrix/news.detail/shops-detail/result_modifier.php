<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$data   = [];
$params = [];

$params = [
    'show_picture'      => $arParams['DISPLAY_PICTURE'] !== 'N' && is_array($arResult['DETAIL_PICTURE']),
    'show_date'         => $arParams['DISPLAY_DATE'] !== 'N' && $arResult['DISPLAY_ACTIVE_FROM'],
    'show_name'         => $arParams['DISPLAY_NAME'] !== 'N' && $arResult['NAME'],
    'show_preview_text' => $arParams['DISPLAY_PREVIEW_TEXT'] != 'N' && $arResult['FIELDS']['PREVIEW_TEXT'],
    'use_share'         => isset($arParams['USE_SHARE']) && $arParams['USE_SHARE'] == 'Y',
];

$displayProps = $arResult['DISPLAY_PROPERTIES'];

$cityProp = $displayProps['CITY'] ?? '';

$data['cityName'] = '';

if ($cityProp) {
    $cityId   = $cityProp['VALUE'];
    $cityName = $cityProp['LINK_ELEMENT_VALUE'][$cityId]['NAME'] ?? '';
    $data['cityName'] = $cityName;
}

$data['address'] = '';
$address         = $displayProps['ADDRESS']['VALUE'] ?? '';

if ($address) {
    $tmpCityName = $cityName ? $cityName . ', ' : '';
    $data['address'] = $tmpCityName . $address;
}

$data['phone'] = $displayProps['PHONE']['VALUE'] ?? '';
$data['contacts'] = $displayProps['CONTACTS']['~VALUE']['TEXT'] ?? '';
$data['worktime'] = $displayProps['WORK_TIME']['VALUE'] ?? '';
$data['email'] = $displayProps['EMAIL']['VALUE'] ?? '';

/*$data['timetable'] = null;

$timetableProp = $displayProps['TIMETABLE'] ?? null;

if ($timetableProp) {

    foreach ($timetableProp['VALUE'] as $key => $time) {

        $data['timetable'][] = [
            'days' => $timetableProp['DESCRIPTION'][$key],
            'time' => $time,
        ];
    }
}*/

$data['slides'] = null;
$slidesProp     = $displayProps['PHOTO'] ?? null;

if ($slidesProp) {

    foreach ($slidesProp['FILE_VALUE'] as $slide) {

        $resizeImg = CFile::ResizeImageGet(
            $slide,
            [
                'width'  => 139,
                'height' => 127,
            ],
            BX_RESIZE_IMAGE_EXACT
        );

        if (!empty($resizeImg['src'])) {
            $slide = [
                'src'      => $resizeImg['src'],
                'full-src' => $slide['SRC'],
                'width'    => $resizeImg['width'] ?? '',
                'height'   => $resizeImg['height'] ?? '',
            ];
        } else {
            $slide = [
                'src'      => $slide['SRC'],
                'full-src' => $slide['SRC'],
                'width'    => $resizeImg['WIDTH'],
                'height'   => $resizeImg['HEIGHT'],
            ];
        }

        $data['slides'][] = $slide;
    }
}

$data['mapData'] = null;
$mapProp         = $displayProps['LOCATION'] ?? null;

if ($mapProp) {

    $coords = explode(',', $mapProp['VALUE']);

    $data['mapData'] = serialize([
        'yandex_lat'   => $coords[0],
        'yandex_lon'   => $coords[1] - 0.02,
        'yandex_scale' => 14,
        'PLACEMARKS'   => [
            [
                'LAT'     => $coords[0],
                'LON'     => $coords[1],
                'TEXT'    => $arResult['NAME'],
                'options' => [
                    'balloonCloseButton' => true,
                    'iconImageHref'      => SITE_TEMPLATE_PATH . '/img/map-marker.png',
                    'iconImageSize'      => [39, 56],
                ],
            ]
        ],
    ]);
}

$arResult['tpl'] = [
    'data'   => $data,
    'params' => $params,
];
