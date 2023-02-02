<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	global $APPLICATION;
?>
<?if($arResult["FORM_TYPE"] == "login"):?>
	<div class="top_login">
		<a href="javascript: document.location.href = '/personal/'">Вход</a> <span class="hidmobile">|</span> <a href="javascript: document.location.href = '/personal/registration/'">Регистрация</a>
	</div>
<?
elseif($arResult["FORM_TYPE"] == "logout"):
?>
<div class="top_login" style="margin-top:-20px;text-align:center;">
	<!-- <span class="hidmobile">|</span> -->
	
	<?=$arResult["USER_NAME"]?><br />
	<span class="hidmobile">[<?=$arResult["USER_LOGIN"]?>]<br /></span>
	<a href="javascript: document.location.href = '/personal/'" title="<?=GetMessage("AUTH_PROFILE")?>" style="color:#db4b40;"><?=GetMessage("AUTH_PROFILE")?></a>
	<br class="hidmobile" />
	<a href="javascript: document.location.href = '<?echo $APPLICATION->GetCurPageParam("logout=yes", array(
     "login",
     "logout",
     "register",
     "forgot_password",
     "change_password"));?>'">Выход</a>
</div>

<?endif;?>