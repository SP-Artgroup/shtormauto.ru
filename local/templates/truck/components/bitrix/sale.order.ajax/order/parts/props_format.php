<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!function_exists("PrintPropsForm"))
{
	function PrintPropsForm($arSource = array(), $locationTemplate = ".default")
	{
		if (!empty($arSource)) {
			foreach ($arSource as $arProperties)
			{
				if($arProperties['CODE'] == 'SHOP')
					continue;

				if($arProperties['CODE'] == 'CITY')
					continue;

				if($arProperties['CODE'] == 'BONUS_CARD_NUMBER')
					continue;

				if($arProperties['CODE'] == 'OTHER_CITY')
					continue;

				if ($arProperties["TYPE"] == "CHECKBOX")
				{
					?>
					<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">

					<div class="bx_block r1x3 pt8">
						<?=$arProperties["NAME"]?>
						<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
							<span class="bx_sof_req">*</span>
						<?endif;?>
					</div>

					<div class="bx_block r1x3 pt8">
						<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>

						<?
						if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
						?>
						<div class="bx_description">
							<?=$arProperties["DESCRIPTION"]?>
						</div>
						<?
						endif;
						?>
					</div>

					<div style="clear: both;"></div>
					<?
				}
				elseif ($arProperties["TYPE"] == "TEXT")
				{
					if ($arProperties['CODE'] == 'PHONE')
					{
						if (empty($arProperties["VALUE"]))
						{
							$user = $GLOBALS['USER']->GetByID($GLOBALS['USER']->GetID())->Fetch();
							if (!empty($user['PERSONAL_MOBILE']))
								$arProperties["VALUE"] = $user['PERSONAL_MOBILE'];
						}
					}

					$name = $arProperties["NAME"] . (
						$arProperties["REQUIED_FORMATED"] == "Y"
						? ' *'
						: ''
					);
					?>

					<?php if ($arProperties['CODE'] === 'DELIVERY_DATE'): ?>

						<div class="input input-group date datetimepicker-group">
		                    <input
		                    	type="text"
		                    	maxlength="250"
		                    	size="<?=$arProperties["SIZE1"]?>"
		                    	value="<?=$arProperties["VALUE"]?>"
		                    	name="<?=$arProperties["FIELD_NAME"]?>"
		                    	id="<?=$arProperties["FIELD_NAME"]?>"
		                    	placeholder="<?= $name ?>"
		                    >
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>

					<?php else: ?>

						<p class="input">
							<input
								type="text"
								maxlength="250"
								size="<?=$arProperties["SIZE1"]?>"
								value="<?=$arProperties["VALUE"]?>"
								name="<?=$arProperties["FIELD_NAME"]?>"
								id="<?=$arProperties["FIELD_NAME"]?>"
								placeholder="<?= $name ?>"
							>
							<?php if ($arProperties['ICON']): ?>
								<img src="<?= $arProperties['ICON'] ?>" alt="">
							<?php endif ?>
						</p>

					<?php endif ?>

					<?
				}
				elseif ($arProperties["TYPE"] == "SELECT")
				{
					?>
					<br/>
					<div class="bx_block r1x3 pt8">
						<?=$arProperties["NAME"]?>
						<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
							<span class="bx_sof_req">*</span>
						<?endif;?>
					</div>

					<div class="bx_block r3x1">
						<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants):
							?>
								<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
							endforeach;
							?>
						</select>

						<?
						if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
						?>
						<div class="bx_description">
							<?=$arProperties["DESCRIPTION"]?>
						</div>
						<?
						endif;
						?>
					</div>
					<div style="clear: both;"></div>
					<?
				}
				elseif ($arProperties["TYPE"] == "MULTISELECT")
				{
					?>
					<br/>
					<div class="bx_block r1x3 pt8">
						<?=$arProperties["NAME"]?>
						<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
							<span class="bx_sof_req">*</span>
						<?endif;?>
					</div>

					<div class="bx_block r3x1">
						<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants):
							?>
								<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
							endforeach;
							?>
						</select>

						<?
						if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
						?>
						<div class="bx_description">
							<?=$arProperties["DESCRIPTION"]?>
						</div>
						<?
						endif;
						?>
					</div>
					<div style="clear: both;"></div>
					<?
				}
				elseif ($arProperties["TYPE"] == "TEXTAREA")
				{
					$rows = ($arProperties["SIZE2"] > 10) ? 4 : $arProperties["SIZE2"];

					$name = $arProperties["NAME"] . (
						$arProperties["REQUIED_FORMATED"] == "Y"
						? ' *'
						: ''
					);
					?>

					<p class="textarea">
						<textarea
							rows="<?=$rows?>"
							cols="<?=$arProperties["SIZE1"]?>"
							name="<?=$arProperties["FIELD_NAME"]?>"
							id="<?=$arProperties["FIELD_NAME"]?>"
							placeholder="<?= $name ?>"
						><?=$arProperties["VALUE"]?></textarea>

						<?php if ($arProperties['ICON']): ?>
							<img src="<?= $arProperties['ICON'] ?>" alt="">
						<?php endif ?>
					</p>
					<?
				}
				elseif ($arProperties["TYPE"] == "RADIO")
				{
					?>
					<div class="bx_block r1x3 pt8">
						<?=$arProperties["NAME"]?>
						<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
							<span class="bx_sof_req">*</span>
						<?endif;?>
					</div>

					<div class="bx_block r3x1">
						<?
						if (is_array($arProperties["VARIANTS"]))
						{
							foreach($arProperties["VARIANTS"] as $arVariants):
							?>
								<input
									type="radio"
									name="<?=$arProperties["FIELD_NAME"]?>"
									id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
									value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

								<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
							<?
							endforeach;
						}
						?>

						<?
						if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
						?>
						<div class="bx_description">
							<?=$arProperties["DESCRIPTION"]?>
						</div>
						<?
						endif;
						?>
					</div>
					<div style="clear: both;"></div>
					<?
				}
				?>

				<?if(CSaleLocation::isLocationProEnabled()):?>

					<?
					$propertyAttributes = array(
						'type' => $arProperties["TYPE"],
						'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form' // value taken from property DEFAULT_VALUE or it`s a user-typed value?
					);

					if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
						$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

					if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
						$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

					if($arProperties['IS_ZIP'] == 'Y')
						$propertyAttributes['isZip'] = true;
					?>

					<script>

						<?// add property info to have client-side control on it?>
						(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
							'id' => intval($arProperties["ID"]),
							'attributes' => $propertyAttributes
						))?>);

					</script>
				<?endif?>

				<?
			}

		}
	}
}
?>