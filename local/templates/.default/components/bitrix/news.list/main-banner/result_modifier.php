<?
foreach($arResult["ITEMS"] as $key=>$arItem){
    if(is_array($arItem["PROPERTIES"]["BANNER"])){
        $file = CFile::GetPath($arItem["PROPERTIES"]["BANNER"]["VALUE"]);
        $type = end(explode(".", $file));
        if($type == "swf")
            $arResult["ITEMS"][$key]["TYPE"] = "flash";
        else
            $arResult["ITEMS"][$key]["TYPE"] = "image";
            
        //if($type != "gif")
        //	unset($arResult["ITEMS"][$key]);
              
            
        $arResult["ITEMS"][$key]["VALUE"] = $file;
    }
}
?>