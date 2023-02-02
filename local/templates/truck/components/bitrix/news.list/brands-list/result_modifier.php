<?php

if (empty($arResult['ITEMS'])) {
    return;
}

foreach ($arResult['ITEMS'] as $key => $item) {

    if (!empty($item['PREVIEW_PICTURE']['SRC'])) {

        $resizeImg = CFile::ResizeImageGet(
            $item['PREVIEW_PICTURE'],
            [
                'width'  => 172,
                'height' => 119,
            ],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );

        if (!empty($resizeImg['src'])) {
            $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = $resizeImg['src'];
        }
    }
}
