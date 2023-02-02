<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$SMTP_MAIL = COption::GetOptionString("main", "email_from");
$res="OK";
if ($_POST["email"]&& $_POST["comments"]){
    $arEventFields = array(
        "EMAIL_TO"=>$SMTP_MAIL,
        "AUTHOR_EMAIL"=>$_POST["email"],
        "TEXT"=>$_POST["comments"]
    );
    ;$res = CEvent::Send("FEEDBACK_FORM", "s1", $arEventFields,"N", 63);
}
else{
    $res="";
    if (!$_POST["email"]){
        $res.="Не заполнено обязательное поле - эл. почта <br/>";
    }
    if (!$_POST["comments"]){
        $res.="Не заполнено обязательное поле - сообщение <br/>";
    }    
}
echo $res;
?>