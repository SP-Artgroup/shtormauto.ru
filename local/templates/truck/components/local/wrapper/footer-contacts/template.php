<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

?>
<?php if (!empty($arParams['address'])): ?>

    <p class="address">
        <i class="fas fa-home"></i> <?= $arParams['address'] ?>
    </p>

<?php endif ?>
<?php if (!empty($arParams['phone'])): ?>

    <p class="tel">
        <a href="tel:<?= $arParams['phone'] ?>">
            <i class="fas fa-phone"></i> <?= $arParams['phone'] ?>
        </a>
    </p>

<?php endif ?>