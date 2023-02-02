<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$langPrefix = 'TPL_TRUCK_';
$msg = [];

foreach ([
    'COMPANY_TITLE',
    'CATALOG_TITLE',
    'SHOPS_TITLE',
] as $langCode) {
    $msg[strtolower($langCode)] = Loc::getMessage($langPrefix . $langCode);
}

?>
    <?php if ($wrapWorkArea): ?>
        </div><!-- .container -->
    <?php endif ?>

</div><!-- .content -->

<footer>
    <div class="container footer-container">
        <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 company">
            <p class="caption"><?= $msg['company_title'] ?></p>
            <?php
            // Задаётся в bitrix:menu:main
            $APPLICATION->showViewContent('footer-main-menu');
            ?>
        </div>

        <div class="col-lg-3 col-md-2 col-sm-3 catalog">
            <p class="caption"><?= $msg['catalog_title'] ?></p>
            <?php
            // Задаётся в bitrix:menu:top-catalog
            $APPLICATION->showViewContent('footer-catalog-menu');
            ?>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-3 our-shopes">
            <p class="caption"><?= $msg['shops_title'] ?></p>

            <?$APPLICATION->IncludeComponent(
                "sp-artgroup:listContacts",
                "",
                Array(
                    "IBLOCK_ID" => "15",
                    "IBLOCK_TYPE_ID" => "services",
                    "PROPERTY" => "PHONES"
                )
                );?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                [
                    "AREA_FILE_SHOW" => "file",
                    "PATH"           => SITE_DIR . "include/footer/question.php",
                ],
                null,
                ['HIDE_ICONS' => 'Y']
            ) ?>
        </div>
    </div>
    </div>

    <div class="container copyright">
        <div class="row">
            <div class="copy col-lg-4 col-md-6 col-sm-12">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                    "AREA_FILE_SHOW" => "file",	// Показывать включаемую область
            		"PATH" => SITE_DIR."include/footer/copyright.php",	// Путь к файлу области
                ]) ?>
            </div>
            <div class="web col-lg-8 col-md-6 col-sm-12">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/footer/developer.php",
                ]) ?>
            </div>
        </div>
    </div>
</footer>

<script>
$(function () {
    $(".select-drop").select2({
       tags: true,
       minimumResultsForSearch: Infinity

    });
});
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52155493, "init", {
        id:52155493,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52155493" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
<?php
unset($msg);
?>