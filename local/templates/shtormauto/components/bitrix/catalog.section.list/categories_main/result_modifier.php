<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$resultSections = [];
$cnt = 0;
foreach ($arResult["SECTIONS"] as $arSection){
if ($cnt==4) break;
    if($arSection["UF_ON_MAIN"]==1){
        $resultSections[] = array(
        "NAME"=>$arSection["NAME"],
        "DESCRIPTION"=>$arSection["UF_DESCRIPRION"],
        "LINK"=>$arSection["SECTION_PAGE_URL"],
        "PICTURE"=>$arSection["PICTURE"]["SRC"],
        );
        $cnt++;
    }
}
// dump1($cnt);
// dump1($resultSections);
$arResult = $resultSections;
$arResult["ELEMENTS_CNT"] = $cnt;
?>