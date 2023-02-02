<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
global $USER;
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixBasketComponent $component
 */

$actionVar       = $arParams['ACTION_VARIABLE'];
$deleteActionUrl = '/personal/cart/index.php?' . $actionVar . '=delete&id=';

if (isset($arParams["DISCOUNT_CHECK"])) {
   $discountCheck = explode(", ", $arParams["DISCOUNT_CHECK"]);
} else {
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    $discountCheck = explode(", ",$arUser['UF_SKIDKA_SDAT_STARIY_AKKAMULYATOR']);
}
?>
<div class="basket-full">

    <header class="basket-full-header">
        <div class="basket-full-header__wrapper">
            <div class="basket-full-header__step active">
                <span class="basket-full-header__step-number">1</span>
                <span class="basket-full-header__step-text">Проверка заказа</span>
            </div>
            <div class="basket-full-header__delimiter"></div>
            <div class="basket-full-header__step">
                <span class="basket-full-header__step-number">2</span>
                <span class="basket-full-header__step-text">Оплата и доставка</span>
            </div>
        </div>
        <div class="basket-full-header__current-step d-block d-md-none">Проверка заказа</div>
    </header>

    <? if (sizeof($arResult['ITEMS']['AnDelCanBuy']) <= 0): ?>
        <div id="basket_items_list">
            <table>
                <tbody>
                    <tr>
                        <td colspan="<?=$numCells?>" style="text-align:center">
                            <div class=""><?=GetMessage("SALE_NO_ITEMS");?> Перейти в <a href="/catalog/">каталог</a></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <? endif ?>

    <? if (strlen($arResult["ERROR_MESSAGE"]) <= 0): ?>

        <div class="content-form-body content-form-body--table">

            <div id="warning_message">
                <?= implode('<br/> ', $arResult["WARNING_MESSAGE"]) ?>
            </div>

            <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="basket_form" id="basket_form">
                <input type="hidden" id="action_var" value="<?= CUtil::JSEscape($arParams["ACTION_VARIABLE"]) ?>" />
                <input type="hidden" id="quantity_float" value="<?= $arParams["QUANTITY_FLOAT"] ?>" />
                <input type="hidden" id="count_discount_4_all_quantity" value="<?= ($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N" ?>" />
                <input type="hidden" id="price_vat_show_value" value="<?= ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N" ?>" />
                <input type="hidden" id="hide_coupon" value="<?= ($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N" ?>" />
                <input type="hidden" id="use_prepayment" value="<?= ($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N" ?>" />
                <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />

                <table class="table">
                    <thead class="d-none d-md-table-header-group">
                        <tr>
                            <th>Название</th>
                            <th class="t-price d-none d-lg-table-cell">Цена</th>
                            <th class="t-counter d-none d-lg-table-cell">Количество</th>
                            <th class="t-total-price">Сумма</th>
                            <th class="t-delete"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <? 
                            $i = 0;
                        foreach ($arResult['ITEMS']['AnDelCanBuy'] as $arItem): ?>
                            <?
                            $sezon = "";
                            switch ($arItem["PROP_SEZONNOST"]){
                                case "Лето": $sezon="icon i-summer"; break;
                                case "Зима": $sezon="icon i-winter"; break;
                            }
                            ?>
                            <tr class="rowItem">
                                <td>
                                    <div class="basket-item">
                                        <div class="basket-item__img-wrapper">
                                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" tabindex="-1">
                                                <img
                                                src="<?= $arItem['PREVIEW_PICTURE_SRC'] ?>"
                                                alt="<?= $arItem['NAME'] ?>"
                                                title="<?= $arItem['NAME'] ?>"
                                                class="basket-item__img"
                                                >
                                            </a>
                                        </div>
                                        <div class="basket-item__info">
                                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="basket-item__name"><?=$arItem['NAME']?><i class="<?=$sezon;?>"></i></a>
                                            <div class="basket-item__small-description"><?=$arItem["PREVIEW_TEXT"];?></div>
                                            <? if((int)$arResult["MAX_QUANTITY_CITY"][$arItem["PRODUCT_ID"]] < (int)$arItem['QUANTITY']):?>
                                                <div class="scarlet"><strong>Доставка от 3-х дней</strong></div>
                                              <? endif;?>
                                            <div class="basket-item__address">
                                                <?php if (!empty($arItem['STORE'])): ?>
                                                    <span><?= $arItem['STORE']['NAME'] ?></span>
                                                <?php endif ?>
                                            </div>
                                            <div class="basket-item__info-bottom d-flex d-lg-none">

                                                <div class="basket-item__price order-last order-md-first">
													<?if ($arItem["BASE_PRICE"]>$arItem["PRICE"]){?>
                                            		<span class="d-md-none table__price-old">&#8381;<?=$arItem["FULL_PRICE"];?></span>
                                            		<?}?>
													&#8381;<?=$arItem["PRICE"]; ?>
												</div>
                                                <div class="counter order-first order-md-last">
                                                    <button type="button" class="btn counter__minus">-</button>
                                                    <input type="number" value="<?=$arItem["QUANTITY"]?>" data-id="<?=$arItem["ID"]?>" data-shopId="<?=$arItem['STORE']["VALUE"]?>" data-mode="update" class="counter__input">
                                                    <button type="button" class="btn counter__plus">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= $deleteActionUrl . $arItem['ID'] ?>" class="table__delete-item d-block d-md-none"><i class="icon i-delete"></i></a>
                                    </div>
                                </td>
                                <td class="t-price d-none d-lg-table-cell">
                                    <div class="table__price">
                                        <?if ($arItem["BASE_PRICE"]>$arItem["PRICE"]){?>
                                            <span class="table__price-old">&#8381;<?=$arItem["FULL_PRICE"];?></span>
                                            <?}?>
                                            <span class="table__price-current">&#8381;<?=$arItem["PRICE"]; ?></span>
                                        </div>
                                    </td>
                                    <td class="t-counter d-none d-lg-table-cell">
                                        <div class="counter">
                                            <button type="button" class="btn counter__minus">-</button>
                                            <input type="number" value="<?=$arItem["QUANTITY"]?>" data-id="<?=$arItem["ID"]?>" data-shopId="<?=$arItem['STORE']["VALUE"]?>" data-mode="update" class="counter__input">
                                            <button type="button" class="btn counter__plus">+</button>
                                        </div>
                                    </td>
                                    <td class="t-total-price d-none d-md-table-cell">
                                        <div class="table-total-price-value">
                                            <span id="SUM_<?= $arItem['ID'] ?>" class="table__price-current">
                                              &#8381;<?= ($arItem["SUM_VALUE"]<$arItem["SUM_FULL_PRICE"])? $arItem["SUM_VALUE"]:$arItem["SUM_FULL_PRICE"];?>
                                          </span>
                                      </div>
                                  </td>
                                  <td class="t-delete d-none d-md-table-cell">
                                    <a href="<?= $deleteActionUrl . $arItem['ID'] ?>" class="table__delete-item"><i class="icon i-delete"></i></a>
                                </td>
                            </tr>
                            <?if ($arItem['DISCOUNT_PERCENT']):?>
                            <tr>
                                <td class="t-discount-check" colspan="5">
                                    <input hidden class="js-id-product" type="text" value="<?=$arItem['PRODUCT_ID']?>" size="20">
                                    <input id="cehckbox-<?=$arItem['ID']?>" data-id="<?=$arItem['PRODUCT_ID']?>" class="js-add-discount" type="checkbox">
                                    <label for="cehckbox-<?=$arItem['ID']?>">
                                        <?=Loc::getMessage(
                                                'GET_DISCOUNT_FOR_BATTERY',
                                                [
                                                    "#PRECENT#" => $arItem['DISCOUNT_PERCENT'],
                                                    "#LINK#" => "<a target='_blank' href='/news/sday_staryy_akkumulyator_poluchi_skidku_na_novyy/'>" . Loc::getMessage('LINK') . "</a>"
                                                ]
                                        )?>
                                    </label>
                                </td>
                            </tr>
                            <?endif;?>
                            <?
                        $i++;
                        endforeach;?>
                        </tbody>
                </table>

                <?if ($arParams["HIDE_COUPON"] != "Y"):?>
                    <table class="order-coupon">
                        <tr>
                            <td colspan="3">

                                <?php if ($arParams['COUPON_ERROR']): ?>
                                    <div class="order-coupon__error"><?= $arParams['COUPON_ERROR'] ?></div>
                                <?php endif ?>

								<?= GetMessage("COUPON_PROMT") ?>
                                <?php if ($arResult['COUPON']): ?>
                                    <span class="order-coupon__entered text-success"><?= $arResult['COUPON'] ?></span>
                                    <span class="order-coupon__remove js-remove-coupon">x</span>
                                <?php else: ?>
                                    <input class="order-coupon__input js-coupon" type="text" name="COUPON" value="<?=$arResult["COUPON"]?>" size="14">
                                    <span class="order-coupon__add js-add-coupon"><span class="d-none d-sm-inline-block">активировать</span></span>
                                <?php endif ?>
                            </td>
                        </tr>
                    </table>
                <?endif;?>

                <div class="table-total-price">
                    <div class="table-total-price__text">
                        Итого:
                    </div>
                    <div class="table-total-price-value table-total-price-value-itog"> &#8381;<?=$arResult["allSum"];?></div>
                </div>
								<div>
									<div class="i-24"></div>
									Все товары в вашем заказе резервируются на 24 часа. Заказ необходимо оплатить в течение суток, по истечении 24 часов с момента заказа резерв будет снят, заказ отменен.
								</div>
								<br>
								<br>
                <div class="d-flex justify-content-between flex-column flex-md-row">
                    <a href="/catalog/" class="btn btn-white content-form-body__button">Продолжить покупки</a>
                    <a href="<?=$arParams['PATH_TO_ORDER']?>" class="btn btn-dark content-form-body__button">Далее</a>
                </div>
            </form>

        </div>
		

    <? endif ?>
</div>