<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (!CSite::InDir('/catalog/')) {
    // На главной странице пустой $arResult['FORM_ACTION']
    $linkCatalog = array(
        'tyre' => '/catalog/shiny',
        'wheel' => '/catalog/_diski',
        'mototire' => '/catalog/_motoshiny',
        'akkumulyatory' => '/catalog/_akkumulyatory_i_soputstvuyushchee',
        'gruz' => '/catalog/_avtoshiny_gruzovye',
        'shiny_atv' => '/catalog/_shiny_atv_kvadrotsikl',
        'shiny_industrialnye' => '/catalog/3_industrialnye_shiny_2',
        'diski_gruzovye' => '/catalog/diski_gruzovye/'
    );
}

$arPropId = array(
    'tyre' => array(
        'SHIRINA'   => 397, 
        'PROFIL'    => 396, 
        'DIAMETR'   => 395,
        'BREND' => 393, 
        'SEZONNOST' => 398,                     
    ),
    'wheel' => array(
        'DIAMETR'                   => 395,
        'VYLET_LEGKOVOGO_DISKA_ET'  => 431,
        'PCD'                       => 390,
        'SHIRINA_LEGKOVOGO_DISKA'   => 481
    ),
    'mototire' => array(
        'SHIRINA_MOTOSHINY'   => 579,
        'VYSOTA_MOTOSHINY'    => 578,
        'DIAMETR_MOTOSHINY'   => 577,
    ),
    'akkumulyatory' => array(
        'AKKUMULYATOR_POLYARNOST'   => 596,
        'AKKUMULYATOR_TIP_KLEM'    => 597,
        'AKKUMULYATOR_EMKOST'   => 598,
        'AKKUMULYATOR_PUSKOVOY_TOK'   => 599,
        'AKKUMULYATOR_DLINNA'   => 600,
        'AKKUMULYATOR_SHIRINA'   => 601,
        'AKKUMULYATOR_VYSOTA'   => 602,
    ),
    
    'gruz' => array(
        'SHIRINA_GRUZOVOY_SHINY'    => 485,
        'PROFIL_GRUZOVOY_SHINY'   => 488,
        'DIAMETR_GRUZOVOY_SHINY_DISKA'   => 484,

    ),
    'shiny_atv' => array(
        'SHIRINA_ATVSHINY'   => 617,
        'VYSOTA_ATVSHINY'    => 616,
        'DIAMETR_ATVSHINY'   => 618
    ),
    'shiny_industrialnye' => array(
        'SHIRINA_GRUZOVOY_SHINY'   => 485,
        'PROFIL_GRUZOVOY_SHINY'    => 488,
        'DIAMETR_GRUZOVOY_SHINY_DISKA'   => 484
    ),
    'diski_gruzovye' => array(
        'DIAMETR_GRUZOVOY_SHINY_DISKA'   => 484,
        'VYLET_GRUZOVOGO_DISKA'          => 483,
        'PCD'                            => 390,
        'SHIRINA_GRUZOVOGO_DISKA'        => 482

    )
);

$isCarByGrz = $arResult['IS_SAVED_CAR'];

?>
<div class="filter-item__form tyre-and-wheel">
    <form name="<?php echo $arResult['FILTER_NAME'].'_form'?>" action="<?= $linkCatalog[$tyreOrWheel] . $arResult['FORM_ACTION'] ?>" method="get" class="smartfilter">
        <?php foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?php echo $arItem['CONTROL_NAME']?>" id="<?php echo $arItem['CONTROL_ID']?>" value="<?php echo $arItem['HTML_VALUE']?>" />
        <?php endforeach;?>

        <?php if($tyreOrWheel == 'tyre' || $tyreOrWheel == 'wheel'):?>
            <div data-tabs>
                <div class="filter-tabs-nav">
                    <div class="filter-tabs-nav__item <?=$isCarByGrz ? '' : 'active'?>" data-tab-item data-tab-id="filter-params">По параметрам</div>
                    <div class="toggle <?=$isCarByGrz ? 'switch-off' : 'switch-on'?>"><span></span></div>
                    <div class="filter-tabs-nav__item <?=$isCarByGrz ? 'active' : ''?>" data-tab-item data-tab-id="filter-car-brand">По госномеру</div>
                </div>

            <?php // По параметрам ?>
                <div class="filter-tabs-content <?=$isCarByGrz ? '' : 'active'?>" data-tab-content data-tab-id="filter-params">
                    <?php require __dir__ .'/_not_prices.php'; // Свойства кроме "Цена" ?>
                    <?php //require __dir__ .'/_prices.php';     // Цена ?>
                </div>

            <?php // По марке авто ?>
                <div class="filter-tabs-content <?=$isCarByGrz ? 'active' : ''?>" data-tab-content data-tab-id="filter-car-brand">
                    <?php $isSelectedCarInFilter = $APPLICATION->IncludeComponent(
                        "wecanit:car.select",
                        "",
                        [
                            'TYRE_OR_WHEEL'         => $tyreOrWheel,
                            'TYRE_SELECTION_FILTER' => $arParams['TYRE_SELECTION_FILTER'],
                        ],
                        false
                    );
                    ?>
                </div>

            </div><?php // data-tabs ?>

        <?php elseif ($tyreOrWheel == 'akkumulyatory'): ?>
            <div data-tabs>
                <div class="filter-tabs-nav">
                    <div class="filter-tabs-nav__item active" data-tab-item data-tab-id="filter-params">По параметрам</div>
                    <div class="toggle switch-on"><span></span></div>
                    <div class="filter-tabs-nav__item" data-tab-item data-tab-id="filter-car-brand">По марке авто</div>
                </div>

                <?php// По параметрам ?>
                <div class="filter-tabs-content active" data-tab-content data-tab-id="filter-params">
                    <?php require __dir__ .'/_not_prices.php'; // Свойства кроме "Цена" ?>
                </div>

                <?php// По марке авто ?>
                <div class="filter-tabs-content" data-tab-content data-tab-id="filter-car-brand">
                    <?php $APPLICATION->IncludeComponent(
                        "sp-artgroup:tyre.selection",
                        "",
                        [
                            'TYRE_OR_WHEEL'         => $tyreOrWheel,
                            'TYRE_SELECTION_FILTER' => $arParams['TYRE_SELECTION_FILTER'],
                        ],
                        false
                    );?>
                </div>
            </div><?php// data-tabs ?>

        <?php else:?>
           <div class="filter-tabs-content active" data-tab-content data-tab-id="filter-params">
               <?php require __dir__ .'/_not_prices.php'; // Свойства кроме "Цена" ?>
               <?php //require __dir__ .'/_prices.php';     // Цена ?>
            </div>
        <?php endif;?>

        <div class="form-group form-group--btn d-flex justify-content-center js-form-button">
            <input class="btn btn-scarlet-border" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
            <input type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" style='display: none;'/>

            <div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?php if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
                <?php echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                <span class="arrow"></span>
                <a href="<?php echo $arResult["FILTER_URL"]?>"><?php echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
            </div>
        </div>
        <?php if ($isCarByGrz):?>
          <div class="form-group d-flex justify-content-center form-select-other">
            <span class="js-select-other-car"><?= GetMessage('CAR_SELECT_OTHER')?></span>
          </div>
        <?php endif ?>
    </form>

    <?php $tsFilter = (isset($GLOBALS[ $arParams['TYRE_SELECTION_FILTER'] ])) ? $GLOBALS[ $arParams['TYRE_SELECTION_FILTER'] ] : false; ?>
    <?php if ($tsFilter): ?>
        <?php if (in_array($tsFilter['tyreOrWheel'], ['tyre', 'wheel'])): ?>
            <div class="tyre-and-wheel-specification">
                <div>Заводская комплектация и размеры:</div>
                <?php foreach ($tsFilter['specification_formatted'] as $ar): ?>
                    <?php if ($tsFilter['tyreOrWheel'] == 'tyre'): ?>
                        <div class="item"><?= $ar['UF_WIDTH'] ?>/<?= $ar['UF_PROFILE'] ?> R<?= $ar['UF_DIAMETER'] ?></div>
                    <?php else: ?>
                        <div class="item"><?= $ar['UF_WIDTH'] ?>J<?= $ar['UF_DIAMETER'] ?> <?= $ar['UF_LZ'] ?>*<?= $ar['UF_PCD'] ?> ET <?= $ar['UF_ET'] ?></div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        <?php elseif ($tsFilter['tyreOrWheel'] == 'akkumulyatory'): ?>
            <div class="tyre-and-wheel-specification">
                <div>Заводская комплектация и размеры:</div>
                <?php foreach ($tsFilter['specification_formatted'] as $value): ?>
                    <div class="item"><?= $value ?></div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    <?php endif ?>
</div>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?=CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);

    $(document).ready(function() {
        if ($(".select-car-content.car-select select[name=MODIFICATION]").val()) {
            // Указана модель авто - активируем вкладку
            $('[data-tab-id=filter-car-brand]').click();
            <?php if(isset($isSelectedCarInFilter) && !$isSelectedCarInFilter):?>
              $('[data-id=car-select]').click();
            <?php endif;?>
        }

        $('[data-tab-id="filter-params"]').click(function () {
          $('.js-select-other-car').addClass('hidden');
          $('.js-form-button').removeClass('hidden');
        });

      $('.filter-tabs-nav__item').click(function () {
        if ($('.js-car-select-result').hasClass('hidden')) {
          $('.js-form-button').addClass('hidden');
        }
      });

      $('[data-tab-id="filter-car-brand"]').click(function () {
        var currentTab = $(".filter-item__select-type input[name='filter-item']:checked").val();

        if (!$('.js-car-select-result').hasClass('hidden') && (currentTab === 'tire' || currentTab === 'disk')) {
          $('.js-select-other-car').removeClass('hidden');
        }

      });
    });
</script>