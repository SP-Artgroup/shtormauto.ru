<?
if(is_array($arResult["PREVIEW_PICTURE"])):
    $arResult["DETAIL_PICTURE"] = $arResult["PREVIEW_PICTURE"];
    $img = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"], array("width"=>220,"height"=>190), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["PREVIEW_PICTURE"] = $img;
elseif(is_array($arResult["DETAIL_PICTURE"])):
    $img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width"=>220,"height"=>190), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["PREVIEW_PICTURE"] = $img;
endif;
if(count($arResult["MORE_PHOTO"])>0):
    foreach($arResult["MORE_PHOTO"] as $cell=>$photo):
        $img = CFile::ResizeImageGet($photo, array("width"=>70,"height"=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["MORE_PHOTO"][$cell]["MIN"] = $img;
    endforeach;
endif
?>