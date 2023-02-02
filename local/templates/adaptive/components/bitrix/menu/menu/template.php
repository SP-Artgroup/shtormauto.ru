<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="menu-main-menu" class="menu">

<?
$previousLevel = 0;

foreach ($arResult as $arItem): ?>

	<?
	$itemClass     = $arItem['SELECTED'] ? 'item-selected' : '';
	$rootItemClass = $arItem['SELECTED'] ? 'root-item-selected' : 'root-item';
	?>

	<? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]))?>
	<? endif ?>

	<? if ($arItem["IS_PARENT"]): ?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="menu-item-has-children">
				<a href="<?=$arItem["LINK"]?>" class="<?=$rootItemClass?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>

				<ul class="sub-menu">
		<?else:?>
			<li class="<?=$itemClass?>">
				<a href="<?=$arItem["LINK"]?>" class="parent" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<? else: ?>

		<? if ($arItem["PERMISSION"] > "D"): ?>

			<? if ($arItem["DEPTH_LEVEL"] == 1): ?>
				<li>
					<a href="<?=$arItem["LINK"]?>" class="<?=$rootItemClass?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
				</li>
			<? else: ?>
				<li class="<?=$itemClass?>">
					<a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
				</li>
			<? endif ?>

		<? else: ?>

			<? if ($arItem["DEPTH_LEVEL"] == 1): ?>
				<li>
					<a href="" class="<?=$rootItemClass?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a>
				</li>
			<? else: ?>
				<li>
					<a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a>
				</li>
			<? endif ?>

		<? endif ?>

	<? endif ?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<? endforeach ?>

<? if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) )?>
<? endif ?>

<li><a href="/storm/" title="Сервис">Сервис</a></li>
</ul>
<div class="menu-clear-left"></div>
<?endif?>