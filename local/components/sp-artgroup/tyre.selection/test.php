<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// http://local-shtormauto.ru/local/components/sp-artgroup/tyre.selection/test.php

if (1) {

    if (!$USER->IsAdmin()) {
        echo 'Недостаточно прав';
        exit;
    } //
    
    $APPLICATION->IncludeComponent(
        'sp-artgroup:tyre.selection',
        '',
        [
            'flagTest' => true,
        ]
    );

    return;
} //

require __dir__ .'/class.php';

if (1) {
    $arLists = TyreSelection::get_arLists(true);
    SP_Log::consoleLog( $arLists );

    //print_r( $arLists['PCD'][5]['114.3'] );
}

if (0) {
    $arFields = [
        'VENDOR'       => 'Toyota',
        'MODEL'        => 'Chaser',
        'YEAR'         => '1989',
    ];
    $res = TyreSelection::getData($arFields);
    SP_Log::consoleLog( $res );
}

if (0) {
    $res = $APPLICATION->IncludeComponent(
        "sp-artgroup:tyre.selection",
        "",
        ['OPER' => 'getFilter'],
        false
    );
    SP_Log::consoleLog( $res );
}

if (1) {
    $arFields = [
        'VENDOR'       => 'Toyota',
        'MODEL'        => 'Chaser',
        'YEAR'         => '1989',
        'MODIFICATION' => '2.0i Turbo (GX81) IV (X80)',
    ];

    $res = TyreSelection::getFilter(['arFields'=>$arFields, 'tyreOrWheel' => 'tyre']);
    SP_Log::consoleLog( $res );

    $res = TyreSelection::getFilter(['arFields'=>$arFields, 'tyreOrWheel' => 'wheel']);
    SP_Log::consoleLog( $res );
}