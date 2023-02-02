<?

use Bitrix\Main\Loader;
use Bitrix\Catalog\StoreProductTable;
use SP\City as SPCity;
use SP\Store as SPStore;

Loader::includeModule('catalog');

class Shtormauto {

    public static $current_city = [];
    private static $_Instance;
    private static $arResult;

    public static function getInstance()
    {

        if (!self::$_Instance) {
            self::$_Instance = new self();
        }

        return self::$_Instance;
    }

    public function getCityPrice($cityId = null)
    {
        if ($cityId === null) {

            $city = SPCity::getCurrentCityData();

            if (empty(self::$arResult['current_price'])) {
                $price = CCatalogGroup::GetByID($city['PROPERTY_PRICE_ID_VALUE']);
                self::$arResult['current_price'] = $price;
            } else {
                $price = self::$arResult['current_price'];
            }

        } else {
            $city = SPCity::getCityData($cityId);
            $price = CCatalogGroup::GetByID($city['PROPERTY_PRICE_ID_VALUE']);
        }

        return !empty($price) ? $price : 0;
    }

    function getCurrentCityPrice()
    {
        return self::getCityPrice();
    }

    function getCurrentCityPriceName()
    {
        $price = $this->getCurrentCityPrice();

        if(!empty($price['NAME']))
            return $price['NAME'];
        else
            return 0;
    }

    public function getCityPriceId($cityId = null)
    {
        $price  = $this->getCityPrice($cityId);

        return !empty($price['ID']) ? $price['ID'] : 0;
    }

    public function getCurrentCityPriceId()
    {
        return self::getCityPriceId();
    }

    /**
     * @deprecated use SP\Store::getCityStore($cityId)
     */
    public function getCityStore($cityId = null)
    {
        return SPStore::getCityStore($cityId);
    }

    function getCurrentCityStore()
    {
        return SPStore::getCityStore();
    }

    function getCurrentCityId()
    {
        $city = SPCity::getCurrentCityId();

        return $city ?: 0;
    }

    /**
     * @deprecated use SP\City:getCurrentCityData()
     */
    function getCurrentCityArray()
    {
        return SPCity::getCurrentCityData();
    }

    /**
     * @deprecated use SP\City:getAllCities()
     */
    function getCityList()
    {
        return SPCity::getAllCities();
    }
}