<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'mobile:mobileapp.order.cancel',
    '',
    array(
        "ID" => isset($_GET["ID"]) ? intval($_GET["ID"]) : false,
    )
);
?>
<script>
    setPageTitle({type:"text", content: "Личный кабинет"});
    //app.setPageTitle({"title": "Личный кабинет"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>

