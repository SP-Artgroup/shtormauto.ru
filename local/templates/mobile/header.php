<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

require_once(__DIR__."/parts/class_include.php");

use Bitrix\Main\Page\Asset;

$detect = new Mobile_Detect();
$asset  = Asset::getInstance();
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    if (CModule::IncludeModule("mobileapp"))
    {
        CMobile::Init();
    }

    $APPLICATION->ShowHead();

    /* JQuery */
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.min.js');

    /* Main */
    $asset->addCss(SITE_TEMPLATE_PATH."/css/media.css");
    $asset->addCss(SITE_TEMPLATE_PATH."/styles.css");
    $asset->addJs(SITE_TEMPLATE_PATH."/script.js");

    /* Proxima Nova */
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/ubuntu-font.css');

    /* Font Awesome */
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/font-awesome.min.css');

    /* Owl Carousel*/
    $asset->addCss(SITE_TEMPLATE_PATH . '/js/owlcarousel/assets/owl.carousel.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/js/owlcarousel/assets/owl.theme.default.min.css');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/owlcarousel/owl.carousel.js');

    /* Inputmask */
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/inputmask/inputmask.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/inputmask/jquery.inputmask.js');

    /* Bootstrap */
    $asset->addCss(SITE_TEMPLATE_PATH . '/js/bootstrap/bootstrap.min.css');
    $asset->addJs(SITE_TEMPLATE_PATH."/js/bootstrap/bootstrap.min.js");
    $asset->addCss(SITE_TEMPLATE_PATH . '/js/bootstrap/bootstrap-select.css');
    $asset->addJs(SITE_TEMPLATE_PATH."/js/bootstrap/bootstrap-select.js");
    ?>
    <title>
        <?php $APPLICATION->ShowTitle(); ?>
    </title>

    <meta 123></meta>
    <?php
    if( $detect->isAndroidOS() ){
    $version = (float)$detect->version('Android');
/*        print $version;*/
    if($version <= 4.4) {
        ?>
        <script>
            $(document).ready(function(){
                $("input").attr("placeholder", "");
                $("select").removeClass("selectpicker").addClass("select_less");
            });
        </script>
           <?   } ?>
    <? }?>
</head>
<body>

    <?
    if($detect->isiOS()){
    ?>
    <script>
        window.onorientationchange = function (){
            $(".top-nav-bar").css({'paddingTop': '20px', 'height': '60px'});
            $(".app-main-container").css({"marginTop": "4.5em"});
            //var orientation = window.orientation; // РІ РіСЂР°РґСѓСЃР°С…
        }
    </script>
    <?
    }
    ?>

    <div class="top-nav-bar">
        <div class="col-xs-1 nospace">
            <div class="nav-menu-icon" onclick="app.openLeft();">

            </div>
        </div>
        <div class="col-xs-10 page-title">

        </div>
        <div class="col-xs-1 nospace">
            <div class="nav-cart-icon" onclick="window.location.href='/mobile_app/personal/cart/'">
                <?
                if(isset($_SESSION["CART"]) && $number = intval($_SESSION["CART"])) {
                ?>
                    <div class="cart-badge" onclick="window.location.href='/mobile_app/personal/cart/'"><?= $number; ?></div>
                <?
                }
                ?>
            </div>
        </div>
    </div>

    <!-- CпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ -->
    <!-- script>BXMobileApp.UI.Page.TopBar.hide();</script-->

    <!-- пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅ, пїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ -->
    <?php if(isset($_GET['leftupdate'])) { ?><script>app.onCustomEvent("onLeftUpdate", {});</script><?php } ?>

    <div class="app-main-container">
        <?php /*$APPLICATION->ShowPanel();*/ ?>
        <!-- div id="custom-top-bar"></div-->
        <div class="app-content">
