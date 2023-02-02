<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!empty($arResult)): ?>
    
    <ul class="left-menu">

        <? foreach ($arResult as $arItem): ?>
            
            <?
            if ($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1) {
                continue;
            }

            $linkClass = $arItem['SELECTED'] ? 'selected' : '';
            ?>

            <li>
                <a href="<?= $arItem['LINK'] ?>" class="<?= $linkClass ?>"><?= $arItem['TEXT'] ?></a>
            </li>

        <? endforeach ?>

    </ul>

<? endif ?>