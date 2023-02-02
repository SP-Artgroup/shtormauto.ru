<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (empty($arResult)) {
    return;
}

$parent       = null;
$prevDepth    = null;
$currentDepth = null;

$root = [
    'ITEMS' => [],
];

foreach ($arResult as $item) {

    $currentDepth  = (int) $item['DEPTH_LEVEL'];
    $item['ITEMS'] = [];

    // На текущей вложенности закончились элементы,
    // родителем становится родитель родителя

    if ($currentDepth < $prevDepth) {
        $parent = &$parent['PARENT'];
    }

    $prevDepth = $currentDepth;

    if ($currentDepth === 1) {
        $item['PARENT'] = null;
        $parent         = &$root;
    } else {
        $item['PARENT'] = &$parent;
    }

    $amountItems = array_push($parent['ITEMS'], $item);
    $lastIndex   = $amountItems - 1;
    $newItem     = &$parent['ITEMS'][$lastIndex];

    // Текущий элемент становится родителем

    if ($item['IS_PARENT']) {
        $parent = &$newItem;
    }
}

$arResult = $root['ITEMS'];

// tmp
$lastElem = $arResult[count($arResult) - 1];
$arResult = array_slice($arResult, 0, 4);
$arResult[] = $lastElem;
