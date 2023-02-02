<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

$this->setFrameMode(true);

$data   = $arResult['tpl']['data'];
$params = $arResult['tpl']['params'];

$picture = $arResult['DETAIL_PICTURE'];

?>
<div class="news-detail">

    <? if ($params['show_picture']): ?>
        <img
            class="detail_picture"
            border="0"
            src="<?= $picture['SRC'] ?>"
            width="<?= $picture['WIDTH'] ?>"
            height="<?= $picture['HEIGHT'] ?>"
            alt="<?= $picture['ALT'] ?>"
            title="<?= $picture['TITLE'] ?>"
        >
    <? endif ?>

    <? if ($params['show_date']): ?>
        <span class="news-date-time"><?= $arResult['DISPLAY_ACTIVE_FROM'] ?></span>
    <? endif ?>

    <? if ($params['show_name']): ?>
        <h3><?= $arResult['NAME'] ?></h3>
    <? endif ?>

    <? if ($params['show_preview_text']): ?>
        <p><?=$arResult['FIELDS']['PREVIEW_TEXT'];unset($arResult['FIELDS']['PREVIEW_TEXT']);?></p>
    <? endif ?>

    <?if ($arResult['NAV_RESULT']): ?>

        <?if ($arParams['DISPLAY_TOP_PAGER']): ?>
            <?=$arResult['NAV_STRING']?><br />
        <?endif;?>

        <?= $arResult['NAV_TEXT']; ?>

        <?if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
            <br /><?=$arResult['NAV_STRING']?>
        <?endif;?>

    <?elseif (strlen($arResult['DETAIL_TEXT']) > 0): ?>
        <?= $arResult['DETAIL_TEXT']; ?>
    <?else: ?>
        <?= $arResult['PREVIEW_TEXT']; ?>
    <?endif?>

    <div style="clear:both"></div>
    <br />

    <?foreach ($arResult['FIELDS'] as $code => $value): ?>

        <?if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code): ?>
            <?=GetMessage('IBLOCK_FIELD_' . $code)?>:&nbsp;

            <? if (!empty($value) && is_array($value)): ?>
                <img border="0" src="<?=$value['SRC']?>" width="<?=$value['WIDTH']?>" height="<?=$value['HEIGHT']?>">
            <? endif ?>
        <?else: ?>
            <?=GetMessage('IBLOCK_FIELD_' . $code)?>:&nbsp;<?=$value;?>
        <?endif?>
        <br />

    <?endforeach?>

    <?foreach ($arResult['DISPLAY_PROPERTIES'] as $pid => $arProperty): ?>

        <?= $arProperty['NAME'] ?>:&nbsp;
        <? if (is_array($arProperty['DISPLAY_VALUE'])): ?>
            <?= implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']) ?>
        <? else: ?>
            <?= $arProperty['DISPLAY_VALUE'] ?>
        <? endif ?>
        <br />

    <? endforeach ?>

    <? if ($params['use_share']): ?>
        <div class="news-detail-share">
            <noindex>
            <?
            $APPLICATION->IncludeComponent(
                'bitrix:main.share',
                '',
                [
                    'HANDLERS'          => $arParams['SHARE_HANDLERS'],
                    'PAGE_URL'          => $arResult['~DETAIL_PAGE_URL'],
                    'PAGE_TITLE'        => $arResult['~NAME'],
                    'SHORTEN_URL_LOGIN' => $arParams['SHARE_SHORTEN_URL_LOGIN'],
                    'SHORTEN_URL_KEY'   => $arParams['SHARE_SHORTEN_URL_KEY'],
                    'HIDE'              => $arParams['SHARE_HIDE'],
                ],
                $component,
                ['HIDE_ICONS' => 'Y']
            );
            ?>
            </noindex>
        </div>
    <? endif ?>
</div>