<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

include 'props_format.php';

?>

<div class="form-block delivery-data">

    <div class="form-block__title">Данные для доставки</div>

    <div class="form-block__content">

        <div id="sale_order_props">
            <?
            PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
            PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
            ?>
        </div>

    </div>
</div>