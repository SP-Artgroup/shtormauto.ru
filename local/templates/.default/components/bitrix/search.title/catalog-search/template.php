<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<script>
$(document).ready(function(){
    var text= $(".catalog-search-input").val();
    $('.catalog-search-input').focus(function(){
        if($(this).val() == "Артикул или название")
            $(this).val("");
    });
    $('.catalog-search-input').blur(function(){
        if($(this).val()=="")
            $(this).val(text);
    });
});
</script>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
<div class="grey-block">
    <div class="grey-block-title"><?=GetMessage("CATALOG_SEARCH")?></div>
	<div class="grey-block-content catalog-search">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<input type="hidden" name="type" value="auto" />
		<div id="<?echo $CONTAINER_ID?>"><input id="<?echo $INPUT_ID?>" type="text" name="q" class="catalog-search-input" value="Артикул или название" size="40" maxlength="50" autocomplete="off" /></div>
        <input name="s" type="submit" class="catalog-search-submit" value="" />
	</form>
	</div>
</div>
<?endif?>
<script type="text/javascript">
var jsControl = new JCTitleSearch({
	//'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
	'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
	'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
	'INPUT_ID': '<?echo $INPUT_ID?>',
	'MIN_QUERY_LEN': 2
});
</script>