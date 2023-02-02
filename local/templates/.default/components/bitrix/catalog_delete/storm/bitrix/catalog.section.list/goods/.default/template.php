<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section-list">
	<h1>Бренды</h1>
<?
$count = 0;
foreach($arResult["SECTIONS"] as $cell=>$arSection):
	if($arSection["DEPTH_LEVEL"] != 2)
		continue;
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($arSection["DEPTH_LEVEL"] == 1):
		if($curDepth > $arSection["DEPTH_LEVEL"]):?>
			<div style="clear: both;"></div>
		<?endif;?>
        <a id="<?=$this->GetEditAreaId($arSection['ID']);?>" href="<?=$arSection["SECTION_PAGE_URL"]?>"><h2><?=$arSection["NAME"]?></h2></a>
    <?elseif($arSection["DEPTH_LEVEL"] == 2):?>
		<?$curDepth = $arSection["DEPTH_LEVEL"];?>
        <a id="<?=$this->GetEditAreaId($arSection['ID']);?>" href="<?=$arSection["SECTION_PAGE_URL"]?>" title="<?=$arSection["NAME"]?>">
            <div class="brand-wrap <?=($count%3==0)?"noml":""?>">
                <img src="<?=$arSection["PICTURE"]["src"]?>" width="<?=$arSection["PICTURE"]["width"]?>" style="margin: <?=$arSection["PICTURE"]["MT"]?>px 0 0 <?=$arSection["PICTURE"]["ML"]?>px;" height="<?=$arSection["PICTURE"]["height"]?>" title="<?=$arSection["NAME"]?>" alt="<?=$arSection["NAME"]?>" />
            </div>
        </a>
        <?$count++;?>
    <?endif;?>
<?endforeach;?>
</div>