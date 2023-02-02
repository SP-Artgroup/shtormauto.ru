<?php
/** @var $arResult */
/** @global CMain $APPLICATION */

$APPLICATION->IncludeComponent(
    "wecanit:car.api.get",
    "",
    array(
        "COMPONENT_TEMPLATE" => "",
        "SEF_MODE"           => "Y",
        "SEF_FOLDER"         => "/api/car/",
        "SEF_URL_TEMPLATES"  => [],
    ),
    $component
);