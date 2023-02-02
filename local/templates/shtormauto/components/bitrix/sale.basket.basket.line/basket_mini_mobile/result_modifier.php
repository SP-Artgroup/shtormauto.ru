<?php

foreach ($arResult["CATEGORIES"] as $category => $items) {
    if (empty($items))
        continue;
    foreach ($items as $key=>$v) {
        $db_props = CIBlockElement::GetProperty(26, $v["PRODUCT_ID"], array("sort" => "asc"), Array("CODE" => "SEZONNOST"));
        if ($ar_props = $db_props->Fetch()){
            $arResult["CATEGORIES"][$category][$key]["SEZON"] = $ar_props["VALUE_XML_ID"];
        }
        $db_props = CIBlockElement::GetProperty($v["PRODUCT_ID"]);
        if ($ar_props = $db_props->Fetch()){
            $ar_props["VALUE_XML_ID"];
            $arResult["CATEGORIES"][$category][$key]["DESCRIPTION"] = $ar_props["PREVIEW_TEXT"];
        }        

    }
}
                    

