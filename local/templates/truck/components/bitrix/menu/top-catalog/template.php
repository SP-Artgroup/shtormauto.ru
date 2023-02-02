<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

if (empty($arResult)) {
    return;
}

function showMenu($menu, $params = []) {
    include __DIR__ . '/parts/menu.php';
}

$msg        = [];
$langPrefix = 'CT_MENU_TOP_CATALOG_';

foreach ([
    'TITLE',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

?>
<div class="nav-menu">
    <div class="container">
        <nav>
            <?php showMenu($arResult, ['is_top_level' => true]) ?>
        </nav>
    </div>
</div>

<?php $this->setViewTarget('mobile-catalog-menu') ?>

<div class="nav-menu-mobile-catalog">
    <p class="caption"><?= $msg['title'] ?> <i class="fas fa-caret-down"></i></p>
    <ul>
        <?php foreach ($arResult as $item): ?>
            <li>
                <a href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>
            </li>

        <?php endforeach ?>
    </ul>
</div>

<?php $this->endViewTarget() ?>

<?php $this->setViewTarget('footer-catalog-menu') ?>

<ul>
    <?php foreach ($arResult as $item): ?>
        <li>
            <a href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php $this->endViewTarget() ?>