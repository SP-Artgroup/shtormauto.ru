<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результат оплаты");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment.receive",
	"",
	Array(
		"PAY_SYSTEM_ID" => "28",
		"PERSON_TYPE_ID" => "1"
	)
);?> 
<?
/*
Данный скрипт можно использовать дважды:
1. как скрипт на который будет обращаться roboxchange в случае успешной оплаты (сash Register queries the Result_URL)
2. как скрипт на который будет возвращаться клиент в случае успешной оплаты ( The customer is redirected to Success_URL only if the payment was successful and the sum of e-currency transferred to Merchant equals to the amount)
*/
/*

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

CModule::IncludeModule("sale");

$inv_id = $_REQUEST["InvId"];
$out_summ = $_REQUEST["OutSum"];
$CHECKSUM = $_REQUEST["SignatureValue"];

	if(IntVal($inv_id)>0)
	{
		$bCorrectPayment = True;
		$arOrder = CSaleOrder::GetByID(IntVal($inv_id));
		
		if (!$arOrder)
			$bCorrectPayment = False;

		if ($bCorrectPayment)
			CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);

		$mrh_pass2 =  CSalePaySystemAction::GetParamValue("ShopPassword2"); // пароль2

		$strCheck = md5($out_summ.":".$inv_id.":".$mrh_pass2);
		echo $strCheck;
		if ($bCorrectPayment && strtoupper($CHECKSUM) != strtoupper($strCheck))
			$bCorrectPayment = False;
			
		
		if($bCorrectPayment)
		{
			$arFields = array(
					"PS_STATUS" => "Y",
					"PS_STATUS_CODE" => "-",
					"PS_STATUS_DESCRIPTION" => "Оплачено",
					"PS_STATUS_MESSAGE" => "OK",
					"PS_SUM" => $out_summ,
					"PS_CURRENCY" => "",
					"PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
					"USER_ID" => $arOrder["USER_ID"]
				);

			// You can comment this code if you want PAYED flag not to be set automatically
			if ($arOrder["PRICE"] == $out_summ)
			{
				$arFields["PAYED"] = "Y";
				$arFields["STATUS_ID"] = "P";
				$arFields["DATE_PAYED"] = Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));
				$arFields["EMP_PAYED_ID"] = false;
			}

			if(CSaleOrder::Update($arOrder["ID"], $arFields))
				echo "Заказ успешно оплачен!";
		
		}
	}
	else echo "Ошибка оплаты.";
*/
/*
CModule::IncludeModule("sale");
$arOrder = CSaleOrder::GetByID($_REQUEST["InvId"]);
$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment.receive",
	"",
	Array(
		"PAY_SYSTEM_ID" => $arOrder["PERSON_TYPE_ID"],
		"PERSON_TYPE_ID" => $arOrder["PAY_SYSTEM_ID"]
	),
false
);
*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>