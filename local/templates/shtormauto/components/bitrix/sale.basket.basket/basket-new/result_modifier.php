<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use SP\City as SPCity;
use SP\Shop as SPShop;
use Bitrix\Main\Loader;

$currentCityId = SPCity::getCurrentCityId();

if (!empty($arResult['ITEMS']['AnDelCanBuy'])) {

    foreach ($arResult['ITEMS']['AnDelCanBuy'] as $itemKey => $item) {

        if (!empty($item['PROPS'])) {

            foreach ($item['PROPS'] as $prop) {

                if ($prop['CODE'] === 'STORE_ID') {
                    $arResult['ITEMS']['AnDelCanBuy'][$itemKey]['STORE'] = $prop;
                    break;
                }
            }
        }

        if ($item['PREVIEW_PICTURE']) {

            $arFile = CFile::ResizeImageGet(
                $item['PREVIEW_PICTURE'],
                [
                    'width'  => 70,
                    'height' => 67,
                ],
                BX_RESIZE_IMAGE_EXACT,
                true
            );

            $arResult['ITEMS']['AnDelCanBuy'][$itemKey]['PREVIEW_PICTURE_SRC'] = $arFile['src'];
        }
        $cityShopIds = SPShop::getCityShops($currentCityId);    
        $quanCities[] = SPShop::getProductAmount($item["PRODUCT_ID"], $cityShopIds);
    }
}

foreach ($arResult['ITEMS']['AnDelCanBuy'] as $key => $arItem) {

    $res = CIBlockElement::GetList(
        [],
        [
            'ID'        => $arItem['PRODUCT_ID'],
            'IBLOCK_ID' => IBLOCK_ID_CATALOG,
        ],
        false,
        false,
        ['ID', 'PROPERTY_SEZONNOST']
    );

    if ($arRes = $res->Fetch()) {
        $arResult['ITEMS']['AnDelCanBuy'][$key]['PROP_SEZONNOST'] = $arRes['PROPERTY_SEZONNOST_VALUE'];
    }
}

foreach ($quanCities as $key => $quanCity) {
    $maxQuantity = 0;
    foreach ($quanCity as $key_2 => $shops) {
        foreach ($shops as $key_3 => $quan) {
            $maxQuantity = $maxQuantity + $quan;
        }
        $arResult["MAX_QUANTITY_CITY"][$key_2] = $maxQuantity;
    }   
}

$arProductsId = [];
foreach ($arResult['ITEMS']['AnDelCanBuy'] as $item) {
    array_push($arProductsId, $item['PRODUCT_ID']);
}

if (Loader::includeModule('iblock')) {
    $arSelect = ['IBLOCK_SECTION_ID', 'ID'];
    $arFilter = ['IBLOCK_ID' => IBLOCK_ID_CATALOG, 'ID' => $arProductsId];
    $elements = CIBlockElement::GetList(['SORT'=>'ASC'], $arFilter, false, false, $arSelect);

    $idSections = [];
    while ($element = $elements->getNext()) {
        $idSections[$element["ID"]] = $element["IBLOCK_SECTION_ID"];
    }
}

$entityClass = \SP\MainClass::getHighloadBlockEntityClass(HLBLOCK_SECTIONS_DISCOUNTS);

$arSetionsId = [];
foreach ($idSections as $idSection) {
    $resSection = CIBlockSection::GetNavChain(false, $idSection);
    while ($section = $resSection->GetNext()) {
        array_push($arSetionsId, $section["ID"]);
    }
}
$arSetionsId = array_unique($arSetionsId);

$sectionsDiscounts = $entityClass::getList([
    'select' => ['UF_DISCOUNT', 'UF_ID_SECTION'],
    'filter' => ['UF_ID_SECTION' => $arSetionsId]
]);

$arDisounts = [];
while ($discount = $sectionsDiscounts->Fetch()) {
    $sectionId = (string)$discount['UF_ID_SECTION'];
    $arDisounts[$sectionId] = $discount['UF_DISCOUNT'];
}

foreach ($arResult['ITEMS']['AnDelCanBuy'] as &$item) {
    $idSection = $idSections[$item['PRODUCT_ID']];

    $resSection = CIBlockSection::GetNavChain(false, $idSection);
    while ($section = $resSection->GetNext()) {
        if (array_key_exists($section["ID"], $arDisounts)) {
            $item["DISCOUNT_PERCENT"] = $arDisounts[$section["ID"]];
        };
    }
}