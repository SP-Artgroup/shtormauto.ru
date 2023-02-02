<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<header class="header-content header-content--orders">
    <div class="header-content__col">
        <h1 class="header-content__heading"><?$APPLICATION->ShowTitle();?></h1>
    </div>
    <div class="header-content__col">
    <?$APPLICATION->IncludeComponent(
            "bitrix:menu", 
            "guaranty", 
            array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "guaranty",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "guaranty"
            ),
            false
    );?>
    </div>
</header>
<div class="content-form-body content-form-body--user-orders">
    <table class="table table--user-orders">
        <thead>
            <tr>
                <th class="d-table-cell d-lg-none">Инфо</th>
                <th class="d-none d-lg-table-cell">№ заказа</th>
                <th class="t-orders-date d-none d-lg-table-cell">Дата</th>
                <th class="t-orders-status d-none d-lg-table-cell">Статус</th>
                <th class="t-orders-shop d-none d-sm-table-cell">Магазин</th>
                <th class="t-orders-price">Сумма</th>
                <th class="t-orders-capabilities d-none d-sm-table-cell">Возможности</th>
            </tr>
        </thead>
        <tbody>
        <? foreach($arResult['ORDERS'] as $arOrder) { ?>            
            <tr>
                <td class="d-table-cell d-lg-none t-orders-info">
                    <div><a href="<?=$arOrder['ORDER']['URL_TO_DETAIL']?>">№S-<?=$arOrder['ORDER']['ID']?></a></div>
                    <div><?=$arOrder['ORDER']['DATE_INSERT_FORMATED']?></div>
                    <div class="cool-grey-83"><?=$arResult['INFO']['STATUS'][$arOrder['ORDER']['STATUS_ID']]['NAME']?></div>
                    <div class="d-block d-sm-none">
                        <? if(intval($arOrder['SHOP_ID'])) { ?>
                            <a href="/shops/<?= $arOrder['SHOP_ID'] ?>/"><?= $arOrder['PROPERTIES']['SHOP']['VALUE'] ?></a>
                        <? } else { ?>
                            <?= $arOrder['PROPERTIES']['SHOP']['VALUE'] ?>
                        <? } ?>                        
                    </div>
                </td>
                <td class="d-none d-lg-table-cell"><a href="<?=$arOrder['ORDER']['URL_TO_DETAIL']?>">№S-<?=$arOrder['ORDER']['ID']?></a></td>
                <td class="t-orders-date d-none d-lg-table-cell"><?=$arOrder['ORDER']['DATE_INSERT_FORMATED']?></td>
                <td class="t-orders-status d-none d-lg-table-cell"><span class="cool-grey-83"><?=$arResult['INFO']['STATUS'][$arOrder['ORDER']['STATUS_ID']]['NAME']?></span></td>
                <td class="t-orders-shop d-none d-sm-table-cell">
                        <? if(intval($arOrder['SHOP_ID'])) { ?>
                            <a href="/shops/<?= $arOrder['SHOP_ID'] ?>/"><?= $arOrder['PROPERTIES']['SHOP']['VALUE'] ?></a>
                        <? } else { ?>
                            <?= $arOrder['PROPERTIES']['SHOP']['VALUE'] ?>
                        <? } ?>                     
                </td>
                <td class="t-orders-price"><?=$arOrder['ORDER']['FORMATED_PRICE']?></td>
                <td class="t-orders-capabilities d-none d-sm-table-cell"><a href="<?=$arOrder['ORDER']['URL_TO_CANCEL']?>">Отменить</a></td>
            </tr>
        <?}?>    
        </tbody>
    </table>
</div>
<div class="catalog-pagination">
    <?echo $arResult["NAV_STRING"];?>
</div>
