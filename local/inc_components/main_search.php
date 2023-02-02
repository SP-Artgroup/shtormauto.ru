<?php

$APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "search",
    array(
        "NUM_CATEGORIES"     => "3",
        "TOP_COUNT"          => "10",
        "ORDER"              => "date",
        "USE_LANGUAGE_GUESS" => "Y",
        "CHECK_DATES"        => "Y",
        "SHOW_OTHERS"        => "N",
        "PAGE"               => "#SITE_DIR#search/index.php",
        "CATEGORY_0_TITLE"   => "Каталог",
        "CATEGORY_0" => array(
            0 => "iblock_catalog",
        ),
        "CATEGORY_0_main" => "",
        "CATEGORY_0_iblock_news" => array(
            0 => "1",
        ),
        "SHOW_INPUT" => "Y",
        "INPUT_ID" => "title-search-input",
        "CONTAINER_ID" => "title-search",
        "CATEGORY_0_iblock_catalog" => array(
            0 => "26"
        ),
        "CATEGORY_0_iblock_services" => array(
            0 => "7",
        ),
        "CATEGORY_0_iblock_shop" => array(
            0 => "12",
        ),
        "CATEGORY_1_TITLE" => "Бренды",
        "CATEGORY_1" => array(
            0 => "iblock_catalog",
        ),
        "CATEGORY_1_iblock_catalog" => array(
            0 => "14",
        ),
        "CATEGORY_2_TITLE" => "Дополнительно",
        "CATEGORY_2" => array(
            0 => "main",
            1 => "iblock_news",
            2 => "iblock_services",
            3 => "iblock_shop",
        ),
        "CATEGORY_2_main" => array(
        ),
        "CATEGORY_2_iblock_news" => array(
            0 => "1",
        ),
        "CATEGORY_2_iblock_services" => array(
            0 => "7",
        ),
        "CATEGORY_2_iblock_shop" => array(
            0 => "12",
        )
    ),
    false
);