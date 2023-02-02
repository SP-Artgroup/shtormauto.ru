<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !==true)die();

use SP\City;


$CODE = $arParams['PROPERTY'];
$id_iblock = $arParams['IBLOCK_ID'];


$id_element = City::getCurrentCityId();
$arResult['SITY_ID'] = '';
if($CODE !== '' && $id_iblock !== '')
{
    $res = CIBlockElement::GetProperty($id_iblock, $id_element, array("sort" => "asc"), Array("CODE"=>$CODE));
    while($ar_props = $res->Fetch())
    {
        $arResult['SITY_ID'] = $ar_props['VALUE'];
    }
}





$this->IncludeComponentTemplate();
?>