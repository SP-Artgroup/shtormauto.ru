<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$frame = $this->createFrame()->begin("");
?>

<div class="carousel-main">
	<? foreach ($arResult["BANNERS"] as $k => $banner): ?>
		<?= $banner ?>
	<? endforeach ?>
</div>

<? $frame->end() ?>