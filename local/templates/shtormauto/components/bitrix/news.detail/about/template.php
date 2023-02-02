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
<div class="about-page about-page--about d-flex d-lg-block flex-column">
    <h1 class="about-page__name about-page__name--margin-bottom-60 order-1"><?$APPLICATION->ShowTitle();?></h1>
    <div class="about-page__preview-text order-2">
        <?= $arResult["PREVIEW_TEXT"]; ?>
    </div>
    <?if (is_array($arResult["PROPERTIES"]["BANNER"]["VALUE"])){?>
    <div class="about-page-slider order-3 order-lg-2">
        <?foreach ($arResult["PROPERTIES"]["BANNER"]["VALUE"] as $banner){
            $arFile = CFile::GetFileArray($banner);
        ?>
        <div class="about-page-slider__item"><img src="<?=$arFile["SRC"]?>" alt=""></div>
        <?}?>
    </div>
    <?}?>
    <div class="row order-2 order-lg-3">
        <div class="col-lg-7 col-xl-8 d-none d-lg-block">
            <div class="about-page__full-text">

                <?= $arResult["DETAIL_TEXT"]; ?>
            </div>
        </div>
<div class="col-lg-5 col-xl-4">
    <div class="about-page__info">
        <h3 class="about-page__info-heading">Контакты</h3>
                <!--Магазины-->   
                <?$APPLICATION->IncludeComponent(
                                "bitrix:news.list", 
                                "shops_about", 
                                array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "N",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "N",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                                ),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "7",
                                "IBLOCK_TYPE" => "services",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "30",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(
                                0 => "EMAIL",
                                1 => "ADDRESS",
                                2 => "CONTACTS",
                                3 => "SHORT_NAME",
                                4 => "LOCATION",
                                5 => "WORK_TIME",
                                6 => "PHONE",
                                7 => "",
                                ),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "SORT",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "COMPONENT_TEMPLATE" => "shops_on_main"
                                ),
                                false
                        );?>        
                <!--Магазины-->  
                
    </div>
</div>

    </div>
    <div class="about-page__full-text d-block d-lg-none order-4">
        <?= $arResult["DETAIL_TEXT"]; ?>
    </div>
</div>

