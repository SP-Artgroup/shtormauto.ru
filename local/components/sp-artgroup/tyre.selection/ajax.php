<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
    "sp-artgroup:tyre.selection",
    "",
    ['OPER' => 'getData'],
    false
);
