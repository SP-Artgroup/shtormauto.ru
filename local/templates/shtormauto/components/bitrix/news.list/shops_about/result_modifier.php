<?php
use SP\City;
$arNewItems = [];
$curSity = City::getCurrentCityData();
//dump1($curSity["NAME"]);
$i = 1; 
foreach ($arResult["ITEMS"] as $arItem){
    if ($i==$arParams["NEWS_COUNT"]) break;
    if ($arItem["PROPERTIES"]["CITY"]["VALUE"]==$curSity["ID"]){
        if ($arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"]){
            $arItem["NAME"] = $arItem["PROPERTIES"]["SHORT_NAME"]["VALUE"];
        }
        $arNewItems[] = $arItem;
    }
    $i++;
}
$arResult["ITEMS"] = $arNewItems;
?>

