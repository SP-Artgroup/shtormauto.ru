<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
foreach ($arResult as $key=>$item){
    //ucfirst - не работает
    $str = strtolower(trim(str_replace("-", "", $item["TEXT"])));
    $first = substr($str, 0, 1);
    $rezStr = strtoupper($first).substr($str, 1);
    $arResult[$key]["TEXT"] = $rezStr;
}
