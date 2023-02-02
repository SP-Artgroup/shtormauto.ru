<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$section     = $arResult['SECTION'];
$sectionPath = implode('/', array_column($section['PATH'], 'NAME'));
$price       = $arResult['CURRENT_PRICE'];
$canBuy      = $arResult['CAN_BUY'] && !empty($price);

$strAvailableCities = $arResult['AVAILABLE_CITIES_STRING'];
$templateData = [
	'MODEL' => $arResult['PROPERTIES']['MODEL']['VALUE'],
];

$mark = "";
if ($arResult['PROPERTIES']['NEWITEM']['VALUE_XML_ID'] == "Y"){
	$mark = "product-marks--new";
}
if ($arResult['PROPERTIES']['HITITEM']['VALUE_XML_ID'] == "Y"){
	$mark = "product-marks--hit";
}

?>
<div class="product-detail" itemscope itemtype=http://schema.org/Product>
	<div class="row">
		<div class="col-md-6">
			<div class="product-detail-image product-marks">
				<div class="<?=$mark;?>"></div>
				<div class="sticker-buy-credit">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"named_area",
						Array(
							"AREA_FILE_SHOW" => "file",
							"NAME" => "Изменить логотип",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/sticker_credit.php"
						)
					);?>
				</div>	
				<div class="blocks">           
					<?if($arResult['EX_GUARANT'] == 'Y'):?>
						<div class="show-block btn"><span>расширенная гарантия</span></div>
					<?endif?>
					<?if($arResult['FREE_REPAIR'] == 'Y'):?>
						<div class="show-block btn"><span>бесплантый шиномонтаж</span></div>
					<?endif?>
				</div>
				<? if (is_array($arResult["PREVIEW_PICTURE"])): ?>
					<a rel="photos" href="<?=$arResult['DETAIL_PICTURE']["SRC"]?>">
						<img
							itemprop="image"
							src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>"
							alt="<?=$arResult["NAME"]?>"
							title="<?=$arResult["NAME"]?>"
						>
					</a>
				<? else: ?>
					<img
						itemprop="image"
						src="<?=$templateFolder?>/images/PP.png"
						alt=""
					>
				<? endif ?>
			</div>

			<div class="advert-banner-horizontal d-none d-xl-block">
			   <?$APPLICATION->IncludeComponent(
					"bitrix:advertising.banner",
					".default",
					array(
						"CACHE_TIME" => "0",
						"CACHE_TYPE" => "A",
						"NOINDEX" => "Y",
						"QUANTITY" => "3",
						"TYPE" => "in_product_banner",
						"COMPONENT_TEMPLATE" => ".default"
					),
					false
				);?>
			</div>

			<div class="product-detail-props product-detail-props--separate d-none d-md-block d-xl-none">
				<h3 class="product-detail-props__heading">Характеристики</h3>
				<div class="product-detail-props__list">
				<? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
					<div class="product-detail-props__item">
						<div class="product-detail-props__name"><?=$arProperty["NAME"]?>:</div>&nbsp;<?
						if (!empty($arProperty["DISPLAY_VALUE"])):?>
						<div class="product-detail-props__value"><?=$arProperty["DISPLAY_VALUE"];?></div>
						<? endif ?>
					</div>
				<? endforeach ?>
				</div>
			</div>
		</div>

		<div class="col-md-6">

			<div class="product-detail-meta">
				<?
				$iSezon = "";
				switch ($arResult["PROPERTIES"]["SEZONNOST"]["VALUE_XML_ID"]){
					case ("8f7f0dc2-59a2-11e4-ae29-002191f46f07") :
						$iSezon = "icon i-summer";
						break;
					case ("cd21ed25-58af-11e4-ae29-002191f46f07"):
						$iSezon = "icon i-winter";
						break;
				};
				?>

				<h3 class="product-detail-meta__name"><?=$arResult["NAME"]?> <?if (!empty($iSezon)){?><i class="<?=$iSezon?>"></i><?}?></h3>

				<div class="product-detail-meta__description">
					<?= $arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT'];?>
				</div>

				<div class="product-detail-props d-none d-xl-block">
					<div class="product-detail-props__list">
					<? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
						<div class="product-detail-props__item">
							<div class="product-detail-props__name"><?=$arProperty["NAME"]?>:</div>&nbsp;<?
							if (!empty($arProperty["DISPLAY_VALUE"])):?>
							<div class="product-detail-props__value"><?=$arProperty["DISPLAY_VALUE"];?></div>
							<? endif ?>
						</div>
					<? endforeach ?>
					</div>
				</div>

				<?php if ($canBuy): ?>
					<div class="product-detail-price-counter">
							<div class="product-detail-price" itemscope itemtype="http://schema.org/Offer">
								<? if ($price["DISCOUNT"]): ?>
								<s><?= '&#8381;'.(int)$price["BASE_PRICE"] ?></s>
								<? endif ?>
								<span><?= '&#8381;'.(int)$price["PRICE"] ?></span>
								<?/* For SEO */?>
								<span itemprop="price" style="display: none;"><?= '&#8381;'.(int)$price["PRICE"] ?></span>

							</div>
						<div class="counter">
							<button type="button" class="btn counter__minus">-</button>
							<input type="number" value="0" class="counter__input">
							<button type="button" class="btn counter__plus">+</button>
						</div>
					</div>
				<?php endif ?>

				<div class="product-detail-availability">
					<?php if ($strAvailableCities): ?>
						<div class="product-detail-availability__status">В наличии:</div>
						<div class="product-detail-availability__city"><?=$strAvailableCities?></div>
					<?php endif ?>
				</div>

				<?php if ($canBuy): ?>
					<div class="product-detail-buy">
						<div class="catalog-element-store-list">
							<?$APPLICATION->IncludeComponent(
								"sp-artgroup:store.list",
								"new",
								[
									"PRODUCT_ID" => $arResult['ID'],
								],
								$component
							);?>
						</div>
						<button
							type="button"
							class="btn btn-dark button pokupka js-buy-btn"
							rel="<?=$arResult['ID']?>"
						>
							<span>Купить</span>
						</button>
					</div>
				<?php endif ?>

				<?php if (!$canBuy): ?>
					<span class="product-not-available">Товара нет в наличии</span>
				<?php endif ?>
			</div>

			<div class="product-detail-props product-detail-props--separate d-block d-md-none">
				<h3 class="product-detail-props__heading">Характеристики</h3>
				<div class="product-detail-props__list">
					<? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
						<div class="product-detail-props__item">
							<div class="product-detail-props__name"><?=$arProperty["NAME"]?>:</div>&nbsp;<?
							if (!empty($arProperty["DISPLAY_VALUE"])):?>
							<div class="product-detail-props__value"><?=$arProperty["DISPLAY_VALUE"];?></div>
							<? endif ?>
						</div>
					<? endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.dataLayer = window.dataLayer || [];
	window.dataLayer.push({
		"ecommerce": {
			"detail": {
				"products": [
					{
						"id": "<?= $arResult['ID'] ?>",
						"name" : "<?= $arResult['NAME'] ?>",
						"price": <?= $price["PRICE"] ?>,
						"brand": "<?= (!empty($arResult['PROPERTIES']['BREND']['VALUE']) ? $arResult['PROPERTIES']['BREND']['VALUE'] : '') ?>",
						"category": "<?= $sectionPath ?>"
					}
				]
			}
		}
	});
var elementData = <?= CUtil::PhpToJsObject($arResult['JS_DATA']) ?>;
</script>

