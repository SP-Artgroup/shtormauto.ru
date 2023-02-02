<?php

namespace SP;

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;
use Bitrix\Catalog\StoreTable;
use SP\City as SPCity;
use SP\Store as SPStore;

Loader::includeModule('iblock');
Loader::includeModule('catalog');

/**
*
*/
class Shop
{
    const IBLOCK_ID = 7;

    public static function getShopData($shopIds)
    {
        if (!is_array($shopIds)) {
            $shopIds = [$shopIds];
        }

        $cache       = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();
        $cacheTtl    = 60 * 60 * 24 * 365;
        $cacheDir    = 'shopData';
        $cacheTag    = 'iblock_id_' . self::IBLOCK_ID;

        $shops    = [];
        $uncached = [];

        foreach ($shopIds as $shopId) {

            $cacheId = $shopId;

            if ($cache->initCache($cacheTtl, $cacheId, $cacheDir)) {
                $shops[$shopId] = $cache->getVars();
            } else {
                $uncached[] = $shopId;
            }
        }

        if (!empty($uncached)) {

            $filter = [
                'ACTIVE'    => 'Y',
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ID'        => $uncached,
            ];

            $select = [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'SORT',
                'PROPERTY_LOCATION',
                'PROPERTY_CITY',
                'PROPERTY_CITY.NAME',
                'PROPERTY_ADDRESS',
                'PROPERTY_CONTACTS',
                'PROPERTY_EMAIL',
            ];

            $res = \CIBlockElement::GetList(
                ['PROPERTY_CITY' => 'ASC', 'SORT' => 'ASC'],
                $filter,
                false,
                false,
                $select
            );

            $taggedCache->startTagCache($cacheDir);
            $taggedCache->registerTag($cacheTag);
            $taggedCache->endTagCache();

            while ($row = $res->Fetch()) {
                $cacheId = $row['ID'];
                if ($cache->startDataCache($cacheTtl, $cacheId, $cacheDir)) {
                    $cache->endDataCache($row);
                    $shops[$row['ID']] = $row;
                }
            }
        }
        return $shops;
    }

    public static function getCityShops($cityId = null)
    {
        if (!$cityId) {
            $cityId = SPCity::getCurrentCityId();
        }

        $cache       = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();
        $cacheTtl    = 60 * 60 * 24 * 365;
        $cacheId     = $cityId;
        $cacheDir    = 'cityShops';
        $cacheTag    = 'iblock_id_' . self::IBLOCK_ID;

        $shops = [];

        if ($cache->initCache($cacheTtl, $cacheId, $cacheDir)) {

            $shops = $cache->getVars();

        } elseif ($cache->startDataCache()) {

            $ob = \CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_ID'     => self::IBLOCK_ID,
                    'PROPERTY_CITY' => $cityId,
                ],
                false,
                false,
                [
                    'ID'
                ]
            );

            while ($row = $ob->Fetch()) {
                $shops[] = $row['ID'];
            }

            $taggedCache->startTagCache($cacheDir);
            $taggedCache->registerTag($cacheTag);
            $taggedCache->endTagCache();
            $cache->endDataCache($shops);
        }

        return $shops;
    }

    public static function getCityShopByName($shopIds){
        if (!is_array($shopIds)) {
            $shopIds = [$shopIds];
        }

        $cache       = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();
        $cacheTtl    = 60 * 60 * 24 * 365;
        $cacheDir    = 'shopData';
        $cacheTag    = 'iblock_id_' . self::IBLOCK_ID;

        $shops    = [];
        $uncached = [];
        
        foreach ($shopIds as $shopId) {

            $cacheId = $shopId;

            if ($cache->initCache($cacheTtl, $cacheId, $cacheDir)) {
                $shops[$shopId] = $cache->getVars();
            } else {
                $uncached[] = $shopId;
            }
        }
        if (!empty($uncached)) {

            $filter = [
                // 'ACTIVE'    => 'Y',
                'IBLOCK_ID' => self::IBLOCK_ID,
                'NAME'        => $uncached,
            ];

            $select = [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'PROPERTY_LOCATION',
                'PROPERTY_CITY',
                'PROPERTY_CITY.NAME',
                'PROPERTY_ADDRESS',
                'PROPERTY_CONTACTS',
                'PROPERTY_EMAIL',
            ];

            $res = \CIBlockElement::GetList(
                ['PROPERTY_CITY' => 'ASC', 'SORT' => 'ASC'],
                $filter,
                false,
                false,
                $select
            );
            
            $taggedCache->startTagCache($cacheDir);
            $taggedCache->registerTag($cacheTag);
            $taggedCache->endTagCache();

            while ($row = $res->Fetch()) {

                $cacheId = $row['NAME'];

                if ($cache->startDataCache($cacheTtl, $cacheId, $cacheDir)) {
                    $cache->endDataCache($row);
                    $shops[$row['ID']] = $row;
                }
            }
        }
        return $shops;
    }

    public static function getAllShops($byCities = false)
    {
        $cityIds = array_keys(City::getAllCities());

        $allShops = [];

        foreach ($cityIds as $cityId) {
            $cityShops = self::getCityShops($cityId);

            if ($byCities) {
                $allShops[$cityId] = $cityShops;
            } else {
                $allShops  = array_merge($allShops, $cityShops);
            }
        }

        return $allShops;
    }

    public static function getShopStores(int $shopId)
    {
        if ($shopId <= 0) {
            return null;
        }

        $cache       = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();
        $cacheTtl    = 60 * 60 * 24 * 365;
        $cacheId     = $shopId;
        $cacheDir    = 'shopStores';
        $cacheTag    = 'iblock_id_' . self::IBLOCK_ID;

        $stores = [];

        if ($cache->initCache($cacheTtl, $cacheId, $cacheDir)) {

            $stores = $cache->getVars();

        } elseif ($cache->startDataCache()) {

            $raw = StoreTable::query()
                ->setFilter([
                    'ACTIVE' => 'Y',
                    'UF_SHOP' => $shopId,
                ])
                ->SetSelect(['ID'])
                ->exec();

            foreach ($raw as $row) {
                $stores[] = $row['ID'];
            }

            $taggedCache->startTagCache($cacheDir);
            $taggedCache->registerTag($cacheTag);
            $taggedCache->endTagCache();
            $cache->endDataCache($stores);
        }

        return $stores;
    }

    public static function getProductAmount($productIds, $shopIds = [])
    {
        $storeIds    = [];
        // $shopByStore - key is a store, value is a shop
        $shopByStore = [];

        if (!is_array($shopIds)) {
            $shopIds = [$shopIds];
        }

        if (empty($shopIds)) {
            $shopIds = self::getCityShops();
        }

        foreach ($shopIds as $shopId) {
            $tmpIds = self::getShopStores($shopId);

            if (!empty($tmpIds)) {
                $shopByStore += array_fill_keys($tmpIds, $shopId);
                array_push($storeIds, ...$tmpIds);
            }
        }

        $storeAmounts   = SPStore::getCityProductAmount($productIds, $storeIds);
        $productAmounts = [];

        foreach ($storeAmounts as $productId => $stores) {

            $shopAmounts = [];

            foreach ($stores as $storeId => $storeAmount) {

                $shopId = $shopByStore[$storeId];

                if (isset($shopAmounts[$shopId])) {
                    $shopAmounts[$shopId] += $storeAmount;
                } else {
                    $shopAmounts[$shopId] = $storeAmount;
                }

            }

            $productAmounts[$productId] = $shopAmounts;
        }

        return $productAmounts;
    }
}