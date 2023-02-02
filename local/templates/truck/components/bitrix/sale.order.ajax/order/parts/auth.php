<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
<div class="order-auth">

    <?php

    $APPLICATION->IncludeComponent(
        'bitrix:system.auth.authorize',
        '',
        [
            'COMPONENT_TEMPLATE'   => '.default',
            'REGISTER_URL'         => '',
            'PROFILE_URL'          => '',
            'SHOW_ERRORS'          => 'Y',
            'AUTH_RESULT'          => $APPLICATION->arAuthResult,
            'COMPOSITE_FRAME_MODE' => 'A',
            'COMPOSITE_FRAME_TYPE' => 'AUTO',
        ]
    );

    $APPLICATION->IncludeComponent(
        'bitrix:main.register',
        'register',
        [
            'AUTH'               => 'Y',
            'COMPONENT_TEMPLATE' => 'register',
            'REQUIRED_FIELDS'    => [
                'EMAIL',
                'NAME',
                'PERSONAL_PHONE',
            ],
            'SET_TITLE'          => 'N',
            'SHOW_FIELDS'        => [
                'EMAIL',
                'NAME',
                'PERSONAL_PHONE',
                'LOGIN',
            ],
            'SUCCESS_PAGE'       => '',
            'USER_PROPERTY'      => [],
            'USER_PROPERTY_NAME' => '',
            'USE_BACKURL'        => 'Y',
        ]
    );

    ?>

</div>