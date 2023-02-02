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


$this->createFrame()->begin('Загрузка');

$data        = $arResult['tpl']['data'];
$cities      = $arResult['CITIES'];
$currentCity = $arResult['CURRENT'];

?>
<div class="col-lg-6 col-md-12 col-sm-6 header-city-select">
    <div class="citysearch">
        <select class="selectcustom js-cityselect">

            <? foreach ($cities as $city): ?>

                <option
                    value="<?= $city['ID'] ?>"
                    <?php if ($city['ID'] === $currentCity['ID']): ?>
                        selected
                    <?php endif ?>
                ><?=$city['NAME']?></option>

            <? endforeach ?>

        </select>
    </div>
</div>

<?php if ($data['phone']): ?>
    <div class="col-lg-6 col-md-12 col-sm-5 phone">
        <a href="tel:<?= $data['format_phone'] ?>">
            <i class="fas fa-phone"></i> <?= $data['phone'] ?>
        </a>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/header/whatsapp.php"
            )
        );?>
    </div>
<?php endif ?>

<?php $this->setViewTarget('city_list') ?>

<div class="citysearch">
    <select class="selectcustom js-cityselect">

        <? foreach ($cities as $city): ?>

            <option
                value="<?= $city['ID'] ?>"
                <?php if ($city['ID'] === $currentCity['ID']): ?>
                    selected
                <?php endif ?>
            ><?= $city['NAME'] ?></option>

        <? endforeach ?>

    </select>
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/header/whatsapp.php"
        )
    );?>
</div>

<?php $this->endViewTarget() ?>

<?php $this->setViewTarget('city_phone') ?>

<?php if ($data['phone']): ?>
    <a href="tel:<?= $data['format_phone'] ?>">
        <i class="fas fa-phone"></i> <?= $data['phone'] ?>
    </a>
<?php endif ?>

<?php $this->endViewTarget() ?>