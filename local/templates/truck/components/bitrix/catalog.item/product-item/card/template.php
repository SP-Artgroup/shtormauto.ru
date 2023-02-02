<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

$maxQuantity = 5;

?>
<div class="product-unit">
    <? //echo '<pre style=display:none>'; print_r($arResult); echo '</pre>';?>

    <a
        class="head-slide"
        href="<?=$item['DETAIL_PAGE_URL']?>"
        title="<?=$imgTitle?>"
        data-entity="image-wrapper"
    >
        <div
            class="image"
            style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC']?>)"
            id="<?=$itemIds['PICT']?>"
        ></div>

        <?
        if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
        {
            ?>
            <div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
                <?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>>
                <span><?=-$price['PERCENT']?>%</span>
            </div>
            <?
        }

        if ($item['LABEL'])
        {
            ?>
            <div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>">
                <?
                if (!empty($item['LABEL_ARRAY_VALUE']))
                {
                    foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
                    {
                        ?>
                        <div<?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
                            <span title="<?=$value?>"><?=$value?></span>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <?
        }
        ?>
    </a>

    <div class="product-info">

        <p class="name">
            <a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><?=$productTitle?></a>
        </p>

        <div class="price-box" data-entity="price-block">

            <?php if ($arParams['SHOW_OLD_PRICE'] === 'Y'): ?>
                <span class="price_old" id="<?=$itemIds['PRICE_OLD']?>"
                    <?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
                    <?=$price['PRINT_RATIO_BASE_PRICE']?>
                </span>&nbsp;
            <?php endif ?>

            <span class="price" id="<?=$itemIds['PRICE']?>">
                <?
                if (!empty($price))
                {
                    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
                    {
                        echo Loc::getMessage(
                            'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                            array(
                                '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                '#VALUE#' => $measureRatio,
                                '#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
                            )
                        );
                    }
                    else
                    {
                        echo $price['PRINT_RATIO_PRICE'];
                    }
                }
                ?>
            </span>
        </div>

        <?$APPLICATION->IncludeComponent(
        	'sp-artgroup:store.list',
        	'truck-store-list',
        	[
        		'PRODUCT_DATA' => [
        			'STORES'  => $item['STORE_DATA']['STORES'],
        			'AMOUNTS' => $item['STORE_DATA']['AMOUNTS'],
        		]
        	],
        	$component,
        	['HIDE_ICONS' => 'Y']
        );?>

        <? if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) { ?>

            <div class="clearfix footer-slide">

                <? foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {

                    switch ($blockName)
                    {
                        case 'quantity':

                            if (
                                $arParams['USE_PRODUCT_QUANTITY']
                                && (
                                    (!$haveOffers && $actualItem['CAN_BUY'])
                                    || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y'
                                )
                            ) { ?>
                                <div class="custom-input-number" data-entity="quantity-block">
                                    <button type="button" class="cin-btn cin-btn-1 cin-btn-md cin-decrement" id="<?=$itemIds['QUANTITY_DOWN']?>">
                                    -
                                    </button>

                                    <input
                                        type="number"
                                        class="cin-input basket-quantity"
                                        step="1"
                                        value="1"
                                        min="1"
                                        max="<?= $maxQuantity ?>"
                                        name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
                                        id="<?=$itemIds['QUANTITY']?>"
                                        value="<?=$measureRatio?>"
                                    >

                                    <button type="button" class="cin-btn cin-btn-1 cin-btn-md cin-increment" id="<?=$itemIds['QUANTITY_UP']?>">
                                    +
                                    </button>
                                </div>
                            <?
                            }

                            break;

                        case 'buttons':
                            ?>
                            <div class="product-item-info-container" data-entity="buttons-block">

                                <?
                                if (!$haveOffers)
                                {
                                    if ($actualItem['CAN_BUY'])
                                    {
                                        ?>
                                        <div class="product-item-button-container" id="<?= $itemIds['BASKET_ACTIONS'] ?>">

                                            <a class="btn2 inbascet" id="<?= $itemIds['BUY_LINK'] ?>"
                                                href="javascript:void(0)" rel="nofollow"
                                            >
                                                <i class="fas fa-shopping-cart"></i>
                                                <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
                                            </a>

                                        </div>

                                        <?
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="product-item-button-container">
                                            <?
                                            if ($showSubscribe)
                                            {
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.product.subscribe',
                                                    '',
                                                    array(
                                                        'PRODUCT_ID' => $actualItem['ID'],
                                                        'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                        'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
                                                        'DEFAULT_DISPLAY' => true,
                                                        'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                            }
                                            ?>
                                            <span
                                                class="out-of-stock"
                                                id="<?=$itemIds['NOT_AVAILABLE_MESS']?>"
                                                href="javascript:void(0)"
                                                rel="nofollow"
                                            ><?= $arParams['MESS_NOT_AVAILABLE'] ?></span>
                                            <? if($item['AVAILABLE_CITIES_STRING'] != ''):?>
                                                <div class="available-cities">В наличии: <?= $item['AVAILABLE_CITIES_STRING'] ?></div>
                                            <? endif;?>
                                        </div>
                                        <?
                                    }
                                }
                                else
                                {
                                    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
                                    {
                                        ?>
                                        <div class="product-item-button-container">
                                            <?
                                            if ($showSubscribe)
                                            {
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.product.subscribe',
                                                    '',
                                                    array(
                                                        'PRODUCT_ID' => $item['ID'],
                                                        'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                        'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
                                                        'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
                                                        'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                            }
                                            ?>
                                            <a class="btn btn-link <?=$buttonSizeClass?>"
                                                id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
                                                <?=($actualItem['CAN_BUY'] ? 'style="display: none;"' : '')?>>
                                                <?=$arParams['MESS_NOT_AVAILABLE']?>
                                            </a>
                                            <div id="<?=$itemIds['BASKET_ACTIONS']?>" <?=($actualItem['CAN_BUY'] ? '' : 'style="display: none;"')?>>
                                                <a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
                                                    href="javascript:void(0)" rel="nofollow">
                                                    <?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
                                                </a>
                                            </div>
                                        </div>
                                        <?
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="product-item-button-container">
                                            <a class="btn btn-default <?=$buttonSizeClass?>" href="<?=$item['DETAIL_PAGE_URL']?>">
                                                <?=$arParams['MESS_BTN_DETAIL']?>
                                            </a>
                                        </div>
                                        <?
                                    }
                                }
                                ?>

                            </div>
                            <?
                            break;
                    }
                } ?>

            </div>
        <?
        }
        ?>
    </div>

</div>