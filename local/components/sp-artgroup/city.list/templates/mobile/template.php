<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$this->createFrame()->begin('Загрузка');

$currentCity = $arResult['CURRENT'];
$href = $APPLICATION->GetCurPageParam('chcity=' . $currentCity['ID'] . '&city_changed=1', ['chcity']);
?>
<div id="choose-city-block">
    <div class="choose-city-form">
        <div class="choose-city-caption"><?=Loc::getMessage('CITY_LIST_LOCATIION')?></div>
        <div class="choose-city-guess"><?=Loc::getMessage('CITY_LIST_YOUR_CITY') . ' ' . $currentCity['NAME']?>?</div>
        <a class="choose-city-yes adpt-btn-red" href="<?=$href?>"><?=Loc::getMessage('CITY_LIST_YES')?></a>
        <a class="choose-city-another" href="/mobile_app/change_city.php"><?=Loc::getMessage('CITY_LIST_CHOOSE_ANOTHER_CITY')?></a>
    </div>
</div>