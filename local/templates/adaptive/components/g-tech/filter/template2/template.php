<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
function subarray_sort($a, $b){
	return $a['VALUE'] - $b['VALUE'];
}
usort($arResult["FILTER_VALUES"]["PROPERTY_SHIRINA"]["VALUES"], 'subarray_sort');
usort($arResult["FILTER_VALUES"]["PROPERTY_PROFIL"]["VALUES"], 'subarray_sort');
usort($arResult["FILTER_VALUES"]["PROPERTY_DIAMETR"]["VALUES"], 'subarray_sort');

//dump($arResult["FILTER_VALUES"]);
?>

<div class="grey-block filter toggle-box">
    <div class="grey-block-title toggle"><?=$arParams["FILTER_DISPLAY_NAME"]?></div>
	<div class="grey-block-content smart-filter content">
        <form action="<?=$arParams["RESULT_PAGE"]?>" method="get" class="smartfilter">
        		<ul>
        		<?foreach($arResult["FILTER_VALUES"] as $code=>$arItem):?>
        			<?if(!empty($arItem["VALUES"])):?>
        			<li class="lvl1">
					<select id="ul_<?echo $arItem["CODE"]?>" name="FILTER[<?=$arItem["CODE"]?>]" class="propselect">

                        <option value=""><?=GetMessage("PROPERTY_".$arItem["CODE"]."_NAME")?></option>

                        <? foreach ($arItem["VALUES"] as $val => $value): ?>

                            <option
                                class="prop"
                                value="<?=$value["ENUM_ID"];?>"
                                <?echo $value["SELECTED"] ? 'selected' : ''?>
                            ><?= $value["VALUE"] ?></option>

                        <? endforeach ?>

        				</select>
        			</li>
        			<?endif;?>
        		<?endforeach;?>
        		</ul>
        		<input type="submit" id="set_filter" class="catalog-search-submit" value="" />
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
    // cuSel(params);
    $("span.disabled").click(function(){
        return false;
    });
});
</script>