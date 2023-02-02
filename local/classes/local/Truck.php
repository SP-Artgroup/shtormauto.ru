<?php

namespace Local;

class Truck
{
    public function showPageHeaderBackground()
    {
        global $APPLICATION;

        $APPLICATION->AddBufferContent(function () use ($APPLICATION) {
            return $APPLICATION->getProperty('PAGE_HEADER_BG')
                ?: SITE_TEMPLATE_PATH . '/img/catalog-screen.jpg';
        });
    }

    public function showUiClass()
    {
        global $APPLICATION;

        $APPLICATION->AddBufferContent(function () use ($APPLICATION) {
            return $APPLICATION->getProperty('is_user_area') === 'Y'
                ? 'user-area'
                : '';
        });
    }
}