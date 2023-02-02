<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<div class="filters all_address">
<h4>Магазины и сервисы</h4>
    <?foreach($arResult["ITEMS"] as $item):?>
        <div>
            <span class="title">Магазин «Штормавто»</span>
            <span>г.<?=$item['NAME']?>, <?=$item['DESCRIPTION']?></span>
            <span>Телефон: <?=$item['VALUE']?></span>
        </div>
    <?endforeach;?>
</div>

