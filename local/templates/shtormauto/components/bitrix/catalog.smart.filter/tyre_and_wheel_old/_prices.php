<?
foreach ($arResult["ITEMS"] as $arItem) {
    $key = $arItem["ENCODED_ID"];
    if (!isset($arItem["PRICE"]) 
        || $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
    ) {
        continue;
    }

    $step_num = 4;
    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
    $prices = array();
    if (Bitrix\Main\Loader::includeModule("currency")) {
        for ($i = 0; $i < $step_num; $i++) {
            $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
        }
        $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
    } else {
        $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
        for ($i = 0; $i < $step_num; $i++) {
            $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
        }
        $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
    }
    ?>
    <div class="bx-filter-parameters-box form-group">
        <span class="bx-filter-container-modef"></span>
        <div class="bx-filter-parameters-box-title form-slider"><label for="" class="form-label">Цена</label></div>
        <div class="bx-filter-block" data-role="bx_filter_block">
            <div class="bx-filter-parameters-box-container">
                <div class=" form-slider__inputs">
                    <div class="form-slider__input-wrapper">
                        <?
                        $minPriceFilter = (int)$arItem["VALUES"]["MIN"]["VALUE"];
                        if ($_GET["catalogFilter_P3_MIN"]) {
                            $minPriceFilter = $_GET["catalogFilter_P3_MIN"];
                        }
                        ?>
                        <span class='rubl'>&#8381;</span><input
                            class="min-price form-input form-slider__input"
                            type="text"
                            name='<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>'
                            id='<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'
                            value='<?=$minPriceFilter?>'
                            size="5"
                            onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                    <div class="form-slider__dash"></div>
                    <div class="form-slider__input-wrapper">
                        <?
                        $maxPriceFilter = (int)$arItem["VALUES"]["MAX"]["VALUE"];
                        if ($_GET["catalogFilter_P3_MAX"]) {
                            $maxPriceFilter = $_GET["catalogFilter_P3_MAX"];
                        }
                        ?>
                        <span class='rubl'>&#8381;</span><input
                            class="max-price form-input form-slider__input"
                            type="text"
                            name='<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>'
                            id='<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'
                            value='<?= $maxPriceFilter?>'
                            size="5"
                            onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
                <div class="bx-ui-slider-track-container form-slider__control">
                    <div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
                        <?for($i = 0; $i <= $step_num; $i++):?>
                            <div class="bx-ui-slider-part p<?=$i+1?>"><span><?=$prices[$i]?></span></div>
                        <?endfor;?>

                        <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                        <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                        <div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                        <div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
                            <a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                            <a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
    $arJsParams = array(
        "leftSlider" => 'left_slider_'.$key,
        "rightSlider" => 'right_slider_'.$key,
        "tracker" => "drag_tracker_".$key,
        "trackerWrap" => "drag_track_".$key,
        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
        "precision" => $precision,
        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
        "colorAvailableActive" => 'colorAvailableActive_'.$key,
        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
    );
    ?>
    <script type="text/javascript">
        BX.ready(function(){
            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
        });
    </script>
<?
} // foreach
