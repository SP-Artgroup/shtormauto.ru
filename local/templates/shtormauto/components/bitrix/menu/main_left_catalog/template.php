<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="categories-sidebar">
<h3 class="categories-sidebar__heading">Каталог</h3>

    <? if (!empty($arResult)): ?>
        <ul class="categories-sidebar__list">
            <?

            $previousLevel = 0;

            foreach ($arResult as $arItem): ?>

                <?
                $itemSelectedClass = $arItem['SELECTED'] ? 'selected' : '';
                ?>
                
                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?endif?>

                <? if ($arItem["IS_PARENT"]): ?>

                    <li class="categories-sidebar__item">
                        <a href="<?=$arItem["LINK"]?>" class="categories-sidebar__link parent"><i class="icon i-triangle"></i><?=$arItem["TEXT"]?></a>    
                        <ul class="categories-sidebar__list">

                <? else: ?>

                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                         <li class="categories-sidebar__item">
                            <a href="<?=$arItem["LINK"]?>" class="categories-sidebar__link_noparent"><?=$arItem['TEXT']?></a>
                        </li>
                    <? else: ?>
             
                        <li>
                            <a href="<?=$arItem["LINK"]?>" class="categories-sidebar__link" ><?=$arItem['TEXT']?></a>
                        </li>
                    <? endif ?>

                <?endif?>

                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

            <? endforeach ?>

            <? if ($previousLevel > 1): ?>
                <?=str_repeat("</ul></li>", ($previousLevel-1))?>
            <? endif ?>

        </ul>
        <a href="#" class="categories-sidebar__more-link">Развернуть</a>                    
    <? endif ?>
</div>