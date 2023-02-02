<? require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (CModule::IncludeModule("form")) {
		$arResult["arrVALUES"] = array();
		if (isset($_REQUEST['g-recaptcha-response']) && $_REQUEST['g-recaptcha-response']) {
			$secret = '6Ld2drIZAAAAAJnhOcsT_W78sZtAf3fk-qr6xd8I';
			$ip = $_SERVER['REMOTE_ADDR'];
			$response = $_REQUEST['g-recaptcha-response'];
			$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
			$arr = json_decode($rsp, TRUE);
		}
		if ($_REQUEST['WEB_FORM_ID'] != "" && $arr['success']){
			$arResult["arrVALUES"] = $_REQUEST;
			// check errors
			$arResult["FORM_ERRORS"] = CForm::Check($arResult["arrVALUES"]["WEB_FORM_ID"], $arResult["arrVALUES"], false, "Y", "Y");
			if ((!is_array($arResult["FORM_ERRORS"]) || count($arResult["FORM_ERRORS"]) <= 0) && strlen($arResult["FORM_ERRORS"]) <= 0)	{
				// check user session
				
				if (check_bitrix_sessid())
				{
					$return = false;

					// add result
					if($RESULT_ID = CFormResult::Add($arResult["arrVALUES"]["WEB_FORM_ID"], $arResult["arrVALUES"]))
					{
						$arResult["FORM_RESULT"] = 'addok';

						// send email notifications
						CFormCRM::onResultAdded($arParams["WEB_FORM_ID"], $RESULT_ID);
						CFormResult::SetEvent($RESULT_ID);
						CFormResult::Mail($RESULT_ID);

						// choose type of user redirect and do it

						LocalRedirect(
							$APPLICATION->GetCurPageParam(
								"WEB_FORM_ID=".$arParams["WEB_FORM_ID"]
								."&RESULT_ID=".$RESULT_ID
								."&formresult=".urlencode($arResult["FORM_RESULT"]),
								array('formresult', 'strFormNote', 'WEB_FORM_ID', 'RESULT_ID')
							)
						);

						die();
						
					}
					else
					{
						$arResult["FORM_ERRORS"] = $GLOBALS["strError"];
					}
				}
			}
			else{
				foreach ($arResult["FORM_ERRORS"] as $key => $value) {
					echo $value.'<br/>';
				}
			}
		}
		else{
			echo $_REQUEST['formresult'];
		}
	}
}
?>