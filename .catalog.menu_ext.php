<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

if (!function_exists("GetTreeRecursive")) //Include from main.map component
{
	global $menuSectionsFilter;

	$menuSectionsFilter = [
		'UF_HIDE' => 0,
	];

	$aMenuLinksExt = $APPLICATION->IncludeComponent("sp-artgroup:menu.sections", "", array(
		"IS_SEF"           => "Y",
		"SEF_BASE_URL"     => "/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		"DETAIL_PAGE_URL"  => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
		"IBLOCK_TYPE"      => "catalog",
		"IBLOCK_ID"        => 26,
		"DEPTH_LEVEL"      => "2",
		"CACHE_TYPE"       => "A",
		"CACHE_TIME"       => "3600",
		"FILTER_NAME"      => "menuSectionsFilter",
		//'CURRENT_CITY'     => Shtormauto::getInstance()->getCurrentCityId(),
		),
		false
	);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}
