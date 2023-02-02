<?

namespace SP;

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;
use Bitrix\Catalog\StoreTable;
use Bitrix\Catalog\StoreProductTable;
use SP\City as SPCity;

Loader::includeModule('catalog');

$shtormauto = \Shtormauto::getInstance();

/**
*
*/
class Store
{
    public static function getStoreData($storeIds)
    {
        if (!is_array($storeIds)) {
            $storeIds = [$storeIds];
        }

        $stores = [];
        $fetchStoreIds = [];

        $cache = Cache::createInstance();
        $cacheTime = 60 * 60 * 24 * 30;
        $cacheDir = '/store_data';

        foreach ($storeIds as $storeId) {

            $cacheId = $storeId;

            if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
                $store = $cache->getVars();
                $stores[$storeId] = $store;
            } else {
                $fetchStoreIds[] = $storeId;
            }
        }

        if (!empty($fetchStoreIds)) {
            $rows = StoreTable::query()
                ->setFilter([
                    'ID' => $fetchStoreIds,
                    'ACTIVE' => 'Y',
                ])
                ->setSelect([
                    'ID', 'TITLE', 'ADDRESS', 'EMAIL'
                ])
                ->exec();

            foreach ($rows as $row) {

                $cacheId = $row['ID'];

                if ($cache->startDataCache($cacheTime, $cacheId, $cacheDir)) {
                    $cache->endDataCache($row);
                }

                $stores[$row['ID']] = $row;
            }
        }

        return $stores;
    }

    public static function getCityStore($cityId = null)
    {
        $city = $cityId === null
            ? SPCity::getCurrentCityData()
            : SPCity::getCityData($cityId);

        $stores = [];

        $shops = Shop::getCityShops($cityId);

        if (!empty($shops)) {
            foreach ($shops as $shopId) {
                if ($shopStores = Shop::getShopStores($shopId)) {
                    array_push($stores, ...$shopStores);
                }
            }
        }

        return $stores;

        // return is_array($city['PROPERTY_STORE_ID_VALUE'])
        //     ? $city['PROPERTY_STORE_ID_VALUE']
        //     : [];
    }

    public static function getCityProductAmount($productIds, $storeIds = null)
    {
        if (!is_array($productIds)) {
            $productIds = [$productIds];
        }

        $amounts = [];

        $storeIds = $storeIds ?: self::getCityStore();

        $rows = StoreProductTable::query()
            ->setOrder(['PRODUCT_ID' => 'ASC', 'STORE_ID' => 'ASC'])
            ->setFilter([
                'PRODUCT_ID' => $productIds,
                'STORE_ID'   => $storeIds,
                '>AMOUNT'    => 0,
            ])
            ->setSelect(['PRODUCT_ID', 'STORE_ID', 'AMOUNT'])
            ->exec();

        foreach ($rows as $row) {
            $amounts[$row['PRODUCT_ID']][$row['STORE_ID']] = $row['AMOUNT'];
        }

        return $amounts;
    }

    public function sortProductIdsByAvailableInCurrentCity(array $productIds)
    {
        \Bitrix\Main\Loader::includeModule('catalog');
        $storesForCurrentCity = self::getCityStore();        
        $amountsInStores = \Bitrix\Catalog\StoreProductTable::getList([
            'filter' => [
                'PRODUCT_ID' => $productIds,
                'STORE_ID' => $storesForCurrentCity
            ]
        ])->fetchAll();

        $amountsInStore = [];

        foreach ($productIds as $productId) {
            $amountsInStore[$productId] = 0;
        }

        foreach ($amountsInStores as $productInStore) {
            if ($productInStore['AMOUNT'] > 0) {
                $amountsInStore[$productInStore['PRODUCT_ID']] = 1;
            }
        }

        $sortedItems = [];

        foreach ($amountsInStore as $productId => $isAvailable) {
            if (in_array($productId, $sortedItems)) {
                continue;
            }

            if ($isAvailable) {
                array_push($sortedItems, $productId);
            }
        }

        foreach ($amountsInStore as $productId => $isAvailable) {
            if (in_array($productId, $sortedItems)) {
                continue;
            }

            if (!$isAvailable) {
                array_push($sortedItems, $productId);
            }
        }

        return $sortedItems;
    }
}