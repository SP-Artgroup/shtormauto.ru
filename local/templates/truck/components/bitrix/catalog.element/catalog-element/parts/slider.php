<div class="detailed-slider">
    <div class="slider-for <?= !$showSliderControls ? 'single' : '' ?>">
        <?
        if (!empty($actualItem['MORE_PHOTO'])) {

            foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                ?>
                <div class="slide">
                    <a
                        class="sprite sprite-lupa"
                        data-fancybox="gallery"
                        href="<?= $photo['SRC'] ?>"
                    >
                        <div
                            class="image"
                            alt="<?= $alt ?>"
                            title="<?= $title ?>"
                            style="background-image: url(<?= $photo['SRC'] ?>)"
                            <?= ($key == 0 ? ' itemprop="image"' : '') ?>
                        ></div>
                    </a>
                </div>
                <?
            }
        }
        ?>
    </div>

    <?
    if ($showSliderControls)
    {
        if ($haveOffers)
        {
            foreach ($arResult['OFFERS'] as $keyOffer => $offer)
            {
                if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
                    continue;

                $strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
                ?>
                <div class="product-item-detail-slider-controls-block" id="<?=$itemIds['SLIDER_CONT_OF_ID'].$offer['ID']?>" style="display: <?=$strVisible?>;">
                    <?
                    foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo)
                    {
                        ?>
                        <div class="product-item-detail-slider-controls-image<?=($keyPhoto == 0 ? ' active' : '')?>"
                            data-entity="slider-control" data-value="<?=$offer['ID'].'_'.$photo['ID']?>">
                            <img src="<?=$photo['SRC']?>">
                        </div>
                        <?
                    }
                    ?>
                </div>
                <?
            }
        }
        else
        {
            ?>
            <div class="slider-nav">
                <?
                if (!empty($actualItem['MORE_PHOTO'])) {

                    foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                        ?>

                        <div class="slide">
                            <div
                                class="image"
                                style="background-image: url(<?= $photo['SRC'] ?>)"
                            ></div>
                        </div>

                        <?
                    }
                }
                ?>
            </div>
            <?
        }
    }
    ?>

</div>

<? /*
<div class="col-md-6 col-sm-12">
    <div class="product-item-detail-slider-container" id="<?=$itemIds['BIG_SLIDER_ID']?>">

        <span class="product-item-detail-slider-close" data-entity="close-popup"></span>

        <div class="product-item-detail-slider-block
            <?=($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '')?>"
            data-entity="images-slider-block">
            <span class="product-item-detail-slider-left" data-entity="slider-control-left" style="display: none;"></span>
            <span class="product-item-detail-slider-right" data-entity="slider-control-right" style="display: none;"></span>
            <div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>"

                <?=(!$arResult['LABEL'] ? 'style="display: none;"' : '' )?>>

                <?
                if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE']))
                {
                    foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value)
                    {
                        ?>
                        <div <?=(!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
                            <span title="<?=$value?>"><?=$value?></span>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <?
            if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
            {
                if ($haveOffers)
                {
                    ?>
                    <div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
                        style="display: none;">
                    </div>
                    <?
                }
                else
                {
                    if ($price['DISCOUNT'] > 0)
                    {
                        ?>
                        <div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
                            title="<?=-$price['PERCENT']?>%">
                            <span><?=-$price['PERCENT']?>%</span>
                        </div>
                        <?
                    }
                }
            }
            ?>
        </div>

    </div>
</div>
*/ ?>