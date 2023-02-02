<?
if($_REQUEST["ajaxtype"] == "get_bonus" && $_REQUEST["code"] != ""){
	$code = preg_replace('/[^0-9]/', '', $_REQUEST["code"]);
	$lenght = strlen($code);
	
	$filelist = glob($_SERVER["DOCUMENT_ROOT"].'/upload/1c_catalog/Bonus__*.xml');
	if(isset($filelist[0]))
	{	
		//$xml = simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/bonus.xml");
		$xml = simplexml_load_file($filelist[0]);

		foreach($xml->ДисконтныеКарты->ДисконтнаяКарта as $discontCard)
		//foreach()
		{
			//if($discontCard->КодКорты == "Карта № ".$_REQUEST["code"])
			if($discontCard->Штрихкод == $code && $lenght == 13)
			{

	//			echo $discontCard->КодКорты."<br>";
	//			echo $discontCard->Остаток;
				echo $discontCard->ОстатокБонусов;
				break;
			}
			elseif($discontCard->НомерТелефона == substr($code, 1) && $lenght == 11){
				echo $discontCard->ОстатокБонусов;
				break;
			}
		}
	}
}
?>