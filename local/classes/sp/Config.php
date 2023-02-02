<?

/*
    \SP\Config::IBLOCK_ID_MAIN_CATALOG

    \SP\Config::get('iblock_main_catalog_id')
    \SP\Config::get('hlblock_tyre_id')
    \SP\Config::get('hlblock_wheel_id')

    \SP\Config::get('flag_dev')
    \SP\Config::isDev()
*/

namespace SP;

class Config {

    //const IBLOCK_ID_MAIN_CATALOG = 26;       // Основной каталог товаров

    //const HLBLOCK_ID_TYRE  = 2;              // Шины
    //const HLBLOCK_ID_WHEEL = 3;              // Диски

    private static $arConfig = [
        'flag_dev' => false,

        'iblock_main_catalog_id' => 26,       // Основной каталог товаров

        'hlblock_tyre_id'    => 2,            // Шины
        'hlblock_wheel_id'   => 3,            // Диски
        'hlblock_battery_id' => 5,            // Аккумуляторы
    ];

    private static $flag_init = false;

    public static function get($key=null) {
        $arConfig = &self::$arConfig;

        if (!self::$flag_init) {
            $ar = require __dir__ . '/config_local.php';

            $arConfig = array_merge($arConfig, $ar);
            self::$flag_init = true;
        }

        if (!$key) {
            return $arConfig;
        } else {
            return isset($arConfig[ $key ]) ? $arConfig[ $key ] : null;
        }
    } // function

    public static function isDev() {
        return self::get('flag_dev');
    } // function

} // class

/*

######################################################################################
##### HLBLOCK_ID_TYRE = 2 ### tyre ### Шины

VENDOR
MODEL
YEAR
MODIFICATION

DIAMETER
WIDTH
PROFILE

######################################################################################
##### HLBLOCK_ID_TYRE = 3 ### wheel ### Диски

VENDOR
MODEL
YEAR
MODIFICATION

DIAMETER
WIDTH
ET
LZ
PCD

######################################################################################
##### IBLOCK_ID_MAIN_CATALOG = 26 ### main_catalog ### Основной каталог товаров

DIAMETR                     Диаметр шины/диска
SHIRINA                     Ширина легковой шины
PROFIL                      Профиль легковой шины

SHIRINA_LEGKOVOGO_DISKA     Ширина легкового диска
VYLET_LEGKOVOGO_DISKA_ET    Вылет легкового диска (ET)
PCD                         Крепеж (PCD) легкового диска

######################################################################################

*/