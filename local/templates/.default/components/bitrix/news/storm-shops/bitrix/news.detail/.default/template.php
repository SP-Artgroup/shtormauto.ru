<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$propCity = $arResult['DISPLAY_PROPERTIES']['CITY'];

$city = !empty($propCity['VALUE'])
    ? $propCity['LINK_ELEMENT_VALUE'][$propCity['VALUE']]['NAME']
    : '';

$templateData = [
    'CITY' => $city,
];
?>
<script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>

<?if(is_array($arResult["DISPLAY_PROPERTIES"]["LOCATION"])):?>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap,
        myPlacemark;
    function init(){
        myMap = new ymaps.Map ("shopLocation", {
            center: [<?=$arResult["DISPLAY_PROPERTIES"]["LOCATION"]["VALUE"]?>],
            zoom: 16,
            behaviors: ['drag', 'scrollZoom'],
        });
        myPlacemark = new ymaps.Placemark([<?=$arResult["DISPLAY_PROPERTIES"]["LOCATION"]["VALUE"]?>], {
            hintContent: '<?=$arResult["NAME"]?>',
            balloonContent: ''
        });
        myMap.geoObjects.add(myPlacemark);
    }
</script>
<?endif;?>
<div class="news-detail">

    <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
		<h1><?= '"' . $arResult['NAME'] . '" ' . $city ?></h1>
	<? endif ?>

    <?if(is_array($arResult["DISPLAY_PROPERTIES"]["LOCATION"])):?>
        <div class="map-wrap">
            <div style="width: 240px; height: 145px;" id="shopLocation"></div>

        </div>
    <?endif;?>
    <div class="ptitle"><?=$arResult["NAME"]?></div>
    <?if(is_array($arResult["DISPLAY_PROPERTIES"]["CONTACTS"])):?>
        <?=$arResult["DISPLAY_PROPERTIES"]["CONTACTS"]["DISPLAY_VALUE"]?>
    <?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
    <div style="clear: both;"></div>
    <div class="ptitle">О компании</div>
	<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif;?>
    <div style="clear: both;height: 10px;"></div>
<div class="gallery">
    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["PREVIEW_PICTURE"])):?>
        <div style="background: url('<?=$arResult["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;" class="img-wrap">
            <a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="big-img detail_picture" rel="photo"><img border="0" src="<?=$templateFolder?>/images/detail-img-wrap.png" width="460px" height="280px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
        </div>
	<?endif;?>
    <?foreach($arResult["PROPERTIES"]["PHOTO"]["IMAGES"] as $cell=>$photo):?>
        <div style="background: url('<?=$photo["PREVIEW"]["src"]?>') center center no-repeat;width: 110px;height: 90px;<?=($cell==0)?"margin-left: 0;":""?>" class="small-img-wrap">
            <a href="<?=$photo["DETAIL"]?>" class="big-img" rel="photo"><img border="0" src="<?=$templateFolder?>/images/small-news-img-wrap.png" width="110px" height="90px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
        </div>
    <?endforeach;?>
</div>
	<div style="clear:both"></div>
</div>