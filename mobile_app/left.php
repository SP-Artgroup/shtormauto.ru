<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->IncludeComponent('mobile:mobileapp.menu', '');
?>

<script type="text/javascript">
    app.enableSliderMenu(true);
</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>