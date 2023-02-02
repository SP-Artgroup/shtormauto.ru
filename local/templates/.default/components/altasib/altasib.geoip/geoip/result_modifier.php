<?
if(CModule::IncludeModule("iblock"))
{ //dump($arResult);
	if(!$_GET["chcity"])
	{
		if($_COOKIE["geo_ip_city"])
		{
			$city = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","NAME"=>$_COOKIE["geo_ip_city"]),false,array("nTopCount"=>"1"),array("ID","NAME"))->Fetch();
			if(!$city)
			{
				$city = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","!PROPERTY_DEFAULT"=>false),false,array("nTopCount"=>"1"),array("ID","NAME"))->Fetch();
			}
		}
		else
		{
			$city = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","NAME"=>$arResult["city"]),false,array("nTopCount"=>"1"),array("ID","NAME"))->Fetch();
			if(!$city)
			{
				$city = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","!PROPERTY_DEFAULT"=>false),false,array("nTopCount"=>"1"),array("ID","NAME"))->Fetch();
			}
			//setcookie("geo_ip_city",$city["NAME"],time()+86400,"/");
		}
	}
	else
	{
		$city = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","ID"=>$_GET["chcity"]),false,array("nTopCount"=>"1"),array("ID","NAME"))->Fetch();
		setcookie("geo_ip_city",$city["NAME"],time()+86400,"/");
	}

	$obProps = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>"15","ID"=>$city["ID"]),false,array("nTopCount"=>"1"),array("IBLOCK_ID","ID","PROPERTY_PHONES","PROPERTY_CATALOG"))->GetNextElement();

	$props 						= $obProps->GetProperties();
	$arResult['result']			= $arResult;
	$arResult["city"] 			= $city["NAME"];
	$arResult["phones"] 		= $props["PHONES"]["VALUE"] ? array(current($props["PHONES"]["VALUE"])) : "";
	$_SESSION["catalog_id"] 	= $props["CATALOG"]["VALUE"];
	$_SESSION["cur_city_name"] 	= $city["NAME"];
}?>