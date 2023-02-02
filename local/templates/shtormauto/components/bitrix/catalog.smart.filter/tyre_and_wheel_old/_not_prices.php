<?

foreach ($arPropId as $key) {
    $arItem = $arResult["ITEMS"][ $key ];

    if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) {
        continue;
    }

    if (($tyreOrWheel == 'tyre' && $arItem["CODE"] == 'SHIRINA')
        || ($tyreOrWheel == 'wheel' && in_array($arItem["CODE"], ['DIAMETR', 'PCD']))
    ) {
        /*  Обертка для 
                Шины:  ширина, профиль, диаметр
                Диски: диаметр, вылет
                Диски: крепеж
        */
        ?>
        <div class="form-group"><div class="filter-item__sizes">
        <?
    }
    ?>
    <div class="bx-filter-parameters-box">
        <span class="bx-filter-container-modef"></span>

        <div class="bx-filter-block" data-role="bx_filter_block">
            <div class="bx-filter-parameters-box-container">
            <?
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"])
            {
                case "B"://NUMBERS
                    ?>
                    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                        <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                        <div class="bx-filter-input-container">
                            <input
                                class="min-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                                />
                        </div>
                    </div>
                    <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                        <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                        <div class="bx-filter-input-container">
                            <input
                                class="max-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                                />
                        </div>
                    </div>
                    <?
                    break;
                case "P"://DROPDOWN
                    $checkedItemExist = false;
                    ?>
                    <div class="bx-filter-select-container filter-item__sizes-item">
                        <label for="selectWidth" class="form-label"><?=$arItem["NAME"]?>:</label>
                        <?/*<div class="bx_filter_select_block d-none d-sm-block d-md-block d-lg-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                            <div class="bx_filter_select_text" data-role="currentOption">
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar)
                                {
                                    if ($ar["CHECKED"])
                                    {
                                        echo $ar["VALUE"];
                                        $checkedItemExist = true;
                                    }
                                }
                                if (!$checkedItemExist)
                                {
                                    echo GetMessage("CT_BCSF_FILTER_ALL");
                                }
                                ?>
                            </div>
                            <div class="bx_filter_select_arrow"></div>
                            <input
                                style="display: none"
                                type="radio"
                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                value=""
                            />
                            <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                <input
                                    style="display: none"
                                    type="radio"
                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                />
                            <?endforeach?>
                            <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
                                <ul>
                                    <li>
                                        <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                            <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                        </label>
                                    </li>
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class.= " selected";
                                    if ($ar["DISABLED"])
                                        $class.= " disabled";
                                    if($ar["HTML_VALUE_ALT"] != "1620020923" && $ar["HTML_VALUE_ALT"] != "394837549" && $ar["HTML_VALUE_ALT"] != "2390880151"){?>
                                        <li>
                                            <label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
                                        </li>
                                    <?}?>
                                <?endforeach?>
                                </ul>
                            </div>
                        </div>*/?>
                        <div class="bx_filter_select_block d-block <?//d-sm-none d-md-none d-lg-none?> no-padding">
                            <select name="<?=$arCur["CONTROL_NAME_ALT"]?>">
                                <option><?=GetMessage("CT_BCSF_FILTER_ALL"); ?></option>
                                <?foreach ($arItem["VALUES"] as $val => $ar):
                                        $class = "";
                                        if ($ar["CHECKED"])
                                            $class.= " selected";
                                        /* @@@ DVG @@@ ticket/2723/
                                        original:
                                        if ($ar["DISABLED"])
                                            $class.= " disabled";
                                        */
                                ?>
                                    <option value="<?=$ar["HTML_VALUE_ALT"] ?>" <?=$class?>><?=$ar["VALUE"]?></optin>
                                <?endforeach?>        
                            </select>
                        </div> 
                    </div>
                    <?

                    break;
                case "K"://RADIO_BUTTONS
                    ?>
                    <div class="form-group">
                        <div class="form-label"><?=$arItem["NAME"];?>:</div>
                        <div class="form-radio">
                            <div class="form-radio__list">
                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <label class="form-radio__item" data-role="label_<?=$ar["CONTROL_ID"]?>" for="<? echo $ar['CONTROL_ID'] ?>">
                                    <input
                                        class="form-radio__input"
                                        type="radio"
                                        value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                        name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                        onclick="smartFilter.click(this)"
                                    />
                                    <span class="form-radio__text <? echo $ar['DISABLED'] ? 'disabled': '' ?>"><?=$ar["VALUE"];?></span>
                                </label>
                            <?endforeach;?>
                            </div>
                        </div>
                    </div>
                    <?
                    break;
                default://CHECKBOXES
                    ?>
                    <div class="col-xs-12">
                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                            <div class="checkbox">
                                <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
                                    <span class="bx-filter-input-checkbox">
                                        <input
                                            type="checkbox"
                                            value="<? echo $ar["HTML_VALUE"] ?>"
                                            name="<? echo $ar["CONTROL_NAME"] ?>"
                                            id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                            onclick="smartFilter.click(this)"
                                        />
                                        <span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                            ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                        endif;?></span>
                                    </span>
                                </label>
                            </div>
                        <?endforeach;?>
                    </div>
            <?
            } // switch
            ?>
            </div>
        </div>
    </div>
    <?
    if (($tyreOrWheel == 'tyre' && $arItem["CODE"] == 'DIAMETR')
        || ($tyreOrWheel == 'wheel' && in_array($arItem["CODE"], ['VYLET_LEGKOVOGO_DISKA_ET', 'PCD']))
    ) {
        // Обертка
        ?>
        </div></div>
        <?
    }
    ?>
<?
} // foreach
