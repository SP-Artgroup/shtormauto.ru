<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$ajax = Bitrix\Main\Context::getCurrent()->getRequest()->isAjaxRequest();
if($ajax){
	global $USER;
	$arResult = $USER->Register(
		$_POST["REGISTER"]["LOGIN"], 
		$_POST["REGISTER"]["NAME"], 
		$_POST["REGISTER"]["LAST_NAME"], 
		$_POST["REGISTER"]["PASSWORD"], 
		$_POST["REGISTER"]["CONFIRM_PASSWORD"], 
		$_POST["REGISTER"]["EMAIL"],
		false,
		$_POST["captcha_word"],
		$_POST["captcha_sid"]
	);
	if ($arResult["TYPE"] != 'OK'){?>
		<div class="reg_error"><? ShowMessage($arResult);?></div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.register", 
			"modal_register_form", 
			Array(
				"AUTH" => "Y",	// Автоматически авторизовать пользователей
				"REQUIRED_FIELDS" => array(	// Поля, обязательные для заполнения
					0 => "EMAIL",
				),
				"SET_TITLE" => "N",	// Устанавливать заголовок страницы
				"SHOW_FIELDS" => array(	// Поля, которые показывать в форме
					1 => 'NAME', 
					2 => 'LAST_NAME', 
					3 => 'EMAIL', 
					4 => 'PERSONAL_MOBILE', 
					5 => 'PASSWORD', 
					6 => 'CONFIRM_PASSWORD'
				),
				"SUCCESS_PAGE" => "",	// Страница окончания регистрации
				"USER_PROPERTY" => "",	// Показывать доп. свойства
				"USER_PROPERTY_NAME" => "",	// Название блока пользовательских свойств
				"USE_BACKURL" => "Y",	// Отправлять пользователя по обратной ссылке, если она есть
			),
			false
		);
	}else{
		$user = new CUser;
		$fields = Array(
		  "PERSONAL_MOBILE" => $_POST["REGISTER"]["PERSONAL_MOBILE"],
		);
		$user->Update($arResult["ID"], $fields);
	   	$USER->Authorize($arResult["ID"]);
	   	echo 'OK';
	}
}
?>