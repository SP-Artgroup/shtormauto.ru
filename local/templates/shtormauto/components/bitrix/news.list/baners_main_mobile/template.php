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
?>
<div class="d-block d-lg-none">
    <div class="advert-banner-horizontal">
        <a href="<?=$arResult["ITEMS"][1]["PROPERTIES"]["LINK"]["VALUE"]?>" class="d-none d-md-block"><img src="<?=$arResult["ITEMS"][1]["PREVIEW_PICTURE"]["SRC"]?>" alt=""></a>
        <a href="<?=$arResult["ITEMS"][0]["PROPERTIES"]["LINK"]["VALUE"]?>" class="d-block d-md-none"><img src="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["SRC"]?>" alt=""></a>
    </div>
</div>
