<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="grey-block filter toggle-box" id="filter-node">
    <div class="grey-block-title toggle"><?=$arParams["FILTER_DISPLAY_NAME"]?></div>
	<div class="grey-block-content smart-filter content">
        <form action="<?=$arParams["RESULT_PAGE"]?>" method="post" class="smartfilter">
            <input type="hidden" name="FILTER[AKUM]" value="Y" />
        		<ul>
        		<?
                $cnt = count($arResult["FILTER_VALUES"])-1;
                $count = 0;
                foreach($arResult["FILTER_VALUES"] as $code=>$arItem):?>
        			<li class="lvl1">
        				<select id="ul_<?echo $arItem["CODE"]?>" name="FILTER[<?=$arItem["CODE"]?>]" class="<?=($count<$cnt)?"charsel":""?> propselect">
                            <option value=""><?=GetMessage("PROPERTY_".$arItem["CODE"]."_NAME")?></option>
        					<?foreach($arItem["VALUES"] as $val => $value):?>
                                <option class="prop" value="<?=urlencode($value["VALUE"]);?>" <?echo $value["SELECTED"]?'selected="selected"':''?>>
                                    <?=$value["VALUE"];?>
                                </option>
        					<?endforeach;?>
        				</select>
        			</li>
        			<?$count++;?>
        		<?endforeach;?>
        		</ul>
        		<input type="submit" id="set_filter" class="akum-search catalog-search-submit" value="" />
        </form>
    </div>
</div>
<script>
$("select.charsel").change(function(){
    $(".charsel").addClass("inactive");
    $("input.akum-search").addClass("inactive");
    var strUri = "/catalog/akb-ajax.php?FILTER[AKUM]=Y";
    $(".charsel input").each(function(){
        var val = $(this).val();
        if(val.length > 0){
            var code = $(this).attr("name");
            strUri += "&"+code+"="+val;
        }
   });
   BX.ajax.insertToNode(strUri, "filter-node");
   $(".charsel").removeClass("inactive");
   $("input.akum-search").removeClass("inactive");
});
$(document).ready(function(){
    var params = {
        changedEl: ".smart-filter select",
        visRows: 8,
        scrollArrows: true
    }
    // cuSel(params);
    $("span.disabled").click(function(){
        return false;
    });
    $(".inactive").live("click", function(){
        return false;
    });
});
</script>