<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if($arResult["MESSAGE"]):?>
	<p class="notetext"><?echo $arResult["MESSAGE"]?></p>
<?endif?>

<?if(count($arResult["ERRORS"]) > 0):?>

	<?foreach($arResult["ERRORS"] as $strError):?>
		<p class="errortext"><?echo $strError?></p>
	<?endforeach?>

<?elseif(count($arResult["RUBRICS"]) <= 0):?>

	<p class="errortext"><?echo GetMessage("CT_BSS_NO_RUBRICS_FOUND")?></p>

<?else:?>

	<form method="POST" action="<?echo $arResult["FORM_ACTION"]?>">
	<table class="data-table">
	<tbody>
		<tr>
			<td>
			<?foreach($arResult["RUBRICS"] as $arRubric):?>
				<input name="RUB_ID[]" value="<?echo $arRubric["ID"]?>" id="RUB_<?echo $arRubric["ID"]?>" type="checkbox" <?if($arRubric["CHECKED"]) echo "checked";?>><label for="RUB_<?echo $arRubric["ID"]?>"><?echo $arRubric["NAME"]?></label><br>
			<?endforeach?>
        	<br>
			<input name="FORMAT" value="text" id="FORMAT_text" type="radio" <?if($arResult["FORMAT"] === "text") echo "checked";?>><label for="FORMAT_text"><?echo GetMessage("CT_BSS_TEXT")?></label>
			&nbsp;/&nbsp;
			<input name="FORMAT" value="html" id="FORMAT_html" type="radio" <?if($arResult["FORMAT"] === "html") echo "checked";?>><label for="FORMAT_html"><?echo GetMessage("CT_BSS_HTML")?></label>
			</td>
		</tr>
	</tbody>
    <tfoot>
		<tr>
			<td>
				<?echo bitrix_sessid_post();?>
				<input type="submit" name="Update" value="<?echo GetMessage("CT_BSS_FORM_BUTTON")?>">
			</td>
		</tr>
	</tfoot>
	</table>
	</form>

<?endif?>
