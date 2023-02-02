<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
/*
//было  <option value="<?=$curPage.'?city='.$id?>" <?if ($_GET["city"]==$id){?>selected="selected"<?}?>><?=$name;?></option> - не менялся город в шапке
*/
use Bitrix\Main\Loader;
use SP\City;
$currentCity = City::getCurrentCityId();
?>
<div class="news-list">
    <header class="header-content">
    <div class="header-content__col">
        <h1 class="header-content__heading">Магазины и сервисы</h1>
    </div>
    <div class="header-content__col">
        <div class="form-select">
            <select id="selectCityNews">
                <?$curPage = $APPLICATION->GetCurPage();?>
                <?foreach ($arResult["CITY_LIST"] as $id=>$name){?>
                <option value="<?=$curPage.'?chcity='.$id?>" <?if ($currentCity==$id){?>selected="selected"<?}?>><?=$name;?></option>
                <?}?>
            </select>
        </div>
    </div>
</header>

<?if ($APPLICATION->GetCurPageParam() !== $arParams["SECTION_URL"].'index.php?city=506029' && $APPLICATION->GetCurPageParam() !== $arParams["SECTION_URL"].'index.php?city=560928'): ?>

<div class="row margin-m-20">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
      <div class="col-md-6 col-lg-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="tile-item">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" class="tile-item__img"></a>
          <div class="tile-item__info">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"]?></a>
            <div class="service-location"><i class="icon i-balloon"></i><?=$arResult["CITY_LIST"][$arItem["PROPERTIES"]["CITY"]["VALUE"]];?></div>
            <div class="tile-item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
          </div>
        </div>
      </div>        
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<?else: ?>
    <div class="catalog-main-exeption">
        <p>ПРИ ЗАКАЗЕ ЛЮБЫХ АВТОТОВАРОВ СО СКЛАДА ВЛАДИВОСТОКА - ДОСТАВКА БЕСПЛАТНО!</p>
        <p><a href="?chcity=55254">СДЕЛАТЬ ЗАКАЗ - ВЛАДИВОСТОК</a></p>
    </div>
<?endif ?>

</div>
<script>
$(document).on("change", "#selectCityNews", function(){
    console.log($(this).val());
    window.location = $(this).val();
})
</script>