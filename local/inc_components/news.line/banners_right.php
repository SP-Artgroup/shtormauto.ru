<?php

$APPLICATION->IncludeComponent(
    "bitrix:news.line",
    "banners-left",
    array(
        "IBLOCK_TYPE" => "services",
        "IBLOCKS"     => array(
            0 => "28",
        ),
        "NEWS_COUNT" => "1",
        "FIELD_CODE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "PROPERTY_LINK",
        ),
        "SORT_BY1"           => "SORT",
        "SORT_ORDER1"        => "ASC",
        "SORT_BY2"           => "SORT",
        "SORT_ORDER2"        => "ASC",
        "DETAIL_URL"         => "",
        "CACHE_TYPE"         => "A",
        "CACHE_TIME"         => "300",
        "CACHE_GROUPS"       => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y"
    )
);
