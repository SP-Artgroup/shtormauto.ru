<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent("g-tech:akb.podbor", ".default", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "5",
	"FILTER_DISPLAY_NAME" => "Поиск аккумуляторов",
	"RESULT_PAGE" => "/catalog/akkumulyatory/",
	"FILTER_NAME" => "arrFilter",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000"
	),
	false
);?>