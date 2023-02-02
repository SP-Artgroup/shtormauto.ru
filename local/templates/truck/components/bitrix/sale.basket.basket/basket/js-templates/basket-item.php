<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
    'left' => 'basket-item-label-left',
    'center' => 'basket-item-label-center',
    'right' => 'basket-item-label-right',
    'bottom' => 'basket-item-label-bottom',
    'middle' => 'basket-item-label-middle',
    'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
    {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
    }
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
    {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
    }
}
?>
<script id="basket-item-template" type="text/html">

    <tr
        class="basket-table__row"
        id="basket-item-{{ID}}"
        data-entity="basket-item"
        data-id="{{ID}}"
    >
        {{#SHOW_RESTORE}}
            <td class="basket-table__cell" colspan="<?=$restoreColSpan?>">
                <div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed" id="basket-item-height-aligner-{{ID}}">
                    {{#SHOW_LOADING}}
                        <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
                    <div class="basket-items-list-item-removed-container">
                        <div>
                            <?=Loc::getMessage('SBB_GOOD_CAP')?> <strong>{{NAME}}</strong> <?=Loc::getMessage('SBB_BASKET_ITEM_DELETED')?>.
                        </div>
                        <div class="basket-items-list-item-removed-block">
                            <a href="javascript:void(0)" data-entity="basket-item-restore-button">
                                <?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
                            </a>
                            <span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
                        </div>
                    </div>
                </div>
            </td>
        {{/SHOW_RESTORE}}
        {{^SHOW_RESTORE}}
            <td class="basket-table__cell basket-table__cell_product-info">

                <div class="basket-table__inner-cell basket-table__inner-cell_flex-row" id="basket-item-height-aligner-{{ID}}">

                    <?php if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST'])): ?>

                        {{#DETAIL_PAGE_URL}}
                            <a href="{{DETAIL_PAGE_URL}}">
                        {{/DETAIL_PAGE_URL}}

                        <div
                            class="basket-table__product-image"
                            style="background-image: url({{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}})"
                        ></div>

                        {{#DETAIL_PAGE_URL}}
                            </a>
                        {{/DETAIL_PAGE_URL}}

                    <?php endif ?>

                    <div class="basket-table__product-info">

                        <h2 class="basket-table__product-name">
                            {{#DETAIL_PAGE_URL}}
                                <a href="{{DETAIL_PAGE_URL}}">
                            {{/DETAIL_PAGE_URL}}

                            <span data-entity="basket-item-name">{{NAME}}</span>

                            {{#DETAIL_PAGE_URL}}
                                </a>
                            {{/DETAIL_PAGE_URL}}
                        </h2>

                        {{#SHOP}}
                            <div class="basket-table__product-shop">
                                {{SHOP.NAME}}
                            </div>
                        {{/SHOP}}

                        <span class="basket-table__remove" data-entity="basket-item-delete">Удалить</span>

                        {{#NOT_AVAILABLE}}
                            <div class="basket-items-list-item-warning-container">
                                <div class="alert alert-warning text-center">
                                    <?=Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE')?>.
                                </div>
                            </div>
                        {{/NOT_AVAILABLE}}

                        {{#DELAYED}}
                            <div class="basket-items-list-item-warning-container">
                                <div class="alert alert-warning text-center">
                                    <?=Loc::getMessage('SBB_BASKET_ITEM_DELAYED')?>.
                                    <a href="javascript:void(0)" data-entity="basket-item-remove-delayed">
                                        <?=Loc::getMessage('SBB_BASKET_ITEM_REMOVE_DELAYED')?>
                                    </a>
                                </div>
                            </div>
                        {{/DELAYED}}

                        {{#WARNINGS.length}}
                            <div class="basket-items-list-item-warning-container">
                                <div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
                                    <span class="close" data-entity="basket-item-warning-close">&times;</span>
                                        {{#WARNINGS}}
                                            <div data-entity="basket-item-warning-text">{{{.}}}</div>
                                        {{/WARNINGS}}
                                </div>
                            </div>
                        {{/WARNINGS.length}}

                    </div>

                </div>

            </td>

            <td class="basket-table__cell basket-table__cell_quantity">

                <div class="basket-table__inner-cell basket-table__inner-cell_flex-col {{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}"
                    data-entity="basket-item-quantity-block">

                    <div class="custom-input-number" data-entity="quantity-block">

                        <button
                            class="cin-btn cin-btn-1 cin-btn-md cin-decrement"
                            type="button"
                            data-entity="basket-item-quantity-minus"
                        >-</button>

                        <input
                            type="number"
                            class="cin-input basket-quantity"
                            step="1"
                            value="{{QUANTITY}}"
                            min="1"
                            max="<?= $maxQuantity ?>"
                            name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
                            id="basket-item-quantity-{{ID}}"
                            {{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
                            data-value="{{QUANTITY}}"
                            data-entity="basket-item-quantity-field"
                        >

                        <button
                            class="cin-btn cin-btn-1 cin-btn-md cin-increment"
                            type="button"
                            data-entity="basket-item-quantity-plus"
                        >+</button>

                    </div>

                    <span class="basket-table__remove visible-xs" data-entity="basket-item-delete">Удалить</span>

                </div>

            </td>

            <?php if ($usePriceInAdditionalColumn): ?>

                <td class="basket-table__cell basket-table__cell_price hidden-xs">

                    <div class="basket-table__inner-cell basket-table__inner-cell_flex-col">

                        {{#SHOW_DISCOUNT_PRICE}}
                            <span class="price price_old">
                                {{{FULL_PRICE_FORMATED}}}
                            </span>
                        {{/SHOW_DISCOUNT_PRICE}}

                        <span class="basket-table__price price" id="basket-item-price-{{ID}}">
                            {{{PRICE_FORMATED}}}
                        </span>

                    </div>

                </td>

            <?php endif ?>

            <?
            if ($useSumColumn)
            {
                ?>
                <td class="basket-table__cell basket-table__cell_sum">
                    <div class="basket-table__inner-cell basket-table__inner-cell_flex-col">

                        {{#SHOW_DISCOUNT_PRICE}}
                            <div class="price price_old" id="basket-item-sum-price-old-{{ID}}">
                                {{{SUM_FULL_PRICE_FORMATED}}}
                            </div>
                        {{/SHOW_DISCOUNT_PRICE}}

                        <div class="price" id="basket-item-sum-price-{{ID}}">
                            {{{SUM_PRICE_FORMATED}}}
                        </div>

                    </div>
                </td>
                <?
            }
            ?>
        {{/SHOW_RESTORE}}
    </tr>
</script>