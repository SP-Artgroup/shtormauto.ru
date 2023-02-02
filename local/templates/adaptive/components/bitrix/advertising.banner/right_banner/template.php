<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (count($arResult['BANNERS']) > 0):

$frame = $this->createFrame()->begin("");
?>
	<div class="right_banner">
		<div class="slider">
			<? foreach ($arResult["BANNERS"] as $k => $banner): ?>
				<div class="slide"><?=$banner?></div>
			<? endforeach ?>
		</div>
	</div>

	<? if (count($arResult['BANNERS']) > 1): ?>
		<script type="text/javascript">
			$(function () {
				$('.slider').owlCarousel({
					navigation : false, // Show next and prev buttons
					pagination: false,
					slideSpeed : 300,
					paginationSpeed : 400,
					singleItem: true,
					//autoPlay: 5000,
				});
			});
		</script>
	<? endif ?>
<? $frame->end() ?>
<? endif ?>