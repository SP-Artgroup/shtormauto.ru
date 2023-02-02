<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$shops            = $arResult['SHOPS'];
$jsonShops        = $arResult['SHOPS_TO_JSON'];
$cities           = $arResult['CITIES'];
$shopId           = $arResult['SHOP_ID'];
$currentCityId    = $shopId ? $jsonShops[$shopId]['CITY'] : $arResult['CURRENT_CITY_ID'];
$selectedCity     = $currentCityId ? $arResult['CITIES'][$currentCityId] : 'Выберите город:';
$selectedCityName = $arResult['CITIES'][$currentCityId];
$personType       = $arResult['ORDER_DATA']['PERSON_TYPE_ID'];
$shopId           = $shopId ?: $shops[$selectedCity][0]['ID'];

// $orderPropIds = [
// 	1 => [
// 		'SHOP' => 20,
// 		'OTHER_CITY' => 26,
// 	],
// 	2 => [
// 		'SHOP' => 21,
// 		'OTHER_CITY' => 27,
// 	],
// ];

// $orderProps = [];

// foreach ($orderPropIds[$personType] as $propCode => $propId) {
// 	$orderProps[$propCode] = $arResult['ORDER_PROP']['USER_PROPS_N'][$propId];
// }

// Свойства "Магазин" и "Город" для разных типов плательщиков
$orderProps = [
	[
		'name'  => 'ORDER_PROP_20',
		'class' => 'order_prop_shop',
		'value' => $shopId,
	],
	[
		'name'  => 'ORDER_PROP_21',
		'class' => 'order_prop_shop',
		'value' => $shopId,
	],
	[
		'name'  => 'SHOP_ID',
		'class' => 'order_prop_shop',
		'value' => $shopId,
	],
	[
		'name'  => 'ORDER_PROP_5',
		'class' => 'order_prop_city',
		'value' => $selectedCityName,
	],
	[
		'name'  => 'ORDER_PROP_17',
		'class' => 'order_prop_city',
		'value' => $selectedCityName,
	],
	[
		'name'  => 'CITY_NAME',
		'class' => 'order_prop_city',
		'value' => $selectedCityName,
	],
]
?>
<div class="form-block map">

	<div class="form-block__title">Пункт доставки</div>

	<div class="form-block__content">

		<?php foreach ($orderProps as $prop): ?>
			<input
				class="<?= $prop['class'] ?>"
				type="hidden"
				value="<?= $prop['value'] ?>"
				name="<?= $prop['name'] ?>"
				id="<?= $prop['name'] ?>"
			>
		<?php endforeach ?>

		<div class="select-box">
			<div class="select-box__item select-drop-magazine">
				<select class="select-drop js-city-select" name="" id="">
					<? foreach ($arResult['CITIES'] as $cityName): ?>
						<option
							value="<?= $cityName ?>"
							<?php if ($cityName === $selectedCityName): ?>
								selected
							<?php endif ?>
						><?= $cityName ?></option>
					<? endforeach ?>
				</select>
				<input type="hidden" value="<?= $currentCityId ?: '' ?>">
			</div>

			<div class="select-box__item select-drop-magazine">
				<select class="select-drop js-shop-select" name="" id="">
					<?php foreach ($arResult['SHOPS'][$selectedCityName] as $shop): ?>
						<option
							value="<?= $shop['ID'] ?>"
						><?= $shop['NAME'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

		<div class="map">
			<div id="map" style="width:100%;height:250px;"></div>
		</div>

		<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>">

	</div>

</div>

