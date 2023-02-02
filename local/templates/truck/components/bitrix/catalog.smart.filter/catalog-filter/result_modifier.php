<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (
    isset($arParams["POPUP_POSITION"])
    && in_array($arParams["POPUP_POSITION"], array("left", "right"))
)
    ? $arParams["POPUP_POSITION"] . '-pos'
    : "left-pos";

//сортировка по возрастанию значений
foreach($arResult["ITEMS"] as $key => $arItem){
	foreach ($arItem["VALUES"] as $x => $row) {
        $sortValues[$x]  = $row['VALUE'];
    }
    array_multisort($sortValues, SORT_ASC, $arItem['VALUES']);
    unset($sortValues);
    $arResult["ITEMS"][$key]['VALUES'] = $arItem['VALUES'];
}
