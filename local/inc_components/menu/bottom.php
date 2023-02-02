<?php

$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "bottom",
    Array(
        "ROOT_MENU_TYPE"        => "footer",
        "MENU_CACHE_TYPE"       => "A",
        "MENU_CACHE_TIME"       => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS"   => "",
        "MAX_LEVEL"             => "1",
        "CHILD_MENU_TYPE"       => "left",
        "USE_EXT"               => "N",
        "DELAY"                 => "N",
        "ALLOW_MULTI_SELECT"    => "N",
    )
);