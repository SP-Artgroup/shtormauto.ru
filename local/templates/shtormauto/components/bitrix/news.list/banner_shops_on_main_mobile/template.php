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
<?//echo '<pre>'; print_r($arParams["PROPERTY_CITY"]); echo '</pre>';?>
<?// if ($USER->isAdmin()) { ?>

<div class="d-block d-md-none mobile-banner">  
    <div class="header-banner"><?=$arResult["ITEMS"][0]["PROPERTIES"]["HEADER_MOB_BANNER"]["VALUE"]?></div>
    <div class="advert-banner-horizontal mob-banner-mobile">
        <a href="<?=$arResult["ITEMS"][0]["PROPERTIES"]["LINK_MOB_BANNER"]["VALUE"]?>">
            <img src="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["SRC"]?>" alt="">
        </a>
    </div>
    <div class="mob-banner-button">
            <a href="<?=$arResult["ITEMS"][0]["PROPERTIES"]["LINK_MOB_BANNER"]["VALUE"]?>">
                <span>
                     <?=$arResult["ITEMS"][0]["PROPERTIES"]["TEXT_BUTTON"]["VALUE"]?> 
                </span>
             </a>
     </div>
</div>
<?//}?>