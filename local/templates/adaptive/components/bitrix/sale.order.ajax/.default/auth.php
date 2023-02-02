<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="status">
	<span class="name">Заказ</span>
	<span class="stat1">Этап 1</span>
	<span class="stat2 active">Этап 2</span>
	<span class="stat3">Этап 3</span>
</div>

<div class="login_register_page">


<div class="form_login">
	<div class="new_zag">Авторизация</div>
	<form method="post" action="" name="order_auth_form">

		<?=bitrix_sessid_post()?>

		<? foreach ($arResult["POST"] as $key => $value): ?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>">
		<? endforeach ?>

		<div class="item">
			<span>E-mail</span>
			<input type="text" name="USER_LOGIN" maxlength="30" size="30" value="<?=$arResult["AUTH"]["USER_LOGIN"]?>">
		</div>

		<div class="item">
			<span>Пароль</span>
			<input type="password" name="USER_PASSWORD" maxlength="30" size="30">
		</div>

		<div class="item">
			<span><a href="<?=$arParams["PATH_TO_AUTH"]?>?forgot_password=yes&back_url=<?= urlencode($APPLICATION->GetCurPageParam()); ?>" class="forgout_pass">Забыли пароль?</a></span>
			<?//<input type="button" class="button" value="Продолжить" >?>
			<input type="submit" class="button" value="Продолжить">
			<input type="hidden" name="do_authorize" value="Y">
		</div>
	</form>
</div>



	<div class="form_register">
		<div class="new_zag">Регистрация</div>

		<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
			<form method="post" action="" name="order_reg_form">
				<?=bitrix_sessid_post()?>
				<?
				foreach ($arResult["POST"] as $key => $value)
				{
				?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?
				}
				?>
				<input type="hidden" name="NEW_LOGIN" size="40" value="temp_login">
				<div class="item">
					<span>Имя<span class="red">*</span></span>
					<input type="text" name="NEW_NAME" size="40" value="<?=$arResult["AUTH"]["NEW_NAME"]?>">
				</div>
				<div class="item">
					<span>Фамилия<span class="red">*</span></span>
					<input type="text" name="NEW_LAST_NAME" size="40" value="<?=$arResult["AUTH"]["NEW_LAST_NAME"]?>">
				</div>
				<div class="item">
					<span>E-mail<span class="red">*</span></span>
					<input type="text" name="NEW_EMAIL" size="40" value="<?=$arResult["AUTH"]["NEW_EMAIL"]?>">
				</div>
				<div class="item">
					<span>Телефон<span class="red">*</span></span>
					<input type="text" name="NEW_PHONE" class="phone" size="40" value="<?=$_REQUEST['NEW_PHONE']?>">
				</div>
				<div class="item" style="display:none;">
					<input type="radio" id="NEW_GENERATE_N" name="NEW_GENERATE" value="N" OnClick="ChangeGenerate(false)" checked="checked"> <label for="NEW_GENERATE_N"><?echo GetMessage("STOF_MY_PASSWORD")?></label>
				</div>
				<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
					<div id="sof_choose_login">
				<?endif;?>
				<div class="item">
				<span>Пароль<span class="red">*</span></span>
					<input type="password" name="NEW_PASSWORD" size="30" class="<?if(in_array(GetMessage("STOF_ERROR_REG_FLAG1"), $arResult['ERROR'])) echo 'error';?>" value="<?=$arResult["AUTH"]["NEW_PASSWORD"]?>">
				</div>
				<div class="item">
					<span>Пароль еще раз<span class="red">*</span></span>
					<input type="password" name="NEW_PASSWORD_CONFIRM" size="30" class="<?if(in_array(GetMessage("STOF_ERROR_REG_PASS"), $arResult['ERROR'])) echo 'error';?>" value="<?=$arResult["AUTH"]["NEW_PASSWORD_CONFIRM"]?>">
				</div>
				<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
					</div>
				<?endif;?>

				<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
					<script language="JavaScript">
					<!--
					ChangeGenerate(false);
					//-->
					</script>
				<?endif;?>

				<?
				if($arResult["AUTH"]["captcha_registration"] == "Y") //CAPTCHA
				{
					?>
					<div class="item sm">
						<b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b>
						<br/><br/>
					</siv>
					<div class="item">
						<span>
							<input type="hidden" name="captcha_sid" value="<?=$arResult["AUTH"]["capCode"]?>">
						</span>
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["AUTH"]["capCode"]?>" width="180" height="40" alt="CAPTCHA">
					</div>
					<div class="item">
						<span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:<span class="red">*</span></span>
						<input type="text" name="captcha_word" size="30" maxlength="50" value="">
						<br/>
					</div>
					<?
				}
				?>

				<div class="item">
					<div class="checkboxes">
						<div class="check <?=($_REQUEST['privacy_policy'] == 'on' ? 'active' : '')?>">
							<input type="checkbox" id="polit" name="privacy_policy" <?=($_REQUEST['privacy_policy'] == 'on' ? 'checked="checked"' : '')?> >
							<label for="polit">Я принимаю условия <a href="#" class="privacy_policy_link">политики конфиденциальности</a></label>
						</div>
					</div>
					<div class="gray small privacy_policy_text">
						Настоящим я даю разрешение ИП Буря Павел Сергеевич (далее – «Штормавто») в целях заключения и исполнения договора купли-продажи обрабатывать - собирать, записывать, систематизировать, накапливать, хранить, уточнять (обновлять, изменять), извлекать, использовать, передавать (в том числе поручать обработку другим лицам), обезличивать, блокировать, удалять, уничтожать - мои персональные данные: фамилию, имя, номера домашнего и мобильного телефонов, адрес электронной почты. Также я разрешаю М.видео в целях информирования о товарах, работах, услугах осуществлять обработку вышеперечисленных персональных данных и направлять на указанный мною адрес электронной почты и/или на номер мобильного телефона рекламу и информацию о товарах, работах, услугах Штормавто и его партнеров. Согласие может быть отозвано мною в любой момент путем направления письменного уведомления по адресу Штормавто.
					</div>
				</div>

				<div class="item">
					<span></span>

					<input type="submit" class="button" value="Продолжить" >
					<input type="hidden" name="order_register" value="Y">
					<input type="hidden" name="do_register" value="Y">
				</div>
			</form>
			<div class="gray small">
				<?echo GetMessage("STOF_REQUIED_FIELDS_NOTE")?><br /><br />
				<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
					<?echo GetMessage("STOF_EMAIL_NOTE")?><br /><br />
				<?endif;?>
				<?echo GetMessage("STOF_PRIVATE_NOTES")?>
			</div>
		<?endif;?>
	</div>
</div>


