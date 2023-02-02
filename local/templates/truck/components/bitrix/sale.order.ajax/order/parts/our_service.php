<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
<div class="our-service">

    <div class="col-xs-12 col-sm-6">

        <div class="our-service__question">Хотите ли вы воспользоваться нашим сервисом:</div>

    </div>

    <div class="col-xs-12 col-sm-6 radio">
        <div class="our-serivce__buttons">

            <div class="our-serivce__button-box">
                <input
                    class="js-our-service"
                    type="radio"
                    name="our-serivce"
                    id="our-serivce-yes"
                    value="Y"
                >
                <label for="our-serivce-yes">Да, меня интересует сервис</label>
            </div>

            <div class="our-serivce__button-box">
                <input
                    class="js-our-service"
                    type="radio"
                    name="our-serivce"
                    id="our-serivce-no"
                    value="N"
                >
                <label for="our-serivce-no">Нет, спасибо</label>
            </div>

            <input class="order_prop_service" type="hidden" name="ORDER_PROP_22" value="<?=(isset($_REQUEST['ORDER_PROP_22']) ? $_REQUEST['ORDER_PROP_22'] : 'Y')?>" />
            <input class="order_prop_service" type="hidden" name="ORDER_PROP_23" value="<?=(isset($_REQUEST['ORDER_PROP_23']) ? $_REQUEST['ORDER_PROP_23'] : 'Y')?>" />
        </div>
    </div>

</div>