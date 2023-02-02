<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach ($arResult['ITEMS'] as $key => $arElement)
{
	if(is_array($arElement["PREVIEW_PICTURE"])){
        $img = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array("width"=>140,"height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;
    }elseif(is_array($arElement["DETAIL_PICTURE"])){
        $img = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width"=>140,"height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = $img;
    }
    if(intval($arElement["PROPERTIES"]["TIRE_R"]["VALUE"]))
        $arResult['ITEMS'][$key]["PREVIEW_TEXT"] = $arElement["PROPERTIES"]["TIRE_W"]["VALUE"]."/".$arElement["PROPERTIES"]["TIRE_H"]["VALUE"]." R".$arElement["PROPERTIES"]["TIRE_R"]["VALUE"];
    elseif(intval($arElement["PROPERTIES"]["DISK_R"]["VALUE"]))
        $arResult['ITEMS'][$key]["PREVIEW_TEXT"] = $arElement["PROPERTIES"]["DISK_Q"]["VALUE"]."x".$arElement["PROPERTIES"]["DISK_D"]["VALUE"]." R".$arElement["PROPERTIES"]["DISK_R"]["VALUE"];
}
?>