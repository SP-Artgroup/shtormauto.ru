<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выгрузка в Дром");
?>
<?$APPLICATION->IncludeComponent(
	"richsite:drom", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "26",
		"QUANTITY_ALLOW" => "N",
		"SAVED_FILE" => "Y"
	),
	false
);?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>