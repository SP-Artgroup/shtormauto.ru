<?

$newItems = [];

foreach ($arResult['ITEMS'] as $key => $arItem) {

    if (!is_array($arItem['PROPERTIES']['BANNER'])) {
        continue;
    }

    $file = CFile::GetPath($arItem['PROPERTIES']['BANNER']['VALUE']);
    $type = end(explode('.', $file));

    if ($type === 'swf') {
        continue;
    }

    $arItem['TYPE'] = 'image';
    $arItem['VALUE'] = $file;

    $newItems[$key] = $arItem;
}

$arResult['ITEMS'] = $newItems;
