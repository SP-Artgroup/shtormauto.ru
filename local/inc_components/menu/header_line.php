<?php

$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "shtorm",
    array(
        "ROOT_MENU_TYPE" => "top",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "left",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "COMPONENT_TEMPLATE" => "shtorm",
        "CACHE_SELECTED_ITEMS" => "N",
        "MENU_CACHE_USE_USERS" => "N"
    ),
    false
);