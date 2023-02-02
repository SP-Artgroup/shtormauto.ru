<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Подбор шин"});
    //app.setPageTitle({"title": "Подбор шин"});
</script>
<?
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.wheels',
    ''
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


