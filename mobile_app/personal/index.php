<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Личный кабинет"});
    //app.setPageTitle({"title": "Личный кабинет"});
</script>
<?
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.personal',
    ''
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


