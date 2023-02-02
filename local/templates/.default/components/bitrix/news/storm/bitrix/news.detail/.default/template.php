<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-detail">
    <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><?=$arResult["NAME"]?></h1>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
<div class="gallery">
    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["PREVIEW_PICTURE"])):?>
        <div style="background: url('<?=$arResult["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;" class="img-wrap">
            <a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="big-img detail_picture" rel="photo"><img border="0" src="<?=$templateFolder?>/images/detail-img-wrap.png" width="460px" height="280px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
        </div>
	<?endif?>
<div>
    <?foreach($arResult["PROPERTIES"]["PHOTO"]["IMAGES"] as $cell=>$photo):?>
        <div style="background: url('<?=$photo["PREVIEW"]["src"]?>') center center no-repeat;width: 110px;height: 90px;<?=($cell==0)?"margin-left: 0;":""?>" class="small-img-wrap">
            <a href="<?=$photo["DETAIL"]?>" class="big-img" rel="photo"><img border="0" src="<?=$templateFolder?>/images/small-news-img-wrap.png" width="110px" height="90px" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /></a>
        </div>
    <?endforeach;?>
</div>
</div>
<div class="asd_social_share" style="margin-top:15px;display:inline-block;float:right;">
<?$APPLICATION->IncludeComponent(
    "bitrix:asd.share.buttons", 
    ".default", 
    array(
        "ASD_ID" => $arResult["ID"],
        "ASD_TITLE" => $arResult["NAME"],
        "ASD_URL" => $arResult["DETAIL_PAGE_URL"],
        "ASD_PICTURE" => $arResult["PREVIEW_PICTURE"]["src"],
        "ASD_TEXT" => $arResult["PREVIEW_TEXT"],
        "ASD_LINK_TITLE" => "Поделиться в #SERVICE#",
        "ASD_SITE_NAME" => "",
        "ASD_INCLUDE_SCRIPTS" => array(
        ),
        "LIKE_TYPE" => "LIKE",
        "VK_API_ID" => "",
        "VK_LIKE_VIEW" => "mini",
        "TW_DATA_VIA" => "",
        "SCRIPT_IN_HEAD" => "N"
    ),
    false
);?>
</div>
	<div style="clear:both"></div>
</div>