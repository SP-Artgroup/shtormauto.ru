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
	'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
	'CONFIRM' => ['CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')],
];

$cityName = SP\City::getCurrentCityName();

?>
<div class="shops-list">

	<? foreach ($arResult["ITEMS"] as $arItem): ?>

		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $hermitage['EDIT']);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $hermitage['DELETE'], $hermitage['CONFIRM']);

		$props   = $arItem['PROPERTIES'];
		$address = $props['ADDRESS']['VALUE'];
		?>

		<a
			class="shop-item"
			id="<?=$this->GetEditAreaId($arItem['ID'])?>"
			href="<?=$arItem["DETAIL_PAGE_URL"]?>"
			title="<?=$arItem['NAME']?>"
		><?= $cityName . ', ' . $address ?></a>

	<? endforeach ?>

</div>