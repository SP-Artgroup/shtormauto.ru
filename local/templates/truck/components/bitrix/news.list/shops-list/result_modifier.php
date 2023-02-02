<?php

if (empty($arResult['ITEMS'])) {
    return;
}

$newItems = [];

foreach ($arResult['ITEMS'] as $key => $item) {

    $tpl = [];

    if (!empty($item['PREVIEW_PICTURE']['SRC'])) {

        $resizeImg = CFile::ResizeImageGet(
            $item['PREVIEW_PICTURE'],
            [
                'width'  => 214,
                'height' => 215,
            ],
            BX_RESIZE_IMAGE_EXACT
        );

        if (!empty($resizeImg['src'])) {
            $item['PREVIEW_PICTURE']['SRC'] = $resizeImg['src'];
        }
    }

    $displayProps = $item['DISPLAY_PROPERTIES'];
    $cityProp     = $displayProps['CITY'];
    $cityId       = $cityProp['VALUE'];

    if ($cityId) {
        $tpl['cityName'] = $cityProp['LINK_ELEMENT_VALUE'][$cityId]['NAME'] ?? '';
    }

    $tpl['address'] = $tpl['cityName'] && !empty($displayProps['ADDRESS']['VALUE'])
        ? $displayProps['ADDRESS']['VALUE']
        : '';

    $tpl['phone'] = !empty($displayProps['PHONE'])
        ? $displayProps['PHONE']['VALUE']
        : '';

    $tpl['desc'] = !empty($item['PREVIEW_TEXT'])
        ? strip_tags($item['PREVIEW_TEXT'])
        : '';

    $item['tpl']    = $tpl;
    $newItems[$key] = $item;
}

$arResult['ITEMS'] = $newItems;
