<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$langPrefix = 'TRUCK_SEARCH_TITLE_';
$msg        = [];

foreach ([
    'SHOW_ALL',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

$showAllItem = $arResult['CATEGORIES']['all']['ITEMS'][0];
unset($arResult['CATEGORIES']['all']);

$addlContClass = !empty($arParams['IS_MOBILE']) && $arParams['IS_MOBILE'] === 'Y'
    ? 'mobile-cont'
    : '';

if (!empty($arResult['CATEGORIES'])): ?>

    <div class="search-result-container <?= $addlContClass ?>">

        <?php foreach ($arResult['CATEGORIES'] as $category_id => $arCategory): ?>

            <div class="item item1">
                <ul>
                    <? foreach ($arCategory['ITEMS'] as $i => $arItem): ?>

                        <?
                        $url = $arItem['URL'];
                        ?>

                        <? if (isset($arItem['ICON'])): ?>

                            <li>
                                <a href="<?= $arItem['URL'] ?>"><?= $arItem['NAME'] ?></a>
                            </li>

                        <? endif ?>

                    <? endforeach ?>
                </ul>
            </div>

        <?php endforeach ?>

        <div class="item item2">
            <ul>
                <li>
                    <a href="<?= $showAllItem['URL'] ?>"><?= $msg['show_all'] ?> <i class="fas fa-angle-double-right"></i></a>
                </li>
            </ul>
        </div>

    </div>

<?php endif ?>