<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use SP\City;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

if (empty($arResult['ITEMS'])) {
    return;
}

$msg        = [];
$langPrefix = 'ct_bnl_';

foreach ([
    'element_delete_confirm',
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . $langCode);
}

$params = [
    'display_date'         => $arParams['DISPLAY_DATE'] !== 'N',
    'display_name'         => $arParams['DISPLAY_NAME'] !== 'N',
    'display_preview_text' => $arParams['DISPLAY_PREVIEW_TEXT'] !== 'N',
    'display_picture'      => $arParams['DISPLAY_PICTURE'] !== 'N',
    'display_link'         => !$arParams['HIDE_LINK_WHEN_NO_DETAIL'],
];

$hermitageParams = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => $msg['element_delete_confirm']],
];

$items = [];

foreach ($arResult['ITEMS'] as $key => $item) {

    $displayProps = $item['DISPLAY_PROPERTIES'];

    $newItem   = [
        'id'              => $item['ID'],
        'name'            => $item['NAME'],
        'preview_picture' => [
            'src'   => $item['PREVIEW_PICTURE']['SRC'],
            'title' => $item['PREVIEW_PICTURE']['TITLE'],
        ],
        'preview_text'    => $item['PREVIEW_TEXT'],
        'detail_text'     => $item['DETAIL_TEXT'],
        'areaId'          => $this->GetEditAreaId($item['ID']),
        'location'        => explode(',', $displayProps['LOCATION']['VALUE']),
    ];

    $itemParams = [
        'display_active_from'  => $params['display_date'] && $newItem['active_from'],
        'display_name'         => $params['display_name'] && $newItem['name'],
        'display_preview_text' => $params['display_preview_text'] && $newItem['preview_text'],
        'display_picture'      => $params['display_picture'] && is_array($newItem['preview_picture']),
        'display_link'         => $params['display_link'] || ($newItem['detail_text'] && $arResult['USER_HAVE_ACCESS']),
    ];

    // $this->AddEditAction(
    //     $item['ID'],
    //     $item['EDIT_LINK'],
    //     $hermitageParams['EDIT']
    // );

    // $this->AddDeleteAction(
    //     $item['ID'],
    //     $item['DELETE_LINK'],
    //     $hermitageParams['DELETE'],
    //     $hermitageParams['CONFIRM']
    // );

    $newItem['params'] = $itemParams;
    $items[]           = $newItem;
}

$data = [
    'msg'             => $msg,
    'hermitageParams' => $hermitageParams,
    'items'           => $items,
    'cities'          => City::getAllCities(),
    'currentCityId'   => $arParams['CITY_ID'],
    'topPager'        => $arParams['DISPLAY_TOP_PAGER']
        ? $arResult['NAV_STRING']
        : '',
    'bottomPager'     => $arParams['DISPLAY_BOTTOM_PAGER']
        ? $arResult['NAV_STRING']
        : '',
];

$arResult['tpl'] = [
    'data'   => $data,
    'params' => $params,
];
