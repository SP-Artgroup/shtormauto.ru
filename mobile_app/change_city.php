<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->IncludeComponent(
    'mobile:mobileapp.change_city',
    ''
);
?>
<script>
    setPageTitle({type:"text", content: "Местоположение"});
    //app.setPageTitle({"title": "Местоположение"});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


