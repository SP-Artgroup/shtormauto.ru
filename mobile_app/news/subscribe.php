<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Подписаться на новости"});
    //app.setPageTitle({"title": "Подписаться на новости"});
</script>
<?
$APPLICATION->IncludeComponent('mobile:mobileapp.subscribe', '', array());

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>