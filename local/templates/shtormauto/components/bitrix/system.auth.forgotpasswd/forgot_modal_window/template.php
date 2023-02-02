<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
die();
}

/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
*/

?>

<?
if(!empty($arParams["~AUTH_RESULT"])):
$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
<div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
<?endif?>


<form name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>" class="form-container content-form forgot-passwd">
                        <input type="hidden" name="AJAX-ACTION" value="FORGOT"/>
    <hr>            
    <?if($arResult["BACKURL"] <> ''):?>
    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
    <?endif?>
    <input type="hidden" name="AUTH_FORM" value="Y">
    <input type="hidden" name="TYPE" value="SEND_PWD">
    <div class="error_forgot_form"></div>
    <div class="form-group">
        <input type="text" name="USER_LOGIN" class="form-input" placeholder="your@email.co" value="<?= $arResult["LAST_LOGIN"] ?>" />
        <input type="hidden" name="USER_EMAIL" />                                                            
        <label for="authLogin" class="form-label">Почта</label>
        <div class="form-note">Укажите вашу почту и мы вышлем вам ссылку
            для сброса пароля</div>
    </div>
    <div class="modal-auth__buttons forgot-passwd-btn">
        <input type="submit" class="btn btn-dark" name="send_account_info" value="<?= GetMessage("AUTH_SEND") ?>" />
    </div>
</form>
<hr>  

<script type="text/javascript">
    document.bform.onsubmit = function () {
        document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;
    };
    //document.bform.USER_LOGIN.focus();
    $('.forgot-passwd').submit(function (e) {
        e.preventDefault();
        $.post('/personal/?forgot_password=yes', $('.forgot-passwd').serialize(), function (response) {
            console.log(response);
             if (response && response.STATUS) {
                if (response.STATUS == 'OK') {
                    if (response.FORM == 'FORGOT') {
                        $('.error_forgot_form').empty();
                       $('.forgot-passwd').empty();
                       $('.forgot-passwd-btn').css('display', 'none');
                       $('.forgot-passwd').css('color', 'green');
                       $('.forgot-passwd').css('padding-top', '25px');
                       $('.forgot-passwd').html(response.MESSAGES);
                    } 
                } else {
                    $('.error_forgot_form').html();
                    $('.error_forgot_form').html('Логин или Email не найден.');
                }
            }
        }, 'json');
        return false;
    });        
</script>
