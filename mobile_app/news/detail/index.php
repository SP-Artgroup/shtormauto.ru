<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Новости и акции"});
    //app.setPageTitle({"title": "Новости и акции"});
</script>
<?
$arParams = array(
    "ELEMENT_ID" => isset($_GET["ELEMENT_ID"]) ? intval($_GET["ELEMENT_ID"]) : false
);
$APPLICATION->IncludeComponent('mobile:mobileapp.news.detail', '', $arParams);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>