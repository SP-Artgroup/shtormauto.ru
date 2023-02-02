<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
/** @global CMain $APPLICATION */
$APPLICATION->IncludeComponent(
    "wecanit:car.api.get",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "SEF_MODE"           => "Y",
        "SEF_FOLDER"         => "/api",
    ),
    false
);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");