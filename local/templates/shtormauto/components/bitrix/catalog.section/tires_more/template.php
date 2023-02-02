<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$hermitage = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'),
    'CONFIRM' => ['CONFIRM' => Loc::getMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')],
];

?>
<div class="similar-products-list">

    <br/>

    <span style="font-size:14px; color:#000;">Другие товары данной модели:</span>

    <br/><br/>

    <table cellpadding="0" cellspacing="0" border="0" width="100%">

        <tr>
            <th>Размер</th>
            <th>Цена</th>
            <th style="width:80px;"></th>
        </tr>

        <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>

            <?
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], $hermitage['EDIT']);
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], $hermitage['DELETE'], $hermitage['CONFIRM']);

            $price = $arElement['ITEM_PRICES'][$arElement['ITEM_PRICE_SELECTED']];
            ?>

            <tr class="tires">
                <td id="<?=$this->GetEditAreaId($arElement['ID'])?>">

                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=trim($arElement["NAME"])?>"><?=trim($arElement["NAME"])?></a><br />

                    <?php if (isset($arElement['STORE_DATA'])): ?>
                        <div class="similar-products-store-list">
                            <?$APPLICATION->IncludeComponent(
                                "sp-artgroup:store.list",
                                "",
                                [
                                    "PRODUCT_DATA" => [
                                        'STORES'  => $arElement['STORE_DATA']['STORES'],
                                        'AMOUNTS' => $arElement['STORE_DATA']['AMOUNTS'],
                                    ]
                                ],
                                $component
                            );?>
                        </div>
                    <?php endif ?>

                </td>

                <td width="100px" align="center">
                    <? if ($price['DISCOUNT']): ?>
                        <s><?= $price['BASE_PRICE'] ?></s>
                    <? endif ?>
                    <span class="catalog-price"><?=$price['PRINT_PRICE']?></span>
                </td>

                <td class="td-buy-btn">
                    <button
                        type="button"
                        class="buy-btn-small js-buy-btn"
                        href="/local/ajax/action.php?action=add_to_basket&product_id=" rel="<?=$arElement['ID']?>"
                        data-product-id="<?=$arElement['ID']?>"
                        data-price-id="<?=$price['ID']?>"
                    ></button>
                </td>

            </tr>
        <? endforeach ?>
    </table>

</div>