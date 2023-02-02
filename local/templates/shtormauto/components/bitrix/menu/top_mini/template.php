<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<nav class="responsive-menu-first-nav">
    <ul class="responsive-menu-first-nav__list">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
		<li class="responsive-menu-first-nav__item"><a href="<?=$arItem["LINK"]?>" class="responsive-menu-first-nav__link <?if ($arItem['PARAMS']['scarlet']){?>scarlet<?}?>"><?=$arItem["TEXT"]?></a></li>

<?endforeach?>

</ul>
    </nav>
<?endif?>