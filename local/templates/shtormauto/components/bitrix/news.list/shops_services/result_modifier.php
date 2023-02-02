<?php
$res = CIBlockElement::GetList(array("ID"=>"ASC"), array("IBLOCK_ID"=>15, "ACTIVE"=>"Y"));
$arCities = [];
while($arCity=$res->Fetch()){
    $arCities[$arCity["ID"]] = $arCity["NAME"];
};
$arResult["CITY_LIST"] = $arCities;

foreach($arResult["ITEMS"] as $key=>$arItem){
    if (is_array($arItem["PREVIEW_PICTURE"])){
        $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>360, 'height'=>240), BX_RESIZE_IMAGE_EXACT, true); 
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $file["src"];
    }
}

