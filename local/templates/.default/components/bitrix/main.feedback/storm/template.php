<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>
<div class="feedback-title">Обратная связь</div>
<div style="clear: both;"></div>
<form action="<?=$APPLICATION->GetCurPage()?>" method="POST">
<?=bitrix_sessid_post()?>
	<div class="mf-name">
		<input type="text" name="user_name" <?=(!$arResult["AUTHOR_NAME"])?"class='default'":""?> value="<?=($arResult["AUTHOR_NAME"])?$arResult["AUTHOR_NAME"]:GetMessage("MFT_NAME")?>">
	</div>
    <div style="clear: both;"></div>
	<div class="mf-email">
		<input type="text" name="user_email" <?=(!$arResult["AUTHOR_EMAIL"])?"class='default'":""?> value="<?=($arResult["AUTHOR_EMAIL"])?$arResult["AUTHOR_EMAIL"]:GetMessage("MFT_EMAIL")?>">
	</div>
    <div style="clear: both;"></div>
	<div class="mf-message">
		<textarea name="MESSAGE" <?=(!$arResult["MESSAGE"])?"class='default'":""?>><?=($arResult["MESSAGE"])?$arResult["MESSAGE"]:GetMessage("MFT_MESSAGE")?></textarea>
	</div>
	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
    <div style="clear: both;"></div>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" class="submit" value="">
</form>
</div>