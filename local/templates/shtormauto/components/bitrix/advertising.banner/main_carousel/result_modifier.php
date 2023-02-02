<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? //global $USER;
//if($USER->IsAdmin()) {
	$sortedBanners = [];
	foreach ($arResult["BANNERS_PROPERTIES"] as $key => $value) {
		$sortedBanners[$value["WEIGHT"]] = $arResult["BANNERS"][$key];
	}

	if($arParams["WEIGHT_SORT_ORDER"] == "ASC") 
		ksort($sortedBanners, SORT_NUMERIC);
	else
		krsort($sortedBanners, SORT_NUMERIC);
	
	$arResult["BANNERS"] = $sortedBanners;
?>
