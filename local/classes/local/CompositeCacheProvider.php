<?php

namespace Local;

use Bitrix\Main\Context;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Composite\Data\CacheProvider as BaseCacheProvider;
use SP\City;

/**
 *
 */
class CompositeCacheProvider extends BaseCacheProvider
{
    public static function getCachekey($cityId = null)
    {
        if (!$cityId) {
            $cityId = City::getCurrentCityId();
        }

        return 'page_city_' . $cityId;
    }

    /**
     * EventHandler main:OnGetStaticCacheProvider
     * @return CacheProvider
     */
    public static function getSelf()
    {
        return new self;
    }

    public static function setCookie($cityId = null)
    {
        $cookie = new Cookie('BITRIX_SM_PK', self::getCachekey($cityId));
        Context::getCurrent()->getResponse()->addCookie($cookie);
    }

    public function isCacheable() {
        return true;
    }

    public function setUserPrivateKey() {}

    // Определяется имя композитной страницы
    // а читается оно из куки BITRIX_SM_PK
    public function getCachePrivateKey() {
        return self::getCachekey();
    }

    public function onBeforeEndBufferContent() {}
}
