<?php

$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "auth_header_line",
    Array(
        "COMPONENT_TEMPLATE"  => ".default",
        "REGISTER_URL"        => "",
        "FORGOT_PASSWORD_URL" => "",
        "PROFILE_URL"         => "",
        "SHOW_ERRORS"         => "Y"
    )
);