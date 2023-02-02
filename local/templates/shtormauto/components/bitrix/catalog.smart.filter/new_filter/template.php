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
$firstInBlock = true;
$countProps = 1;
if (!CSite::InDir('/catalog/')){
    $linkCatalog = "/catalog/shiny";
}else{
    $linkCatalog = "";
}
?>
<div class="filter-item__form">
		<form name="<?echo $arResult['FILTER_NAME'].'_form'?>" action="<?=$linkCatalog.$arResult['FORM_ACTION']?>" method="get" class="smartfilter">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem['CONTROL_NAME']?>" id="<?echo $arItem['CONTROL_ID']?>" value="<?echo $arItem['HTML_VALUE']?>" />
			<?endforeach;?>

				<?//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if(
						empty($arItem["VALUES"])
						|| isset($arItem["PRICE"])
					)
						continue;
                                                                if ($firstInBlock && $arItem["DISPLAY_TYPE"]=="P" ){
                                                                    $firstInBlock = false;
                                                                    ?>
								<div class="form-group">
									<div class="filter-item__sizes">
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
								<div class="bx-filter-select-container /*bx_filter_select_container*/ filter-item__sizes-item">
                                                                    <label for="selectWidth" class="form-label"><?=$arItem["NAME"]?>:</label>
									<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
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
											?>
												<li>
													<label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
												</li>
											<?endforeach?>
											</ul>
										</div>
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
							}
                                                                if ($countProps==3 && $arItem["DISPLAY_TYPE"]=="P" ){
                                                                $firstInBlock = true;
                                                                $countProps = 1;
                                                                    ?></div>
                                                                        </div><?
                                                                }elseif($arItem["DISPLAY_TYPE"]=="P"){
                                                                $countProps++;
                                                                }
							?>
							</div>
						</div>
					</div>
				<?
				}

				foreach($arResult["ITEMS"] as $key=>$arItem)//prices
				{
					$key = $arItem["ENCODED_ID"];
					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;

						$step_num = 4;
						$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
						$prices = array();
						if (Bitrix\Main\Loader::includeModule("currency"))
						{
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
							}
							$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
						}
						else
						{
							$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
							for ($i = 0; $i < $step_num; $i++)
							{
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
                                                                                    <?$minPriceFilter = (int)$arItem["VALUES"]["MIN"]["VALUE"];
                                                                                    if ($_GET["catalogFilter_P3_MIN"])
                                                                                        $minPriceFilter = $_GET["catalogFilter_P3_MIN"];
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
                                                                                <?$maxPriceFilter = (int)$arItem["VALUES"]["MAX"]["VALUE"];
                                                                                    if ($_GET["catalogFilter_P3_MAX"])
                                                                                        $maxPriceFilter = $_GET["catalogFilter_P3_MAX"];
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
					<?endif;
				}
				?>

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

</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>