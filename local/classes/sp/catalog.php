<?

namespace SP;

use Bitrix\Catalog\PriceTable;
use Bitrix\Catalog\StoreProductTable;
use Bitrix\Iblock\SectionTable;
use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');
Loader::includeModule('catalog');

/**
 *
 */
class Catalog
{
    const IBLOCK_ID = 26;

    private static $sections = [];

    public static function getAvailableSections($sectionIds, $cityId, $debug = false)
    {
        $hash = serialize($sectionIds) . $cityId;

        if (!empty(self::$sections[$hash])) {
            return self::$sections[$hash];
        }

        $shtormauto = \Shtormauto::getInstance();

        $priceTypeId = $shtormauto->getCityPriceId($cityId);
        $storeIds    = $shtormauto->getCityStore($cityId);

        if (
            is_array($sectionIds[0])
            && !empty($sectionIds[0]['LEFT_MARGIN'])
            && !empty($sectionIds[0]['RIGHT_MARGIN'])
        ) {
            $sections = $sectionIds;
        } else {
            $sections = SectionTable::query()
                ->setFilter([
                    'IBLOCK_ID' => self::IBLOCK_ID,
                    'ID'        => $sectionIds,
                ])
                ->setSelect(['ID', 'LEFT_MARGIN', 'RIGHT_MARGIN'])
                ->setLimit(count($sectionIds))
                ->exec()
                ->fetchAll();
        }

        $baseQuery = PriceTable::query()
            ->registerRuntimeField('STORE', [
                'data_type' => StoreProductTable,
                'reference' => ['this.PRODUCT_ID' => 'ref.PRODUCT_ID'],
            ])
            ->setFilter([
                '>PRICE'            => 0,
                'CATALOG_GROUP_ID'  => $priceTypeId,
                'ELEMENT.IBLOCK_ID' => self::IBLOCK_ID,
                'ELEMENT.ACTIVE'    => 'Y',
                '>PRODUCT.QUANTITY' => 0,
                'PRODUCT.AVAILABLE' => 'Y',
                'STORE.STORE_ID'    => $storeIds,
                '>STORE.AMOUNT'     => 0,
            ])
            ->setSelect(['ELEMENT.ID', 'PARENT_SECTION_ID'])
            ->setLimit(1);

        $unions = [];

        foreach ($sections as $section) {

            $newQuery = clone $baseQuery;

            $unions[] = $newQuery
                ->registerRuntimeField('PARENT_SECTION_ID', [
                    'data_type'  => 'integer',
                    'expression' => [$section['ID']],
                ])
                ->addFilter('>=ELEMENT.IBLOCK_SECTION.LEFT_MARGIN', $section['LEFT_MARGIN'])
                ->addFilter('<=ELEMENT.IBLOCK_SECTION.RIGHT_MARGIN', $section['RIGHT_MARGIN']);
        }

        $mainQuery = array_pop($unions);

        call_user_func_array([$mainQuery, 'union'], $unions);

        if ($debug) {
            return $mainQuery->getQuery();
        }

        $data = $mainQuery->exec();

        $newSectionIds = [];

        foreach ($data as $row) {
            $newSectionIds[] = $row['PARENT_SECTION_ID'];
        }

        return self::$sections[$hash] = $newSectionIds;
    }

    public static function getTireSectionsCodes()
    {
        $cache       = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();
        $cacheTtl    = 60 * 60 * 24 * 365;
        $cacheId     = 'tireSections';
        $cacheDir    = $cacheId;

        $codes = [];

        if ($cache->initCache($cacheTtl, $cacheId, $cacheDir)) {

            $codes = $cache->getVars();

        } elseif ($cache->startDataCache()) {

            $tireSection = SectionTable::query()
                ->setFilter([
                    'IBLOCK_ID'     => self::IBLOCK_ID,
                    'ACTIVE'        => 'Y',
                    'GLOBAL_ACTIVE' => 'Y',
                    'DEPTH_LEVEL'   => 1,
                    'CODE'          => 'shiny',
                ])
                ->setSelect(['LEFT_MARGIN', 'RIGHT_MARGIN'])
                ->setLimit(1)
                ->exec()
                ->fetch();

            $rows = SectionTable::query()
                ->setFilter([
                    'IBLOCK_ID'     => self::IBLOCK_ID,
                    'ACTIVE'        => 'Y',
                    'GLOBAL_ACTIVE' => 'Y',
                    '>DEPTH_LEVEL'  => 1,
                    '>LEFT_MARGIN'  => $tireSection['LEFT_MARGIN'],
                    '<RIGHT_MARGIN' => $tireSection['RIGHT_MARGIN'],
                ])
                ->setSelect(['CODE'])
                ->exec();

            foreach ($rows as $row) {
                $codes[] = $row['CODE'];
            }

            $taggedCache->startTagCache($cacheDir);
            $taggedCache->registerTag('iblock_id_' . self::IBLOCK_ID);
            $taggedCache->endTagCache();

            $cache->endDataCache($codes);
        }

        return $codes;
    }

    public function testNewGetAvailSect($sectionIds, $cityId)
    {
        $shtormauto = \Shtormauto::getInstance();

        $priceTypeId = $shtormauto->getCityPriceId($cityId);
        $storeIds    = $shtormauto->getCityStore($cityId);

        if (
            is_array($sectionIds[0])
            && !empty($sectionIds[0]['LEFT_MARGIN'])
            && !empty($sectionIds[0]['RIGHT_MARGIN'])
        ) {
            $sections = $sectionIds;
        } else {
            $sections = SectionTable::query()
                ->setFilter([
                    'IBLOCK_ID' => self::IBLOCK_ID,
                    'ID'        => $sectionIds,
                ])
                ->setSelect(['ID', 'LEFT_MARGIN', 'RIGHT_MARGIN'])
                ->setLimit(count($sectionIds))
                ->exec()
                ->fetchAll();
        }

        $result = PriceTable::query()
            ->registerRuntimeField('STORE', [
                'data_type' => StoreProductTable,
                'reference' => ['this.PRODUCT_ID' => 'ref.PRODUCT_ID'],
            ])
            ->registerRuntimeField('cnt', [
                'data_type' => 'integer',
                'expression' => ['count(%s)', 'ELEMENT.ID'],
            ])
            ->setFilter([
                '>PRICE'            => 0,
                'CATALOG_GROUP_ID'  => $priceTypeId,
                'ELEMENT.IBLOCK_ID' => self::IBLOCK_ID,
                'ELEMENT.ACTIVE'    => 'Y',
                '>PRODUCT.QUANTITY' => 0,
                'PRODUCT.AVAILABLE' => 'Y',
                'STORE.STORE_ID'    => $storeIds,
                '>STORE.AMOUNT'     => 0,
            ])
            ->setGroup(['ELEMENT.IBLOCK_SECTION_ID'])
            ->setSelect(['ELEMENT.IBLOCK_SECTION_ID', 'cnt'])
            ->exec()
            ->fetchAll();

        echo '<pre>'; print_r($result); echo '</pre>';
    }
}
