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
<?if ($arResult["ELEMENTS_CNT"]>0){?>
<div class="tiled-categories">
    <div class="row flex-column flex-lg-row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <a href="/catalog.html">
                        <div class="tiled-categories__item tiled-categories__item--tires">
                            <h2 class="tiled-categories__item-heading">Шины</h2>
                            <div class="tiled-categories__item-description">
                                Еще у нас есть шикарный шинный центр и, конечно, надежный профессиональный сервис!
                            </div>
                        </div>
                    </a>
                </div>
                <?if (is_array($arResult[1])){?>
                <div class="col-md-6 d-block d-lg-none">
                    <a href="<?=$arResult[1]["LINK"];?>">
                        <div class="tiled-categories__item tiled-categories__item--discs">
                            <h2 class="tiled-categories__item-heading"><?=$arResult[1]["NAME"];?></h2>
                            <div class="tiled-categories__item-description">
                                <?=$arResult[1]["DESCRIPTION"];?>
                            </div>
                        </div>
                    </a>
                </div>
                <?}?>
            </div>
        </div>
        <div class="col-lg-6">
            <?if (is_array($arResult[1])){?>
            <a href="<?=$arResult[1]["LINK"];?>">
                <div class="tiled-categories__item tiled-categories__item--discs d-none d-lg-flex">
                    <h2 class="tiled-categories__item-heading"><?=$arResult[1]["NAME"];?></h2>
                    <div class="tiled-categories__item-description">
                       <?=$arResult[1]["DESCRIPTION"];?>
                    </div>
                </div>
            </a>
            <?}?>
            <div class="row">
                <?if (is_array($arResult[2])){?>
                <div class="col-md-6">
                    <a href="<?=$arResult[2]["LINK"];?>">
                        <div class="tiled-categories__item tiled-categories__item--accumulators">
                            <h2 class="tiled-categories__item-heading"><?=$arResult[2]["NAME"];?></h2>
                        </div>
                    </a>
                </div>
                <?}?>
                <?if (is_array($arResult[3])){?>
                <div class="col-md-6">
                    <a href="<?=$arResult[3]["LINK"];?>">
                        <div class="tiled-categories__item tiled-categories__item--oils">
                            <h2 class="tiled-categories__item-heading"><?=$arResult[3]["NAME"];?></h2>
                        </div>
                    </a>
                </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
<?}?>