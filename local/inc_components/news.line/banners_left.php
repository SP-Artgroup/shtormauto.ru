<?php

$APPLICATION->IncludeComponent(
    "bitrix:news.line",
    "banners-left",
    array(
        "IBLOCK_TYPE" => "services",
        "IBLOCKS" => array(
            0 => "8",
        ),
        "NEWS_COUNT" => "2",
        "FIELD_CODE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "",
        ),
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "DETAIL_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "300",
        "CACHE_GROUPS" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y"
    ),
    false,
    array("ACTIVE_COMPONENT" => "N")
);