<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Sale\Location\TypeTable;
use SP\City as SPCity;
use SP\Shop as SPShop;

// if order doesn't create
if (empty($arResult['ORDER'])) {

    $shopId              = $_REQUEST['SHOP_ID'] ?? null;
    $arResult['SHOP_ID'] = $shopId;

    $delayDeliveryMessage = false;

    foreach ($arResult['BASKET_ITEMS'] as $itemKey => $item) {

        $store = null;

        if (!empty($item['PROPS'])) {

            foreach ($item['PROPS'] as $prop) {

                if ($prop['CODE'] === 'STORE_ID') {

                    if ($prop['VALUE'] !== $shopId) {
                        $delayDeliveryMessage = true;
                    }

                    $store = $prop;
                    break;
                }
            }
        }

        if ($store) {
            $arResult['BASKET_ITEMS'][$itemKey]['STORE'] = $store;
        }
    }

    $arResult['DELAY_DELIVERY_MESSAGE'] = $delayDeliveryMessage;

    $shops_to_json = [];
    $cities        = [];
    $shops         = [];

    $arResult['CURRENT_CITY_ID'] = SPCity::cityConfirm() ? SPCity::getCurrentCityId() : null;

    $allShopIds   = SPShop::getAllShops();
    $allShopIds[] = 498906; // костыль
    $allShops     = SPShop::getShopData($allShopIds);

    foreach ($allShops as $shop) {

        $jsonShop = [
            'ID'       => $shop['ID'],
            'NAME'     => $shop['NAME'],
            'LOCATION' => $shop['PROPERTY_LOCATION_VALUE'],
            'CITY'     => $shop['PROPERTY_CITY_VALUE'],
            'ADDRESS'  => $shop['PROPERTY_ADDRESS_VALUE'],
        ];

        $cityId   = $shop['PROPERTY_CITY_VALUE'] ?: 'other';
        $cityName = $shop['PROPERTY_CITY_NAME'] ?? 'Другой город';

        $shops_to_json[$shop['ID']] = $jsonShop;
        $shops[$cityName][]         = $shop;
        $cities[$cityId]            = $cityName;
    }

    $arResult['SHOPS']         = $shops;
    $arResult['CITIES']        = $cities;
    $arResult['SHOPS_TO_JSON'] = $shops_to_json;

    // Штуки для карта

    $isLocationProEnabled        = CSaleLocation::isLocationProEnabled();
    $arResult['LOC_PRO_ENABLED'] = $isLocationProEnabled;

    if ($isLocationProEnabled) {

        $arResult['MAP_CITY'] = TypeTable::getList([
            'filter' => ['=CODE' => 'CITY'],
            'select' => ['ID'],
        ])->fetch();
    }

    // Ссылки на иконки для полей

    $iconDir = SITE_TEMPLATE_PATH . '/img/';

    if (!empty($arResult['ORDER_PROP']['USER_PROPS_Y'])) {

        $props = [];

        foreach ($arResult['ORDER_PROP']['USER_PROPS_Y'] as $key => $prop) {

            if (in_array($prop['CODE'], ['SERVICE'])) {
                continue;
            }

            switch ($prop['CODE']) {

                case 'notice':
                    $iconName = 'textarea.png';
                    break;

                case 'FIO':
                    $iconName = 'name-icon.png';
                    break;

                case 'EMAIL':
                    $iconName = 'email-icon.png';
                    break;

                case 'PHONE':
                    $iconName = 'tel-icon.png';
                    break;

                default:
                    $iconName = 'pass-icon.png';
                    break;
            }

            $prop['ICON'] = $iconName
                ? $iconDir . $iconName
                : null;

            $props[$key] = $prop;
        }

        $arResult['ORDER_PROP']['USER_PROPS_Y'] = $props;
    }

    if (!empty($arResult['ORDER_PROP']['USER_PROPS_N'])) {

        $props = [];

        foreach ($arResult['ORDER_PROP']['USER_PROPS_N'] as $key => $prop) {

            if (in_array($prop['CODE'], ['SERVICE'])) {
                continue;
            }

            switch ($prop['CODE']) {

                case 'notice':
                    $iconName = 'textarea.png';
                    break;

                default:
                    $iconName = null;
                    break;
            }

            $prop['ICON'] = $iconName
                ? $iconDir . $iconName
                : null;

            $props[$key] = $prop;
        }

        $arResult['ORDER_PROP']['USER_PROPS_N'] = $props;
    }

    if (!function_exists("cmpBySort"))
    {
        function cmpBySort($array1, $array2)
        {
            if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
                return -1;

            if ($array1["SORT"] > $array2["SORT"])
                return 1;

            if ($array1["SORT"] < $array2["SORT"])
                return -1;

            if ($array1["SORT"] == $array2["SORT"])
                return 0;
        }
    }

    // resort arrays according to SORT value
    uasort($arResult["PAY_SYSTEM"], "cmpBySort");

} else {

    if ($arResult['ORDER']['USER_ID'] === $USER->GetID()) {

        $items = [];

        $dbBasketItems = CSaleBasket::GetList(
            [
                'NAME' => 'ASC',
                'ID'   => 'ASC',
            ],
            [
                'LID'      => SITE_ID,
                'ORDER_ID' => $arResult['ORDER']['ID'],
            ],
            false,
            false,
            ['PRODUCT_ID', 'NAME', 'PRICE', 'QUANTITY']
        );

        while ($row = $dbBasketItems->Fetch()) {
            $items[] = [
                'id'       => $row['PRODUCT_ID'],
                'name'     => $row['NAME'],
                'price'    => $row['PRICE'],
                'quantity' => $row['QUANTITY'],
            ];
        }

        $arResult['ORDER']['GA_DATA'] = $items;

        $options                      = JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES;
        $arResult['ORDER']['GA_JSON'] = Bitrix\Main\Web\Json::encode($items, $options);
    }

}
