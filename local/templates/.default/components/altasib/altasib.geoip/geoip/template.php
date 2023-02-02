<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->createFrame()->begin("Загрузка");?>

<?if($arResult["city"]){?>
<span class="notetext curcity">
	<?$rsCity = CIBlockElement::GetList(array("name"=>"asc"),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y"),false,false,array("ID","NAME"));?>
	<div class="morecity">
		<?while($arCity = $rsCity->Fetch()){$j++;?>
			<div class="morecity_item" <?if($j>1){?>style="border-top:solid 1px #fff;"<?}?>>
				<span onclick="window.location='<?=$APPLICATION->GetCurPageParam("chcity=".$arCity["ID"],array("chcity"))?>'" class="choose-city"><?=$arCity["NAME"]?></span>
			</div>
		<?}?>
	</div>
	<?=$arResult["city"]?></span>&nbsp;|&nbsp;
	<?foreach($arResult["phones"] as $key => $phone){?>
		<?if($key>0){?>, <?}?><?=$phone?>
	<?}?>
<?}?>


<?
if(
	1
	&& !CCity::cityConfirm()
)
{

	$cities	= CCity::GetCityList();
	$arCity	= CCity::DetectCityByIp();
	?>

	<? if(!is_array($arCity)){?>
	<?	$arCity['ID'] = '55252';
		$arCity['NAME'] = $arResult["city"];?>
		<div style="display:none"><?dump($arCity);?></div>
	<?}?>

	<ul class="city_list" id="city_list" style="display:none;">
		<? foreach($cities as $city) { ?>
			<li >
				<span onclick="window.location='<?=$APPLICATION->GetCurPageParam("chcity=".$city["ID"],array("chcity"))?>'"><?=$city['NAME']?></span>
			</li>
		<? } ?>
	</ul>

	<div id="geo_confirm" style="display: block;">

	    <div class="inner-shadow"></div>

	    <div class="close j-close"></div>

			<p><?=GetMessage('YOUR_CITY')?> <b class="name"><?=$arCity['NAME']?></b>? </p>
			<span onclick="window.location='<?=$APPLICATION->GetCurPageParam("chcity=".$arCity["ID"],array("chcity"))?>'" class="button_red confirm-btn"><?=GetMessage('YES')?></span>

	    <a href="#city_list" class=" fancybox choise_other_city"><?=GetMessage('CHANGE_CITY')?></a>
	</div>
<?
}
?>