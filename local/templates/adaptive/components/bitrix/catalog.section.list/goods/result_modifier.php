<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use SP\Catalog as SPCatalog;

if (!empty($arResult['SECTIONS'])) {

    $checkSections = [];

    foreach ($arResult['SECTIONS'] as $section) {

        $checkSections[] = [
            'ID'           => $section['ID'],
            'LEFT_MARGIN'  => $section['LEFT_MARGIN'],
            'RIGHT_MARGIN' => $section['RIGHT_MARGIN'],
        ];
    }

    $shtormauto = Shtormauto::getInstance();

    $availableSections = SPCatalog::getAvailableSections($checkSections, $shtormauto->getCurrentCityId());

    $newSections = [];

    foreach ($arResult['SECTIONS'] as $cell => $arSection) {

        if ($arSection['UF_HIDE'] || !in_array($arSection['ID'], $availableSections)) {
            continue;
        }

        if (is_array($arSection["PICTURE"])) {

            $img = CFile::ResizeImageGet(
                $arSection['PICTURE'],
                ['width' => 140, 'height' => 120],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );

            $arSection['PICTURE'] = $img;
        }

        $newSections[$cell] = $arSection;
    }

    $arResult['SECTIONS'] = $newSections;
}