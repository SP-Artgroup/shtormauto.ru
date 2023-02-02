<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use SP\City;

/**
*
*/
class CityList extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult = [
            'CITIES'  => array_filter(City::getAllCities(), function ($city) {
                return $city['PROPERTY_USE_IN_GEO_VALUE'] === 'Y';
            }),
            'CURRENT' => City::getCurrentCityData(),
        ];

        $this->includeComponentTemplate();
    }
}