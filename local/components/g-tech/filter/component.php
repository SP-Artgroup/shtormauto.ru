<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!isset($arParams['CACHE_TIME'])) {
    $arParams['CACHE_TIME'] = 36000000;
}

$arParams['ID']        = intval($arParams['ID']);
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);

$arParams['DEPTH_LEVEL'] = intval($arParams['DEPTH_LEVEL']);
if ($arParams['DEPTH_LEVEL'] <= 0) {
    $arParams['DEPTH_LEVEL'] = 1;
}

$arResult['FILTER_VALUES'] = [];

$FILTER_NAME = $arParams['FILTER_NAME'];

global ${$FILTER_NAME};
if (!is_array(${$FILTER_NAME})) {
    ${$FILTER_NAME} = [];
}

$arrFilter = &${$FILTER_NAME};

$selectedValue = [];

if (isset($_REQUEST['FILTER']) && !empty($_REQUEST['FILTER'])) {
    $selectedValues = $_REQUEST['FILTER'];
    foreach ($selectedValues as $code => $value) {
        if (!empty($value)) {
            if ($code == 'TIRE_W') {
                $arrFilter['PROPERTY_' . $code . '_VALUE'] = $value;
            } else {
                $arrFilter['PROPERTY_' . $code] = $value;
            }
        }

    }
    if (!empty($arrFilter)) {
        $arrFilter['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
        $ids                    = [];
        $dbOffers               = CIBlockElement::GetList([], $arrFilter, ['ID'], false, ['IBLOCK_ID', 'ID']);
        while ($arOffer = $dbOffers->Fetch()) {
            $ids[] = $arOffer['ID'];
        }
        if (!empty($ids)) {
            $arrFilter       = [];
            $arrFilter['ID'] = $ids;
        } else {
            unset($arrFilter['IBLOCK_ID']);
        }
    }
}
if ($this->StartResultCache()) {

    if (!CModule::IncludeModule('iblock')) {

        $this->AbortResultCache();

    } elseif (!empty($arParams['PROPERTY_CODE'])) {

        $arFilter = [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        ];

        $arSelect = [
            'IBLOCK_ID',
            'ID',
        ];

        foreach ($arParams['PROPERTY_CODE'] as $propCode) {

            if (strlen($propCode) <= 0) {
                continue;
            }

            $propName      = 'PROPERTY_' . $propCode;
            $propNameValue = $propName . '_VALUE';

            $arFilter['!' . $propNameValue] = [false, '*'];
            $arSelect[]                     = $propName;

            $arResult['FILTER_VALUES'][$propName]         = [];
            $arResult['FILTER_VALUES'][$propName]['CODE'] = $propCode;
        }

        $obCache = new CPHPCache();
        if ($obCache->InitCache(3600, 'GTECH_FILTER__' . $arParams['RESULT_PAGE'], '/')) // Если кэш валиден
        {
            $arResult = $obCache->GetVars();      // Извлечение переменных из кэша
        } elseif ($obCache->StartDataCache()) // Если кэш невалиден
        {
            $dbRes  = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
            $values = [];

            while ($arRes = $dbRes->Fetch()) {

                foreach ($arResult['FILTER_VALUES'] as $code => $value) {
                    if (
                        $arRes[$code . '_VALUE']
                        && (
                            !isset($values[$code])
                            || !in_array($arRes[$code . '_VALUE'], $values[$code])
                        )
                    ) {
                        if ($arRes[$code . '_VALUE'] != '*') {
                            $arResult['FILTER_VALUES'][$code]['VALUES'][] = [
                                'VALUE'   => $arRes[$code . '_VALUE'],
                                'ENUM_ID' => $arRes[$code . '_ENUM_ID'],
                            ];
                            $values[$code][] = $arRes[$code . '_VALUE'];
                        }
                    }
                }
            }

            $obCache->EndDataCache($arResult);
        }

        foreach ($arResult['FILTER_VALUES'] as $filter_code => $filter_values) {

           foreach ($filter_values['VALUES'] as $key => $filter_value) {

                if ($filter_value['ENUM_ID'] == $selectedValues[$filter_values['CODE']]) {
                    $arResult['FILTER_VALUES'][$filter_code]['VALUES'][$key]['SELECTED'] = true;

                }
            }
        }

        foreach ($arResult['FILTER_VALUES'] as $code => $arrValues) {
            sort(array_unique($arrValues['VALUES']));
            $arResult['FILTER_VALUES'][$code] = $arrValues;
        }

        $this->EndResultCache();
    }
}

$this->IncludeComponentTemplate();
