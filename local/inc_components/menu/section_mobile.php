<?php

$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "section-menu-mobile",
    Array(
        "ROOT_MENU_TYPE"        => "catalog",
        "MENU_CACHE_TYPE"       => "N",
        "MENU_CACHE_TYPE"       => "A",
        "MENU_CACHE_TIME"       => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS"   => "",
        "MAX_LEVEL"             => "2",
        "CHILD_MENU_TYPE"       => "catalog",
        "USE_EXT"               => "Y",
        "DELAY"                 => "N",
        "ALLOW_MULTI_SELECT"    => "N",
        "COMPONENT_TEMPLATE"    => "horizontal_multilevel",
        "MENU_THEME"            => "site"
    ),
    false
);