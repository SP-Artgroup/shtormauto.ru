<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["SECTIONS"] as $cell=>$arSection){
    if(is_array($arSection["PICTURE"])){
        $img = CFile::ResizeImageGet($arSection["PICTURE"], Array("width"=>140, "height"=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["SECTIONS"][$cell]["PICTURE"] = $img;
    }
}

if(is_array($arResult["SECTION"]["PICTURE"])){
    $img = CFile::ResizeImageGet($arResult["PICTURE"], Array("width"=>120, "height"=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["SECTION"]["PICTURE"] = $img;
    $arResult["SECTION"]["PICTURE"]["ML"] = (140-$img["width"])/2;
    $arResult["SECTION"]["PICTURE"]["MT"] = (90-$img["height"])/2;
}
?>