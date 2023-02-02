<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

if ($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
    if (
        $arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y"
        || $arResult["NEED_REDIRECT"] == "Y"
        || empty($arResult['BASKET_ITEMS'])
    ) {
        if(strlen($arResult["REDIRECT_URL"]) > 0)
        {
            $APPLICATION->RestartBuffer();
            ?>
            <script type="text/javascript">
                window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <?
            die();
        }
    }
}

$showRegForm = !$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N";

if ($showRegForm) {
    include 'parts/auth.php';
} else {
    $this->addExternalJs('//api-maps.yandex.ru/2.1/?lang=ru_RU');
    ?>

    <div class="order-form" id="order_form_div">

        <noscript>
            <div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
        </noscript>

        <div class="form-item">
            <?php
            if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {

                if (strlen($arResult["REDIRECT_URL"]) == 0) {
                    include 'parts/confirm.php';
                }

            } else {

                include 'parts/basket.php';

                ?>
                <script type="text/javascript">

                    //Массив магазинов, для вывода меток
                    var shops       = <?= json_encode($arResult['SHOPS_TO_JSON']) ?>;
                    var cities      = <?= json_encode($arResult['CITIES']) ?>;
                    var basketItems = <?= json_encode($arResult['BASKET_ITEMS']) ?>;

                    <?
                    // spike: for children of cities we place this prompt
                    $city = $arResult['MAP_CITY'];
                    ?>

                    BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
                        'source'     => $this->__component->getPath().'/get.php',
                        'cityTypeId' => intval($city['ID']),
                        'messages'   => array(
                            'otherLocation'    => '--- '.GetMessage('SOA_OTHER_LOCATION'),
                            'moreInfoLocation' => '--- '.GetMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                            'notFoundPrompt'   => '<div class="-bx-popup-special-prompt">'.GetMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                                '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                                '#ANCHOR_END#' => '</a>'
                            )).'</div>'
                        )
                    ))?>);

                </script>

                <? if ($_POST["is_ajax_post"] != "Y") { ?>
                    <form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
                    <?=bitrix_sessid_post()?>
                    <div id="order_form_content">
                    <?
                } else {
                    $APPLICATION->RestartBuffer();
                }

                if($_REQUEST['PERMANENT_MODE_STEPS'] == 1)
                {
                    ?>
                    <input type="hidden" name="PERMANENT_MODE_STEPS" value="1" />
                    <?
                }

                if (!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y") {
                    foreach($arResult["ERROR"] as $v)
                        echo ShowError($v);
                    ?>
                    <script type="text/javascript">
                        top.BX.scrollToNode(top.BX('ORDER_FORM'));
                    </script>
                    <?
                }

                include 'parts/our_service.php';

                ?>

                <div class="order-form__border">

                    <?
                    include 'parts/person_type.php';
                    include 'parts/props.php';

                    if ($arParams['DELIVERY_TO_PAYSYSTEM'] === 'p2d') {
                        include 'parts/paysystem.php';
                        include 'parts/delivery.php';
                    } else {
                        include 'parts/delivery.php';
                        include 'parts/paysystem.php';
                    }

                    if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0) {
                        echo $arResult["PREPAY_ADIT_FIELDS"];
                    }
                    ?>

                </div>

                    <? if ($_POST["is_ajax_post"] != "Y") { ?>

                        </div>

                        <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                        <input type="hidden" name="profile_change" id="profile_change" value="N">
                        <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                        <input type="hidden" name="json" value="Y">
                        <input type="hidden" name="" id="site_template_path" value="<?= SITE_TEMPLATE_PATH ?>">

                        <div class="order-form__submit-box">
                            <input
                                class="btn1 btn-red order-form__submit-btn"
                                type="button"
                                value="Подтвердить"
                                onclick="submitForm('Y'); return false;"
                                id="ORDER_CONFIRM_BUTTON"
                            >
                        </div>

                    </form>

                        <?
                        if ($arParams["DELIVERY_NO_AJAX"] == "N") {
                            ?>
                            <div style="display:none;">
                                <?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?>
                            </div>
                            <?
                        }

                    }
                    else
                    {
                        ?>
                        <script type="text/javascript">
                            top.BX('confirmorder').value = 'Y';
                            top.BX('profile_change').value = 'N';
                        </script>
                        <?
                        die();
                    }
                    ?>

                <?
            }
            ?>
        </div>

    </div>

    <?
}
