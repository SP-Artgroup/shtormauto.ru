<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Новости и акции"});
    //app.setPageTitle({"title": "Новости и акции"});
</script>
<?
$arParams = array(
    "ITEM_ID" => isset($_GET["ITEM_ID"]) ? intval($_GET["ITEM_ID"]) : false
);
$APPLICATION->IncludeComponent('mobile:mobileapp.news.list', '', $arParams);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>