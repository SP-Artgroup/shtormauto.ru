<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$section     = $arResult['SECTION'];
$sectionPath = implode('/', array_column($section['PATH'], 'NAME'));
$price       = $arResult['CURRENT_PRICE'];
$canBuy      = $arResult['CAN_BUY'] && !empty($price);

$strAvailableCities = $arResult['AVAILABLE_CITIES_STRING'];

$templateData = [
    'MODEL' => $arResult['PROPERTIES']['MODEL']['VALUE'],
];
?>

<div class="catalog-element" itemscope itemtype=http://schema.org/Product>

    <div class="gallery">

        <div class="main-img">

            <? if (is_array($arResult["PREVIEW_PICTURE"])): ?>
                <a class="main-image-link big-img" rel="photos" href="<?=$arResult['DETAIL_PICTURE']["SRC"]?>">
                    <img
                        class="main-image"
                        itemprop="image"
                        src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>"
                        alt="<?=$arResult["NAME"]?>"
                        title="<?=$arResult["NAME"]?>"
                    >
                </a>
            <? else: ?>
                <img
                    itemprop="image"
                    style="border:solid 1px rgba(0,0,0,0.3); border-radius:5px;"
                    src="<?=$templateFolder?>/images/PP.png"
                    width="218"
                    height="188"
                    alt=""
                >
            <? endif ?>

            <? if ($arResult['PROPERTIES']['NEWITEM']['VALUE'] == "Y"): ?>
                <div class="new-icon">
                    <img itemprop="image" src="<?=$templateFolder?>/images/new-icon.png" width="70" height="70" alt="">
                </div>
            <? endif ?>

        </div>

        <? /*if (count($arResult["MORE_PHOTO"]) > 0): ?>

            <? foreach ($arResult["MORE_PHOTO"] as $cell => $PHOTO): ?>
                <div class="more-photo <?=($cell%3==0)?"nml":""?>" style="background-image: url('<?=$PHOTO["MIN"]["src"]?>');">
                    <a href="<?=$PHOTO["SRC"]?>" class="big-img" rel="photos">
                        <img
                            border="0"
                            src="<?=$templateFolder?>/images/more-photo-wrap.png"
                            width="70px"
                            height="50px"
                            alt="<?=$arResult["NAME"]?>"
                            title="<?=$arResult["NAME"]?>"
                        >
                    </a>
                </div>
            <? endforeach ?>

        <? endif*/ ?>

        <br/>
        <?php if ($strAvailableCities): ?>
            <strong>В наличии:</strong><br><?=$strAvailableCities?>
        <?php endif ?>
    </div>

    <div class="properties">

        <h1 itemprop="name"><?=$arResult["NAME"]?></h1>

        <?php if ($canBuy): ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="5" class="offers">
                <tr>
                    <th>Цена</th>
                </tr>

                <tr>
                    <td>

                        <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                            <? if ($price["DISCOUNT"]): ?>
                                <s><?=$price["BASE_PRICE"]?></s>
                            <? endif ?>

                            <span class="catalog-price"><?=$price["PRINT_PRICE"]?></span>

                            <?/* For SEO */?>
                            <span itemprop="price" style="display: none;"><?=$price["PRICE"]?></span>
                            <span itemprop="priceCurrency" content="RUB" style="display: none;"><?=$price["CURRENCY"]?></span>

                        </span>

                        <script>
                            window.dataLayer = window.dataLayer || [];
                            window.dataLayer.push({
                                "ecommerce": {
                                    "detail": {
                                        "products": [
                                            {
                                                "id": "<?=$arResult['ID']?>",
                                                "name" : "<?=$arResult['NAME']?>",
                                                "price": <?=$price["PRICE"]?>,
                                                "brand": "<?=(!empty($arResult['PROPERTIES']['BREND']['VALUE']) ? $arResult['PROPERTIES']['BREND']['VALUE'] : '')?>",
                                                "category": "<?=$sectionPath?>"
                                            }
                                        ]
                                    }
                                }
                            });
                        </script>

                        <!-- /************************НОВОЕ********** В РЕЛ СТАВИМ АЙДИ ТОВАРА*******************/ -->
                        <div class="quan_form">
                            <button class="minus js-down" type="button"></button>
                            <input class="quan js-quantity" type="text" value="1">
                            <button class="plus js-up" type="button"></button>
                        </div>
                        <!-- /************************НОВОЕ*****************************/ -->
                    </td>
                </tr>
            </table>

            <div class="catalog-element-store-list">
                <?$APPLICATION->IncludeComponent(
                    "sp-artgroup:store.list",
                    "",
                    [
                        "PRODUCT_ID" => $arResult['ID'],
                    ],
                    $component
                );?>
            </div>

            <div class="browse_but2">
                <button
                    type="button"
                    class="button pokupka js-buy-btn"
                    rel="<?=$arResult['ID']?>"
                >
                    <span>Купить</span>
                </button>
            </div>
        <?php else: ?>
            <span class="product-not-available">Товара нет в наличии</span>
        <?php endif ?>

        <? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
            <div class="property">
                <span class="name"><?=$arProperty["NAME"]?>:</span>&nbsp;<?
                if (!empty($arProperty["DISPLAY_VALUE"])):
                    echo $arProperty["DISPLAY_VALUE"];?>
                <? endif ?>
            </div>
        <? endforeach ?>
    </div>

    <div class="description-title"><?=GetMessage("CATALOG_DESCRIPTION")?></div>

    <? $desc = $arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT'] ?>

    <?php if ($desc): ?>
        <p itemprop="description"><?= $desc ?></p>
    <?php endif ?>
    <br />

    <div class="asd_social_share">
        <?$APPLICATION->IncludeComponent(
            "bitrix:asd.share.buttons",
            ".default",
            array(
                "ASD_ID"              => $arResult["ID"],
                "ASD_TITLE"           => $arResult["NAME"],
                "ASD_URL"             => $arResult["DETAIL_PAGE_URL"],
                "ASD_PICTURE"         => $arResult["PREVIEW_PICTURE"]["src"],
                "ASD_TEXT"            => $arResult["DETAIL_TEXT"],
                "ASD_LINK_TITLE"      => "Поделиться в #SERVICE#",
                "ASD_SITE_NAME"       => "",
                "ASD_INCLUDE_SCRIPTS" => [],
                "LIKE_TYPE"           => "LIKE",
                "VK_API_ID"           => "",
                "VK_LIKE_VIEW"        => "mini",
                "TW_DATA_VIA"         => "",
                "SCRIPT_IN_HEAD"      => "N"
            ),
            $component
        );?>
    </div>

    <?if(is_array($section)):?>
        <br /><a href="<?=$section["SECTION_PAGE_URL"]?>"><<<?=GetMessage("CATALOG_BACK")?></a><br />
    <?endif?>

    <script>
        var elementData = <?=CUtil::PhpToJsObject($arResult['JS_DATA'])?>;
    </script>

</div>