<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $arrFilterAlsoBuy;
global $itemName;
/*$arrFilterMy = Array(
	"LOGIC" => "OR",
);
foreach($arResult["PROPERTIES"] as $pid=>$arProperty){
    if(!in_array($pid, $arParams["PROPERTY_CODE"]) || empty($arProperty["VALUE"]))
        continue;
    if($arProperty["PROPERTY_TYPE"] == "L")
        $arrFilterMy["PROPERTY_".$pid."_VALUE"] = $arProperty["VALUE"];
    else
        $arrFilterMy["PROPERTY_".$pid] = $arProperty["VALUE"];
}*/
$arrFilterAlsoBuy["ID"] = $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"];
$itemName = $arResult["NAME"];
?>