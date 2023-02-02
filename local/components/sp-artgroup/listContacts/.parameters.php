<?
CModule::IncludeModule("iblock");

$dbIBlockType = CIBlockType::GetList(
   array("sort" => "asc"),
   array("ACTIVE" => "Y")
);
while ($arIBlockType = $dbIBlockType->Fetch())
{
      $arIblockType[$arIBlockType["ID"]] = "[".$arIBlockType["ID"]."] ".$arIBlockTypeLang["NAME"];
}

$dbIBlocks = CIBlock::GetList(array("SORT" => "ASC"), array("ACTIVE" => "Y", "TYPE" => $arCurrentValues["IBLOCK_TYPE_ID"],));
while ($arIBlocks = $dbIBlocks->Fetch())
{
    $paramIBlocks[$arIBlocks["ID"]] = "[" . $arIBlocks["ID"] . "] " . $arIBlocks["NAME"];
}

$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
   "GROUPS" => array(
      "SETTINGS" => array(
         "NAME" => "Настройки"
      ),
   ),
   "PARAMETERS" => array(
      "IBLOCK_TYPE_ID" => array(
         "PARENT" => "SETTINGS",
         "NAME" => GetMessage('MESS_IBLOCK_TYPE_ID'),
         "TYPE" => "LIST",
         "VALUES" => $arIblockType,
         "REFRESH" => "Y"
        ),
    "IBLOCK_ID" =>  array(
        "PARENT"    =>  "SETTINGS",
        "NAME"      =>   GetMessage('MESS_IBLOCK_ID'),
        "TYPE"      =>  "LIST",
        "VALUES"    =>  $paramIBlocks,
        "REFRESH"   =>  "Y",
        "MULTIPLE"  =>  "N",
        ),
    "PROPERTY" =>  array(
        "PARENT"    =>  "SETTINGS",
        "NAME"      =>  GetMessage('MESS_PROPERTY'),
        "TYPE"      =>  "LIST",
        "VALUES"    =>  $arProperty,
        "REFRESH"   =>  "Y",
        "MULTIPLE"  =>  "N",
        ),
   )
   
);
?>