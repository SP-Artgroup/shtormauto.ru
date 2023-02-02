<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

#USER_ID# - ID пользователя
#STATUS# - Статус логина
#MESSAGE# - Сообщение пользователю
#LOGIN# - Логин
#CHECKWORD# - Контрольная строка для смены пароля
#NAME# - Имя
#LAST_NAME# - Фамилия
#EMAIL# - E-Mail пользователя


$res="OK";
if ($_POST["email"]){
    $arEventFields = array(
        "EMAIL_TO"=>$_POST["email"],
        "AUTHOR_EMAIL"=>$_POST["email"],
        "TEXT"=>$_POST["comments"]
    );
    CEvent::Send("USER_PASS_REQUEST", "s1", $arEventFields);
}
else{
        $res="Не заполнено обязательное поле - эл. почта <br/>";
}
echo $res;
?>