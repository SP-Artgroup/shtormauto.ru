<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<nav class="top-menu d-none d-lg-flex">
    <ul class="top-menu__list">

        <?
        foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        continue;
        ?>
        <?if ($arItem['PARAMS']['scarlet']){?>
			<li class="top-menu__item"><a href="javascript:void(0);" class="top-menu__link scarlet" onclick="$('.myButton.bottom.left').click();"><?= $arItem["TEXT"] ?></a></li>
		<?}else{?>
        	<li class="top-menu__item"><a href="<?= $arItem["LINK"] ?>" class="top-menu__link"><?= $arItem["TEXT"] ?></a></li>
        <? }?>	
        <?endforeach?>

    </ul>
</nav>
<?endif?>