<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (is_array($arResult["DETAIL_PICTURE"])): ?>
<a href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>" class="d-none d-md-block"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt=""></a>
<?endif;?>
<?if (is_array($arResult["PREVIEW_PICTURE"])): ?>
<a href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>" class="d-block d-md-none"><img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt=""></a>
<?endif;?>