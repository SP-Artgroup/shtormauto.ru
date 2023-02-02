<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
//var_dump($_SESSION); exit;
?>
<!--script>
    BXMobileApp.UI.Page.TopBar.title.setImage("/mobile_app/images/logo.png");
</script-->
<?
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.auth.login',
    ''
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


