<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($arParams['SET_META'] === 'Y') {

    $meta = $arResult['SECTION']['IPROPERTY_VALUES'];

    $APPLICATION->setTitle($meta['SECTION_PAGE_TITLE']);
    $APPLICATION->setPageProperty('title', $meta['SECTION_META_TITLE']);
    $APPLICATION->setPageProperty('description', $meta['SECTION_META_DESCRIPTION']);
    $APPLICATION->setPageProperty('keywords', $meta['SECTION_META_KEYWORDS']);
}
