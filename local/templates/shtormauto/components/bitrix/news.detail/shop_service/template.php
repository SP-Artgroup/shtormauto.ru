<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if (is_array($arResult["DETAIL_PICTURE"])){
$arFile = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>947, 'height'=>440), BX_RESIZE_IMAGE_EXACT, true);
}elseif(is_array($arResult["PREVIEW_PICTURE"])){
$arFile = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"], array('width'=>947, 'height'=>440), BX_RESIZE_IMAGE_EXACT, true);
}
//dump($arResult["PROPERTIES"]["PHOTO"]);
?>
<div class="about-page">
    <?$strCity = str_replace('<a href="">', '', $arResult["DISPLAY_PROPERTIES"]["CITY"]["DISPLAY_VALUE"]);
        $strCity = str_replace('</a>', '', $strCity);
    ?>
    <h1 class="about-page__name  about-page__name--margin-bottom-77"><?=$arResult["NAME"]?> <span><?='г. '.$strCity?></span></h1>
    <div class="about-page__info-map">
        <div class="about-page__info">
            <div class="about-page__info-item">
                <div class="service-location"><i class="icon i-balloon"></i><?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"]?></div>
            </div>
            <div class="about-page__info-item">
                <div class="about-page__info-item-label">Телефон</div>
                <div class="about-page__info-item-value">
                    <a href="tel: <?=$arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"]?>"><?=$arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"]?></a>
                </div>
            </div>
            <div class="about-page__info-item">
                <div class="about-page__info-item-label">Режим работы</div>
                <?=htmlspecialchars_decode($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["VALUE"]);?>
            </div>
        </div>
        <?$coords = (explode(',',$arResult["DISPLAY_PROPERTIES"]["LOCATION"]["VALUE"]));?>
        <div class="about-page__map" data-ymap='{"coords": ["<?=$coords[0]?>", "<?=$coords[1]?>"], "address": "Белогорск, ул. Нагорная,1А", "placemarkSizes": ["19", "25"]}'></div>
    </div>

    <div class="about-page__description">
        <? if($arResult["DETAIL_TEXT"] != ""):?>
            <?=$arResult["DETAIL_TEXT"]?>
        <? endif;?>
        <?=$arResult["DETAIL_PICTURE"];?>
    </div>
    <?if (is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"])){?>
    <div class="about-page-slider">
        <?foreach ($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $banner){
        $arFile = CFile::ResizeImageGet($banner, array('width'=>947, 'height'=>440), BX_RESIZE_IMAGE_EXACT, true);
        
        ?>
        <div class="about-page-slider__item"><img src="<?=$arFile["src"]?>" alt=""></div>
        <?}?>
    </div>
    <?}?>
</div>
