<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="grey-block">
    <div class="grey-block-title"><?=GetMessage("FILTER_TIRE")?></div>
	<div class="grey-block-content smart-filter">
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?=$APPLICATION->GetCurDir()?>" method="get" class="smartfilter">
        	<?foreach($arResult["HIDDEN"] as $arItem):?>
        		<input
        			type="hidden"
        			name="<?echo $arItem["CONTROL_NAME"]?>"
        			id="<?echo $arItem["CONTROL_ID"]?>"
        			value="<?echo $arItem["HTML_VALUE"]?>"
        		/>
        	<?endforeach;?>
        		<ul>
        		<?foreach($arResult["ITEMS"] as $arItem):?>
        			<?if(!empty($arItem["VALUES"])):?>
        			<li class="lvl1">
        				<select id="ul_<?echo $arItem["ID"]?>" name="" class="propselect">
                            <option value=""><?=$arItem["NAME"]?></option>
        					<?foreach($arItem["VALUES"] as $val => $ar):?>
                                <option class="prop" value="<?=$ar["HTML_VALUE"];?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]?'selected="selected"':''?>>
                                    <?echo $ar["VALUE"];?>
                                </option>
        					<?endforeach;?>
        				</select>
        			</li>
        			<?endif;?>
        		<?endforeach;?>
        		</ul>
        		<input type="submit" id="set_filter" name="set_filter" class="catalog-search-submit" value="" />
        </form>
    </div>
</div>
<script>
$(document).ready(function(){
    var params = {
        changedEl: ".smart-filter select",
        visRows: 8,
        scrollArrows: true
    }
    cuSel(params);
    $(".cuselActive").each(function(){
        var name = $(this).attr("name");
        $("input", $(this).parent().parent().parent().parent()).attr("name", name);
    });
    $(".prop").click(function(){
        var name = $(this).attr("name");
        $("input", $(this).parent().parent().parent().parent()).attr("name", name);
    });
    $("span.disabled").click(function(){
        return false;
    });
});
</script>