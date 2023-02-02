<?php

$data = [
    'objectId'     => $arParams['FILTER_NAME'] ?: 'smallFilter',
    'filter_title' => $arParams['CONTAINER_TITLE'] ?? null,
];

$arResult['data'] = $data;

//сортировка по возрастанию значений
foreach($arResult["ITEMS"] as $key => $arItem){
	foreach ($arItem["VALUES"] as $x => $row) {
        $sortValues[$x]  = $row['VALUE'];
    }
    array_multisort($sortValues, SORT_ASC, $arItem['VALUES']);
    unset($sortValues);
    $arResult["ITEMS"][$key]['VALUES'] = $arItem['VALUES'];
}