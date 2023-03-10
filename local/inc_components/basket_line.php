<?php

$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"basket.line", 
	array(
		"BUY_URL_SIGN" => "action=ADD2BASKET",
		"COMPONENT_TEMPLATE" => "basket.line",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "N",
		"SHOW_TOTAL_PRICE" => "Y",
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_AUTHORIZE" => "",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_IMAGE" => "N",
		"SHOW_PRICE" => "N",
		"SHOW_SUMMARY" => "N"
	),
	false
);