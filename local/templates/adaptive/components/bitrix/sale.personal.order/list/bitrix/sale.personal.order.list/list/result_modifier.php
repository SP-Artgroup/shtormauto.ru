<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

//, 'NAME' => $properties['SHOP']['VALUE'], 'PROPERTY_CITY' => $properties['CITY']['VALUE']

$shops		= array();

$arSelect 	= Array("ID", "IBLOCK_ID", "NAME");
$arFilter 	= Array("IBLOCK_ID" => 7, "ACTIVE"=>"Y");
$res 		= CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 100), $arSelect);
while($ob = $res->GetNextElement())
{ 
	$arFields = $ob->GetFields();  
	$arProps = $ob->GetProperties();

	$shops[$arProps['CITY']['VALUE']][$arFields['NAME']] = $arFields['ID'];
}
//dump($shops);

$arResult["ORDER_BY_STATUS"] = Array();
foreach($arResult["ORDERS"] as $k => $val)
{
	$arResult["ORDER_BY_STATUS"][$val["ORDER"]["STATUS_ID"]][] = $val;
	
	
	$properties	= array();
	$db_vals = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array(
                "ORDER_ID" => $val['ORDER']['ID']
            )
    );
	while($arFields = $db_vals->Fetch())
	{
		$properties[$arFields['CODE']]	= $arFields;
	}
	
	$arResult["ORDERS"][$k]['PROPERTIES']	= $properties;
	
	if(isset($shops[$properties['CITY']['VALUE']][$properties['SHOP']['VALUE']]))
	{
		$arResult["ORDERS"][$k]['SHOP_ID']	= $shops[$properties['CITY']['VALUE']][$properties['SHOP']['VALUE']];
	}
}
?>