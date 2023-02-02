<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Каталог"});
    //app.setPageTitle({"title": "Каталог"});
</script>
<?
$arParams = array(
    "SECTION_ID" => isset($_GET["SECTION_ID"]) ? intval($_GET["SECTION_ID"]) : false
);

$filterFields = array(
    "PROPERTY_DIAMETR",
    "PROPERTY_SHIRINA",
    "PROPERTY_PROFIL",
    "PROPERTY_SEZONNOST",
);
foreach($filterFields as $k) {
    if(isset($_GET[$k]) && $_GET[$k]) {
        $arParams["FILTER"][$k] = $_GET[$k];
    }
}

$APPLICATION->IncludeComponent('mobile:mobileapp.catalog', '', $arParams);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


