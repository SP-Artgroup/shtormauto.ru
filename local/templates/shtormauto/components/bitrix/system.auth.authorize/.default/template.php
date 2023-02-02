<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>
<div class="login_register_page">


	<div class="form_login">
	<div class="new_zag">Авторизация</div>
		<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<?if (strlen($arResult["BACKURL"]) > 0):?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<?foreach ($arResult["POST"] as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
	
			<div class="item">
				<span>E-mail</span>
				<input class="bx-auth-input" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
			</div>
			<div class="item">
				<span>Пароль</span>
				<input class="bx-auth-input" type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
			</div>
			<?if($arResult["CAPTCHA_CODE"]):?>
				<div class="item">
					<span></span>
					<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
				</div>
				<div class="item">
					<span><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</span>
					<input class="bx-auth-input" type="text" name="captcha_word" maxlength="50" value="" size="15" />
				</div>
			<?endif;?>
			
			<div class="item">
				<span>
					<noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow" class="forgout_pass"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex>
				</span>
				<?//<input type="button" class="button" value="Продолжить" >?>
				<input type="submit" name="Login" class="button" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
			</div>
			<div class="item">
				<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
					<noindex>
						<p>
							<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
							<?=GetMessage("AUTH_FIRST_ONE")?>
						</p>
					</noindex>
				<?endif?>
			</div>
		</form>
	</div>



</div>
