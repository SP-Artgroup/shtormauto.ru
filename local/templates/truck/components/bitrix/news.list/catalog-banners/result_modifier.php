<?php

$items = [];

foreach ($arResult['ITEMS'] as $item) {

    if (!empty($item['PREVIEW_PICTURE'])) {

        $resizedImage = CFile::resizeImageGet(
            $item['PREVIEW_PICTURE'],
            [
                'width'  => 253,
                'height' => 393,
            ],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );

        if ($resizedImage) {

            $item['PREVIEW_PICTURE'] = array_change_key_case(
                $resizedImage,
                CASE_UPPER
            );
        }
    }

    $items[] = $item;
}

$arResult['ITEMS'] = $items;
