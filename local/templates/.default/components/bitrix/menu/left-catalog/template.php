<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="catalog-menu">
    <div class="catalog-menu-head">Каталог</div>

    <? if (!empty($arResult)): ?>
        <ul class="root">
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

                    <li class="parent">

                    <a href="<?=$arItem["LINK"]?>" class="root-item root-item-parent <?=$itemSelectedClass?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                        <ul class="child <?if($arItem["SELECTED"]):?>open<?endif?>">

                <? else: ?>

                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                        <li>
                            <a href="<?=$arItem["LINK"]?>" class="root-item <?=$itemSelectedClass?>" title="<?=$arItem["TEXT"]?>"><?=$arItem['TEXT']?></a>
                        </li>
                    <? else: ?>
                        <li>
                            <a href="<?=$arItem["LINK"]?>" class="<?=$itemSelectedClass?>" title="<?=$arItem["TEXT"]?>"><?=$arItem['TEXT']?></a>
                        </li>
                    <? endif ?>

                <?endif?>

                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

            <? endforeach ?>

            <? if ($previousLevel > 1): ?>
                <?=str_repeat("</ul></li>", ($previousLevel-1))?>
            <? endif ?>

        </ul>
    <? endif ?>

    <div style="clear: both;"></div>
</div>