<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["BANNERS_PROPERTIES"] as $arBanner){
    if ($arBanner["AD_TYPE"] == "image" ){
        $arFile = CFile::GetFileArray($arBanner["IMAGE_ID"]);
        ?>
        <div class="col-12 d-block d-xs-none">
            <a href="#" class="advert-banner-vertical" style="background-image:url(<?=$arFile["SRC"]?>)"></a>
        </div>        
    <?}else{
        $frame = $this->createFrame()->begin("");
        echo $arResult["BANNER"];
        $frame->end();
    }
}