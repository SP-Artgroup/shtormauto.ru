<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(is_array($arResult["PICTURE"])){
    $img = CFile::ResizeImageGet($arResult["PICTURE"], Array("width"=>220, "height"=>190), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["PREVIEW_PICTURE"] = $img;
}
foreach ($arResult['ITEMS'] as $key => $arElement)
{
    if(is_array($arElement["PREVIEW_PICTURE"])){
        $img = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array("width"=>140,"height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;
    }elseif(is_array($arElement["DETAIL_PICTURE"])){
        $img = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width"=>140,"height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;
    }
}
?>