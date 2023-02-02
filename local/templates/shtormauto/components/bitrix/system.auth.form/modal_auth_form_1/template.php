<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
ShowMessage($arResult['ERROR_MESSAGE']);
        //  dump($arResult);
?>
<div class="auth d-none d-md-flex">
    <a href="#" class="auth__link" data-micromodal-trigger="modal-auth">Войти</a>
</div>
<div class="modal modal-auth micromodal-slide" id="modal-auth" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true">
            <header class="modal__header">
                <h2 class="modal__title">
                    Войти
                </h2>
                <button class="modal__close" aria-label="Close modal" ><i class="icon i-close" data-micromodal-close></i></button>
            </header>
            <div class="modal__content">
                <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>" class="form-container auth-form-modal">
                    <div class='error_auth_form'></div>
                    <input type="hidden" name="AJAX-ACTION" value="AUTH"/>
                    <?if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
                    <?endif?>
                    <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
                    <?endforeach?>
                    <input type="hidden" name="AUTH_FORM" value="Y" />
                    <input type="hidden" name="TYPE" value="AUTH" />

                    <div class="form-group">
                        <input type="text" class="form-input" name="USER_LOGIN" value="<?= $arResult["USER_LOGIN"] ?>" placeholder="+7 900 000 00 00">
                        <label for="authLogin" class="form-label">Ваш E-mail</label>
                    </div>                    
                    <div class="form-group">
                        <input class="form-input" placeholder="<?= GetMessage("AUTH_PASSWORD") ?>" name="USER_PASSWORD" type="password">
                        <label for="authPassword" class="form-label">Пароль</label>
                    </div>                    
                    <?/*галка - запомнить пароль
                    if ($arResult["STORE_PASSWORD"] == "Y"):?>
                    <div class="head_remember_me" style="margin-top: 10px">
                        <input id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" type="checkbox">
                        <label for="USER_REMEMBER_frm" title="<?= GetMessage("AUTH_REMEMBER_ME") ?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label>
                    </div>	
                    <?endif*/?>	

                    <?if ($arResult["CAPTCHA_CODE"]):?>	
                    <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                    <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                           <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                    <input type="text" name="captcha_word" maxlength="50" value="" /></td>

                    <?endif?>
                    <div class="modal-auth__buttons">
                        <input value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>" name="Login" class="btn btn-scarlet" type="submit">
                        <?if($arResult["AUTH_SERVICES"]):?>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "shtormauto", 
                        array(
                        "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                        "SUFFIX"=>"form",
                        "SHOW_TITLES"=>"N"
                        ), 
                        $component, 
                        array("HIDE_ICONS"=>"Y")
                        );
                        ?>
                        <?endif?>
                    </div>
                </form>
                <?$APPLICATION->IncludeComponent( "bitrix:system.auth.forgotpasswd", 
                    "forgot_modal_window", 
                    Array() 
                    );
                ?>
                <?if($arResult["AUTH_SERVICES"]):?>
                <?
                      $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
                array(
                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                "AUTH_URL"=>$arResult["AUTH_URL"],
                "POST"=>$arResult["POST"],
                "POPUP"=>"Y",
                "SUFFIX"=>"form",
                ), 
                $component, 
                array("HIDE_ICONS"=>"Y")
                );
                ?>
                <?endif?>                
            </div>
        </div>
    </div>
</div>

<?/*if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
<noindex><a href="<?= $arResult["AUTH_REGISTER_URL"] ?>" class="hd_signup" rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a></noindex>
<?endif*/?>

<?
//if($arResult["FORM_TYPE"] == "login")
else:
?>
  <a href="javascript: document.location.href = '/personal/profile/'" class="authorized-user d-none d-md-flex">
    <div class="authorized-user__info">
      <div class="authorized-user__name"><?= $arResult["USER_NAME"] ?></div>
    </div>
    <?
    $rsUser = CUser::GetByID($USER->GetId());
    $arUser = $rsUser->Fetch();
    $arFile = CFile::GetFileArray($arUser["PERSONAL_PHOTO"]);
    if (is_array($arFile)){
    ?>
        <div class="authorized-user__photo test" style="background-image:url(<?=$arFile['SRC']?>)"></div>
    <?}else{?>
        <div class="authorized-user__photo" style="background-image:url(http://placehold.it/40x40)"></div>    
    <?}?>
  </a>

<?endif?>
<!--> <div class="authorized-user__points" style="display: none;">
              <a href="javascript: document.location.href = '<?echo $APPLICATION->GetCurPageParam("logout=yes", array(
       "login",
       "logout",
       "register",
       "forgot_password",
       "change_password"));?>'" >&emsp;Выход</a>
      </div>
<!-->
<script>
    $('.auth-form-modal').submit(function () {
        $.post('', $('.auth-form-modal').serialize(), function (response) {
            if (response && response.STATUS) {
                if (response.STATUS == 'OK') {
                        $('.error_auth_form').html();
                        window.location.reload();
                } else {
                    $('.error_auth_form').empty();
                    $('.error_auth_form').append(response.MESSAGES);
                }
            }
        }, 'json');
        return false;
    });
</script>
