<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.auth.login',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Авторизация"});
    //app.setPageTitle({"title": "Авторизация"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


