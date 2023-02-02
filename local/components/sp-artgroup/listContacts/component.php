<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !==true)die();

use SP\City;


$CODE = $arParams['PROPERTY'];
$id_iblock = $arParams['IBLOCK_ID'];

if($CODE == '') $CODE = 'PHONES';
if(isset($id_iblock)) $id_iblock = 15;

$id_element = City::getCurrentCityId();
$arResult['ITEMS'] = [];
$testall = [];
if($CODE !== '' && $id_iblock !== '')
{
    $res = CIBlockElement::GetProperty($id_iblock, $id_element, array("sort" => "asc"), Array("CODE"=>$CODE));
    while($ar_props = $res->Fetch())
    {
        $testall[] = $ar_props;
        $arResult['ITEMS'][] = ['VALUE' => $ar_props['VALUE'], 'DESCRIPTION' => $ar_props['DESCRIPTION'], 'NAME' => City::getCurrentCityName()];
    }
}

$this->IncludeComponentTemplate();
?>