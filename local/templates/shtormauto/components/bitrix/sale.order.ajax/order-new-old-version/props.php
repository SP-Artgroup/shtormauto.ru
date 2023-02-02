<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
$shops     = $arResult['SHOPS'];
$jsonShops = $arResult['SHOPS_TO_JSON'];
$cities    = $arResult['CITIES'];

$shopId        = $arResult['SHOP_ID'];
$currentCityId = $shopId ? $jsonShops[$shopId]['CITY'] : $arResult['CURRENT_CITY_ID'];
$selectedCity  = $currentCityId ? $arResult['CITIES'][$currentCityId] : 'Выберите город:';

$delayDeliveryMessage = $arResult['DELAY_DELIVERY_MESSAGE'];

$personType = $arResult['ORDER_DATA']['PERSON_TYPE_ID'];

$orderPropIds = [
    1 => [
        'SHOP' => 20,
        'OTHER_CITY' => 26,
    ],
    2 => [
        'SHOP' => 21,
        'OTHER_CITY' => 27,
    ],
];

$allProps = $arResult["ORDER_PROP"]["ORDER_PROPS_ALL"];
?>

<div style="display:none;">
<?
    $APPLICATION->IncludeComponent(
        "bitrix:sale.ajax.locations",
        $arParams["TEMPLATE_LOCATION"],
        array(
            "AJAX_CALL" => "N",
            "COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
            "REGION_INPUT_NAME" => "REGION_tmp",
            "CITY_INPUT_NAME" => "tmp",
            "CITY_OUT_LOCATION" => "Y",
            "LOCATION_VALUE" => "",
            "ONCITYCHANGE" => "submitForm()",
        ),
        null,
        array('HIDE_ICONS' => 'Y')
    );
?>
</div>

<div class="content-form__row-wrapper content-form__row-wrapper--border-top">
    <div class="content-form__row">
        <div class="row">
            <?foreach($allProps as $arProp){
            if ($arProp["PROPS_GROUP_ID"]==1 || $arProp["PROPS_GROUP_ID"]==3){
            switch ($arProp["ID"]){
                case 1: case 12: case 8: case 9: $col_size="col-sm-12"; ;break;
                case 28: case 29: $col_size="col-sm-4"; ;break;
                case 30: case 31: $col_size="col-sm-8"; ;break;
                default: $col_size = "col-sm-6";
            }
            ?>
            <div class="<?=$col_size;?>">
                <div class="form-group">
                    <?/*if ($arProp["REQUIRED"]=='Y'){?>
                        <div class="form-error">Пожалуйста, заполните это поле</div>
                    <?}*/?>
                    <?
                    $mask = "";
                    $paleholder = "";

                    switch ($arProp["CODE"]){
                        case "DELIVERY_DATE":
                            $arProp["TYPE"] = "date";
                            $paleholder = date("d-m-Y");
                        break;
                        case "PHONE":
                            $mask = 'data-masked="+7 (999) 999-99-99"';
                            $paleholder = "+7 (999) 999-99-99";
                        break;
                        case "FIO":
                            $paleholder = "Иванов Петр Иванович";
                        break;
                        case "EMAIL":
                            $paleholder = "your@email.co";
                        break;
                        case "BONUS_CARD_NUMBER":
                            $mask = 'data-masked="9999999999999"';
                            $paleholder = "XXXXXXXXXXXXX";
                        break;
                        case "notice": case "comments":
                            $paleholder = "Если требуется";
                        break;
                    }
                        ?>
                        <input type="<?= $arProp["TYPE"] ?>" name="<?= $arProp["FIELD_NAME"] ?>" id="<?= $arProp["FIELD_NAME"] ?>" <?=$mask?> placeholder="<?=$paleholder?>" class="form-input" value='<?=$arProp["VALUE"]?>' <?if ($arProp["REQUIRED"]=='Y') echo "required"; ?>/>
                    <label for="basketFormDateDelivery" class="form-label"><?= $arProp["NAME"] ?></label>
                </div>
            </div>
            <?}
            }?>
        </div>
    </div>
</div>
<?php

$propOtherCity = null;

foreach ($allProps as $prop) {

    if ($prop['CODE'] === 'OTHER_CITY') {
        $propOtherCity = $prop;
        break;
    }
}

?>
<div class="content-form__row-wrapper content-form__row-wrapper--border-top">
    <div class="content-form__row">
        <div class="row">
            <?php if ($delayDeliveryMessage): ?>
                <div class="delay-delivery-message">
                    <div class="buy-error-message">
                        Возможно некоторых товаров из корзины нет на выбранном складе.<br>
                        Они появятся на нём в течении 2-3 дней,
                        либо вы можете забрать товары с выбранных складов самостоятельно.
                    </div>
                </div>
            <?php endif ?>
            <?foreach($allProps as $arProp){
                if ($arProp["PROPS_GROUP_ID"]==2 || $arProp["PROPS_GROUP_ID"]==4){?>
                    <?if ($arProp["CODE"]=="CITY"){?>
                    <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" name="oldCity" value="<?=$currentCityId?>">
                                <label for="basketFormCity" class="form-label">Город</label>
                                <div class="form-select">
                                    <select name="" id="basketFormCity">
                                        <?foreach ($arResult['CITIES'] as $id=>$cityName){?>
                                        <option value="<?=$id?>" <?if ($id==$currentCityId) echo " selected=\"selected\"";?>><?=$cityName?></option>
                                        <?}?>
                                    </select>
                                </div>
                            </div>
                        <input type="hidden" name="<?= $arProp["FIELD_NAME"] ?>" id="<?= $arProp["FIELD_NAME"] ?>" value="<?= $currentCityId ? $cities[$currentCityId] : '' ?>"/>
                    </div>
                    <?}
                    if ($arProp["CODE"]=="SHOP"){?>
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label for="basketFormShop" class="form-label">Магазин</label>
                                <div class="form-select">
                                    <select name="<?= $arProp["FIELD_NAME"] ?>" id="basketFormShop">
                                        <?
                                        unset($shopId);
                                        foreach ($shops[$currentCityId] as $key => $row) {
                                            $sort[$key] = $row['SORT'];
                                        }
                                        $sort = array_column($shops[$currentCityId], 'SORT');
                                        array_multisort($sort, SORT_ASC, $shops[$currentCityId]);
                                        foreach ($shops[$currentCityId] as $arShop){
                                        if (!$shopId) $shopId = $arShop['ID'];?>
                                            <option value="<?=$arShop['ID']?>" <?if ($arShop['ID']==$shopId) echo " selected=\"selected\"";?>><?=$arShop["PROPERTY_ADDRESS_VALUE"]?></option>
                                        <?}?>
                                    </select>
                                </div>
                            </div>

                            <?php if ($propOtherCity): ?>
                                <div class="form-group" style="display:none">
                                    <label
                                        class="form-label"
                                        for="other-city"
                                    >Другой город</label>
                                    <input
                                        class="form-input js-other-city"
                                        type="text"
                                        id="other-city"
                                        name="<?= $propOtherCity['FIELD_NAME'] ?>"
                                    >
                                </div>
                            <?php endif ?>
                    </div>
                    <?}?>
            <?}
            }?>
        </div>
    </div>
</div>
<?php
$test = json_encode($arResult["SHOPS_TO_JSON"]);
?>

