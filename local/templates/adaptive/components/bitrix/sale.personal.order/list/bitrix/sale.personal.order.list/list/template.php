<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
//dump($arResult['ORDERS'][0]);?>
<div class="new_zag">Личный кабинет</div>
<div class="personal_area">

	<ul class="personal_area_menu">
		<li class="active"><a href="/personal/order/">Мои заказы</a></li>
		<?//<li rel='2'>Бронирование</li>?>
		<li><a href="/personal/profile/">Личные данные</a></li>
	</ul>
	
	<div id="personal_area_body1" class="personal_area_body">
	
		<div class="nt_table">
			<div class="nt_table_zag">
				<div class="zag1">№ заказа</div>
				<div class="zag2">Дата создания</div>
				<div class="zag3">Статус заказа</div>
				<div class="zag4">Город</div>
				<div class="zag5">Магазин</div>
				<div class="zag6">Сумма, руб.</div>
				<div class="zag7">Возможности</div>
			</div>
			<? foreach($arResult['ORDERS'] as $arOrder) { ?>
				<div class="nt_table_item">
					<div class="zag1"><a href="<?=$arOrder['ORDER']['URL_TO_DETAIL']?>">№S-<?=$arOrder['ORDER']['ID']?></a></div>
					<div class="zag2"><?=$arOrder['ORDER']['DATE_INSERT_FORMATED']?></div>
					<div class="zag3"><?=$arResult['INFO']['STATUS'][$arOrder['ORDER']['STATUS_ID']]['NAME']?></div>
					<div class="zag4"><?=$arOrder['PROPERTIES']['CITY']['VALUE']?></div>
					<div class="zag5">
						<? if(intval($arOrder['SHOP_ID'])) { ?>
							<a href="/shops/<?=$arOrder['SHOP_ID']?>/"><?=$arOrder['PROPERTIES']['SHOP']['VALUE']?></a>
						<? } else { ?>
							<?=$arOrder['PROPERTIES']['SHOP']['VALUE']?>
						<? } ?>
					</div>
					<div class="zag6"><?=$arOrder['ORDER']['FORMATED_PRICE']?></div>
					<div class="zag7"><a href="<?=$arOrder['ORDER']['URL_TO_CANCEL']?>">Отменить</a></div>
				</div>
			<? } ?>
		</div>
	
	</div>
	<div style="clear:both"></div>
</div>
<div style="clear: both;"></div>