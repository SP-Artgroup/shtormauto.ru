<?

namespace SP;

use Bitrix\Main\Loader;
use Bitrix\Main\Data\Cache;
use Bitrix\Iblock\ElementTable;
use Local\CompositeCacheProvider;

Loader::includeModule('iblock');
Loader::includeModule('statistic');

class City {

    public static $current_city = [];
    public static $currentCityId = 0;
    public static $cityIblockId = 15;

    public static function getSessionCityId()
    {
        global $APPLICATION;
        $cityId = $APPLICATION->get_cookie('S_CITY_ID');
        if($_SESSION['CURRENT_CITY_ID']){
            $_SESSION['CURRENT_CITY_ID'] = $_SESSION['CURRENT_CITY_ID'];
        }
        elseif(!$_SESSION['CURRENT_CITY_ID'] && $cityId != ''){
            $_SESSION['CURRENT_CITY_ID'] = $cityId;
        }
        else{
            $_SESSION['CURRENT_CITY_ID'] = null;
        }
        return $_SESSION['CURRENT_CITY_ID'];
    }

    public static function setSessionCityId($cityId)
    {
        global $APPLICATION;
        $APPLICATION->set_cookie('S_CITY_ID', $cityId);
        return $_SESSION['CURRENT_CITY_ID'] = $cityId;
    }

    public static function checkCityOnLoad()
    {
        global $APPLICATION;

        if (isset($_GET['chcity'])) {
            self::$currentCityId = self::setSessionCityId($_GET['chcity']);
            self::cityConfirm(true);

//            CompositeCacheProvider::setCookie(self::$currentCityId);

            LocalRedirect($APPLICATION->GetCurPageParam('', ['chcity']));
        }

        if (!self::cityConfirm() || !self::getSessionCityId()) {
            $currentCityId = self::getCurrentCityId();
            self::$currentCityId = self::setSessionCityId($currentCityId);
        } else {
            self::$currentCityId = self::getSessionCityId();
        }

       // CompositeCacheProvider::setCookie(self::$currentCityId);
    }

    public static function getAllCities()
    {
        $allCities = [];

        $cache = Cache::createInstance();
        $cacheTime = 60 * 60 * 24 * 365;
        $cacheId = $cacheDir = 'all_cities';

        if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
            $allCities = $cache->getVars();
        } elseif ($cache->startDataCache()) {

            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cacheDir);
            $CACHE_MANAGER->RegisterTag('iblock_id_' . self::$cityIblockId);
            $CACHE_MANAGER->EndTagCache();

            $select = [
                'ID',
                'NAME',
                'CODE',
                'PROPERTY_PHONES',
                'PROPERTY_CATALOG',
                // 'PROPERTY_DEFAULT',
                'PROPERTY_PRICE_NAME',
                'PROPERTY_PRICE_ID',
                'PROPERTY_STORE_ID',
                // 'PROPERTY_ADDRESSES',
                'PROPERTY_USE_IN_GEO',
                'PROPERTY_SERIAL_NUMBER_PHONE'
            ];

            $query = \CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_ID' => self::$cityIblockId,
                    'ACTIVE'    => 'Y',
                ],
                false,
                false,
                $select
            );

            while ($row = $query->Fetch()) {
                $allCities[$row['ID']] = $row;
            }

            $cache->endDataCache($allCities);
        }

        return $allCities;
    }

    public static function getCityData($cityId)
    {
        $allCities = self::getAllCities();

        return isset($allCities[$cityId]) ? $allCities[$cityId] : null;
    }

    public static function getCurrentCityData()
    {
        return self::getCityData(self::getCurrentCityId());
    }

    public static function getCurrentCityId()
    {
        $cityId = null;

        if (!empty(self::$currentCityId)) {
            $cityId = self::$currentCityId;
        } elseif (!empty($sessCityId = self::getSessionCityId())) {
            $cityId = $sessCityId;
        } else {
            $defaultCode = 'Blagoveshchensk';

            //$cityInfo = (new \CCity())->GetFullInfo();
            $cityCode = $cityInfo['CITY_NAME']['VALUE'];

            if (!$cityId = self::matchCityByCode($cityCode))
                $cityId = self::matchCityByCode($defaultCode);
        }

        return $cityId;
    }

    public static function getCurrentCityName()
    {
        $city = self::getCurrentCityData();

        return $city['NAME'];
    }

    public static function matchCityByCode($code)
    {
        return ElementTable::query()
            ->setFilter([
                'IBLOCK_ID' => self::$cityIblockId,
                'ACTIVE'    => 'Y',
                'CODE'      => $code,
            ])
            ->setSelect(['ID'])
            ->setLimit(1)
            ->exec()
            ->fetch()['ID'];
    }

    // public static function SetCity($cityId)
    // {
    //     $city               = self::GetCityByID($cityId);
    //     $_SESSION['CITY']   = $city;

    //     setcookie("geo_ip_city", $city["NAME"], time()+86400*10,"/");
    // }

    public static function cityConfirm($confirm = '')
    {
        return true;

        if (!isset($_SESSION['CITY_CONFIRM']))
            $_SESSION['CITY_CONFIRM'] = false;

        if ($confirm !== '')
        {
            $_SESSION['CITY_CONFIRM'] = $confirm;
        }

        return $_SESSION['CITY_CONFIRM'];
    }

    // function GetCityByID($city_id)
    // {
    //     if(!empty($city_id))
    //     {
    //         $arSelect   = Array("ID", "NAME", "CODE", "PROPERTY_PRICE_NAME", "PROPERTY_PRICE_ID", "PROPERTY_STORE_ID");
    //         $arFilter   = array('IBLOCK_ID' => 15, 'ID' => $city_id, "ACTIVE" => "Y");
    //         $res        = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>1), $arSelect);
    //         while($ob = $res->GetNextElement())
    //         {
    //             $arCity     = $ob->GetFields();

    //             return $arCity;
    //         }
    //     }

    //     return 0;
    // }

    // public static function GetCityByCode($city_code)
    // {
    //     if(!empty($city_code))
    //     {
    //         $arSelect   = Array("ID", "NAME", "CODE", "PROPERTY_PRICE_NAME", "PROPERTY_PRICE_ID", "PROPERTY_STORE_ID");
    //         $arFilter   = array('IBLOCK_ID' => 15, 'CODE' => $city_code, "ACTIVE" => "Y");
    //         $res        = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>1), $arSelect);
    //         while($ob = $res->GetNextElement())
    //         {
    //             $arCity     = $ob->GetFields();

    //             return $arCity;
    //         }
    //     }

    //     return 0;
    // }


    // public static function GetCityByName($city_name)
    // {
    //     if(!empty($city_name))
    //     {

    //         $arSelect   = Array("ID", "NAME", "CODE", "PROPERTY_PRICE_NAME", "PROPERTY_PRICE_ID", "PROPERTY_STORE_ID");
    //         $arFilter   = array('IBLOCK_ID' => 15, 'NAME' => $city_name, "ACTIVE" => "Y");
    //         $res        = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>1), $arSelect);
    //         while($ob = $res->GetNextElement())
    //         {
    //             $arCity     = $ob->GetFields();

    //             return $arCity;
    //         }
    //     }

    //     return 0;
    // }

    // function GetCurrentCityName()
    // {
    //     $city   = self::GetCurrentCityArray();

    //     return $city['NAME'];
    // }
}