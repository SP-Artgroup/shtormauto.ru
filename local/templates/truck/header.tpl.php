<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

?><!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <meta charset="<?= LANG_CHARSET ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?/*<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">*/?>
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon">
    <?
    // Отвечает за закрывающий слэш у элементов
    $xhtml = false;

    $APPLICATION->ShowMeta('robots', false, $xhtml);
    $APPLICATION->ShowMeta('keywords', false, $xhtml);
    $APPLICATION->ShowMeta('description', false, $xhtml);
    $APPLICATION->ShowLink('canonical', null, $xhtml);
    $APPLICATION->ShowCSS(true, $xhtml);
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>

    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" data-skip-moving="true"></script>
      <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" data-skip-moving="true"></script>
    <![endif]-->
    
    <script src="//code-ya.jivosite.com/widget/v1O1nITUbn" async></script>
</head>
<body>

<script>
    var app = {
        tplPath: '<?= SITE_TEMPLATE_PATH ?>',
    };

    var path = {
        productSlideNext: app.tplPath + '/img/product-slide-next.png',
        productSlidePrev: app.tplPath + '/img/product-slide-prev.png',
        headerSlideNext: app.tplPath + '/img/header-slide-next.png',
        headerSlidePrev: app.tplPath + '/img/header-slide-prev.png',
    };
</script>

<div class="admin-panel">
    <? $APPLICATION->ShowPanel() ?>
</div>

<!-- BEGIN-HEADER -->
<header>
    <div class="header-desctop">
        <div class="top container">
            <div class="row">
                <div class="col-lg-7 col-md-9 col-sm-9">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
                    	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    		"DELAY" => "N",	// Откладывать выполнение шаблона меню
                    		"MAX_LEVEL" => "1",	// Уровень вложенности меню
                    		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                    			0 => "",
                    		),
                    		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                    		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                    		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    		"CACHE_SELECTED_ITEMS" => "N"
                    	),
                    	false
                    );?>
                </div>

                <div class="col-lg-2 col-lg-offset-3 col-md-3 col-sm-3">

                    <?php ob_start() ?>

                    <div class="kabinet">
                        <ul>
                            <?php if ($USER->isAuthorized()): ?>
                                <li>
                                    <a class="sprite sprite-kabinet" href="/personal/">
                                    <span class="hidden-xs"><?= $msg['personal_page'] ?></span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="kabinet__login">
                                    <a class="sprite sprite-kabinet" href="/personal/auth/">
                                        <span class="hiden-xs"><?= $msg['sign_in'] ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a class="sprite sprite-kabinet2" href="/personal/registration/">
                                        <span class="hiden-xs"><?= $msg['sign_up'] ?></span>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>

                    <?php
                    $personalPage = ob_get_clean();
                    echo $personalPage;
                    ?>

                </div>
            </div>
        </div>

        <div class="info container">
            <div class="row">
                <!-- 1 -->
                <div class="logo col-lg-3 col-md-3 col-sm-3">
                    <a href="<?= SITE_DIR ?>">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.png" alt="">
                    </a>
                </div>
                <!-- 2 -->
                <div class="col-lg-4 col-md-3 col-sm-5 city-search-phone">
                    <div class="clearfix col-lg-12 col-md-12 city-phone">

                        <div class="col-xs-12">
                            <div class="row d-flex align-center">
                                <?php
                                $APPLICATION->IncludeComponent(
                                    'sp-artgroup:city.list',
                                    'city-list',
                                    []
                                );
                                ?>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 search">

                            <? $APPLICATION->IncludeComponent(
                            	"bitrix:search.title",
                            	"top-search",
                            	array(
                            		"CATEGORY_0" => array(
                            			0 => "iblock_catalog",
                            		),
                            		"CATEGORY_0_TITLE" => "V",
                            		"CATEGORY_0_iblock_catalog" => array(
                            			0 => IBLOCK_ID__TRUCK_CATALOG,
                            		),
                                    "CHECK_DATES"          => "N",
                                    "COMPONENT_TEMPLATE"   => "top-search",
                                    "CONTAINER_ID"         => "title-search",
                                    "CONVERT_CURRENCY"     => "N",
                                    "INPUT_ID"             => "title-search-input",
                                    "NUM_CATEGORIES"       => "1",
                                    "ORDER"                => "date",
                                    "PAGE"                 => "#SITE_DIR#search/index.php",
                                    "PREVIEW_HEIGHT"       => "75",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PREVIEW_WIDTH"        => "75",
                                    "PRICE_CODE"           => array($priceName),
                                    "PRICE_VAT_INCLUDE"    => "Y",
                                    "SHOW_INPUT"           => "Y",
                                    "SHOW_OTHERS"          => "N",
                                    "SHOW_PREVIEW"         => "N",
                                    "TOP_COUNT"            => "10",
                                    "USE_LANGUAGE_GUESS"   => "Y",
                                    'INPUT_PLACEHOLDER'    => 'Быстрый поиск товаров',
                            	),
                            	false
                            ) ?>

                        </div>

                    </div>
                </div>
                <!-- 3 -->
                <div class="col-lg-2 col-md-3 col-sm-4 header-btns hidden-sm">
                    <?php
                    // <button class="btn1" data-fancybox data-animation-duration="700" data-src="#call" href="javascript:;">Запись на сервис</button>
                    ?>
                    <a class="btn1 btn-red" href="<?= SITE_DIR ?>service/">Запись на сервис</a>
                    <? if($currentPage == ""):?>
                        <a href="#filter-on-main" class="btn1 btn-black slow-scroll">Подбор шин и дисков</a>
                    <? endif;?>  
                </div>
                <!-- 4 -->
                <div class="col-md-3 col-sm-4 small-basket-wrapper">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.line",
                        "small-basket",
                        Array(
                            "HIDE_ON_BASKET_PAGES" => "Y",	// Не показывать на страницах корзины и оформления заказа
                            "PATH_TO_AUTHORIZE"    => "",	// Страница авторизации
                            "PATH_TO_BASKET"       => SITE_DIR . "personal/basket/",	// Страница корзины
                            "PATH_TO_ORDER"        => SITE_DIR . "personal/order/",	// Страница оформления заказа
                            "PATH_TO_PERSONAL"     => SITE_DIR . "personal/",	// Страница персонального раздела
                            "PATH_TO_PROFILE"      => SITE_DIR . "personal/",	// Страница профиля
                            "PATH_TO_REGISTER"     => SITE_DIR . "personal/registration/",	// Страница регистрации
                            "POSITION_FIXED"       => "N",	// Отображать корзину поверх шаблона
                            "SHOW_AUTHOR"          => "N",	// Добавить возможность авторизации
                            "SHOW_EMPTY_VALUES"    => "Y",	// Выводить нулевые значения в пустой корзине
                            "SHOW_NUM_PRODUCTS"    => "Y",	// Показывать количество товаров
                            "SHOW_PERSONAL_LINK"   => "N",	// Отображать персональный раздел
                            "SHOW_PRODUCTS"        => "N",	// Показывать список товаров
                            "SHOW_TOTAL_PRICE"     => "Y",	// Показывать общую сумму по товарам
                            "COMPONENT_TEMPLATE"   => ".default",
                    	),
                    	false
                    );?>
                </div>
            </div>
        </div>

        <?$APPLICATION->IncludeComponent(
        	"bitrix:menu",
        	"top-catalog",
        	array(
                "ALLOW_MULTI_SELECT"    => "N",
                "CHILD_MENU_TYPE"       => "catalog",
                "DELAY"                 => "N",
                "MAX_LEVEL"             => "2",
                "MENU_CACHE_GET_VARS"   => [],
                "MENU_CACHE_TIME"       => "36000000",
                "MENU_CACHE_TYPE"       => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE"        => "catalog",
                "USE_EXT"               => "Y",
                "CACHE_SELECTED_ITEMS"  => "N",
                "COMPONENT_TEMPLATE"    => "top-catalog"
        	),
        	false
        );?>
    </div>

    <div class="header-mobile">
        <div class="container">
            <!-- 1 -->
            <div class="top-mobile">


                <?php
                // Задаётся в sp-artgroup:city.list:city_list
                $APPLICATION->showViewContent('city_list');
                ?>

                <?= $personalPage ?>
            </div>

            <div class="info-mobile">
                <a href="<?= SITE_DIR ?>" class="logo-mobile">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.png" alt="">
                </a>
                <div class="header-btns">
                    <a class="btn1 btn-red" href="<?= SITE_DIR ?>service/">Запись на сервис</a>
                    <button class="btn1 btn-black">Подбор шин и дисков</button>
                </div>
            </div>
        </div>

        <div class="nav-mobile">
            <div class="container">
                <div class="nav-container-mobile">
                    <i class="fas fa-bars"></i>
                    <?php
                    // Задаётся в bitrix:sale.basket.basket.line:small-basket
                    $APPLICATION->showViewContent('mobile-basket');
                    ?>
                </div>
            </div>
        </div>

        <div class="nav-menu-mobile">

            <p class="close-mobile">закрыть <i class="fas fa-times"></i></p>

            <div class="phone-mobile">
                <?php
                // Задаётся в sp-artgroup:city.list:city_list
                $APPLICATION->showViewContent('city_phone');
                ?>
            </div>

            <div class="search">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:search.title",
                    "top-search",
                    array(
                        "CATEGORY_0" => array(
                            0 => "iblock_catalog",
                        ),
                        "CATEGORY_0_TITLE" => "V",
                        "CATEGORY_0_iblock_catalog" => array(
                            0 => IBLOCK_ID__TRUCK_CATALOG,
                        ),
                        "CHECK_DATES"          => "N",
                        "COMPONENT_TEMPLATE"   => "top-search",
                        "CONTAINER_ID"         => "mobile-search",
                        "CONVERT_CURRENCY"     => "N",
                        "INPUT_ID"             => "mobile-search-input",
                        "NUM_CATEGORIES"       => "1",
                        "ORDER"                => "date",
                        "PAGE"                 => "#SITE_DIR#search/index.php",
                        "PREVIEW_HEIGHT"       => "75",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PREVIEW_WIDTH"        => "75",
                        "PRICE_CODE"           => array($priceName),
                        "PRICE_VAT_INCLUDE"    => "Y",
                        "SHOW_INPUT"           => "Y",
                        "SHOW_OTHERS"          => "N",
                        "SHOW_PREVIEW"         => "N",
                        "TOP_COUNT"            => "10",
                        "USE_LANGUAGE_GUESS"   => "Y",
                        // CUSTOM
                        'INPUT_PLACEHOLDER'    => 'Поиск товаров',
                        'IS_MOBILE'            => 'Y',
                    ),
                    false
                ) ?>
            </div>

            <?php
            // Задаётся в bitrix:menu:top-catalog
            $APPLICATION->showViewContent('mobile-catalog-menu');
            ?>

            <?php
            // Задаётся в bitrix:menu:main
            $APPLICATION->showViewContent('mobile-main-menu');
            ?>
        </div>

    </div><? // .header-mobile ?>

    <?php if (!$hidePageHeader): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="screen" style="background: url(<? $app->showPageHeaderBackground() ?>) no-repeat center;">
                    <div class="container">
                        <h1><?= $APPLICATION->showTitle(false) ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

</header>

<div class="content <?= $app->showUiClass() ?>">

    <?php if ($showBreadcrumb): ?>
        <div class="container">
            <? $APPLICATION->IncludeComponent(
                'bitrix:breadcrumb',
                'breadcrumb',
                [
                    'PATH'       => '',
                    'SITE_ID'    => 's2',
                    'START_FROM' => '0',
                ]
            ); ?>
        </div>
    <?php endif ?>

    <?php if ($wrapWorkArea): ?>
        <div class="container main-container">
    <?php endif ?>
