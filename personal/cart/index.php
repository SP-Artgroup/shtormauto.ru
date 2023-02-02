<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"basket-new", 
	array(
		"ACTION_VARIABLE" => "basket_action",
		"ADDITIONAL_PICT_PROP_26" => "-",
		"ADDITIONAL_PICT_PROP_32" => "-",
		"AUTO_CALCULATION" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DELETE",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
		),
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "TYPE",
			5 => "SUM",
		),
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "basket-new",
		"CORRECT_RATIO" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"HIDE_COUPON" => "N",
		"OFFERS_PROPS" => "",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"USE_GIFTS" => "N",
		"USE_PREPAYMENT" => "N"
	),
	false
);?>

<div class="content-form-body content-form-body--table">
	<?$APPLICATION->IncludeComponent(
		"skyweb24:sharebasket.get",
		"",
		Array(
			"CAPTCHA" => "Y",
			"EMAIL" => "Y",
			"FACEBOOK" => "Y",
			"GOOGLE" => "Y",
			"MOYMIR" => "Y",
			"ODNOKLASSNIKI" => "Y",
			"TWITTER" => "Y",
			"VK" => "Y"
		)
	);?>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>