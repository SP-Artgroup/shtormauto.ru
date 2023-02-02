<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!empty($arResult)): ?>
    <div class="top-menu">
        <ul>
            <? foreach ($arResult as $arItem): ?>

                <?
                $isHide = !empty($arItem['PARAMS']['HIDE_DESKTOP'])
                    && $arItem['PARAMS']['HIDE_DESKTOP'] === 'Y';

                if (
                    $arParams['MAX_LEVEL'] == 1
                    && $arItem['DEPTH_LEVEL'] > 1
                    || $isHide
                ) {
                    continue;
                }

                $linkClass = $arItem['SELECTED'] ? 'selected' : '';
                ?>

                <li>
                    <a href="<?= $arItem['LINK'] ?>" class="<?= $linkClass ?>"><?= $arItem['TEXT'] ?></a>
                </li>

            <? endforeach ?>
        </ul>
    </div>

    <?php $this->setViewTarget('mobile-main-menu') ?>

    <div class="rest-mobile-menu">
        <ul>
            <? foreach ($arResult as $arItem): ?>

                <?
                $isHide = !empty($arItem['PARAMS']['HIDE_MOBILE'])
                    && $arItem['PARAMS']['HIDE_MOBILE'] === 'Y';

                if (
                    $arParams['MAX_LEVEL'] == 1
                    && $arItem['DEPTH_LEVEL'] > 1
                    || $isHide
                ) {
                    continue;
                }

                $linkClass = $arItem['SELECTED'] ? 'selected' : '';
                $isAction = !empty($arItem['PARAMS']['IS_ACTION'])
                    && $arItem['PARAMS']['IS_ACTION'] === 'Y';
                ?>

                <li>
                    <a href="<?= $arItem['LINK'] ?>" class="<?= $linkClass ?>">
                        <?= $arItem['TEXT'] ?>
                        <?php if ($isAction): ?>
                            <i class="fas fa-percent"></i>
                        <?php endif ?>
                    </a>
                </li>

            <? endforeach ?>
        </ul>
    </div>

    <?php $this->endViewTarget() ?>

    <?php $this->setViewTarget('footer-main-menu') ?>

    <ul>
        <? foreach ($arResult as $arItem): ?>

            <?
            $isHide = !empty($arItem['PARAMS']['HIDE_FOOTER'])
                && $arItem['PARAMS']['HIDE_FOOTER'] === 'Y';

            if (
                $arParams['MAX_LEVEL'] == 1
                && $arItem['DEPTH_LEVEL'] > 1
                || $isHide
            ) {
                continue;
            }

            $linkClass = $arItem['SELECTED'] ? 'selected' : '';
            ?>

            <li>
                <a href="<?= $arItem['LINK'] ?>" class="<?= $linkClass ?>">
                    <?= $arItem['TEXT'] ?>
                </a>
            </li>

        <? endforeach ?>
    </ul>

    <?php $this->endViewTarget() ?>

<? endif ?>