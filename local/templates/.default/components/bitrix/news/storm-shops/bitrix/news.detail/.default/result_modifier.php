<?
if(is_array($arResult["PREVIEW_PICTURE"])){
    $arResult["DETAIL_PICTURE"] = $arResult["PREVIEW_PICTURE"];
    $img = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"], array("width"=>460, "height"=>280), BX_RESIZE_IMAGE_EXACT, true);
    $arResult["PREVIEW_PICTURE"] = $img;
}
foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $photo){
    $file = CFile::GetPath($photo);
    $img = CFile::ResizeImageGet($photo, array("width"=>110, "height"=>90), BX_RESIZE_IMAGE_EXACT, true);
    $arPhoto = Array(
        "PREVIEW" => $img,
        "DETAIL" => $file,
    );
    $arResult["PROPERTIES"]["PHOTO"]["IMAGES"][] = $arPhoto;
}
?>