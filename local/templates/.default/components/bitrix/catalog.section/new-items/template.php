<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<? if(sizeof($arResult["ITEMS"]) > 0) { ?>
<div class="catalog-section-new">

    <div class="catalog-new-head"><?=GetMessage("NEW_ITEMS")?></div>

    <div class="catalog-section-new-content">
        <?foreach($arResult["ITEMS"] as $cell => $arElement):?>

            <?
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

            $price  = $arElement['ITEM_PRICES'][$arElement['ITEM_PRICE_SELECTED']];
            $canBuy = $arElement['CAN_BUY'] && !empty($price);
            ?>
            <div id="<?=$this->GetEditAreaId($arElement['ID'])?>" class="catalog-item">

                <div class="new-items-img-block">

                    <?
                    $hasPict = is_array($arElement['PREVIEW_PICTURE']);
                    $src = $templateFolder . '/images/' . ($hasPict ? 'new-img-wrap.png' : 'no-photo.png');
                    ?>

                    <? if ($hasPict): ?>
                        <div style="background: url('<?=$arElement["PREVIEW_PICTURE"]["src"]?>') center center no-repeat;" class="img-wrap">
                    <? endif ?>

                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>">
                        <img
                            src="<?= $src ?>"
                            width="84"
                            height="74"
                            alt="<?=$arElement["NAME"]?>"
                            title="<?=$arElement["NAME"]?>"
                        >
                    </a>

                    <? if ($hasPict): ?>
                        </div>
                    <? endif ?>
                </div>

                <div class="new-items-info-block">

                    <a class="product-title" href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>"><?=$arElement["NAME"]?></a>

                    <?
                    $text = strip_tags(trim($arElement['DETAIL_TEXT']));

                    if (strlen($text) > 100) {
                        $text = substr($text, 0, 100) . ' ...';
                    }
                    ?>
                    <p><?= $text ?></p>


                    <?php if ($canBuy): ?>

                        <? if ($price['DISCOUNT']): ?>
                            <s><?=$price['PRINT_BASE_PRICE']?></s>
                        <? endif ?>

                        <span class="catalog-price"><?=$price['PRINT_PRICE']?></span>

                    <?php endif ?>

                </div>

            </div>
        <? endforeach ?>

    </div>

</div>
<? } ?>