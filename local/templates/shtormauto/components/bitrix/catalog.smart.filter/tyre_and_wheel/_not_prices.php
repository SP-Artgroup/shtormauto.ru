<?
foreach ($arPropId[$tyreOrWheel] as $key) {	
	$arItem = $arResult["ITEMS"][ $key ];

	if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) {
		continue;
	}

	/*if (($tyreOrWheel == 'tyre' && $arItem["CODE"] == 'SHIRINA') || ($tyreOrWheel == 'wheel' && in_array($arItem["CODE"], ['DIAMETR', 'PCD'])) || ($tyreOrWheel == 'akkumulyatory' && $arItem["CODE"] == 'AKKUMULYATOR_DLINNA')) {
		/*  Обертка для 
				Шины:  ширина, профиль, диаметр
				Диски: диаметр, вылет
				Диски: крепеж
		
		?>
		<div class="form-group">
			<div class="filter-item__sizes">
		<?
	}*/
	?>
	<div class="bx-filter-parameters-box <?//=($arItem["CODE"] == "BREND")?'order-1 order-md-0':''?>">
		<span class="bx-filter-container-modef"></span>

		<div class="bx-filter-block" data-role="bx_filter_block">
			<div class="bx-filter-parameters-box-container">
			<?
			$arCur = current($arItem["VALUES"]);
			switch ($arItem["DISPLAY_TYPE"])
			{
				case "B"://NUMBERS?>
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
					<div class="bx-filter-select-container">
						<?/*?><label for="selectWidth" class="form-label"><?=$arItem["NAME"]?>:</label><?*/?>
						<div class="bx_filter_select_block d-block <?//d-sm-none d-md-none d-lg-none?> no-padding">
							<select name="<?=$arCur["CONTROL_NAME_ALT"]?>">
								<?if(strripos($arItem["NAME"], 'Ширина') !== false){
									$arItem["NAME"] = 'Ширина';
								}
								elseif(strripos($arItem["NAME"], 'Профиль') !== false){
									$arItem["NAME"] = 'Профиль';
								}
								elseif(strripos($arItem["NAME"], 'Диаметр') !== false){
									$arItem["NAME"] = 'Диаметр';
								}
								elseif(strripos($arItem["NAME"], 'Высота') !== false){
									$arItem["NAME"] = 'Высота';
								}
								elseif(strripos($arItem["NAME"], 'Бренд') !== false){
									$arItem["NAME"] = 'Производитель';
								}?>
								<?$arItem["NAME"] = str_replace('легкового диска', "", $arItem["NAME"]);
								$arItem["NAME"] = str_replace('Аккумулятор ', "", $arItem["NAME"]);?>
								<option><?=$arItem["NAME"]?></option>

								<?if ($arItem["CODE"] != 'SEZONNOST'): ?>
									<option>Все</option>
								<?endif ?> 

								<?foreach ($arItem["VALUES"] as $val => $ar):
										$class = "";
										if ($ar["CHECKED"])
											$class.= " selected";
								?>

									<option value="<?=$ar["HTML_VALUE_ALT"] ?>" <?=$class?>><?=$ar["VALUE"]?></option>
								<?endforeach?>  

								<?php if ($arItem["CODE"] == 'SEZONNOST'): ?>
									<option>Все</option>
								<?php endif ?>
								
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
					<div class="bx-filter-checkbox-container">
						<?/*?><label for="selectWidth" class="form-label"><?=$arItem["NAME"]?>:</label><?*/?>
						<div class="bx_filter_checkbox_block d-block no-padding">
							<?if(strripos($arItem["NAME"], 'Ширина') !== false){
								$arItem["NAME"] = 'Ширина';
							}
							elseif(strripos($arItem["NAME"], 'Профиль') !== false){
								$arItem["NAME"] = 'Профиль';
							}
							elseif(strripos($arItem["NAME"], 'Диаметр') !== false){
								$arItem["NAME"] = 'Диаметр';
							}
							elseif(strripos($arItem["NAME"], 'Высота') !== false){
								$arItem["NAME"] = 'Высота';
							}
							elseif(strripos($arItem["NAME"], 'Бренд') !== false){
								$arItem["NAME"] = 'Производитель';
							}?>			
							<?$arItem["NAME"] = str_replace('легкового диска', "", $arItem["NAME"]);
							$arItem["NAME"] = str_replace('Аккумулятор ', "", $arItem["NAME"]);?>				
							<span class="selected"><?=$arItem["NAME"]?></span>
							<div style="display:none">
								<?foreach($arItem["VALUES"] as $val => $ar):?>
									<input
											type="checkbox"
											value="<? echo $ar["HTML_VALUE"] ?>"
											name="<? echo $ar["CONTROL_NAME"] ?>"
											id="<? echo $ar["CONTROL_ID"] ?>"
											<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											onclick="smartFilter.click(this)"
										/>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx-filter-input-checkbox">
											
											<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?>
												<? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
													?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)
												<? endif;?>
											</span>
										</span>
									</label>
								<?endforeach;?>
							</div>    
						</div>
					</div>    
			<?
			} // switch
			?>
			</div>
		</div>
	</div>
	<?
	/*if (($tyreOrWheel == 'tyre' && $arItem["CODE"] == 'DIAMETR')
		|| ($tyreOrWheel == 'wheel' && in_array($arItem["CODE"], ['VYLET_LEGKOVOGO_DISKA_ET', 'SHIRINA_LEGKOVOGO_DISKA']))
		 || ($tyreOrWheel == 'akkumulyatory' && $arItem["CODE"] == 'AKKUMULYATOR_VYSOTA')
	) {
		// Обертка
		?>
			</div>
		</div>
		<?
	}*/
	?>
<?
} // foreach
