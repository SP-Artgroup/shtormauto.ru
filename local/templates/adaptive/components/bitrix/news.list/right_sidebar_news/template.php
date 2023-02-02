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

$this->setFrameMode(true);

$hermitage = [
	'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
	'DELETE'  => CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'),
	'CONFIRM' => ['CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')],
];
?>
<div class="catalog-section-new news_list sidebar-news-list">
	<div class="catalog-new-head"><?=Loc::getMessage('LATEST_NEW')?></div>

		<? foreach ($arResult["ITEMS"] as $arItem): ?>

			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $hermitage['EDIT']);
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $hermitage['DELETE'], $hermitage['CONFIRM']);

			$prevPict = $arItem['PREVIEW_PICTURE'];
			$resImg = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], Array("width"=>70,"height"=>70), false);
			?>

			<div class="catalog-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

				<div class="new-items-img-block">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
						<img
							class="small-img-border"
							src="<?=$resImg['src']?>"
							alt="<?=$prevPict['ALT']?>"
							title="<?=$prevPict['TITLE']?>"
						>
					</a>
				</div>

				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a>

				<div class="new-items-info-block">

					<br><?=$arItem["PREVIEW_TEXT"]?><br>
					<a href="<?=SITE_DIR?>news/" class="show_all_news" title="Новости"><?=Loc::getMessage('GO_TO_ALL_NEWS')?></a>

				</div>

				<div style="clear: both;"></div>

			</div>

		<? endforeach ?>

	<div style="clear:both"></div>
</div>