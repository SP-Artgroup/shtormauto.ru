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

//SP_Log::consoleLog( $arResult["ITEMS"] );
//SP_Log::consoleLog( $arResult["HIDDEN"] );
//SP_Log::consoleLog( $arResult );
//SP_Log::consoleLog($arResult['FORM_ACTION'], 'FORM_ACTION');

$tyreOrWheel = $arParams['TYRE_OR_WHEEL'];      //$tyreOrWheel = ($arParams['SECTION_ID'] == 25453) ? 'tyre' : 'wheel';

$linkCatalog = '';
if (!CSite::InDir('/catalog/')) {
    // На главной странице пустой $arResult['FORM_ACTION']
    $linkCatalog = ($tyreOrWheel == 'tyre') ? '/catalog/shiny' : '/catalog/_diski';
}

if ($tyreOrWheel == 'tyre') {
    // Шины
    $arPropId = [
        'SEZONNOST' => 398,
        'SHIRINA'   => 397,
        'PROFIL'    => 396,
        'DIAMETR'   => 395,
        'BREND' => 393,
    ];
} else {
    // Диски
    $arPropId = [
        'DIAMETR'                  => 395,
        'VYLET_LEGKOVOGO_DISKA_ET' => 431,
        'PCD'                      => 390,
    ];
} //

?>
<div class="filter-item__form tyre-and-wheel">
    <form name="<?echo $arResult['FILTER_NAME'].'_form'?>" action="<?= $linkCatalog . $arResult['FORM_ACTION'] ?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem['CONTROL_NAME']?>" id="<?echo $arItem['CONTROL_ID']?>" value="<?echo $arItem['HTML_VALUE']?>" />
        <?endforeach;?>

        <div data-tabs>
            <div class="filter-tabs-nav">
                <div class="filter-tabs-nav__item active" data-tab-item data-tab-id="filter-params"   >По параметрам</div>
                <div class="filter-tabs-nav__item"        data-tab-item data-tab-id="filter-car-brand">По марке авто</div>
            </div>
            
            <?// По параметрам ?>
            <div class="filter-tabs-content active" data-tab-content data-tab-id="filter-params">
                <? require __dir__ .'/_not_prices.php'; // Свойства кроме "Цена" ?>
                <? //require __dir__ .'/_prices.php';     // Цена ?>
            </div>

            <?// По марке авто ?>
            <div class="filter-tabs-content" data-tab-content data-tab-id="filter-car-brand">
                <?$APPLICATION->IncludeComponent(
                    "sp-artgroup:tyre.selection",
                    "",
                    [
                        'TYRE_OR_WHEEL'         => $tyreOrWheel,
                        'TYRE_SELECTION_FILTER' => $arParams['TYRE_SELECTION_FILTER'],
                    ],
                    false
                );?>
            </div>

        </div><?// data-tabs ?>

        <div class="form-group form-group--btn d-flex justify-content-center">
            <input class="btn btn-scarlet" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
            <input type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" style='display: none;'/>

            <div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
                <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                <span class="arrow"></span>
                <a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
            </div>
        </div>
    </form>

    <? $tsFilter = (isset($GLOBALS[ $arParams['TYRE_SELECTION_FILTER'] ])) ? $GLOBALS[ $arParams['TYRE_SELECTION_FILTER'] ] : false; ?>
    <?if ($tsFilter): ?>
        <div class="tyre-and-wheel-specification">
            <div>Заводская комплектация и размеры:</div>
            <?foreach ($tsFilter['specification_formatted'] as $ar): ?>
                <?if ($tsFilter['tyreOrWheel'] == 'tyre'): ?>
                    <div class="item"><?= $ar['UF_WIDTH'] ?>/<?= $ar['UF_PROFILE'] ?> R<?= $ar['UF_DIAMETER'] ?></div>
                <?else: ?>
                    <div class="item"><?= $ar['UF_WIDTH'] ?>J<?= $ar['UF_DIAMETER'] ?> <?= $ar['UF_LZ'] ?>*<?= $ar['UF_PCD'] ?> ET <?= $ar['UF_ET'] ?></div>
                <?endif ?>
            <?endforeach ?>
        </div>
    <?endif ?>
</div>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);

    $(document).ready(function() {
        $("[data-tab-item]").click(function() {
            var tabsObj = $(this).closest("[data-tabs]"),
                tabId   = $(this).attr("data-tab-id");

            tabsObj.find("[data-tab-item]").removeClass("active");
            $(this).addClass("active");

            tabsObj.find("[data-tab-content]").removeClass("active");
            tabsObj.find('[data-tab-content][data-tab-id="' + tabId + '"]').addClass("active");
        });

        if ($("[data-tabs] select[name=MODIFICATION]").val()) {
            // Указана модель авто - активируем вкладку
            $('[data-tab-id=filter-car-brand]').click();
        }
    });    
</script>