<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$data   = $arResult['tpl']['data'];
$params = $arResult['tpl']['params'];
$msg    = $data['msg'];
$form   = $data['form'];

?>
<div class="container">
    <div class="form-container">
        <div class="form-item">

            <p class="caption"><?= $msg['caption'] ?></p>

            <?php if (!empty($arParams['~AUTH_RESULT'])): ?>
                <div class="alert alert-danger">
                    <?= $arParams['~AUTH_RESULT']['MESSAGE'] ?>
                </div>
            <?php endif ?>

            <?php
            // ShowMessage($arResult['ERROR_MESSAGE']);
            ?>

            <?php $form->open() ?>

                <? $form->field('AUTH_FORM') ?>
                <? $form->field('TYPE') ?>

                <?php if (strlen($arResult['BACKURL']) > 0): ?>
                    <? $form->field('backurl') ?>
                <?php endif ?>

                <?php foreach ($arResult['POST'] as $key => $value): ?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
                <?php endforeach ?>

                <div class="form-border">

                    <p class="form-caption"><?= $msg['please_auth'] ?></p>

                    <p class="input mail">
                        <? $form->field('USER_LOGIN') ?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/email-icon.png" alt="">
                    </p>

                    <p class="input pass">
                        <? $form->field('USER_PASSWORD') ?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/pass-icon.png" alt="">
                    </p>

                    <noindex>
                        <a class="forgot-pass" href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'] ?>" rel="nofollow"><?= $msg['forgot_password_2'] ?></a>
                    </noindex>

                </div>

                <p class="text-block">Личные сведения, полученные в распоряжение интернет-магазина при регистрации или каким-либо иным образом, не будут без разрешения пользователей передаваться третьим организациям и лицам за исключением ситуаций, когда этого требует закон или судебное решение.</p>

                <div class="continue-block">
                    <p>Нажимая на кнопку «Продолжить» Я принимаю условия <br> <a href="/privacy-policy/">политики конфиденциальности.</a></p>
                    <p class="continue">
                        <? $form->field('Login') ?>
                    </p>
                </div>

            <?php $form->close() ?>

            <?php if ($arResult['AUTH_SERVICES']) {

                $APPLICATION->IncludeComponent(
                    'bitrix:socserv.auth.form',
                    '',
                    [
                        'AUTH_SERVICES'   => $arResult['AUTH_SERVICES'],
                        'CURRENT_SERVICE' => $arResult['CURRENT_SERVICE'],
                        'AUTH_URL'        => $arResult['AUTH_URL'],
                        'POST'            => $arResult['POST'],
                        'SHOW_TITLES'     => $arResult['FOR_INTRANET'] ? 'N' : 'Y',
                        'FOR_SPLIT'       => $arResult['FOR_INTRANET'] ? 'Y' : 'N',
                        'AUTH_LINE'       => $arResult['FOR_INTRANET'] ? 'N' : 'Y',
                    ],
                    $component,
                    ['HIDE_ICONS' => 'Y']
                );
            }
            ?>

        </div>
    </div>
</div>

<?php

$fieldName = 'USER_' . (
    strlen($arResult['LAST_LOGIN']) > 0 ? 'PASSWORD' : 'LOGIN'
);

?>

<script type="text/javascript">
    try {
        document.form_auth.<?= $fieldName ?>.focus();
    } catch(e) {}
</script>