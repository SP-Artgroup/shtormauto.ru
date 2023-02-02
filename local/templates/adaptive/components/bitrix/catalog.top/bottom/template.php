<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->addExternalCss(SITE_TEMPLATE_PATH . '/css/lightslider.css');
$this->addExternalJs(SITE_TEMPLATE_PATH . "/js/lightslider.js");

$frame = $this->createFrame()->begin();

if ( !empty($arResult['ITEMS']))
{
?>
	<div class="catalog-section catalog_section_new hidmobile viewed_products">
	<div class="catalog-new_head">Вас также может заинтересовать</div>

		<ul id="slider">

		<? foreach ($arResult['ITEMS'] as $arItem) { ?>
		<li>
			<div class="catalog-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

				<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
					<div class="img-wrap">

						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arElement["NAME"]?>">
						</a>
						<br />
					</div>
				<?else:?>
					<div class="img-wrap">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<img style="max-height:105px;" border="0" src="<?=SITE_TEMPLATE_PATH?>/images/no_image.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
					<br />
					</div>
				<?endif?>

				<a class="product_viewed_name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=TruncateText($arItem['NAME'], 50)?></a><br>
					<span class="catalog-price"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></span>

				<div class="browse_but2">
					<button type="button" class="button pokupka action_ajax" href="/local/ajax/action.php?action=add_to_basket&product_id=<?=$arItem['ID']?>" onclick="javascript:send_in_cart('<?=$this->GetEditAreaId($arItem['ID']);?>')" >
						<span>Купить</span>
					</button>
				</div>
			</div>
		</li>
		<? } ?>
		</ul>
	</div>
	<div style="clear: both;"></div>
<? } ?>