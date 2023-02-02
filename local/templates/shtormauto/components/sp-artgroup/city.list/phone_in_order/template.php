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

    <span class="phones">
        <? if (!empty($currentCity['PROPERTY_PHONES_VALUE'])): ?>

            <?=$currentCity['PROPERTY_PHONES_VALUE'][0]?>

        <? endif ?>
    </span>

</div>