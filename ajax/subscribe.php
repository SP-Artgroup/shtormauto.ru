<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule('subscribe') && !empty($_POST['email'])) {
 
	$email = $_POST['email'];
 
	$subscribeFields = array(
		"USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
		"FORMAT" => "html",
		"EMAIL" => $email,
		"ACTIVE" => "Y",
		"CONFIRMED" => "Y",
		"SEND_CONFIRM" => "N",
		"RUB_ID" => array(1)
	);
 
	$subscr = new CSubscription;
	$ID = $subscr->Add($subscribeFields);
 
	if($ID > 0) {
		CSubscription::Authorize($ID);
	}
}
?>


