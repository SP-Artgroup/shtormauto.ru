<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();?>

<header class="modal__header">
	<h2 class="modal__title">Регистрация</h2>
	<button class="modal__close" aria-label="Close modal" ><i class="icon i-close" data-micromodal-close></i></button>
</header>
<?if($USER->IsAuthorized()):?>
	<p class="reg_success"><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<?else:?>
	<div class="reg_error">
		<? if (count($arResult["ERRORS"]) > 0):
			foreach ($arResult["ERRORS"] as $key => $error)
				if (intval($key) == 0 && $key !== 0) 
					$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

			ShowError(implode("<br />", $arResult["ERRORS"]));

		elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
			<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
		<?endif?>
	</div>	
	<div class="modal__content">
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="form-container" id="form-registration" name="regform" enctype="multipart/form-data">
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif;?>	
			<input type="hidden" name="register" value="yes" />

			<?foreach ($arParams["SHOW_FIELDS"] as $key => $FIELD):?>
				<? $placeholder = "";
				$mask = "";
				switch ($FIELD){
				    case "PERSONAL_MOBILE": 
				        $placeholder = 'placeholder="+7 900 000 00 00"';
				        $mask = 'data-masked="+7 (999) 999-99-99"';
				        break;
				    case "NAME": 
				        $placeholder = 'placeholder="Иван"';
				        break;
				    case "EMAIL": 
				        $placeholder = 'placeholder="your@email.com"';
				        break;
				    case "LAST_NAME": 
				        $placeholder = 'placeholder="Иванов"';
				        break;  
				    case "CONFIRM_PASSWORD": case "PASSWORD":    
				        $placeholder = '•••••••••';
				        break;
				}?>
				<div class="form-group <?=($FIELD == "LOGIN")?'hide':''?>">
					<? if($FIELD != "LOGIN"):?>
						<label for="REGISTER[<?=$FIELD?>]" class="form-label"><?=GetMessage("REGISTER_FIELD_".$FIELD)?><?=(in_array($FIELD, $arResult['REQUIRED_FIELDS']))?'<span class="starrequired">*</span>':''?></label>
					<? endif;?>	
					<? switch ($FIELD){
						case "LOGIN":?>
							<input type="hidden" name="REGISTER[LOGIN]" value="temp_login"><?
							break;

						case "PASSWORD":?>
							<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" id="REGISTER[<?=$FIELD?>]" class="form-input" value="<?=$arResult["VALUES"][$FIELD]?>" required="required" autocomplete="off" class="bx-auth-input" <?=$placeholder;?>/><?
							break;
							
						case "CONFIRM_PASSWORD":?>
							<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-input" required="required" autocomplete="off" <?=$placeholder;?> /><?
							break;
				
						case "PERSONAL_GENDER":?>
							<select name="REGISTER[<?=$FIELD?>]">
								<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
								<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
								<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
							</select><?
							break;
				
						case "PERSONAL_COUNTRY":
						case "WORK_COUNTRY":?>
							<select name="REGISTER[<?=$FIELD?>]"><?
							foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
							{
								?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
							<?
							}
							?></select><?
							break;
				
						case "PERSONAL_PHOTO":
						case "WORK_LOGO":?>
							<input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" class="form-input" /><?
							break;
				
						case "PERSONAL_NOTES":
						case "WORK_NOTES":?>
							<textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
							break;
						default:
							if ($FIELD == "PERSONAL_BIRTHDAY"):?>
							<small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
							?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" class="form-input" value="<?=$arResult["VALUES"][$FIELD]?>" <?=($FIELD == 'PERSONAL_MOBILE' ? 'class="phone"' : '')?> <?=$placeholder;?> <?=$mask;?> <?=(in_array($FIELD, $arResult['REQUIRED_FIELDS']))?'required="required"':''?> /><?
								if ($FIELD == "PERSONAL_BIRTHDAY")
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'SHOW_INPUT' => 'N',
											'FORM_NAME' => 'regform',
											'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
											'SHOW_TIME' => 'N'
										),
										null,
										array("HIDE_ICONS"=>"Y")
									);
								?><?
					}?>
				</div>
			<?endforeach?>
			<?// ********************* User properties ***************************************************?>
			<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
				<tr><td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
				<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
				<tr><td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></td><td>
						<?$APPLICATION->IncludeComponent(
							"bitrix:system.field.edit",
							$arUserField["USER_TYPE"]["USER_TYPE_ID"],
							array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
				<?endforeach;?>
			<?endif;?>
			<?// ******************** /User properties ***************************************************?>
			<?
			/* CAPTCHA */
			if ($arResult["USE_CAPTCHA"] == "Y"){?>
				<div class="form-group captcha-group">
					<?/*<b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b>*/?>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<label class="form-label"><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></label>
					<div style="display:flex; justify-content: space-between;">
						<input type="text" name="captcha_word" maxlength="50" value="" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="150" height="40" alt="CAPTCHA" />
					</div>	
				</div>	
			<? } /* !CAPTCHA */ ?>
			<div class="modal-auth__buttons">
				<input type="submit" class="btn btn-scarlet" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />
			</div>
		</form>
	</div>	
<?endif?>
