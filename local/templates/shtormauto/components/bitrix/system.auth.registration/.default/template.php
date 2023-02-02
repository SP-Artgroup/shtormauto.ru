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
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="login_register_page">
	<div class="form_register">
		<div class="new_zag">Регистрация</div>
		<div class="reg_error"><? ShowMessage($arParams["~AUTH_RESULT"]);?></div>
		<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
			<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
		<?else:?>
			<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
				<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
			<?endif?>
			<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
				<input type="text" name="captcha" class="captcha" value="" style="display:none" autocomplete="off" readonly="" onfocus="this.removeAttribute('readonly');">
				<? if (strlen($arResult["BACKURL"]) > 0){?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<?}?>
				<input type="hidden" name="AUTH_FORM" value="Y" />
				<input type="hidden" name="TYPE" value="REGISTRATION" />
				<input type="hidden" name="USER_LOGIN" value="temp_login" />
				<input type="hidden" name="main_register_form" value="Y" />	
				<div class="item">
					<span><?=GetMessage("AUTH_NAME")?><span class="red">*</span></span>
					<input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="bx-auth-input" required="required" />
				</div>
				<div class="item">
					<span><?=GetMessage("AUTH_LAST_NAME")?></span>
					<input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="bx-auth-input" />
				</div>
				
				<div class="item">
					<span><?=GetMessage("AUTH_EMAIL")?><?if($arResult["EMAIL_REQUIRED"]):?><span class="red">*</span><?endif?></span>
					<input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" required="required" />
				</div>
				<div class="item">
					<span>Телефон:<span class="red">*</span></span>
					<input type="text" value="PERSONAL_MOBILE" data-masked="+7 (999) 999-99-99" required="required" />
				</div>
							
				<div class="item">
					<span>Пароль:<span class="red">*</span></span>
					<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" required="required"/>
				</div>
				<div class="item">
					<span>Еще раз:<span class="red">*</span></span>
					<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" required="required"/>
				</div>

				<?// ********************* User properties ***************************************************?>
				<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
					<div class="item">
						<span><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></span>
					</div>
					<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
						<div class="item">
							<span>
								<?=$arUserField["EDIT_FORM_LABEL"]?><?if ($arUserField["MANDATORY"]=="Y"):?><span class="red">*</span><?endif;?>
							</span>
							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.edit",
								$arUserField["USER_TYPE"]["USER_TYPE_ID"],
								array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
						</div>
					<?endforeach;?>
				<?endif;?>
				<?// ******************** /User properties ***************************************************

					/* CAPTCHA */
					if ($arResult["USE_CAPTCHA"] == "Y"){?>
						<div class="item captcha-group">
							<?/*<div class="item sm"><span class=""><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></span></div>*/?>
							<span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:<span class="red">*</span></span>
							<div style="display:flex; justify-content: space-between;">					
								<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
								<input type="text" name="captcha_word" maxlength="50" value="" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
							</div>	
						</div>	
					<? }	/* CAPTCHA */
					?>
					<div class="item">
						<div class="checkboxes">
							<div class="check">
								<input type="checkbox" name="privacy_policy" id="polit" >
								<label for="polit">Я принимаю условия <a href="/">политики конфиденциальности</a></label>
							</div>
						</div>
					</div>
					<input type="submit" name="Register" value="Продолжить" />
			</form>
			<script type="text/javascript">
			document.bform.USER_NAME.focus();
			</script>
		<?endif?>
	</div>	
</div>