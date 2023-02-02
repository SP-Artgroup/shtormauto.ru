<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"",
	Array(
		"AUTH" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"REQUIRED_FIELDS" => array("NAME", "EMAIL", "PERSONAL_MOBILE"),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array("NAME", "LAST_NAME", "EMAIL", "PERSONAL_MOBILE"),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	)
);?>
<?/*
$APPLICATION->IncludeComponent(
	"bitrix:system.auth.registration",
	"",
	Array(
		"AUTH" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"REQUIRED_FIELDS" => array(),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	)
);
*/?>


<!-- /************************НОВОЕ*****************************/ -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>