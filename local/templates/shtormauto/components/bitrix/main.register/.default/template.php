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
//dump($_REQUEST, false);
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
	
	$arResult["SHOW_FIELDS"]	= array(
		'LOGIN', 'NAME', 'LAST_NAME', 'EMAIL', 'PERSONAL_MOBILE', 'PASSWORD', 'CONFIRM_PASSWORD'
	);

?>

<div class="login_register_page">
	<div class="form_register">
		<?if($USER->IsAuthorized()):?>
			<div class="new_zag"><?echo GetMessage("MAIN_REGISTER_AUTH")?></div>
			<ul>
				<li>Перейти <a href="/personal/">в личный кабинет.</a></li>
			</ul>
		<?else:?>
			<div class="new_zag">Регистрация</div>
			<?
			if (count($arResult["ERRORS"]) > 0)
			{
				foreach ($arResult["ERRORS"] as $key => $error)
					if (intval($key) == 0 && $key !== 0) 
						$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
			
				ShowError(implode("<br />", $arResult["ERRORS"]));
			}
			elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y")
			{ 
			?>
				<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
			<?
			}
			?>
			<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
				<? if($arResult["BACKURL"] != '') { ?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<? } ?>
				<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
					<? if($FIELD == 'LOGIN') { ?>
						<input type="hidden" name="REGISTER[LOGIN]" value="temp_login">
					<? continue; } ?>
					<div class="item">
						<span><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="red">*</span><?endif?></span>
						<?
						switch ($FIELD)
						{
							case "PASSWORD":
								?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" /><?
								break;
								
							case "CONFIRM_PASSWORD":
								?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
								break;
					
							case "PERSONAL_GENDER":
								?><select name="REGISTER[<?=$FIELD?>]">
									<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
									<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
									<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
								</select><?
								break;
					
							case "PERSONAL_COUNTRY":
							case "WORK_COUNTRY":
								?><select name="REGISTER[<?=$FIELD?>]"><?
								foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
								{
									?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
								<?
								}
								?></select><?
								break;
					
							case "PERSONAL_PHOTO":
							case "WORK_LOGO":
								?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
								break;
					
							case "PERSONAL_NOTES":
							case "WORK_NOTES":
								?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
								break;
							default:
								if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
								?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" <?=($FIELD == 'PERSONAL_MOBILE' ? 'class="phone"' : '')?> /><?
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
				<?if ($arResult["USE_CAPTCHA"] == "Y") { // CAPTCHA ?>
					<div class="item sm">
						<b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b>
						<br/><br/>
					</siv>
					<div class="item">					
						<span>
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						</span>
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</div>
					<div class="item">
						<span><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="red">*</span></span>
						<input type="text" name="captcha_word" maxlength="50" value="" />
						<br/>
					</div>
				<?} //CAPTCHA?>		
				<div class="item">
					<div class="checkboxes"><?=$_REQUEST['privacy_policy']?>
						<div class="privacy_policy_error">Вы должны принять условия политики конфиденциальности!</div>
						<div class="check <?=($_REQUEST['privacy_policy'] == 'on' ? 'active' : '')?>">
							<input type="checkbox" id="polit" name="privacy_policy" <?=($_REQUEST['privacy_policy'] == 'on' ? 'checked="checked"' : '')?>>
							<label for="polit">Я принимаю условия <a href="#" class="privacy_policy_link">политики конфиденциальности</a></label>
						</div>
					</div>
					<div class="gray small privacy_policy_text">
						Настоящим я даю разрешение ИП Буря Павел Сергеевич (далее – «Штормавто») в целях заключения и исполнения договора купли-продажи обрабатывать - собирать, записывать, систематизировать, накапливать, хранить, уточнять (обновлять, изменять), извлекать, использовать, передавать (в том числе поручать обработку другим лицам), обезличивать, блокировать, удалять, уничтожать - мои персональные данные: фамилию, имя, номера домашнего и мобильного телефонов, адрес электронной почты. Также я разрешаю М.видео в целях информирования о товарах, работах, услугах осуществлять обработку вышеперечисленных персональных данных и направлять на указанный мною адрес электронной почты и/или на номер мобильного телефона рекламу и информацию о товарах, работах, услугах Штормавто и его партнеров. Согласие может быть отозвано мною в любой момент путем направления письменного уведомления по адресу Штормавто.
					</div>
				</div>
				<?/*
<div class="item">
					<div class="checkboxes">
						<div class="check">
							<input type="checkbox" id="rass" ><label for="rass">Подписаться на рассылку</label>
						</div>
					</div>
				</div>
*/?>
				<div class="item">
					<span></span>
					<input type="hidden" name="main_register_form" value="Y" />
					<input type="submit" class="button" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />
				</div>
				<div class="item" style="color:#666;">
					<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
				</div>
				<div class="item" style="color:#666;">
					<?=GetMessage("AUTH_REQ")?><span class="red">*</span>
				</div>	
				<a href="/personal/" rel="nofollow"><b>Авторизация</b></a>
			</form>
		<?endif;?>
	</div>
</div>
<div class="clear"></div>