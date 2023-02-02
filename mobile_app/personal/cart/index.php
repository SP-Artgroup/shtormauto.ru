<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'mobile:mobileapp.personal_cart',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Корзина"});
    //app.setPageTitle({"title": "Корзина"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>

