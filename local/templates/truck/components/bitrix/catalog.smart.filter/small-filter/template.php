<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
	die();
}

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

$this->setFrameMode(true);

$data     = $arResult['data'];
$objectId = $data['objectId'];
$btnSetFilterId = ($arParams["BTN_SET_FILTER_ID"] != "")?$arParams["BTN_SET_FILTER_ID"]:'set_filter';
?>
<div class="towarselect">

	<?php if ($data['filter_title']): ?>
		<p class="caption">
			<?= $data['filter_title'] ?> <i class="fas fa-sort-down"></i>
		</p>
	<?php endif ?>

	<form name="<?= $arParams["FILTER_NAME"] . "_form"?>" action="<?= $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter">
		<input type="hidden" name="param_ajax" value="Y">
		<input type="hidden" name="filterName" value="<?=$arParams["FILTER_NAME"]?>">
		<? foreach ($arResult["HIDDEN"] as $arItem): ?>
			<input
				type="hidden"
				name="<?= $arItem["CONTROL_NAME"]?>"
				id="<?= $arItem["CONTROL_ID"]?>"
				value="<?= $arItem["HTML_VALUE"]?>"
			>

		<? endforeach ?>

		<?

		//not prices
		foreach($arResult["ITEMS"] as $key=>$arItem) {

			if (
				empty($arItem["VALUES"])
				|| isset($arItem["PRICE"])
			) {
				continue;
			}

			if (
				$arItem["DISPLAY_TYPE"] == "A"
				&& (
					$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
				)
			) {
				continue;
			}

			$arItem["DISPLAY_TYPE"] = 'P';
			$arCur = current($arItem["VALUES"]);

			$checkedItemExist = false;
			?>

			<div class="select-drop-container">
				<select
					class="select-drop"
					name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
					id="<?= $arCur["CONTROL_NAME_ALT"] ?>"
					onchange="<?= $objectId ?>.keyup(this);"
				>

					<option value=""><?= $arItem["NAME"] ?></option>

					<?php foreach ($arItem['VALUES'] as $val => $ar): ?>
						<option
							value="<?= $ar["HTML_VALUE_ALT"] ?>"
						><?= $ar['VALUE'] ?></option>
					<?php endforeach ?>

				</select>
			</div>
		<?
		}
		?>

		<button class="btn1" id="<?=$btnSetFilterId?>"><?= 'Подобрать' ?></button>

		<div class="link">
			<a href="/catalog/">Смотреть весь каталог <i class="fas fa-angle-double-right"></i></a>
		</div>

	</form>
</div>

<script type="text/javascript">
	var <?= $objectId ?> = new JCSmartFilter(
		'<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>',
		'<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>',
		<?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>,
		'<?=$btnSetFilterId?>'
	);
</script>