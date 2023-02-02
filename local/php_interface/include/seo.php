<?php

// СЕО ТЕГИ
AddEventHandler('main', 'OnBeforeEndBufferContent', 'SeoManager');
AddEventHandler('main', 'OnPageStart', 'SeoManagerText');

function SeoManager()
{
    if (CModule::IncludeModule('iblock')) {

        $url = urldecode($_SERVER['REQUEST_URI']);

        if (!isset($_GET['FILTER'])) {
            $url = preg_replace('/\?.*/', '', $url);
        }

        $CONFIG = [
            'IBLOCK_ID' => '29',
            'NAME'      => $url,
        ];

        global $APPLICATION;

        $page = CIBlockElement::GetList([], $CONFIG, false, false, ['PROPERTY_H1', 'PROPERTY_TITLE', 'PROPERTY_DESCRIPTION', 'PROPERTY_KEYWORDS'])->GetNext();

        if ($page) {

            // if (!empty($page['PROPERTY_H1_VALUE'])) {
            //     $APPLICATION->SetTitle($page['PROPERTY_H1_VALUE']);
            // }

            if (!empty($page['PROPERTY_TITLE_VALUE'])) {
                $APPLICATION->SetPageProperty('title', $page['PROPERTY_TITLE_VALUE']);
            }

            if (!empty($page['PROPERTY_KEYWORDS_VALUE'])) {
                $APPLICATION->SetPageProperty('keywords', $page['PROPERTY_KEYWORDS_VALUE']['TEXT']);
            }

            if (!empty($page['PROPERTY_DESCRIPTION_VALUE'])) {
                $APPLICATION->SetPageProperty('description', $page['PROPERTY_DESCRIPTION_VALUE']['TEXT']);
            }
        }
    }
}

function SeoManagerText()
{
    if (CModule::IncludeModule('iblock')) {

        $url = urldecode($_SERVER['REQUEST_URI']);

        if (!isset($_GET['FILTER'])) {
            $url = preg_replace('/\?.*/', '', $url);
        }

        $CONFIG = [
            'IBLOCK_ID' => '29',
            'NAME'      => $url,
        ];

        $page = CIBlockElement::GetList([], $CONFIG, false, false, ['PROPERTY_TEXT', 'PROPERTY_H1'])->GetNext();

        if ($page) {

            global $APPLICATION;

            if (isset($page['PROPERTY_TEXT_VALUE']) && !empty($page['~PROPERTY_TEXT_VALUE']['TEXT'])) {
                $APPLICATION->SetPageProperty('additional_text', $page['~PROPERTY_TEXT_VALUE']['TEXT']);
            }

            if (!empty($page['PROPERTY_H1_VALUE'])) {
                $APPLICATION->SetPageProperty('page_header', $page['PROPERTY_H1_VALUE']);
            }
        }
    }
}
