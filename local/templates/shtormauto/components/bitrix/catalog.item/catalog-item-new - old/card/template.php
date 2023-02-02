<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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

unset($item['DISPLAY_PROPERTIES']['EX_GUARANT']);
unset($item['DISPLAY_PROPERTIES']['FREE_REPAIR']);
?>
            
<div class="product-item__wrapper">
    <div class="product-marks <?=$hit?>"></div>
    <div class="sticker-buy-credit">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "named_area",
            Array(
                "AREA_FILE_SHOW" => "file",
                "NAME" => "Изменить логотип",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/sticker_credit.php"
            )
        );?>
    </div>
    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>" data-entity="image-wrapper" class="product-item__img-link">
        <img
            class="product-item__img"
            src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>"
            alt="<?= $imgTitle ?>"
            id="<?= $itemIds['PICT'] ?>"
            style="<?= ($showSlider ? 'display: none;' : '') ?>"
            > 
                       
    </a>
    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="product-item__title"><?= $productTitle ?></a>
    
    <div class="product-item__specification">
        <?foreach ($item["DISPLAY_PROPERTIES"] as $arPropsItem){?>
        <?= $arPropsItem["NAME"] ?>: <?= $arPropsItem["~VALUE"] ?> <br>
        <?}?>
    </div>	
    <? if (/*$actualItem['CAN_BUY']*/!empty($itemIds['PRICE']) && $price["PRICE"] > 0):?>
        <div class="product-item__price" data-entity="price-block">
            <? if ($arParams['SHOW_OLD_PRICE'] === 'Y'){?>
                <span class="product-item__price-old" id="<?= $itemIds['PRICE_OLD'] ?>"
                      <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>>
                          <?= '&#8381;'.(int)$price["BASE_PRICE"]; ?>
                </span>
            <?}?>
            <span id="<?= $itemIds['PRICE'] ?>">
                <?
                echo '&#8381;'.(int)$price["PRICE"];
               /* if (!empty($price))
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
                }*/
                ?>
            </span>
        </div>
    <? endif ?>
    <div class="main-show-block" >
        <?if($arParams['EX_GUARANT'] == 'Y'):?>
            <div class="show-block btn" ><span>расширенная гарантия</span></div>
        <?endif?>
        <?if($arParams['FREE_REPAIR'] == 'Y'):?>
            <div class="show-block btn" ><span>бесплантый шиномонтаж</span></div>
        <?endif?>
 
    </div>
    <div class="product-item__buy">
        <?php if (isset($item['STORE_DATA'])): ?>
            <div class="product-item-store-list form-select product-item__buy-select">
                <?$APPLICATION->IncludeComponent(
                "sp-artgroup:store.list",
                "new",
                [
                "PRODUCT_DATA" => [
                'STORES'  => $item['STORE_DATA']['STORES'],
                'AMOUNTS' => $item['STORE_DATA']['AMOUNTS'],
                ]
                ],
                $component,
                ['HIDE_ICONS' => 'Y']
                );?>
            </div>
        <?php endif ?>    


        <?
        if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
        {
        foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
        {
        switch ($blockName)
        {
        case 'quantityLimit':
        if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
        {
        if ($haveOffers)
        {
        if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
        {
        ?>
        <div class="product-item-info-container product-item-hidden" id="<?= $itemIds['QUANTITY_LIMIT'] ?>"
             style="display: none;" data-entity="quantity-limit-block">
            <div class="product-item-info-container-title">
                <?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
                <span class="product-item-quantity" data-entity="quantity-limit-value"></span>
            </div>
        </div>
        <?
        }
        }
        else
        {
        if (
        $measureRatio
        && (float)$actualItem['CATALOG_QUANTITY'] > 0
        && $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
        && $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
        )
        {
        ?>
        <div class="product-item-info-container product-item-hidden" id="<?= $itemIds['QUANTITY_LIMIT'] ?>">
            <div class="product-item-info-container-title">
                <?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
                <span class="product-item-quantity">
                    <?
                    if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
                    {
                    if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
                    {
                    echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
                    }
                    else
                    {
                    echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
                    }
                    }
                    else
                    {
                    echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
                    }
                    ?>
                </span>
            </div>
        </div>
        <?
        }
        }
        }

        break;

        case 'quantity':
        if (!$haveOffers)
        {
        if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY'])
        {
        ?>
        <div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
            <div class="product-item-amount">
                <div class="product-item-amount-field-container">
                    <a class="product-item-amount-field-btn-minus" id="<?= $itemIds['QUANTITY_DOWN'] ?>"
                       href="javascript:void(0)" rel="nofollow">
                    </a>
                    <input class="product-item-amount-field" id="<?= $itemIds['QUANTITY'] ?>" type="tel"
                           name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>"
                           value="<?= $measureRatio ?>">
                    <a class="product-item-amount-field-btn-plus" id="<?= $itemIds['QUANTITY_UP'] ?>"
                       href="javascript:void(0)" rel="nofollow">
                    </a>
                    <span class="product-item-amount-description-container">
                        <span id="<?= $itemIds['QUANTITY_MEASURE'] ?>">
                            <?= $actualItem['ITEM_MEASURE']['TITLE'] ?>
                        </span>
                        <span id="<?= $itemIds['PRICE_TOTAL'] ?>"></span>
                    </span>
                </div>
            </div>
        </div>
        <?
        }
        }
        elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
        {
        if ($arParams['USE_PRODUCT_QUANTITY'])
        {
        ?>
        <div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
            <div class="product-item-amount">
                <div class="product-item-amount-field-container">
                    <a class="product-item-amount-field-btn-minus" id="<?= $itemIds['QUANTITY_DOWN'] ?>"
                       href="javascript:void(0)" rel="nofollow">
                    </a>
                    <input class="product-item-amount-field" id="<?= $itemIds['QUANTITY'] ?>" type="tel"
                           name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>"
                           value="<?= $measureRatio ?>">
                    <a class="product-item-amount-field-btn-plus" id="<?= $itemIds['QUANTITY_UP'] ?>"
                       href="javascript:void(0)" rel="nofollow">
                    </a>
                    <span class="product-item-amount-description-container">
                        <span id="<?= $itemIds['QUANTITY_MEASURE'] ?>"><?= $actualItem['ITEM_MEASURE']['TITLE'] ?></span>
                        <span id="<?= $itemIds['PRICE_TOTAL'] ?>"></span>
                    </span>
                </div>
            </div>
        </div>
        <?
        }
        }

        break;

        case 'buttons':
        ?>
        <?
        if (!$haveOffers)
        {
        if ($actualItem['CAN_BUY'])
        {
        ?>
        <div class="browse_but2">
            <button
                id="<?= $itemIds['BUY_LINK'] ?>"
                type="button" class="button btn btn-dark product-item__buy-btn"
                >
                <span><?=
                    (
                    $arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']
                    )
                    ?></span>
            </button>
        </div>

        <? /*
        <div class="product-item-button-container" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
        <a class="btn btn-default <?= $buttonSizeClass ?>" id="<?= $itemIds['BUY_LINK'] ?>"
        href="javascript:void(0)" rel="nofollow">
        <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
        </a>
        </div>
        */ ?>
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
            <span class="btn-not-avail">
                <strong><?= $arParams['MESS_NOT_AVAILABLE'] ?></strong><br/>
            </span>
            <? if (!empty($arParams['CITY_AMOUNTS'])): ?>
                <?
                $cityIds = array_keys($arParams['CITY_AMOUNTS']);
                $city_link = [];

                foreach ($cityIds as $cityId) {
                    $cityName = $arParams['CITY_LIST'][$cityId]['NAME'];
                    $city_link[] = '<a href="' . $item['DETAIL_PAGE_URL'].'?chcity='. $cityId . '">' . $cityName . '</a>';
                }

                if (!empty($city_link)) { ?>
                    В наличии:
                    <?= implode(', ', $city_link) ?>
                <? } else { ?>
                    Наличие в других городах: нет
                <? } ?>
            <? endif ?>
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
            <a class="btn btn-link <?= $buttonSizeClass ?>"
               id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" href="javascript:void(0)" rel="nofollow"
               style="display: <?= ($actualItem['CAN_BUY'] ? 'none' : '') ?>;">
                   <?= $arParams['MESS_NOT_AVAILABLE'] ?>
            </a>
            <div id="<?= $itemIds['BASKET_ACTIONS'] ?>" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;">
                <a class="btn btn-default <?= $buttonSizeClass ?>" id="<?= $itemIds['BUY_LINK'] ?>"
                   href="javascript:void(0)" rel="nofollow">
                       <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                </a>
            </div>
        </div>
        <?
        }
        else
        {
        ?>
        <div class="product-item-button-container">
            <a class="btn btn-default <?= $buttonSizeClass ?>" href="<?= $item['DETAIL_PAGE_URL'] ?>">
                <?= $arParams['MESS_BTN_DETAIL'] ?>
            </a>
        </div>
        <?
        }
        }
        ?>
    </div>
    <?
    break;

    case 'props':
    if (!$haveOffers)
    {

    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']))
    {
    ?>
    <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
        <?
        if (!empty($item['PRODUCT_PROPERTIES_FILL']))
        {
        foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
        {
        ?>
        <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
               value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
        <?
        unset($item['PRODUCT_PROPERTIES'][$propID]);
        }
        }

        if (!empty($item['PRODUCT_PROPERTIES']))
        {
        ?>
        <table>
            <?
            foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo)
            {
            ?>
            <tr>
                <td><?= $item['PROPERTIES'][$propID]['NAME'] ?></td>
                <td>
                    <?
                    if (
                    $item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
                    && $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
                    )
                    {
                    foreach ($propInfo['VALUES'] as $valueID => $value)
                    {
                    ?>
                    <label>
                        <? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
                        <input type="radio" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                               value="<?= $valueID ?>" <?= $checked ?>>
                               <?= $value ?>
                    </label>
                    <br />
                    <?
                    }
                    }
                    else
                    {
                    ?>
                    <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]">
                        <?
                        foreach ($propInfo['VALUES'] as $valueID => $value)
                        {
                        $selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
                        ?>
                        <option value="<?= $valueID ?>" <?= $selected ?>>
                            <?= $value ?>
                        </option>
                        <?
                        }
                        ?>
                    </select>
                    <?
                    }
                    ?>
                </td>
            </tr>
            <?
            }
            ?>
        </table>
        <?
        }
        ?>
    </div>
    <?
    }
    }
    else
    {
    $showProductProps = !empty($item['DISPLAY_PROPERTIES']);
    $showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];

    }

    break;

    case 'sku':
    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP']))
    {
    ?>
    <div id="<?= $itemIds['PROP_DIV'] ?>">
        <?
        foreach ($arParams['SKU_PROPS'] as $skuProperty)
        {
        $propertyId = $skuProperty['ID'];
        $skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
        if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
        continue;
        ?>
        <div class="product-item-info-container product-item-hidden" data-entity="sku-block">
            <div class="product-item-scu-container" data-entity="sku-line-block">
                <?= $skuProperty['NAME'] ?>
                <div class="product-item-scu-block">
                    <div class="product-item-scu-list">
                        <ul class="product-item-scu-item-list">
                            <?
                            foreach ($skuProperty['VALUES'] as $value)
                            {
                            if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
                            continue;

                            $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                            if ($skuProperty['SHOW_MODE'] === 'PICT')
                            {
                            ?>
                            <li class="product-item-scu-item-color-container" title="<?= $value['NAME'] ?>"
                                data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
                                <div class="product-item-scu-item-color-block">
                                    <div class="product-item-scu-item-color" title="<?= $value['NAME'] ?>"
                                         style="background-image: url(<?= $value['PICT']['SRC'] ?>);">
                                    </div>
                                </div>
                            </li>
                            <?
                            }
                            else
                            {
                            ?>
                            <li class="product-item-scu-item-text-container" title="<?= $value['NAME'] ?>"
                                data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
                                <div class="product-item-scu-item-text-block">
                                    <div class="product-item-scu-item-text"><?= $value['NAME'] ?></div>
                                </div>
                            </li>
                            <?
                            }
                            }
                            ?>
                        </ul>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
        </div>
        <?
        }
        ?>
    </div>
    <?
    foreach ($arParams['SKU_PROPS'] as $skuProperty)
    {
    if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
    continue;

    $skuProps[] = array(
    'ID' => $skuProperty['ID'],
    'SHOW_MODE' => $skuProperty['SHOW_MODE'],
    'VALUES' => $skuProperty['VALUES'],
    'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
    );
    }

    unset($skuProperty, $value);

    if ($item['OFFERS_PROPS_DISPLAY'])
    {
    foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer)
    {
    $strProps = '';

    if (!empty($jsOffer['DISPLAY_PROPERTIES']))
    {
    foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty)
    {
    $strProps .= '<dt>'.$displayProperty['NAME'].'</dt><dd>'
    .(is_array($displayProperty['VALUE'])
    ? implode(' / ', $displayProperty['VALUE'])
    : $displayProperty['VALUE'])
    .'</dd>';
    }
    }

    $item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
    }
    unset($jsOffer, $strProps);
    }
    }

    break;
    }
    }
    }?>
    <?if (
    $arParams['DISPLAY_COMPARE']
    && (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
    )
    {
    ?>
    <div class="product-item-compare-container">
        <div class="product-item-compare">
            <div class="checkbox">
                <label id="<?= $itemIds['COMPARE_LINK'] ?>">
                    <input type="checkbox" data-entity="compare-checkbox">
                    <span data-entity="compare-title"><?= $arParams['MESS_BTN_COMPARE'] ?></span>
                </label>
            </div>
        </div>
    </div>
    <?
    }
    ?>

</div>
