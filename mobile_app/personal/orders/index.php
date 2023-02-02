<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'mobile:mobileapp.personal.orders',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Мои заказы"});
    //app.setPageTitle({"title": "Мои заказы"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>

