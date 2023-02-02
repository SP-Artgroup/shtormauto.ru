<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<script>
    setPageTitle({type:"text", content: "Записаться на сервис"});
    //app.setPageTitle({"title": "Записаться на сервис"});
</script>
<?
$APPLICATION->IncludeComponent(
	'mobile:mobileapp.service.new',
	''
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>


