<?php
 $cnt = CIBlockElement::GetList(
    array(),
    array('IBLOCK_ID' => $arParams["IBLOCK_ID"]),
    array(),
    false,
    array('ID', 'NAME')
); 
 $arResult["COUNT_ELEMENTS"] = $cnt;
