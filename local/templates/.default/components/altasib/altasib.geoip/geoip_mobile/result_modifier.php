<?
if(CModule::IncludeModule("iblock"))
{
    if(!empty($_GET["chcity"]))
    {
        $city = CIBlockElement::GetList(
            array(),
            array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","ID"=>$_GET["chcity"]),
            false,
            array("nTopCount"=>"1"),
            array("ID","NAME")
        )->Fetch();
        
        setcookie("geo_ip_city",$city["NAME"],time()+86400,"/");
    }
    
    if($_COOKIE["geo_ip_city"])
    {
        //Если задана кука с определённым городом - используем город оттуда
        $cityToFind = $_COOKIE["geo_ip_city"];
    }
    else
    {
        //Если НЕ задана кука с определённым городом - берём тот, что определился
        $cityToFind = $arResult["city"];
    }
    
    $city = CIBlockElement::GetList(
        array(),
        array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","NAME"=>$cityToFind),
        false,
        array("nTopCount"=>"1"),
        array("ID","NAME")
    )->Fetch();
    
    if(!$city)
    {
        //Если определившийся город не найден - берём просто первый попавшийся
        $city = CIBlockElement::GetList(
            array(),
            array("IBLOCK_ID"=>"15","ACTIVE"=>"Y","!PROPERTY_DEFAULT"=>false),
            false,
            array("nTopCount"=>"1"),
            array("ID","NAME")
        )->Fetch();
    }
    
    //Получим свойства города
    $props = CIBlockElement::GetList(
        array(),
        array("IBLOCK_ID"=>"15","ID"=>$city["ID"]),
        false,
        array("nTopCount"=>"1"),
        array("IBLOCK_ID","ID","PROPERTY_PHONES","PROPERTY_CATALOG")
    )->GetNextElement()->GetProperties();
    
    $arResult['result'] = $arResult;
    $arResult["city"] = $city["NAME"];
    $arResult["phones"] = $props["PHONES"]["VALUE"];
    
    $_SESSION["CITY"]["ID"] = $city["ID"];
    $_SESSION["CITY"]["NAME"] = $city["NAME"];
    $_SESSION["CATALOG"]["ID"] 	= $props["CATALOG"]["VALUE"];
}
?>