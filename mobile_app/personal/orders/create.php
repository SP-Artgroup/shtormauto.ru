<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'mobile:mobileapp.order_new',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Оформить заказ"});
    //app.setPageTitle({"title": "Оформить заказ"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>

