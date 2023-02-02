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
    '/storm',
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
foreach ([
    '/vendor/bootstrap/dist/css/bootstrap.min.css',
    '/js/owl.carousel/owl-carousel/owl.carousel.css',
    '/js/owl.carousel/owl-carousel/owl.theme.css',
    '/js/fancyapps/source/jquery.fancybox.css',
    '/css/global.css',
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
foreach ([
    '/js/fancyapps/source/jquery.fancybox.pack.js',
    '/js/jquery.maskedinput.min.js',
    '/js/owl.carousel/owl-carousel/owl.carousel.min.js',
    '/js/script.js',
    '/js/modules/catalog.js',
] as $path) {
    $asset->addJs(SITE_TEMPLATE_PATH . $path);
}

?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset="<?= LANG_CHARSET ?>">
    <?
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowLink("canonical");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>

    <meta name="viewport" content="width=device-width">

    <? //if (isset($_REQUEST['PAGEN_1'])): ?>
        <link rel="canonical" href="<?=$_SERVER['SCRIPT_URI']?>">
    <? //endif ?>

    <link rel="icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon">

    <script>
        (function($){
          $(function(){
              // $('html').toggleClass('no-js js');
            $('.toggle-box .toggle').click(function(e){
                e.preventDefault();
                $(this).next('.content').slideToggle();
            });
          });
        })(jQuery);
    </script>
    <meta name="yandex-verification" content="e23dc2a244a4cc2c" />
</head>
<body>
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

<?$APPLICATION->ShowPanel();?>
<?
$dir = $APPLICATION->GetCurDir();
$dirs = explode("/", $dir);
?>

<div class="top-line">
    <div class="wrap">
        <div class="city_ip">
            <?$APPLICATION->IncludeComponent("sp-artgroup:city.list", "", Array());?>
        </div>
        <!-- /************************НОВОЕ*****************************/ -->
        <ul class="top_menu hidmobile">
            <li><a href="/about/delivery/" title="Оплата и доставка">Оплата и доставка</a></li>
            <li><a href="/about/guaranty/" title="Гарантия">Гарантия</a></li>
            <li class=""><a href="/about/tires_service/" title="Уход за шинами">Уход за шинами</a></li>
        </ul>
        <!-- /************************НОВОЕ*****************************/ -->

        <div id="search-toggle" class="add-active">
            <span class="theme-icon-search"></span>
        </div>

        <? SPComponent::include('main_search') ?>
    </div>
</div>

<div class="global-wrap">
    <div class="header wrap">

        <? SPComponent::include('header_auth_form') ?>
        <? SPComponent::include('basket_line') ?>

        <div class="header__app-link hidmobile">
            <a
                class="appstore-link"
                href="https://itunes.apple.com/ru/app/stormavto/id1183266373?mt=8"
                target="_blank"
                style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/appstore_header.png)"></a>

            <a class="googleplay-link" href="https://play.google.com/store/apps/details?id=ru.shtormauto.app" target="_blank">
                <img alt="Доступно в Google Play" src="<?=SITE_TEMPLATE_PATH?>/images/googleplay_header.png">
            </a>
        </div>

        <div itemscope itemtype=http://schema.org/Brand class="header-logo">

            <?if(!CSite::InDir('/index.php')):?>
                <a href="http://shtormauto.ru/" title="Штормавто-Поул Позишн. Сеть автомагазинов.">
            <?endif;?>

            <img
                itemprop="image"
                style="outline-width:0px;"
                src="/upload/logo2.png"
                width="501"
                height="98"
                alt="ШтормАвто. Сеть магазинов."
                title="ШтормАвто. Сеть магазинов."
            >

            <? if (!CSite::InDir('/index.php')): ?>
                </a>
            <? endif ?>
            <span itemprop="name" style="display: none;">ШтормАвто</span>

        </div>

        <? if(0) {?>
            <div style="color:red;text-align:center;">
            ИНТЕРНЕТ-МАГАЗИН НАХОДИТСЯ В ТЕСТОВОМ РЕЖИМЕ!<br/>
            ПРИНОСИМ СВОИ ИЗВИНЕНИЯ ЗА ПРЕДОСТАВЛЕННЫЕ НЕУДОБСТВА.
            </div>
        <? } ?>

        <div class="top-menu-block-wrapper">
            <div class="top-menu-block-content">

                <? SPComponent::include('menu/header_line') ?>

                <a href="/storm/" class="storm-button" title="Записаться на сервис"></a>
                <div style="clear: both"></div>
            </div>
        </div>

        <div id="sticky-inner" class="container-inner">

            <div id="menu-toggle" class="add-active">
                <a id="nav-toggle"><span></span></a>
            </div>

            <?php /*
            <div id="sticky-search">
                <div class="triangle triangle-border"></div>
                <div class="triangle"></div>
            </div>
            */ ?>

            <nav id="main-menu">

                <? SPComponent::include('menu/main') ?>

                <div class="triangle triangle-border"></div>
                <div class="triangle"></div>
            </nav>

            <div class="section-toggle add-active">
                <span class="section-more-label">Каталог</span>
                <span class="theme-icon-sort-down"></span>
            </div>

            <div class="section-menu-mobile">
                <? SPComponent::include('menu/section_mobile') ?>
            </div>

        </div>

    </div>

    <div style="clear: both;"></div>

    <div class="content wrap">

        <? if (!empty($currentPath[1])): ?>

            <div class="breadcrumb">
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "storm", array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                    ),
                    false
                );?>
            </div>
            <div style="clear: both;"></div>

        <? endif ?>

        <? if (CSite::InDir('/personal/cart/') || CSite::InDir('/personal/')) { ?>
            <!-- /************************НОВОЕ*****************************/ -->
            <div class="content100">

        <? } else { ?>

            <div class="content-col">

                <? if ($USER->isAdmin() && $showPageHeader): ?>
                    <div style="margin-bottom: 5px;">
                        <h1><? $APPLICATION->showTitle(false) ?></h1>
                    </div>
                <? endif ?>

                <? if (
                    in_array($currentPage, ['', 'news', 'brands'])
                    || ($currentPath[1] === 'catalog' && empty($currentPath[3]))
                ): ?>

                    <? SPComponent::include('news.list/main_banner_slider') ?>

                    <? /*
                    <?
                    global $banner_on_main_filter2;
                    $banner_on_main_filter2['<ID']  = 499226;
                    ?>

                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "main-banner",
                        array(
                            "IBLOCK_TYPE" => "services",
                            "IBLOCK_ID" => "6",
                            "NEWS_COUNT" => "1",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "banner_on_main_filter2",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "A_HREF",
                                1 => "BANNER",
                                2 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_STATUS_404" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_META_DESCRIPTION" => "Y"
                        ),
                        false
                    );?>
                    */ ?>

                <? endif ?>
    <? } ?>