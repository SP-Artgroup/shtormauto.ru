<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корпоративным клиентам");?>Текст страницы...
<br />
<?$APPLICATION->IncludeComponent("bitrix:main.feedback", "storm", Array(
	"USE_CAPTCHA" => "N",	// Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
	"OK_TEXT" => "Спасибо, ваше сообщение принято.",	// Сообщение, выводимое пользователю после отправки
	"EMAIL_TO" => "irina_shtorm@bk.ru",	// E-mail, на который будет отправлено письмо
	"REQUIRED_FIELDS" => array(	// Обязательные поля для заполнения
		0 => "NAME",
		1 => "EMAIL",
		2 => "MESSAGE",
	),
	"EVENT_MESSAGE_ID" => array(	// Почтовые шаблоны для отправки письма
		0 => "7",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>