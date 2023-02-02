<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

// delayed function must return a string

if (empty($arResult)) {
	return '';
}

$strReturn = '';

$tplWithUrl    = file_get_contents(__DIR__ . '/parts/with_url.php');
$tplWithoutUrl = file_get_contents(__DIR__ . '/parts/without_url.php');

$strReturn .= '<ol class="breadcrumb" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);

for ($index = 0; $index < $itemSize; ++$index) {

	$title = htmlspecialcharsex($arResult[$index]['TITLE']);
	$link  = $arResult[$index]['LINK'];

	$replace = [
		'#title#' => $title,
		'#index#' => $index + 1,
		'#link#'  => $link,
	];

	if ($link != '' && $index != $itemSize - 1) {
		$tpl = $tplWithUrl;
	} else {
		$tpl = $tplWithoutUrl;
	}

	$strReturn .= str_replace(
		array_keys($replace),
		array_values($replace),
		$tpl
	);
}

$strReturn .= '</ol>';

return $strReturn;
