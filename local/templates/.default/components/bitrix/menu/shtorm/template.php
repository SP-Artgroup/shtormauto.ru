<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if (!empty($arResult)):?>
<div class="top-menu">
	<ul>
    <?
    $previousLevel = 0;
    foreach($arResult as $key=>$arItem):?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
    		<?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    	<?endif?>
    	<?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <?if($key > 0):?>
                <li class="delim"></li>
            <?endif;?>
            <?if($arItem["IS_PARENT"]):?>
    		    <li><a href="<?=$arItem["LINK"]?>" class="root-item" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a><div class="level2items"><ul>
            <?else:?>
                <li><a href="<?=$arItem["LINK"]?>" class="root-item" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif;?>
        <?else:?>
            <li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
    	<?endif?>
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    <?endforeach?>
    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	</ul>
</div>
<?endif?>