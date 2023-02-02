<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;

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
<div class="product-detail" itemscope itemtype="http://schema.org/Product">
	<div class="row">
		<div class="col-md-6">
			<div class="product-detail-image product-marks <?=((($arResult['EX_GUARANT'] == 'Y' || $arResult['FREE_REPAIR'] == 'Y'|| $arResult['UF_BRIDGESTONE'] == 'Y'|| $arResult['UF_UNCONDITIONAL_GUARANT'] == 'Y') && count($arResult["MORE_PHOTO"]) > 1) || ($arResult['EX_GUARANT'] == 'Y' || $arResult['FREE_REPAIR'] == 'Y'|| $arResult['UF_BRIDGESTONE'] == 'Y'|| $arResult['UF_UNCONDITIONAL_GUARANT'] == 'Y') && count($arResult["ADDITIONAL_PHOTOS"]) > 0)?'big-bottom':''?>">
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
					<?if($arResult['UF_BRIDGESTONE'] == 'Y'):?>
						<!-- <div class="show-block btn"><span>двойная гарантия Bridgestone</span></div> -->
					<?endif?>
					<?if($arResult['UF_UNCONDITIONAL_GUARANT'] == 'Y'):?>
						<div class="show-block btn"><a style="color: red;" href="https://shtormauto.ru/news/besplatnyy_shinomontazh_cordiant22/" target="_blank"><span>безусловная гарантия</span></a></div>
					<?endif?>
				</div>
				
				<? if($arResult['DETAIL_PICTURE']["SRC"] != "" || count($arResult["MORE_PHOTO"]) > 1):?>
					<div class="product-detail-image-container">
						<? if(count($arResult["MORE_PHOTO"]) > 1):?>
							<div class="labels-container-box">
								<div class="labels-container">
									<?if($arResult['PROPERTIES']['TIRE_LONG_LIVER']['VALUE_XML_ID'] == 'Y'):?>
										<img class="label triangle" src="/local/templates/shtormauto/images/label/shina_dolgozhitel.png" alt="Шина долгожитель">
									<?endif?>
									<?if($arResult['UF_BRIDGESTONE'] == 'Y'):?>
										<img class="label" src="/local/templates/shtormauto/images/label/5_year_warranty_mini.png" alt="Двойная гарантия Bridgestone">
									<?endif?>
									<?if($arResult['PROPERTIES']['BRAND_N1_IN_RUSSIA']['VALUE_XML_ID'] == 'Y'):?>
										<img class="label" src="/local/templates/shtormauto/images/label/marka_1.png" alt="Марка №1 России">
									<?endif?>
								</div>
								<div class="product-detail-slider">
									<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" rel="photos" data-fancybox="images">
										<img
											itemprop="image"
											src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>"
											alt="<?=$arResult["NAME"]?>"
											title="<?=$arResult["NAME"]?>"
										>
									</a>
									<? foreach ($arResult["MORE_PHOTO"] as $x => $value) :?>
										<a href="<?=$value["SRC"]?>" rel="photos" data-fancybox="images">
											<img
												src="<?=$value["SRC"]?>"
												alt="<?=$arResult["NAME"]?>, фото <?=$x+1?>"
												title="<?=$arResult["NAME"]?>, фото <?=$x+1?>"
											>
										</a>
									<?endforeach;?>
									<? foreach ($arResult["ADDITIONAL_PHOTOS"] as $x => $src) :?>
										<a href="<?=$src?>" rel="photos" data-fancybox="images">
											<img
												src="<?=$src?>"
												alt="<?=$arResult["NAME"]?>, фото <?=$x+1?>"
												title="<?=$arResult["NAME"]?>, фото <?=$x+1?>"
											>
										</a>
									<?endforeach;?>
								</div>
							</div>
						<? elseif(count($arResult["ADDITIONAL_PHOTOS"]) > 0):?>
							<div class="labels-container-box">
								<div class="labels-container">
									<?if($arResult['PROPERTIES']['TIRE_LONG_LIVER']['VALUE_XML_ID'] == 'Y'):?>
										<img class="label triangle" src="/local/templates/shtormauto/images/label/shina_dolgozhitel.png" alt="Шина долгожитель">
									<?endif?>
									<?if($arResult['UF_BRIDGESTONE'] == 'Y'):?>
										<img class="label" src="/local/templates/shtormauto/images/label/5_year_warranty_mini.png" alt="Двойная гарантия Bridgestone">
									<?endif?>
									<?if($arResult['PROPERTIES']['BRAND_N1_IN_RUSSIA']['VALUE_XML_ID'] == 'Y'):?>
										<img class="label" src="/local/templates/shtormauto/images/label/marka_1.png" alt="Марка №1 России">
									<?endif?>
								</div>

								<div class="product-detail-slider">
									<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" rel="photos" data-fancybox>
										<img
											itemprop="image"
											src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>"
											alt="<?=$arResult["NAME"]?>"
											title="<?=$arResult["NAME"]?>"
										>
									</a>
									<? foreach ($arResult["ADDITIONAL_PHOTOS"] as $x => $src) :?>
										<a href="<?=$src?>" rel="photos" data-fancybox="images">
											<img
												src="<?=$src?>"
												alt="<?=$arResult["NAME"]?>, фото <?=$x+1?>"
												title="<?=$arResult["NAME"]?>, фото <?=$x+1?>"
											>
										</a>
									<?endforeach;?>
								</div>
							</div>
						<? else:?>
							<div class="product-detail-img">
								<div class="labels-container">
									<?if($arResult['PROPERTIES']['TIRE_LONG_LIVER']['VALUE_XML_ID'] == 'Y'):?>
										<img class="label triangle" src="/local/templates/shtormauto/images/label/shina_dolgozhitel.png" alt="Шина долгожитель">
									<?endif?>
									<?if($arResult['UF_BRIDGESTONE'] == 'Y'):?>
										<img class="label" src="/local/templates/shtormauto/images/label/5_year_warranty_mini.png" alt="Двойная гарантия Bridgestone">
									<?endif?>
									<?if($arResult['PROPERTIES']['BRAND_N1_IN_RUSSIA']['VALUE_XML_ID'] == 'Y'):?>
										<img class="label" src="/local/templates/shtormauto/images/label/marka_1.png" alt="Марка №1 России">
									<?endif?>
								</div>
								<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" rel="photos" data-fancybox>
									<img
										itemprop="image"
										src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>"
										alt="<?=$arResult["NAME"]?>"
										title="<?=$arResult["NAME"]?>"
									>
								</a>
							</div>
						<? endif;?>	
					</div>
				<? endif;?>
			</div>

			<!-- <div class="advert-banner-horizontal d-none d-xl-block">
				<?/*$APPLICATION->IncludeComponent(
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
				);*/?>
			</div> -->

			<!-- <div class="product-detail-props product-detail-props--separate d-none d-md-block d-xl-none">
				<h3 class="product-detail-props__heading">Характеристики</h3>
				<div class="product-detail-props__list">
				<?/* foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
					<div class="product-detail-props__item">
						<div class="product-detail-props__name"><?=$arProperty["NAME"]?>:</div>&nbsp;<?
						if (!empty($arProperty["DISPLAY_VALUE"])):?>
						<div class="product-detail-props__value"><?=$arProperty["DISPLAY_VALUE"];?></div>
						<? endif ?>
					</div>
				<? endforeach */?>
				</div>
			</div> -->
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

				<h3 class="product-detail-meta__name characteristics"><?=$arResult["NAME"]?> <?if (!empty($iSezon)){?><i class="<?=$iSezon?>"></i><?}?></h3>

				<?if(!empty($arResult["PROPERTIES"]["ICON"]["VALUE"])):?>
					<div class="block_tempary_icons d-flex flex-wrap justify-content-between alignt-items-center">
					<? foreach ($arResult["PROPERTIES"]["ICON"]["VALUE"] as $key => $value) {?>
						<<?=($arResult["ICON"][$value]["PROPERTY_LINK_VALUE"] != '')?'a href="'.$arResult["ICON"][$value]["PROPERTY_LINK_VALUE"].'"':'div'?> class="tempary_icon">
							<img src="<?=$arResult["ICON"][$value]["PICTURE"]["SRC"]?>" />
						</<?=($arResult["ICON"][$value]["PROPERTY_LINK_VALUE"] != '')?'a':'div'?>>
					<?}?>
					</div>
				<?endif;?>

				
				

				
				<? if ($canBuy || $arResult["SHOW_PRICE"] == 'Y'): ?>
					<div class="product-detail-price-counter">
						<? if ($canBuy || $arResult["SHOW_PRICE"] == 'Y'): ?>
							<div class="product-detail-price" itemscope itemtype="http://schema.org/Offer">
								<? if ($price["DISCOUNT"]): ?>
								<s><?= '&#8381;'.(int)$price["BASE_PRICE"] ?></s>
								<? endif ?>
								<span><?=$price["PRICE"] . Loc::getMessage('RUB');?></span>
								<?/* For SEO */?>
								<span itemprop="price" style="display: none;"><?= '&#8381;'.(int)$price["PRICE"] ?></span>
							</div>
						<?endif;?>
						<? if ($canBuy): ?>
							<div class="counter">
								<button type="button" class="btn counter__minus">-</button>
								<input type="number" value="1" class="counter__input">
								<button type="button" class="btn counter__plus">+</button>
							</div>
						<?endif;?>	
					</div>
				<?php endif ?>

				<? if (!$canBuy): ?>
					<div class="product-not-available"><strong>В выбранном городе данный товар отсутствует!</strong></div>
				<? endif ?>	
				<? if($strAvailableCities && !$arResult["CAN_BUY"]):?>	
					<div class="product-not-available scarlet"><strong>Доставка от 3-х дней</strong></div>
				<? endif ?>

				<?php if ($strAvailableCities && !$arResult["CAN_BUY"]): ?>
					<div class="product-detail-availability characteristics">
						<div class="product-detail-availability__status">В наличии:</div>
						<div class="product-detail-availability__city"><?=$strAvailableCities?></div>
					</div>
				<?php endif ?>

				<? if ($canBuy): ?>
					<div class="product-detail-buy">
						<button
							type="button"
							class="btn btn-dark button pokupka js-buy-btn"
							rel="<?=$arResult['ID']?>"
							data-max-amount="<?=$arResult["MAX_QUANTITY_CITY"]?>"
						>
							<span>Купить</span>
						</button>
					</div>
				<? endif ?>

            <?if ($price["PRICE_WITH_EXCHANGE"]):?>
                <div class="price-with-exchange">
                    <span class="price-with-exchange__price"><?=$price["PRICE_WITH_EXCHANGE"] . Loc::getMessage('RUB')?></span>
                    <span><?=Loc::getMessage('PRICE_HANDING_OVER_OLD');?></span>
                </div>
            <?endif;?>

				
			</div>

			<!-- <div class="product-detail-props product-detail-props--separate d-block d-md-none">
				<h3 class="product-detail-props__heading">Характеристики</h3>
				<div class="product-detail-props__list">
					<?/* foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
						<div class="product-detail-props__item">
							<div class="product-detail-props__name"><?=$arProperty["NAME"]?>:</div>&nbsp;<?
							if (!empty($arProperty["DISPLAY_VALUE"])):?>
							<div class="product-detail-props__value"><?=$arProperty["DISPLAY_VALUE"];?></div>
							<? endif ?>
						</div>
					<? endforeach */?>
				</div>
			</div> -->
		</div>


		<div class="description-buttons-container">
			<div class="description-button active" id="characteristics-button">Характеристики</div>
			<?if (!empty($arResult["DESCRIPTION_FILE"]) && $arResult["DESCRIPTION_FILE"] != ''):?>
				<div class="description-button" id="review-button">Обзор</div>
			<?endif?>
			<?if (!empty($arResult["VIDEO"]) && $arResult["VIDEO"] != ''):?>
				<div class="description-button" id="video-button">Видео</div>
			<?endif?>
		</div>

		
		<div class="product-detail-meta description">
			<div class="characteristics-container">
				<div class="product-detail-meta__description">
					<?= $arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT'];?>
				</div>
				<div class="product-detail-props col-sm-12 col-md-6">
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

			<div class="review-container">

				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
					array(
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => SITE_DIR."include/models/".$arResult["DESCRIPTION_FILE"],
						"AREA_FILE_SHOW" => "file",
						"UF_BRIDGESTONE" => $arResult['UF_BRIDGESTONE'],
					),
					false
				);?>
				
			</div>

			<div class="video-container">
				<?foreach($arResult["VIDEO"] as $link):?>
					<iframe 
						width="560" 
						height="315" 
						src="https://www.youtube.com/embed/<?=$link?>" 
						frameborder="0"
					>
					</iframe>
				<?endforeach?>
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
						"price": <?=($price["PRICE"] != "")?$price["PRICE"]:"0"?>,
						"brand": "<?= (!empty($arResult['PROPERTIES']['BREND']['VALUE']) ? $arResult['PROPERTIES']['BREND']['VALUE'] : '') ?>",
						"category": "<?= $sectionPath ?>"
					}
				]
			}
		}
	});
var elementData = <?= CUtil::PhpToJsObject($arResult['JS_DATA']) ?>;
</script>