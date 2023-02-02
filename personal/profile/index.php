<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки пользователя");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"shtormaotu-lk", 
	array(
		"CHECK_RIGHTS" => "N",
		"COMPONENT_TEMPLATE" => "shtormaotu-lk",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>