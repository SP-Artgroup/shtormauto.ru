<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViews = array(
	"vertical" => GetMessage("CP_BCT_TPL_FILTER_VIEW_V"),
	"horizontal" => GetMessage("CP_BCT_TPL_FILTER_VIEW_H")
);
$arTemplateParameters['FILTER_VIEW_MODE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage("CP_BCT_TPL_FILTER_VIEW"),
	'TYPE' => 'LIST',
	'VALUES' => $arViews,
	'DEFAULT' => 'vertical',
	'ADDITIONAL_VALUES' => 'Y',
	'REFRESH' => "Y"
);

if ($arCurrentValues["FILTER_VIEW_MODE"] == "vertical")
{
	$arPopupPosition = array(
		"left" => GetMessage("CP_BCT_TPL_POPUP_POSITION_LEFT"),
		"right" => GetMessage("CP_BCT_TPL_POPUP_POSITION_RIGHT")
	);
	$arTemplateParameters['POPUP_POSITION'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage("CP_BCT_TPL_POPUP_POSITION"),
		'TYPE' => 'LIST',
		'VALUES' => $arPopupPosition,
		'DEFAULT' => 'left',
		'ADDITIONAL_VALUES' => 'Y'
	);
}

$arTemplateParameters['DISPLAY_ELEMENT_COUNT'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('TP_BCSF_DISPLAY_ELEMENT_COUNT'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y',
);
