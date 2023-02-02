<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

$data   = $arResult['tpl']['data'];
$params = $arResult['tpl']['params'];
$msg    = $data['msg'];
$form   = $data['form'];

?>
<div class="container">
    <div class="form-container">
        <div class="form-item">

            <?php if (!$USER->isAdmin() && $USER->isAuthorized()): ?>

                <p><?= $msg['reg_success'] ?></p>

            <?php else: ?>

                <p class="caption"><?= $msg['first_visit'] ?></p>
                <div class="reg_error"></div>
                <?php if ($data['errors']): ?>

                    <div class="alert alert-danger">
                        <?= implode('<br />', $data['errors']) ?>
                    </div>

                <?php elseif ($arResult['USE_EMAIL_CONFIRMATION'] === 'Y'): ?>

                    <p><?= $msg['email_will_be_sent'] ?></p>

                <?php endif ?>

                <?php $form->open() ?>

                    <?php $form->field('backurl') ?>
                    <?php $form->field('login') ?>
                    <?php //$form->field('captcha_code') ?>
                    <?php //$form->field('captcha_word') ?>

                    <div class="form-border">
                        <p class="form-caption"><?= $msg['registration'] ?></p>

                        <p class="input name">
                            <?php $form->field('name') ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/name-icon.png" alt="">
                        </p>

                        <p class="input tel">
                            <?php $form->field('personal_phone') ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/tel-icon.png" alt="">
                        </p>

                        <p class="input mail">
                            <?php $form->field('email') ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/email-icon.png" alt="">
                        </p>

                        <p class="input pass">
                            <?php $form->field('password') ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/pass-icon.png" alt="">
                        </p>

                        <p class="input pass">
                            <?php $form->field('confirm_password') ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/pass-icon.png" alt="">
                        </p>

                        <?php foreach ($arResult['SHOW_FIELDS'] as $FIELD): ?>

                            <div class="field-box">

                                <?php if ($FIELD == 'PERSONAL_BIRTHDAY'): ?>
                                    <small><?= $arResult['DATE_FORMAT'] ?></small><br />
                                <?php endif ?>

                                <?php $form->field(strtolower($FIELD)) ?>

                                <?php
                                if ($FIELD == 'PERSONAL_BIRTHDAY') {
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                            'SHOW_INPUT' => 'N',
                                            'FORM_NAME' => 'regform',
                                            'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                            'SHOW_TIME' => 'N'
                                        ),
                                        null,
                                        array("HIDE_ICONS"=>"Y")
                                    );
                                }
                                ?>

                                <?php if ($FIELD === 'PASSWORD' && $arResult['SECURE_AUTH']):?>

                                    <span class="bx-auth-secure" id="bx_auth_secure" title="<?= $msg['secure_note'] ?>" style="display:none">
                                        <div class="bx-auth-secure-icon"></div>
                                    </span>

                                    <noscript>
                                        <span class="bx-auth-secure" title="<?= $msg['nonsecure_note'] ?>">
                                            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                        </span>
                                    </noscript>

                                    <script type="text/javascript">
                                        document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                    </script>

                                <?php endif ?>

                            </div>

                        <?php endforeach ?>

                        <?php if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>

                            <tr>
                                <td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td>
                            </tr>

                            <?php foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>

                                <tr>
                                    <td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></td>
                                    <td>
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:system.field.edit",
                                            $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                            array(
                                                "bVarsFromForm" => $arResult["bVarsFromForm"],
                                                "arUserField"   => $arUserField,
                                                "form_name"     => "regform"
                                            ),
                                            null,
                                            array("HIDE_ICONS"=>"Y")
                                        );?>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                        <?php endif ?>

                        <?php if ($arResult["USE_CAPTCHA"] == "Y"): ?>
                            <div class="captcha-group">
                                <p class="input"><?=GetMessage("CT_MAINREG_CAPTCHA_WORD")?></p> 
                                <?/*<b><?= $msg['captcha_title'] ?></b>*/?>
                                <? //$form->field('captcha_sid') ?>
                                <? //$form->field('captcha_word') ?>
                                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                <div class="field-box" style="display:flex; justify-content: space-between;">
                                    <input type="text" name="captcha_word" maxlength="50" value="" />
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="150" height="40" alt="CAPTCHA">
                                </div>
                            </div> 

                        <?php endif ?>

                    </div>

                    <p class="text-block">
                        Личные сведения, полученные в распоряжение интернет-магазина при регистрации или каким-либо иным образом, не будут без разрешения пользователей передаваться третьим организациям и лицам за исключением ситуаций, когда этого требует закон или судебное решение.
                    </p>

                    <div class="continue-block">
                        <p>Нажимая на кнопку «Продолжить» Я принимаю условия <br> <a href="/privacy-policy/">политики конфиденциальности.</a></p>
                        <p class="continue">
                            <? $form->field('submit') ?>
                        </p>
                    </div>

                <?php $form->close() ?>

            <?php endif ?>

        </div>
    </div>
</div>
<script>
    $('.form-container').on('submit','.form-registration',function(e){
        e.preventDefault();
        var form_action = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: '/ajax/registration.php',
            data: $(this).serialize(),
            timeout: 3000,
            error: function(request,error) {
                if (error == "timeout") {
                    alert('timeout');
                }
                else {
                    alert('Error! Please try again!');
                }
            },
            success: function(data) {
                if (data == "OK"){
                   $('.form-container .form-item').html('<p><?= $msg['reg_success'] ?></p>');
                }else{
                    var res = $(data).find('.errortext').html(),
                        captcha = $(data).find('.captcha-group').html();
                    console.log(captcha);
                    $('.form-container .reg_error').html('<div class="alert alert-danger">' + res +'</div>');
                    $('.form-container .captcha-group').html(captcha);
                }
            }
        });
    });
</script>