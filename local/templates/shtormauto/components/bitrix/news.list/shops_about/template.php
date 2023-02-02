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


        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>    
        <div class="d-flex flex-column flex-sm-row flex-lg-column" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <?$coords = (explode(',',$arItem["DISPLAY_PROPERTIES"]["LOCATION"]["VALUE"]));?>
            <div class="about-page__info-items-map order-last order-lg-first" data-ymap='{"coords": ["<?= $coords[0] ?>", "<?= $coords[1] ?>"], "address": "Белогорск, ул. Набережная, 179", "placemarkSizes": ["34", "52"]}'></div>
            <div class="about-page__info-items order-first  order-lg-last">
                <?if ($arItem["PROPERTIES"]["ADDRESS"]["VALUE"] && $arItem["PROPERTIES"]["PHONE"]["VALUE"] && $arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]){?>
                <div class="contacts-sidebar__company-info">
                    <div class="about-page__info-item">
                        <div class="about-page__info-item-value">
                            <?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?>
                        </div>
                    </div>
                    <div class="about-page__info-item">
                        <div class="about-page__info-item-label">Телефон</div>
                        <div class="about-page__info-item-value">
                            <a href="tel:<?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?>"><?= htmlspecialchars_decode($arItem["PROPERTIES"]["PHONE"]["VALUE"]) ?></a>
                        </div>
                    </div>
                    <div class="about-page__info-item">
                        <div class="about-page__info-item-label">Режим работы</div>
                        <?= htmlspecialchars_decode($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]) ?>
                    </div>                        
                </div>
                <?}else{?>
                <div class="about-page__info-item">
                    <?= htmlspecialchars_decode($arItem["PROPERTIES"]["CONTACTS"]["VALUE"]["TEXT"]); ?> 
                </div>
                <?}?>                  
            </div>

        </div>
        <?endforeach;?>


