<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
use SP\City;

$this->createFrame()->begin('Загрузка');

$cities          = $arResult['CITIES'];
$currentCity     = $arResult['CURRENT'];
$currentCityHref = $APPLICATION->GetCurPageParam('chcity=' . $currentCity['ID'], ['chcity']);
?>
<div class="city-list">

    <span class="notetext curcity">

        <div class="morecity">

            <? foreach ($cities as $city): ?>

                <div class="morecity_item">
                    <a
                        class="choose-city"
                        href="<?=$APPLICATION->GetCurPageParam('chcity=' . $city['ID'], ['chcity'])?>"
                    ><?=$city['NAME']?></a>
                </div>

            <? endforeach ?>

        </div>

        <?=$currentCity['NAME']?>

    </span>

    <span class="phones">
        <? if (!empty($currentCity['PROPERTY_PHONES_VALUE'])): ?>

            <?='&nbsp;|&nbsp;' . $currentCity['PROPERTY_PHONES_VALUE'][0]?>

        <? endif ?>
    </span>

    <div class="confirm-city-list">

        <? if (!City::cityConfirm()): ?>

            <ul class="city_list" id="city_list" style="display:none;">

                <? foreach ($cities as $city): ?>

                    <? $href = $APPLICATION->GetCurPageParam('chcity=' . $city['ID'], ['chcity']) ?>

                    <li>
                        <a href="<?=$href?>"><?=$city['NAME']?></a>
                    </li>

                <? endforeach ?>

            </ul>

            <div id="geo_confirm" style="display: block;">
                <div class="inner-shadow"></div>
                <div class="close j-close"></div>
                <p><?=Loc::getMessage('YOUR_CITY')?> <b class="name"><?=$currentCity['NAME']?></b>? </p>
                <a class="button_red confirm-btn" href="<?=$currentCityHref?>"><?=Loc::getMessage('YES')?></a>
                <a href="#city_list" class=" fancybox choise_other_city"><?=Loc::getMessage('CHANGE_CITY')?></a>
            </div>

        <? endif ?>

    </div>

</div>