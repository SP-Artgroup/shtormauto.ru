<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["isFormTitle"])
{
?>
    <header class="header-content">
      <h1 class="header-content__heading"><?=$arResult["FORM_TITLE"]?></h1>
    </header>
<?
} //endif ;

if ($arResult["isFormNote"] != "Y")
{?>
<?=$arResult["FORM_HEADER"]?>
    <div class="content-form-body content-form-body--entry-form">
        <div class="content-form content-form--margin-bottom-69 form-container">
            <div class="row">
	<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{               $req = "";
                                if($arQuestion["REQUIRED"]=="Y"){
                                    $req = "required";
                                }
				if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
                                
                                <div class="<?if ($FIELD_SID=='SIMPLE_QUESTION_610'){?> col-12 <?}else{?> col-sm-6 <?}?>">
                                  <div class="form-group">
                                    <?switch($FIELD_SID){
                                        //Имя
                                        case "SIMPLE_QUESTION_827": 
                                        ?>
                                        <input type="text" class="form-input" name="form_text_11" value="" <?=$req?> placeholder="Имя">
                                        <?
                                        break;
                                        //Город
                                        case "SIMPLE_QUESTION_883": ?>
                                        <input type="text" class="form-input" name="form_text_12" value="" <?=$req?> size="0" placeholder="Город">
                                        <?
                                        break;
                                        //Телефон
                                        case "SIMPLE_QUESTION_832": ?>
                                        <input type="text" class="form-input" name="form_text_13" value="" <?=$req?> data-masked="+7 (999) 999-99-99" placeholder="+7 (999) 999-99-99">
                                        <?
                                        break;
                                        //Почта
                                        case "SIMPLE_QUESTION_382": ?>
                                        <input type="text" class="form-input" name="form_text_14" value="" <?=$req?> placeholder="your@email.co">
                                        <?
                                        break;
                                        //Сообщение
                                        case "SIMPLE_QUESTION_610": ?>
                                        <textarea name="form_textarea_15" cols="40" rows="5" class="form-input" <?=$req?>  placeholder="Расскажите нам о возникших вопросах, мы обязательно свяжемся с вами"></textarea>
                                        <?
                                        break;
                                        default: echo $arQuestion["HTML_CODE"];
                                    };?>  
                                    <label for="feedbackFirstName" class="form-label"><?=$arQuestion["CAPTION"]?></label>
                                  </div>
                                </div>                                
               <?} 
        }       
        if($arResult["isUseCaptcha"] == "Y")
        {
        ?>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="210" height="64" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
             
                <input type="text" name="captcha_word" size="30" maxlength="50" <?=$req?> value="" class="form-input" />
                <label for="feedbackCaptcha" class="form-label"><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE2")?></label>
            </div>
        </div>            
        <?
        } // isUseCaptcha
        ?> 
        </div>
      </div>        
        <div class="d-flex justify-content-center">
	    <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="btn btn-dark content-form-body__button"/>
        </div>
    </div>
 <?=$arResult["FORM_FOOTER"]?> 
 <?}?>