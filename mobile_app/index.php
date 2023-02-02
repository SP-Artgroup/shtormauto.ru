<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"image", content: "/mobile_app/images/logo.png"});
</script>

<?
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.main',
    ''
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


