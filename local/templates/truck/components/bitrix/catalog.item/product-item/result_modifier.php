<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

use Bitrix\Main\Localization\Loc;
use SP\Shop;
use SP\City;
if(isset($arResult['ITEM']['ID']) && !empty($arResult['ITEM']['ID'])){
    $productId = $arResult['ITEM']['ID'];
    $currentCityId = City::getCurrentCityId();
    $currentPrice  = $arResult['ITEM']['ITEM_PRICES'][$arResult['ITEM']['ITEM_PRICE_SELECTED']];

    // Получение данных для вывода списка складов

    $shopIds = Shop::getCityShops(); // id складов города
    $shops   = Shop::getShopData($shopIds); // информация по каждому складу
    $amounts = Shop::getProductAmount($productId, $shopIds); // количество на складе

    if (isset($amounts[$productId])) {
        $arResult['STORE_DATA'] = [
            'STORES'     => $shops,
            'AMOUNTS'    => $amounts[$productId],
            'PRODUCT_ID' => $productId,
        ];
    } else {
        $arResult['ITEM']['CAN_BUY'] = false;
    }

    unset($shops, $amounts);

    if(isset($arResult["CITIES_LIST"])){
        $cities_list   = $arResult["CITIES_LIST"];
        $cities        = [];
        $citiesByShops = [];
        $allShopIds    = [];

        // Получение городов, в которых есть данный товар

        foreach ($cities_list as $city) {

            // Если у товара пустая цена, значит текущий город недоступен

            if ($city['ID'] == $currentCityId && empty($currentPrice)) {
                continue;
            }

            $cities[$city['ID']] = $city;
            //echo '<pre>'; print_r($cities[$city['ID']]); echo '</pre>'; 
            $cityShopIds = Shop::getCityShops($city['ID']);

            array_push($allShopIds, ...$cityShopIds);

            $citiesByShops += array_fill_keys(
                $cityShopIds,
                $city['ID']
            );
        }
        $tmpAmounts = Shop::getProductAmount($productId, $allShopIds);
        $strAvailableCities = '';

        if (!empty($tmpAmounts[$productId])) {

            $amounts = $tmpAmounts[$productId];

            $availableCities = [];

            foreach ($amounts as $shopId => $amount) {
                $cityId = $citiesByShops[$shopId];
                $availableCities[$cityId] = $cities[$cityId]['NAME'];
            }

            // Если текущего города нет среди доступных,
            // значит товар недоступен

            if (!isset($availableCities[$currentCityId])) {
                $arResult['ITEM']['CAN_BUY'] = false;
            }

            $arResult['ITEM']['AVAILABLE_CITIES'] = array_values($availableCities);

            if (!empty($availableCities)) {
                $strAvailableCities = implode(', ', $availableCities);
            }
        }
        $arResult['ITEM']['AVAILABLE_CITIES_STRING'] = $strAvailableCities;
    }
}