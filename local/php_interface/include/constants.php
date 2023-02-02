<?php

use Bex\Tools\Iblock\IblockTools;

// IBLOCK IDS

/*
$constConfig = [
    0 => 'constName',
    1 => 'iblockType',
    2 => 'iblockCode',
];
*/
$constConfig = [
    ['IBLOCK_ID_CATALOG', 'catalog', 'main_catalog'],
    ['IBLOCK_BANER_MAIN_MOBILE', 'services', 'banner_main_mobile'],
    ['IBLOCK_BANER_MAIN_PRODUCT', 'catalog', 'main_categories'],

    ['IBLOCK_ID__TRUCK_CATALOG', 'catalog', 'truck_catalog'],
    ['IBLOCK_ID__TRUCK_MAIN_SLIDER', 'services', 'truck_slider'],
    ['IBLOCK_ID__TRUCK_SUPPLIERS', 'services', 'truck_suppliers'],
    ['IBLOCK_ID__TRUCK_CATALOG_BANNERS', 'services', 'truck_catalog_banners'],
    ['IBLOCK_ID__TRUCK_FORM_ASK_QUESTION', 'forms', 'truck_ask_question'],
    ['IBLOCK_ID__TRUCK_FORM_ENROLL_SERVICE', 'forms', 'truck_enroll_service'],
    ['IBLOCK_ID__TRUCK_FORM_REQUEST', 'forms', 'truck_request'],
];

foreach ($constConfig as $const) {

    $ib = null;

    try {
        $ib = IblockTools::find($const[1], $const[2]);
    } catch (Exception $e) {}

    if ($ib) {
        define($const[0], $ib->id());
    }
}

define("HLBLOCK_SECTIONS_DISCOUNTS", 8);