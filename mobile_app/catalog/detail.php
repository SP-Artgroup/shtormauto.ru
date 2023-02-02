<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$arParams = array(
    "ID" => isset($_GET["ID"]) ? intval($_GET["ID"]) : false
);
$APPLICATION->IncludeComponent('mobile:mobileapp.catalog_detail', '', $arParams);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


