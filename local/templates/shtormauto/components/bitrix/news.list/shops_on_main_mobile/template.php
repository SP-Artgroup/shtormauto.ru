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
use SP\City;
use Bitrix\Main\Localization\Loc;

$currentCity = City::getCurrentCityData();


$this->setFrameMode(true);
?>

<?if ($currentCity["ID"] == '506029' || $currentCity["ID"] == '560928'): 
    ?>
    <div class="catalog-main-exeption">
        <p>ПРИ ЗАКАЗЕ ЛЮБЫХ АВТОТОВАРОВ СО СКЛАДА ВЛАДИВОСТОКА - ДОСТАВКА БЕСПЛАТНО!</p>
        <p><a href="?chcity=55254">СДЕЛАТЬ ЗАКАЗ - ВЛАДИВОСТОК</a></p>
    </div>
<?endif ?>

<div class="d-md-none">
    <div class="filters all_address">
        <h4><?=GetMessage("SHOPS_ON_MAIN_TITLE")?></h4>
        <h5 class="sub_title"><?=$currentCity["NAME"]?></h5>


        <?foreach($arResult["ITEMS"] as $arItem):?>
					<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>    
					<div class="contacts-sidebar__meta">
							<div class="all_address__title">
								<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?>
							</div>
							<a href="#" data="<?=$arItem["PROPERTIES"]["LOCATION"]["VALUE"]?>" class="gps_link">
								Проложить маршрут
							</a>
							<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="detail_link">
								<?=$arItem["NAME"];?>
							</a>
							<?if ($arItem["PROPERTIES"]["ADDRESS"]["VALUE"]){?>
									<a class="number_btn" href="tel:<? echo($arItem["PROPERTIES"]["PHONE"]["VALUE"])?>">
											<?echo($arItem["PROPERTIES"]["PHONE"]["VALUE"])?>
									</a>
							<?}else{?>
									<span>
										<?=htmlspecialchars_decode($arItem["PROPERTIES"]["CONTACTS"]["VALUE"]["TEXT"]);?> 
									</span>
							<?}?>
					</div>
        <?endforeach;?>

    </div> 
		<div class="modal_view" id="address_view">
			<div class="cancel"></div>
			<div class="modal__body">
				<div class="select-navigation__title">
					Проложить маршрут
				</div>
				<div class="select-navigation__address">
					Москва, Сколковское ш., д. 31, стр. 9 (БошАвтоСервис)
				</div>
				<ul class="select-navigation__buttons">
					<li class="select-navigation__item">
						<a id="y_link" href="yandexnavi://build_route_on_map?lat_to=55.705877&amp;lon_to=37.405703" target="_blank">
							<i class="yandex_map__icon location_icon"></i>
							Яндекс Навигатор
						</a>
					</li>
					<li class="select-navigation__item">
						<a id="g_link" href="http://maps.apple.com/?daddr=55.705877,37.405703&dirflg=d" target="_blank" class="select-navigation__link kd-btn kd-btn_border_gray">
							<i class="google_map__icon location_icon"></i>
							Google Карты
						</a>
					</li>
					<li class="select-navigation__item">
						<a id="two_link" href="dgis://2gis.ru/routeSearch/rsType/car/to/37.405703,55.705877" target="_blank" class="select-navigation__link kd-btn kd-btn_border_gray">
							<i class="two_gis_map__icon location_icon"></i>
							Карты
						</a>
					</li>
				</ul>
				<p class="select-navigation__hint">После открытия карты установите начальную точку маршрута, для его построения</p>
			</div>
		</div>
</div>

