<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="news-detail">
    <div class="back">
        <a href="<?= $arResult["LIST_PAGE_URL"]; ?>">
            <i class="icon i-arrow-left"></i>
            <?= GetMessage("T_NEWS_DETAIL_BACK") ?>
        </a>
    </div>
    <div class="news-detail-image">
        <?if (is_array($arResult['PICTURE'])){?>
            <img src="<?= $arResult['PICTURE']["src"] ?>"/>
        <?}?>
    </div>
    <h1 class="news-detail__heading"><?=$arResult["NAME"]?></h1>
    <div class="news-detail__date">
        <?= $arResult["DISPLAY_ACTIVE_FROM"] ?>
    </div>
    <div class="news-detail__content">
        <?= $arResult["DETAIL_TEXT"]; ?>
    </div>
    <div class="news-detail-share">
        <noindex>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.share",
                    "flat",
                    Array(
                            "HANDLERS" => array("twitter","telegram","vk"),
                            "HIDE" => "N",
                            "PAGE_TITLE" => $arResult["~NAME"],
                            "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                            "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                            "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"]
                    ),
            $component,
            Array(
                    'HIDE_ICONS' => 'Y'
            )
            );?>
        </noindex>
    </div>
</div>
