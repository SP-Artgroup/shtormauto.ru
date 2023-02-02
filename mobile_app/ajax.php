<?php
header("Content-Type: application/x-javascript");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/mobile/parts/class_include.php");

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : false;
if($action) {
    $result = CAjaxHelper::$action();
    CJsonHelper::sendAjax($result);
}
?>