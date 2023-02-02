<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Новинки"});
    //app.setPageTitle({"title": "Новинки"});
</script>
<?

$arFilter = array("!PROPERTY_NEWITEM_VALUE"=>false);

$arParams = array(
    //"SECTION_ID" => isset($_GET["SECTION_ID"]) ? intval($_GET["SECTION_ID"]) : false
);

$APPLICATION->IncludeComponent('mobile:mobileapp.novelty', '', $arParams);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>