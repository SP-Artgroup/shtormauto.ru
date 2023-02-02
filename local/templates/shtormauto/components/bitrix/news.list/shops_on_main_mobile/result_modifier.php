<?php
//use SP\City;
//$arNewItems = [];
//$curSity = City::getCurrentCityData();
$i = 1; 
foreach ($arResult["ITEMS"] as $arItem){
	if ($i==$arParams["NEWS_COUNT"]) break;
	if ($arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"]){
			$arItem["NAME"] = $arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"];
	}
	$arItem["PROPERTIES"]["PHONE"]["VALUE"] = preg_replace('/[^0-9()+,]/', '', $arItem["PROPERTIES"]["PHONE"]["VALUE"]);
	$arItem["PROPERTIES"]["PHONE"]["VALUE"] = explode("," ,$arItem["PROPERTIES"]["PHONE"]["VALUE"])[0];
	$string = htmlentities($arItem["PROPERTIES"]["PHONE"]["VALUE"], null, 'utf-8');
	$content = str_replace(" ", "", $string);
	$content = str_replace("-", "", $content);
	$content = html_entity_decode($content);
	$content = preg_replace("/[^0-9()+,]/","",$content);

	$str_ex = array("8","+7");
	foreach ($str_ex as $key => $value) {
		$len = strlen($value);
		if(mb_substr($content, 0, $len) == $value) 
		{
			$content = mb_substr($content, $len, null);
		}
	}

	$length = 10;
	if(str_contains($content, "(")) $length = 12;
	$content = mb_substr($content, 0, $length);
	$content = "+7".$content;
	$arItem["PROPERTIES"]["PHONE"]["VALUE"] = $content;


	$arNewItems[] = $arItem;

	$i++;
		
}

$arResult["ITEMS"] = $arNewItems;
?>

