<?
foreach($arResult["SECTIONS"] as $cell=>$arSection){
    if(is_array($arSection["PICTURE"])){
        $img = CFile::ResizeImageGet($arSection["PICTURE"], Array("width"=>120, "height"=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["SECTIONS"][$cell]["PICTURE"] = $img;
        $arResult["SECTIONS"][$cell]["PICTURE"]["ML"] = (140-$img["width"])/2;
        $arResult["SECTIONS"][$cell]["PICTURE"]["MT"] = (90-$img["height"])/2;
    }
}
?>