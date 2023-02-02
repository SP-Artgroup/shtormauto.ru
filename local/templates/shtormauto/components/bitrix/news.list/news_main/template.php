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
?>
<h4 class="news-sidebar__heading">Новости</h4>
<ul class="news-sidebar__list">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>    
    <li class="news-sidebar__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="news-sidebar__item-img" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/news/sidebar-item.png)"></div>
        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="news-sidebar__link">
            <div class="news-sidebar__title"><?=$arItem["NAME"]?></div>
            <div class="news-sidebar__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
        </a>
    </li>
    <?endforeach;?>    
</ul>
