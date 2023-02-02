<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.auth.signin',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Регистрация"});
    //app.setPageTitle({"title": "Регистрация"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


