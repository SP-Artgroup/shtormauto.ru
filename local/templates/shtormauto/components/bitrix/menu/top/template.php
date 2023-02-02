<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<nav class="header-menu">
    <ul class="header-menu__list">
        <?
        foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        continue;
        ?>
		<?if ($arItem['PARAMS']['scarlet']){?>
			<li class="header-menu__item"><a href="javascript:void(0);" class="header-menu__link scarlet" onclick="$('.yButtonText').click();"><?= $arItem["TEXT"] ?></a></li>
		<?}else{?>
        <li class="header-menu__item"><a href="<?= $arItem["LINK"] ?>" class="header-menu__link"><?= $arItem["TEXT"] ?></a></li>
		<?}?>
        <?endforeach?>

    </ul>
</nav>
<?endif?>