<?php

$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "left-catalog",
    array(
        "ROOT_MENU_TYPE"        => "catalog",
        "MENU_CACHE_TYPE"       => "N",
        "MENU_CACHE_TIME"       => "3600",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS"   => array(),
        "MAX_LEVEL"             => "2",
        "CHILD_MENU_TYPE"       => "catalog",
        "USE_EXT"               => "Y",
        "DELAY"                 => "N",
        "ALLOW_MULTI_SELECT"    => "N",
        "COMPONENT_TEMPLATE"    => "left-catalog"
    ),
    false
);