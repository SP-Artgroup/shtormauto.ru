<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval($arParams["ID"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arResult["FILTER_VALUES"] = Array();

$FILTER_NAME = $arParams["FILTER_NAME"];

global ${$FILTER_NAME};
if(!is_array(${$FILTER_NAME}))
        ${$FILTER_NAME} = array();
$arrFilter = &${$FILTER_NAME};

$selectedValue = Array();
if(isset($_REQUEST["FILTER"])&&!empty($_REQUEST["FILTER"])&&$_REQUEST["FILTER"]["AKUM"]=="Y"){
    foreach($_REQUEST["FILTER"] as $code=>$val){
        $selectedValues[$code] = urldecode($val);
    }
}

if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
        $arResult["FILTER_VALUES"]["VENDOR"] = Array();
        $arResult["FILTER_VALUES"]["VENDOR"]["CODE"] = "VENDOR";
        $arResult["FILTER_VALUES"]["MODEL"] = Array();
        $arResult["FILTER_VALUES"]["MODEL"]["CODE"] = "MODEL";
        $arResult["FILTER_VALUES"]["MODIFICATION"] = Array();
        $arResult["FILTER_VALUES"]["MODIFICATION"]["CODE"] = "MODIFICATION";
        $arResult["FILTER_VALUES"]["DATE"] = Array();
        $arResult["FILTER_VALUES"]["DATE"]["CODE"] = "DATE";

        $arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
		);
        $arSelect =  Array(
            "IBLOCK_ID",
            "ID",
        );

        global $DB;

        $strSql = "SELECT DISTINCT vendor FROM podbor_akb ORDER BY vendor ASC";
        $res = $DB->Query($strSql, false, $err_mess.__LINE__);
        while($arRes = $res->Fetch()){
            $selected = ($arRes["vendor"] == $selectedValues["VENDOR"]) ? true : false;
            $arResult["FILTER_VALUES"]["VENDOR"]["VALUES"][] = Array(
                "VALUE" => $arRes["vendor"],
                "SELECTED" => $selected,
            );
        }
        if($selectedValues["VENDOR"]){
            $strSql = "SELECT DISTINCT car FROM podbor_akb WHERE vendor = '".$selectedValues["VENDOR"]."' ORDER BY vendor ASC";
            $res = $DB->Query($strSql, false, $err_mess.__LINE__);
            while($arRes = $res->Fetch()){
                $selected = ($arRes["car"] == $selectedValues["MODEL"]) ? true : false;
                $arResult["FILTER_VALUES"]["MODEL"]["VALUES"][] = Array(
                    "VALUE" => $arRes["car"],
                    "SELECTED" => $selected,
                );
            }
        }
        if($selectedValues["VENDOR"] && $selectedValues["MODEL"]){
            $strSql = "SELECT DISTINCT modification FROM podbor_akb WHERE vendor = '".$selectedValues["VENDOR"]."' and car = '".$selectedValues["MODEL"]."' ORDER BY vendor ASC";
            $res = $DB->Query($strSql, false, $err_mess.__LINE__);
            while($arRes = $res->Fetch()){
                $selected = ($arRes["modification"] == $selectedValues["MODIFICATION"]) ? true : false;
                $arResult["FILTER_VALUES"]["MODIFICATION"]["VALUES"][] = Array(
                    "VALUE" => $arRes["modification"],
                    "SELECTED" => $selected,
                );
            }
        }
        if($selectedValues["VENDOR"] && $selectedValues["MODEL"] && $selectedValues["MODIFICATION"]){
            $strSql = "SELECT DISTINCT date_start, date_end FROM podbor_akb WHERE vendor = '".$selectedValues["VENDOR"]."' and car = '".$selectedValues["MODEL"]."' and modification = '".$selectedValues["MODIFICATION"]."' ORDER BY vendor ASC";
            $res = $DB->Query($strSql, false, $err_mess.__LINE__);
            $dates = explode("-", urldecode($selectedValues["DATE"]));
            while($arRes = $res->Fetch()){
                $selected = ($arRes["date_start"] == $dates[0] && $arRes["date_end"] == $dates[1]) ? true : false;
                $arResult["FILTER_VALUES"]["DATE"]["VALUES"][] = Array(
                    "VALUE" => $arRes["date_start"]."-".$arRes["date_end"],
                    "SELECTED" => $selected,
                );
            }
        }
        if($selectedValues["DATE"]){
            $dates = explode("-", $selectedValues["DATE"]);
            $strSql = "SELECT emkost_ot, emkost_do FROM podbor_akb WHERE vendor = '".$selectedValues["VENDOR"]."' and car = '".$selectedValues["MODEL"]."' and modification = '".$selectedValues["MODIFICATION"]."' and date_start = '".$dates[0]."' and date_end = '".$dates[1]."' ORDER BY vendor ASC";
            $res = $DB->Query($strSql, false, $err_mess.__LINE__);
            while($arRes = $res->Fetch()){
                if(intval($arRes["emkost_ot"]) > 0)
                    $arrFilter[">=PROPERTY_CAPACITY"] = $arRes["emkost_ot"];
                if(intval($arRes["emkost_do"]) > 0)
                    $arrFilter["<=PROPERTY_CAPACITY"] = $arRes["emkost_do"];
            }
        }

        $this->EndResultCache();
	}

}
$this->IncludeComponentTemplate();
?>