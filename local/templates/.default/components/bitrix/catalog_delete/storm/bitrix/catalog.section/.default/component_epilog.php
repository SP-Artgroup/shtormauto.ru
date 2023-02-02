<?
$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
if($ar_res = $res->GetNext()){
    $APPLICATION->AddChainItem($ar_res['NAME'], "/catalog/".$ar_res['CODE']."/");
}
$APPLICATION->AddChainItem($arResult["NAME"]);
?>