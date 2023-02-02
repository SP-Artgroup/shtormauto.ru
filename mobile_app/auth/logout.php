<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
global $USER;
$USER->Logout();
LocalRedirect("/mobile_app/?leftupdate=1");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


