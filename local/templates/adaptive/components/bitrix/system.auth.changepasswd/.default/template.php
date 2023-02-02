<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="login_register_page">
	<div class="form_login">
		<div class="new_zag">Восстановление пароля</div>
		<div class="item">
			<?//=dump($arParams["~AUTH_RESULT"], false)?>
			<? ShowMessage($arParams["~AUTH_RESULT"]); ?>
			<?//$arParams["~AUTH_RESULT"]['TYPE'] = 'OK';
				if($arParams["~AUTH_RESULT"]['TYPE'] == 'OK')
				{
					?>
					<script>
						setTimeout(function(){document.location.href = '/personal'}, 1000);
					</script>
					<?
				}
			?>
		</div>
		<form class="block_item_item" method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
			<?if (strlen($arResult["BACKURL"]) > 0): ?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<? endif ?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="CHANGE_PWD">
			<div class="item">
				<b><?=GetMessage("AUTH_CHANGE_PASSWORD")?></b>
			</div>
			<div class="item">
				<span>Email<span class="red">*</span></span>
				<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="bx-auth-input" />
			</div>
			<div class="item">
				<span><?=GetMessage("AUTH_CHECKWORD")?><span class="red">*</span></span>
				<input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="bx-auth-input" />
			</div>
			<div class="item">
				<span><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?><span class="red">*</span></span>
				<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
			</div>
			<div class="item">
				<span><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?><span class="red">*</span></span>
				<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
			</div>
			<div class="item">
				<span></span>
				<input type="submit" name="change_pwd" class="button" value="<?=GetMessage("AUTH_CHANGE")?>" />
			</div>
			<div class="item">
				<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
				<p><span class="red">*</span> <?=GetMessage("AUTH_REQ")?></p>
				<p>
					<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
				</p>
			</div>
		</form>		
	</div>
</div>