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
use Bitrix\Main\Web\Json;
use Bitrix\Main\Context;

$this->setFrameMode(true);
$this->addExternalJs(SITE_TEMPLATE_PATH . '/vendor/mustache/mustache.min.js');
$this->addExternalJs('//api-maps.yandex.ru/2.1/?lang=ru_RU');

$data    = $arResult['tpl']['data'];
$mapData = $data['mapData'];

if (Context::getCurrent()->getRequest()->isAjaxRequest()) {
    echo Json::encode($data['items']);
    return;
}

?>
<div class="enroll-container active">

    <div class="map-container" id="enroll-map"></div>

    <div class="container">
        <div class="enroll-item">

            <div class="quantity-enroll">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/quantity-enroll.png" alt="">
            </div>

            <div class="enroll-select">
                <select class="selectcustom js-change-enroll-service-city">
                    <?php foreach ($data['cities'] as $city): ?>
                        <option
                            value="<?= $city['ID'] ?>"
                            <?php if ($city['ID'] === $data['currentCityId']): ?>
                                selected
                            <?php endif ?>
                        ><?= $city['NAME'] ?></option>
                    <?php endforeach ?>
                </select>

                <div class="open-enroll">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/open-enroll.png" alt="">
                </div>
                <div class="close-enroll">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/close-enroll.png" alt="">
                </div>

            </div>

            <div class="enroll-result"></div>

        </div>
    </div>

</div>

<script id="enroll-items-template" type="text/html">

    {{#items}}
        <div class="shop-item" id="{{ areaId }}">

            <span
                class="img"
                title="{{ preview_picture.title }}"
                style="background-image: url({{ preview_picture.src }})"
            ></span>

            <div class="text-block">

                <p class="city">{{name}}</p>

                {{#address}}
                    <p class="street">{{address}}</p>
                {{/address}}

                {{#phone}}
                    <p class="mobile-phone">
                        {{#phone}}
                            <a href="tel:{{phone}}">
                                <i class="fas fa-phone"></i>
                                {{phone}}
                            </a>
                        {{/phone}}
                    </p>
                {{/phone}}

                <p class="text">{{{preview_text}}}</p>

                <button
                    class="btn2 btn-black"
                    data-shop-id="{{id}}"
                >Записаться</button>

            </div>
        </div>
    {{/items}}

</script>

<script>
    $(function () {
        var currentCityId = <?= $data['currentCityId'] ?>;
        shops[currentCityId] = <?= Json::encode($data['items']) ?>;
        renderShops(shops[currentCityId]);
        // renderMap(shops[currentCityId]);
    });
</script>