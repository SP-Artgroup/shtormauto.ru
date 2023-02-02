<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (is_array($arResult["DETAIL_PICTURE"])){
    $arResult['PICTURE'] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>947, 'height'=>440), BX_RESIZE_IMAGE_PROPTIONAL, true);
}elseif(is_array($arResult["PREVIEW_PICTURE"])){
   	$arResult['PICTURE'] = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"], array('width'=>947, 'height'=>440), BX_RESIZE_IMAGE_PROPTIONAL, true);
}
?>