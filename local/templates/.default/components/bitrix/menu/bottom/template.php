<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if (!empty($arResult)):?>
<div class="blue-tabs-menu">
	<ul>
<?foreach($arResult as $key=>$arItem):?>
    <?if($key > 0):?>
        <li>|</li>
    <?endif;?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>

<?endforeach?>

	</ul>
</div>
<div class="menu-clear-left"></div>
<?endif?>