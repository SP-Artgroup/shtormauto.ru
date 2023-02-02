<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$msg = [];
$langPrefix = 'CT_BNL_SHOPS_DETAIL_';

foreach ([
    'phone',
    'timetable',
    'email',
    'worktime'
] as $langCode) {
    $msg[$langCode] = Loc::getMessage($langPrefix . strtoupper($langCode));
}

$data   = $arResult['tpl']['data'];
$params = $arResult['tpl']['params'];

$mapData = $data['mapData'];
?>
<div class="shop-detailed-container">

    <div class="map-container">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:map.yandex.view",
            "",
            Array(
                "CONTROLS"      => array(),
                "INIT_MAP_TYPE" => "MAP",
                "MAP_DATA"      => $mapData,
                "MAP_HEIGHT"    => "100%",
                "MAP_ID"        => "",
                "MAP_WIDTH"     => "100%",
                "OPTIONS"       => array()
            ),
            $component
        );
        ?>
    </div>

    <div class="container">

        <div class="shop-detailed-item">

            <img
                class="shop-logo"
                src="<?= SITE_TEMPLATE_PATH ?>/img/shopdetailed-logo.png"
                alt=""
            >

            <?php if ($data['address']): ?>
                <p class="address">
                    <i class="fas fa-home"></i> <?= $data['address'] ?>
                </p>
            <?php endif ?>

            <?php if ($data['phone']): ?>
                <div class="tel">
                    <p class="caption"><?= $msg['phone'] ?></p>
                    <p>
                        <i class="fas fa-phone"></i>

                        <?/*php foreach ($data['phone'] as $key => $phone): ?>
                            <?= ($key !== 0 ? ', ' : '') ?><a href="tel:<?= $phone ?>"><?= $phone ?></a>
                        <?php endforeach */?>
                        <?=$data['phone']?>
                    </p>
                </div>
            <?php endif ?>

            <?php if ($data['email']): ?>
                <div class="shop-detailed-email">
                    <p class="caption"><?= $msg['email'] ?></p>
                    <p>
                        <i class="fas fa-envelope"></i>
                        <?= $data['email'] ?>
                    </p>
                </div>
            <?php endif ?>

            <?php if ($data['worktime']): ?>
                <div class="shop-detailed-worktime">
                    <p class="caption"><?= $msg['worktime'] ?></p>
                    <p>
                        <i class="fas fa-clock"></i>
                        <?= $data['worktime'] ?>
                    </p>
                </div>
            <?php endif ?>

            <?/*php if ($data['timetable']): ?>
                <div class="workinghours">
                    <p class="caption"><?= $msg['timetable'] ?></p>
                    <p>
                        <i class="fas fa-clock"></i>
                        <?php foreach ($data['timetable'] as $key => $timetable): ?>
                            <?= ($key !== 0 ? ', ' : '') ?><span><?= $timetable['days'] ?>:</span> <?= $timetable['time'] ?>
                        <?php endforeach ?>
                    </p>
                </div>
            <?php endif */?>

            <?php if ($data['contacts']): ?>
                <div class="shop-detailed-contacts">
                    <?= $data['contacts'] ?>
                </div>
            <?php endif ?>

            <?php if ($data['slides']): ?>
                <div class="shop-detailed-slider">
                    <?php foreach ($data['slides'] as $slide): ?>
                        <div class="slide">
                            <a data-fancybox="shop-photos" href="<?= $slide['full-src'] ?>">
                                <img src="<?= $slide['src'] ?>" alt="">
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>