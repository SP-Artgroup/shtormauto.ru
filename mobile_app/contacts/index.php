<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Контакты"});
    //app.setPageTitle({"title": "Контакты"});
</script>
<?
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.contacts',
    ''
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


