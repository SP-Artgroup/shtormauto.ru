<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";


/*сортировка значений элементов типа список по взрастанию*/

foreach($arResult["ITEMS"] as $key=>$arItem)
{
	//if ($arItem["DISPLAY_TYPE"]=="P"){
		$arItemValues = array();
		foreach ($arItem["VALUES"] as $x => $row) {
			if($arItem["CODE"] == "BREND" && $x == 31688){
				$firstBrend[$x] = $row;
			}
			else{
				$sortValues[$x]  = $row['VALUE'];
				$arItemValues[$x] = $arItem["VALUES"][$x];
			}
            
        }
        
        // if ($arItem["CODE"] == "SEZONNOST") {
        // 	array_multisort($sortValues, SORT_DESC, $arItemValues);
        // } else {
        // 	array_multisort($sortValues, SORT_ASC, $arItemValues); //сортировка полей списка первое лето
        // }
		array_multisort($sortValues, SORT_ASC, $arItemValues); //сортировка полей списка первая зима

        unset($sortValues);
        if($arItem["CODE"] == "BREND"){
        	$arResult["ITEMS"][$key]['VALUES'] = array_merge($firstBrend, $arItemValues);
        }
        else{
        	$arResult["ITEMS"][$key]['VALUES'] = $arItemValues;
        }
        //uasort($arItem["VALUES"], 'cmp_function2');
        //$arResult["ITEMS"][$key]["VALUES"] = $arItem["VALUES"];
    //}
}

\Bitrix\Main\Loader::includeModule('wecanit.car');

$userCar = new \Wecanit\Car\UserCar();
$arResult['IS_SAVED_CAR'] = !empty($userCar->getFromCookie());



// @@@ DVG @@@ (
// Удалим лишнее
$ar    = ['VENDOR', 'MODEL', 'YEAR', 'MODIFICATION'];
$arTMP = $arResult['HIDDEN'];
foreach ($arTMP as $key => $item) {
	if (in_array($item['CONTROL_NAME'], $ar)) {
		unset($arResult['HIDDEN'][$key]);
	}
}
$arResult['FORM_ACTION'] = CHTTP::urlDeleteParams($arResult['FORM_ACTION'], $ar);
// @@@ DVG @@@ )
