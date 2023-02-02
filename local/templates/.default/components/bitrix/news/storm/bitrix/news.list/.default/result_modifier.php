<?
foreach($arResult["ITEMS"] as $key=>$arItem){
    if(is_array($arItem["PREVIEW_PICTURE"])){
        $img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array("width"=>140, "height"=>110), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;
    }
}
?>