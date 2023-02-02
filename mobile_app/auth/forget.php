<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.auth.forget',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Забыли пароль?"});
    //app.setPageTitle({"title": "Забыли пароль?"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


