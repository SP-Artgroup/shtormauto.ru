<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"image", content: "/mobile_app/images/logo.png"});
</script>
<?
if (!CModule::IncludeModule("catalog")) {
    return;
}

$city = isset($_SESSION['CITY']) ? $_SESSION['CITY'] : false;
if(!$city) LocalRedirect('/mobile_app/change_city.php');

$id = 494760;
$item = CIBlockElement::GetList(array('ID' => "ASC"), array('ID' => $id))->Fetch();
$prices = [];
$rPrices = CPrice::GetList(array("ID" => "ASC"), array('PRODUCT_ID' => $id, "CAN_BUY" => "Y", "CAN_ACCESS" => "Y", "%CATALOG_GROUP_NAME" => $city['NAME']));
while($pr = $rPrices->Fetch()) {
    $key = str_replace('-розница', '', $pr['CATALOG_GROUP_NAME']);
    $prices[$key] = $pr['PRICE'];
}

echo '<pre>';print_r($prices);die();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


