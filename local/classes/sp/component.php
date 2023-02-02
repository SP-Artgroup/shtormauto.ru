<?php

namespace SP;

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\Model\Section;

/**
*
*/
class Component
{
    private static $compDir = '/local/inc_components/';

    public static function include(string $path)
    {
        global $APPLICATION;

        $app = Application::getInstance();

        include $app->getDocumentRoot() . self::$compDir . $path . '.php';
    }

    public static function getAvailableProductsFilter()
    {
        $shtormauto = \Shtormauto::getInstance();

        $priceId    = $shtormauto->getCurrentCityPriceId();

        $shops = Shop::getCityShops();

        $storeIds = [];

        foreach ($shops as $shopId) {
            if ($shopStores = Shop::getShopStores($shopId)) {
                array_push($storeIds, ...$shopStores);
            }
        }

        $storeFilter = [
            'LOGIC' => 'OR',
        ];

        foreach ($storeIds as $storeId) {
            $storeFilter[] = [
                '>CATALOG_STORE_AMOUNT_' . $storeId => 0,
            ];
        }

        $filter = [
            '>CATALOG_PRICE_' . $priceId => 0,
            $storeFilter,
        ];

        return $filter;
    }

    public static function getFilterSectionImage(int $sectionId)
    {
        Loader::includeModule('iblock');

        $filterImage = false;

        $curSectionData = SectionTable::query()
            ->setFilter([
                'IBLOCK_ID'     => IBLOCK_ID_CATALOG,
                'ID'            => $sectionId,
                'ACTIVE'        => 'Y',
                'GLOBAL_ACTIVE' => 'Y',
            ])
            ->setSelect(['LEFT_MARGIN', 'RIGHT_MARGIN'])
            ->setLimit(1)
            ->exec()
            ->fetch();

        $sectionEntity = Section::compileEntityByIblock(IBLOCK_ID_CATALOG);

        $imageId = $sectionEntity::query()
            ->setOrder(['LEFT_MARGIN' => 'DESC'])
            ->setFilter([
                'IBLOCK_ID'        => IBLOCK_ID_CATALOG,
                'ACTIVE'           => 'Y',
                'GLOBAL_ACTIVE'    => 'Y',
                '<=LEFT_MARGIN'    => $curSectionData['LEFT_MARGIN'],
                '>=RIGHT_MARGIN'   => $curSectionData['RIGHT_MARGIN'],
                '!UF_FILTER_IMAGE' => false,
            ])
            ->setSelect(['ID', 'NAME', 'UF_FILTER_IMAGE'])
            ->exec()
            ->fetch()['UF_FILTER_IMAGE'];

        if ($imageId) {

            $resize = \CFile::resizeImageGet(
                $imageId,
                [
                    'width'  => 350,
                    'height' => 500,
                ],
                BX_RESIZE_IMAGE_PROPORTIONAL
            );

            $filterImage = $resize
                ? $resize['src']
                : \CFile::getPath($imageId);
        }

        return $filterImage;
    }
}