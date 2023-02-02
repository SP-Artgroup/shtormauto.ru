<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use SP\Component as SPComponent;

Loc::loadMessages(__FILE__);

$asset       = Asset::getInstance();
$currentPath = explode('/', $APPLICATION->GetCurPage(false));
$lastIndex   = count($currentPath) - 1;

if (empty($currentPath[$lastIndex])) {
    unset($currentPath[$lastIndex]);
    --$lastIndex;
}

$currentPage = $currentPath[$lastIndex];
unset($lastIndex);

// define show page header (h1)
$showPageHeader = true;

foreach ([
    '/catalog',
    '/news',
    '/partners',
    '/about/delivery',
    '/about/guaranty',
    '/shops',
    '/personal',
] as $urlPath) {
    if (CSite::InDir($urlPath)) {
        $showPageHeader = false;
        break;
    }
}

// include external css
foreach ([
    '//cdn.jsdelivr.net/qtip2/3.0.3/basic/jquery.qtip.min.css',
] as $path) {
    $asset->addCss($path);
}

// include template css
//    '/vendor/bootstrap/dist/css/bootstrap.min.css',
//     '/css/global.css',
foreach ([
    '/js/owl.carousel/owl-carousel/owl.carousel.css',
    '/js/owl.carousel/owl-carousel/owl.theme.css',
    '/css/jquery.fancybox.min.css',
] as $path) {
    $asset->addCss(SITE_TEMPLATE_PATH . $path);
}

// include external js
foreach ([
    '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
    '//cdn.jsdelivr.net/qtip2/3.0.3/basic/jquery.qtip.min.js',
    // '//api-maps.yandex.ru/2.1/?lang=ru_RU',
] as $path) {
    $asset->addJs($path);
}

// include template js
//

foreach ([
    '/js/jquery.fancybox.min.js',
    '/js/jquery.maskedinput.min.js',
    '/js/owl.carousel/owl-carousel/owl.carousel.min.js',
    '/js/modules/catalog.js',
     '/js/script.js',
] as $path) {
    $asset->addJs(SITE_TEMPLATE_PATH . $path);
}

?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset="<?= LANG_CHARSET ?>">
    <title><?= $APPLICATION->ShowTitle(); ?></title>

    <meta name="viewport" content="width=device-width">
    <link rel="canonical" href="<?=$_SERVER['SCRIPT_URI']?>">
    <link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon">
     <?
      CJSCore::Init(array("jquery"));
    ?>
    <meta name="yandex-verification" content="e23dc2a244a4cc2c" />
    <script src="https://cdn.jsdelivr.net/npm/micromodal/dist/micromodal.min.js"></script>
    <?php
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/libs.css');
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/style.css');
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/change_styles.css');
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/libs.js');
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/main.js');
        $APPLICATION->ShowHead();
    ?>
    <script type="text/javascript">
        if (typeof __GetI === "undefined") {
            __GetI = [];
        }
        (function () {
            var p = {
                type: "VIEW",
                /* config START */
                site_id: "5787",
                product_id: "",
                product_price: "",
                category_id: "",
                pixel_id: "shtormauto_track"
                /* config END */
            };
            __GetI.push(p);
            var domain = (typeof __GetI_domain) == "undefined" ? "px.adhigh.net" : __GetI_domain;
            var src = ('https:' == document.location.protocol ? 'https://' : 'http://') + domain + '/p.js';
            var script = document.createElement( 'script' );
            script.type = 'text/javascript';
            script.src = src;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(script, s);
        })();
    </script>
</head>
<body>

<?if (!\SP\Config::get('tpl_NoYandexMetrikaEtc')): ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter24650546 = new Ya.Metrika({
                        id:24650546,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        ecommerce:"dataLayer"
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript>
        <div>
            <img src="https://mc.yandex.ru/watch/24650546" style="position:absolute; left:-9999px;" alt="">
        </div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NDTDKDX');</script>
    <!-- End Google Tag Manager -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NDTDKDX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?endif ?>

<?$APPLICATION->ShowPanel();?>
<?
$dir = $APPLICATION->GetCurDir();
$dirs = explode("/", $dir);
$GLOBALS['page'] = $dirs;
?>
<main class="wrapper">
    <span style="display: none;"> <?// SPComponent::include('basket_line') ?></span>

			<div class="responsive-menu">
				<div class="responsive-menu__wrapper">
					<button class="responsive-menu__close">
						<i class="icon i-close"></i>
					</button>
					<header class="responsive-menu-header">
                                            <div class="responsive-menu-header__logo">
                                            <a href="/">
                                            <?$APPLICATION->IncludeComponent(
                                                    "bitrix:main.include",
                                                    "named_area",
                                                    Array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "NAME" => "Изменить логотип",
                                                            "AREA_FILE_SUFFIX" => "inc",
                                                            "EDIT_TEMPLATE" => "",
                                                            "PATH" => "/include/header_logo.php"
                                                    )
                                            );?>
                                            </a>
                                            </div>
						<div class="responsive-menu-header__pole-postion d-none d-md-block">
                                                <?$APPLICATION->IncludeComponent(
                                                        "bitrix:main.include",
                                                        "named_area",
                                                        Array(
                                                                "AREA_FILE_SHOW" => "file",
                                                                "NAME" => "Изменить логотип",
                                                                "AREA_FILE_SUFFIX" => "inc",
                                                                "EDIT_TEMPLATE" => "",
                                                                "PATH" => "/include/header_poleposition.php"
                                                        )
                                                );?>
						</div>
					</header>
					<div class="d-flex align-items-center justify-content-between justify-content-md-start">
						<div class="city_ip">
                            <?$APPLICATION->IncludeComponent("sp-artgroup:city.list", "top_city_list_mini", Array());?>
						</div>
					</div>

					<div class="responsive-menu-auth-basket">
                                            <div class="responsive-menu-auth-basket__col">
                                            <?if ($USER->IsAuthorized()){?>
                                                <a href="/personal/profile/"><?=$USER->GetFullName();?></a>
                                                <a href="?logout=yes" class="responsive-menu-auth-basket__exit" title="Выход">Выход</a>
                                            <?}else{?>
                                              <a href="#" class="responsive-menu-auth-basket__auth">Войти</a>
                                            <?}?>
                                            </div>
                                                <?$APPLICATION->IncludeComponent(
                                                        "bitrix:sale.basket.basket.line",
                                                        "basket_mini_mobile",
                                                        Array(
                                                                "HIDE_ON_BASKET_PAGES" => "N",
                                                                "PATH_TO_AUTHORIZE" => "",
                                                                "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                                                "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                                                                "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                                                "PATH_TO_PROFILE" => SITE_DIR."personal/",
                                                                "PATH_TO_REGISTER" => SITE_DIR."login/",
                                                                "POSITION_FIXED" => "N",
                                                                "SHOW_AUTHOR" => "N",
                                                                "SHOW_EMPTY_VALUES" => "Y",
                                                                "SHOW_NUM_PRODUCTS" => "N",
                                                                "SHOW_PERSONAL_LINK" => "N",
                                                                "SHOW_PRODUCTS" => "N",
                                                                "SHOW_REGISTRATION" => "N",
                                                                "SHOW_TOTAL_PRICE" => "Y"
                                                        )
                                                );?>
					</div>
                                        <?$APPLICATION->IncludeComponent("bitrix:menu", "top_mini", Array(
                                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                                        "CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
                                                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                                0 => "",
                                                        ),
                                                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                                        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                                ),
                                                false
                                        );?>
                                        <?$APPLICATION->IncludeComponent("bitrix:menu", "top_mini2", Array(
                                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                                        "CHILD_MENU_TYPE" => "top2_menu",	// Тип меню для остальных уровней
                                                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                                0 => "",
                                                        ),
                                                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                                        "ROOT_MENU_TYPE" => "footer",	// Тип меню для первого уровня
                                                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                                ),
                                                false
                                        );?>
				</div>

                        </div>
			<div class="top-panel">
                             <div class="city_ip">
                             <?$APPLICATION->IncludeComponent("sp-artgroup:city.list", "top_city_list", Array());?>
                             </div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "top2_menu", Array(
                                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                            "CHILD_MENU_TYPE" => "top2_menu",	// Тип меню для остальных уровней
                                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                    0 => "",
                                            ),
                                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                            "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                            "ROOT_MENU_TYPE" => "top2_menu",	// Тип меню для первого уровня
                                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    ),
                                    false
                            );?>
			</div>
			<header class="header">
				<div class="logo">
					<div itemscope itemtype=http://schema.org/Brand class="logo__wrapper">
                                            <?$APPLICATION->IncludeComponent(
                                                    "bitrix:main.include",
                                                    "named_area",
                                                    Array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "NAME" => "Изменить логотип",
                                                            "AREA_FILE_SUFFIX" => "inc",
                                                            "EDIT_TEMPLATE" => "",
                                                            "PATH" => "/include/header_logo.php"
                                                    )
                                            );?>
                                            <span itemprop="name" style="display: none;">ШтормАвто</span>
					</div>
				</div>
                            <div class="pole-position d-none d-xl-flex">
                                            <?$APPLICATION->IncludeComponent(
                                                    "bitrix:main.include",
                                                    "named_area",
                                                    Array(
                                                            "AREA_FILE_SHOW" => "file",
                                                            "NAME" => "Изменить логотип",
                                                            "AREA_FILE_SUFFIX" => "inc",
                                                            "EDIT_TEMPLATE" => "",
                                                            "PATH" => "/include/header_poleposition.php"
                                                    )
                                            );?>

                            </div>
                            <div class="d-md-none btn-search"></div>
                            <?$APPLICATION->IncludeComponent(
                            	"bitrix:search.title", 
                            	"header", 
                            	array(
                            		"COMPONENT_TEMPLATE" => "header",
                            		"NUM_CATEGORIES" => "1",
                            		"TOP_COUNT" => "5",
                            		"ORDER" => "date",
                            		"USE_LANGUAGE_GUESS" => "Y",
                            		"CHECK_DATES" => "Y",
                            		"SHOW_OTHERS" => "N",
                            		"PAGE" => "#SITE_DIR#search/",
                            		"SHOW_INPUT" => "Y",
                            		"INPUT_ID" => "title-search-input",
                            		"CONTAINER_ID" => "title-search",
                            		"CATEGORY_0_TITLE" => "",
                            		"CATEGORY_0" => array(
                            			0 => "iblock_catalog",
                            		),
                            		"CATEGORY_0_iblock_catalog" => array(
                            			0 => "26",
                            		),
                            		"PRICE_CODE" => "",
                            		"PRICE_VAT_INCLUDE" => "Y",
                            		"PREVIEW_TRUNCATE_LEN" => "",
                            		"SHOW_PREVIEW" => "Y",
                            		"CONVERT_CURRENCY" => "N",
                            		"PREVIEW_WIDTH" => "75",
                            		"PREVIEW_HEIGHT" => "75"
                            	),
                            	false
                            );?>
                            <?/*$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
                                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                            "CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
                                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                    0 => "",
                                            ),
                                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                            "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    ),
                                    false
                            );*/?>
                            <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "modal_auth_form", Array(
                                    "FORGOT_PASSWORD_URL" => "/personal/?forgot_password=yes",	// Страница забытого пароля
                                    "PROFILE_URL" => "/personal/profile/",	// Страница профиля
                                    "REGISTER_URL" => "/personal/registration/",	// Страница регистрации
                                    "SHOW_ERRORS" => "N",	// Показывать ошибки
                                    ),
                                    false
                                    );?>
                                    <div class="new-basket-small">
                                <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line",
	"basket.line",
	array(
		"COMPONENT_TEMPLATE" => "basket.line",
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_REGISTRATION" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y"
	),
	false
);?>
                                </div>
				<div class="burger d-flex d-lg-none">
					<button class="burger__button">
						<i class="icon i-burger"></i>
					</button>
				</div>
			</header>

<div class="content-wrapper">
    <div class="container">
                <? //SPComponent::include('basket_line') ?>
        <? if (!empty($currentPath[1])): ?>

        <? endif ?>
<!--если каталог?-->
<?php if (CSite::InDir('/catalog/')):?>
<div class="row">
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "catalog-breadcrumbs", Array(
                "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "1",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                        "COMPONENT_TEMPLATE" => ".default"
                ),
                false
        );?>
</div>
<div class="row">
      <div class="container-fluid d-block d-sm-none" id="catalog-small-h1">
        <h1 class="catalog-heading"><?$APPLICATION->ShowViewContent('section_title');?></h1>
      </div>
<?php endif;?>
<!--если каталог-->
<?php if (CSite::InDir('/about/guaranty/')):?>
<!--если гарантии-->
    <header class="header-content header-content--article">
      <div class="header-content__col">
        <h1 class="header-content__heading"><?$APPLICATION->ShowTitle(false);?></h1>
      </div>
        <?$APPLICATION->IncludeComponent("bitrix:menu", "guaranty", Array(
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "guaranty",	// Тип меню для первого уровня
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                false
        );?>
    </header>
<?endif;?>
<!--если гарантии-->
<!--если другая страница-->
<?if ($showPageHeader && $APPLICATION->GetCurPage()!=='/index.php' && $APPLICATION->GetCurPage()!=='/about/index.php' && $APPLICATION->GetCurPage()!=='/bonus/index.php'){?>
    <header class="header-content header-content--article">
      <h1 class="header-content__heading"><?$APPLICATION->ShowTitle();?></h1>
    </header>
    <article class="article">
<?}?>
<!--если другая страница-->


