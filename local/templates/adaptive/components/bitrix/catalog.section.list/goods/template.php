<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$hermitage = [
    'EDIT'    => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT'),
    'DELETE'  => CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE'),
    'CONFIRM' => ['CONFIRM' => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')]
];

if ($arResult["SECTIONS"]): ?>

    <div class="catalog-section">

        <h1><?=$arResult["SECTION"]["NAME"]?></h1>

        <div class="catalog-section-list-cont">

            <? foreach ($arResult["SECTIONS"] as $cell => $arSection): ?>

                <?
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $hermitage['EDIT']);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $hermitage['DELETE'], $hermitage['CONFIRM']);
                ?>
                <div style="display:none"><? echo '<pre>'; print_r($arSection); echo '</pre>';?></div>
                <div class="catalog-item" id="<?=$this->GetEditAreaId($arSection['ID'])?>">

                    <div class="catalog-item-image-wrapper">

                        <? if (is_array($arSection["PICTURE"])): ?>

                            <a
                                class="catalog-item-image"
                                href="<?=$arSection["SECTION_PAGE_URL"]?>"
                                style="background-image: url(<?=$arSection["PICTURE"]["src"]?>)"
                                title="<?=$arSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]?>"
                            ></a>

                        <? else: ?>
                            <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
                                <img border="0"
                                    src="<?=SITE_TEMPLATE_PATH?>/images/no_image.png"
                                    width="126px"
                                    height="123px"
                                    alt="<?=$arSection["NAME"]?>"
                                    title="<?=$arSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]?>"
                                    style="opacity:0.5;"
                                >
                            </a><br/>
                        <? endif ?>
                    </div>

                    <a href="<?=$arSection["SECTION_PAGE_URL"]?>" title="<?=$arSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]?>"><?=$arSection["NAME"]?></a><br/>

                    <? if (intval($arSection["UF_MIN_PRICE"])): ?>
                        <span class="catalog-price"><?=CurrencyFormat($arSection["UF_MIN_PRICE"], 'RUB')?></span>
                    <? endif ?>
                </div>

            <? endforeach; ?>

        </div>

        <? /*if ($arResult["SECTION"]["DESCRIPTION"]): ?>
            <div class="current-section-desc"><?= $arResult["SECTION"]["DESCRIPTION"]?></div>
        <? endif*/ ?>

    </div>

<? endif; ?>