<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("advertising"))
	return;

$arTemplateParameters = array(
	"WEIGHT_SORT_ORDER" => array(
		"NAME" => GetMessage("ADV_WEIGHT_SORT_ORDER"),
		"PARENT" => "BASE",
		"TYPE" => "LIST",
		"VALUES" => array(
			'ASC' => GetMessage("ADV_WEIGHT_SORT_ORDER_ASC"),
			'DESC' => GetMessage("ADV_WEIGHT_SORT_ORDER_DESC")
		)
	)
);
$arTemplateParameters["CACHE_TIME"] = Array("DEFAULT"=>"0");
$arTemplateParameters["NEED_TEMPLATE"] = "Y";