<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["BANNERS_PROPERTIES"] as $arBanner){
    if ($arBanner["AD_TYPE"] == "image" ){
        $arFile = CFile::GetFileArray($arBanner["IMAGE_ID"]);
        ?>
        <div class="product-item-col col-6 col-lg-4 d-none d-lg-block">
            <?/*<a href='<?=$arBanner["URL"]?>' class="advert-banner-vertical" style="background-image:url(<?=$arFile["SRC"]?>)"></a>*/?>
            <?=$arResult["BANNER"];?>  
        </div>
    <?}else{
        $frame = $this->createFrame()->begin("");
        echo $arResult["BANNER"];
        $frame->end();
    }
}