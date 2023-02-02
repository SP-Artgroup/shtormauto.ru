<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="new_zag">Личный кабинет</div>
<div class="login_register_page">
	<div class="personal_area_">
		<ul class="personal_area_menu">
			<li><a href="/personal/order/">Мои заказы</a></li>
			<?//<li rel='2'>Бронирование</li>?>
			<li class="active"><a href="/personal/profile/">Личные данные</a></li>
		</ul>
		<div style="clear:both"></div>

		<h2>Изменения регистрационных данных</h2>
		<?ShowError($arResult["strProfileError"]);?>
		<?
		if ($arResult['DATA_SAVED'] == 'Y')
			ShowNote(GetMessage('PROFILE_DATA_SAVED'));
		?>
		<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
			<input type="hidden" name="edit_profile" value="<?=LANG?>" />
			<div class="item">
				<span><?=GetMessage('NAME')?><span class="red">*</span></span>
				<input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
			</div>
			<div class="item">
				<span><?=GetMessage('LAST_NAME')?><span class="red">*</span></span>
				<input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
			</div>
			<div class="item">
				<span><?=GetMessage('USER_MOBILE')?><span class="red">*</span></span>
				<input type="text" name="PERSONAL_MOBILE" maxlength="255" class="phone" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" />
			</div>
			<div class="item">
				<span><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="red">*</span><?endif?></span>
				<input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
			</div>
			<div class="item">
				<span><?=GetMessage('NEW_PASSWORD_REQ')?></span>
				<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
			</div>
			<div class="item">
				<span>Ещё раз:</span>
				<input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
			</div>
			<div class="item">
				<span></span>
				<input class="button" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
			</div>
			<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
	<p></p>
		</form>
	</div>
<div>