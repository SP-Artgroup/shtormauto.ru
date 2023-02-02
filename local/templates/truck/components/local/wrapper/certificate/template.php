<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
<div class="shtorm-avto-bg">
    <div class="container">
        <div class="shtorm-avto">
            <div class="col-lg-5 col-md-5 col-sm-5 certificate">
                <a href="<?= SITE_DIR ?>certificates/">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/certificate-img.png" alt="">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/certificate-hover.png" alt="">
                </a>
            </div>

            <div class="col-lg-7 col-md-7 col-sm-7 text">
                <h2><?= $arParams['title'] ?></h2>
                <div class="open-text">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        [
                            "AREA_FILE_SHOW" => "file",
                            "PATH"           => SITE_DIR . "include/main_certificate_text.php",
                        ],
                        $component
                    )
                    ?>
                </div>
                <div class="show-text"><?= $arParams['more'] ?><i class="fas fa-angle-double-right"></i></div>
            </div>
        </div>
    </div>
</div>