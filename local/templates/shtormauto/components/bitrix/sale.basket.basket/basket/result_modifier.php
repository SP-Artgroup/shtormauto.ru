<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
    }
}