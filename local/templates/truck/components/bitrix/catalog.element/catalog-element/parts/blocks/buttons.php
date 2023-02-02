<div data-entity="main-button-container">
    <div id="<?=$itemIds['BASKET_ACTIONS_ID']?>" style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;">

        <?php if ($showAddBtn): ?>

            <div class="btn2 inbascet" id="<?=$itemIds['ADD_BASKET_LINK']?>">
                <i class="fas fa-shopping-cart"></i> <?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?>
            </div>

        <?
        endif;

        if ($showBuyBtn)
        {
            ?>
            <div class="product-item-detail-info-container">
                <a class="btn <?=$buyButtonClassName?> product-item-detail-buy-button" id="<?=$itemIds['BUY_LINK']?>"
                    href="javascript:void(0);">
                    <span><?=$arParams['MESS_BTN_BUY']?></span>
                </a>
            </div>
            <?
        }
        ?>
    </div>

    <?php if ($showSubscribe): ?>
        <div class="product-item-detail-info-container">
            <?
            $APPLICATION->IncludeComponent(
                'bitrix:catalog.product.subscribe',
                '',
                array(
                    'CUSTOM_SITE_ID'     => isset($arParams['CUSTOM_SITE_ID']) ? $arParams['CUSTOM_SITE_ID'] : null,
                    'PRODUCT_ID'         => $arResult['ID'],
                    'BUTTON_ID'          => $itemIds['SUBSCRIBE_LINK'],
                    'BUTTON_CLASS'       => 'btn btn-default product-item-detail-buy-button',
                    'DEFAULT_DISPLAY'    => !$actualItem['CAN_BUY'],
                    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                ),
                $component,
                array('HIDE_ICONS' => 'Y')
            );
            ?>
        </div>
    <?php endif ?>

    <?php if (!$canBuy): ?>
        <div class="product-item-detail-info-container">
            <span
                class="not-available"
                id="<?=$itemIds['NOT_AVAILABLE_MESS']?>"
                <?php if ($actualItem['CAN_BUY']): ?>
                    style="display: none"
                <?php endif ?>
            ><?= $arParams['MESS_NOT_AVAILABLE'] ?></span>
        </div>
    <?php endif ?>

</div>