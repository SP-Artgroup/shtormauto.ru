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
<div class="city-list city-change">

    <span class="notetext curcity">

        <div class="morecity2">

            <? foreach ($cities as $city): ?>

                <div class="morecity_item">
                    <a
                        class="choose-city dropdown-item
                        <? if ($city['NAME']==$currentCity['NAME']){?>
                            active
                        <?}?>                                           
                        "
                        href="<?=$APPLICATION->GetCurPageParam('chcity=' . $city['ID'], ['chcity'])?>"
                    ><?=$city['NAME']?></a>
                </div>

            <? endforeach ?>

        </div>

       <span class="d-none d-md-inline-block"> <?=Loc::getMessage('YOUR_CITY')?></span>
        <a class="city-change__toggle2" href='javascript:void(0);'>
            <?=$currentCity['NAME']?>
        </a>

    </span>
			
    <div class="phone">
        <? if (!empty($currentCity['PROPERTY_PHONES_VALUE'])): ?>
            <a href="tel: <?= $currentCity['PROPERTY_PHONES_VALUE'][0]?>" class="phone__link"><?= $currentCity['PROPERTY_PHONES_VALUE'][0]?></a>
        <? endif ?>
    </div>

    <div class="confirm-city-list" style="display:none;">

        <? if (!City::cityConfirm()): ?>

            <ul class="city_list" id="city_list" style="display:none;">

                <? foreach ($cities as $city): ?>

                    <? $href = $APPLICATION->GetCurPageParam('chcity=' . $city['ID'], ['chcity']) ?>

                    <li>
                        <a href="<?=$href?>"><?=$city['NAME']?></a>
                    </li>

                <? endforeach ?>

            </ul>

            <div id="geo_confirm2" style="display: block;">
                <div class="inner-shadow"></div>
                <div class="close j-close"></div>
                <p><?=Loc::getMessage('YOUR_CITY')?> <b class="name"><?=$currentCity['NAME']?></b>? </p>
                <a class="button_red confirm-btn" href="<?=$currentCityHref?>"><?=Loc::getMessage('YES')?></a>
                <a href="#city_list2" class=" fancybox choise_other_city"><?=Loc::getMessage('CHANGE_CITY')?></a>
            </div>

        <? endif ?>

    </div>

</div>