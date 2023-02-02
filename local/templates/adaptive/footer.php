<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use SP\Component as SPComponent;

IncludeTemplateLangFile(__FILE__);
?>
        </div><!-- .content-col -->

        <? if (CSite::InDir('/personal/cart/') || CSite::InDir('/personal/')) { ?>

        <? } else { ?>

            <div class="col left">

                <? SPComponent::include('menu/left_catalog') ?>

                <div style="clear: both;"></div>
                <?//$arrFilterNew["!PROPERTY_NEWITEM"] = false;?>
                <?
                    //global $arrFilterNew;
                    //$arrFilterNew = array();
                    //$arrFilterNew['PROPERTY_NEWITEM'] = '38';
                ?>
                <? SPComponent::include('catalog/section_new_items') ?>

                <? SPComponent::include('news.line/banners_left') ?>
            </div>

            <div class="col <?=(!empty($dirs[1]))?"right":""?>">

                <?$APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "right_banner",
                    array(
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "NOINDEX" => "N",
                        "QUANTITY" => "5",
                        "TYPE" => "r1",
                        "COMPONENT_TEMPLATE" => "right_banner"
                    ),
                    false
                );?>

                <div class="filters">

                    <?$APPLICATION->IncludeComponent(
                        "g-tech:filter",
                        "template2",
                        array(
                            "IBLOCK_TYPE" => "catalog",
                            "IBLOCK_ID" => "26",
                            "FILTER_DISPLAY_NAME" => "ПОИСК ШИН",
                            "RESULT_PAGE" => "/catalog/_avtoshiny/",
                            "FILTER_NAME" => "arrFilter",
                            "PROPERTY_CODE" => array(
                                0 => "SHIRINA",
                                1 => "PROFIL",
                                2 => "DIAMETR",
                                3 => "SEZONNOST",
                                4 => "",
                            ),
                            "CACHE_TYPE" => "N",
                            "CACHE_TIME" => "36000000",
                            "COMPONENT_TEMPLATE" => "template2"
                        ),
                        false
                    );?>

                    <?$APPLICATION->IncludeComponent(
	"g-tech:filter",
	"template3",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "26",
		"FILTER_DISPLAY_NAME" => "ПОИСК ДИСКОВ",
		"RESULT_PAGE" => "/catalog/_diski/",
		"FILTER_NAME" => "arrFilter",
		"PROPERTY_CODE" => array(
			0 => "VYLET_LEGKOVOGO_DISKA_ET",
			1 => "TIP_DISKA",
			2 => "PCD",
			3 => "BREND",
			4 => "DIAMETR",
			5 => "",
		),
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"COMPONENT_TEMPLATE" => "template3"
	),
	false
);?>

                    <?$APPLICATION->IncludeComponent("g-tech:akb.podbor", "template1", array(
                        "IBLOCK_TYPE" => "catalog",
                            "IBLOCK_ID" => "5",
                            "FILTER_DISPLAY_NAME" => "ПОИСК АККУМУЛЯТОРОВ",
                            "RESULT_PAGE" => "/catalog/akkumulyatory/",
                            "FILTER_NAME" => "arrFilter",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "CACHE_TYPE" => "N",
                            "CACHE_TIME" => "36000000",
                            "COMPONENT_TEMPLATE" => "template1"
                        ),
                        false,
                        array(
                        "ACTIVE_COMPONENT" => "N"
                        )
                    );?>

                </div>

                <br/>

                <div class="shopAndNews">

                    <?if($APPLICATION->GetCurDir() != "/bonus/"):?>
                    <div class="catalog-section-new">
                        <div class="catalog-new-head">Бонусная программа</div>
                        <a class="catalog-section-new-link" href="<?=SITE_DIR?>bonus/" title="Бонусная программа">Проверить количество бонусов</a>
                    </div>
                    <?endif;?>

                    <div class="catalog-section-new">
                        <div class="catalog-new-head">Подписка на рассылку</div>
                        <a class="catalog-section-new-link" href="<?=SITE_DIR?>news/subscribe.php" title="Подписка на рассылку">Будь в курсе всех акций и скидок</a>
                    </div>

                    <div class="catalog-section-new shop_list">

                        <div class="catalog-new-head">Наши магазины</div>

                        <? SPComponent::include('news.list/main_shops_list') ?>
                    </div>

                </div>

                <div class="shopAndNews" style="padding-top:10px;">

                    <? SPComponent::include('news.list/right_sidebar_news') ?>
                    <? SPComponent::include('news.line/banners_right') ?>

                </div>

                <div class="our_socials">

                    <a href="https://www.youtube.com/channel/UCrvyu9YthshNP4UpDB9rsAA" title="YouTube" target="_blank">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.png" style="width:22px;margin-left:4px;margin-right:4px;" alt="">
                    </a>

                    <a href="https://www.facebook.com/goodridetire.ru" title="facebook">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/facebook.png" style="width:22px;margin-right:4px;" alt="">
                    </a>

                    <a href="https://twitter.com/goodridetire" title="@goodridetire">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/twitter.png" style="width:22px;margin-right:4px;" alt="">
                    </a>

                    <a href="https://instagram.com/shtormavto/" title="instagram">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/instagram.png" style="width:22px;margin-right:4px;" alt="">
                    </a>

                    <div>
                        <a href='https://play.google.com/store/apps/details?id=ru.shtormauto.app' target="_blank">
                            <img class="g-play-icon" alt='Доступно в Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/ru_badge_web_generic.png'>
                        </a>
                        <a
                            class="app-store-icon"
                            href="https://itunes.apple.com/ru/app/stormavto/id1183266373?mt=8"
                            target="_blank"
                            style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/appstore.svg);"
                        ></a>
                    </div>

                </div>

            </div>

        <? } ?>

        <div style="clear: both;"></div>

        <?
        if (CSite::InDir('/catalog/')) {
            SPComponent::include('catalog/top_slider');
        }
        ?>

    </div><!-- .content.wrap -->

    <div style="clear: both;"></div>

</div><!-- .global-wrap -->

<div style="clear: both;"></div>

<div class="foot-line">
    <div class="foot-auto"></div>
    <div class="footer wrap">
        <div class="right-block">
            <? SPComponent::include('menu/bottom') ?>
        </div>

        <div class="left-block">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/include/copy.php",
                "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        </div>
    </div>
</div>

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107413092-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-107413092-1');
</script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'dV2RLLLryG';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->

<?php // Кнопка онлайн записи на услуги ?>
<script>
var yWidgetSettings = {
buttonAutoShow : true,
buttonText : 'Запись на сервис',
};
</script>
<script type="text/javascript" src="https://w129701.yclients.com/widgetJS" charset="UTF-8"></script>

</body>
</html>