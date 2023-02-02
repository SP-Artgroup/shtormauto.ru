<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

?>

<?php if ($_REQUEST['fancybox'] === 'true'): ?>
    <link rel="stylesheet" type="text/css" href="<?= $templateFolder ?>/style.css">
<?php endif ?>

<div class="modal-call ask-question-form">
    <form
        name="<?= $arResult['FORM_NAME'] ?>"
        action="<?= POST_FORM_ACTION_URI ?>"
        method="post"
        enctype="multipart/form-data"
        id="form-container"
    >
        <h2>Добрый день,<br/> Вы не нашли на нашем сайте нужный Вам товар,<br/> пож-та заполните форму ниже и с вами свяжется наш сотрудник</h2>

        <?php if ($arResult['SUCCESS'] === true): ?>
            <div class="alert alert-success"><?= GetMessage('SUCCESS_MESSAGE') ?></div>
        <?php else: ?>

            <?php if (sizeof($arResult['ERRORS']['LIST']) > 0): ?>
                <div class="alert alert-danger">
                    <?php foreach ($arResult['ERRORS']['LIST'] as $type => $value): ?>
                        <?php if ($type == 'CAPTCHA' || $type == 'CSRF'): ?>
                            <div><?= GetMessage($value) ?></div>
                        <?php else: ?>
                            <div><?= $value ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php foreach ($arResult['VIEW'] as $field): ?>
                <p class="<?= $field['TYPE'] ?>">
                    <?php $APPLICATION->IncludeComponent('citfact:form.view', $field['TYPE'], $field, $component); ?>
                </p>
            <?php endforeach ?>

            <?php if ($arParams['USE_CAPTCHA'] == 'Y'): ?>
                <div class="form-group" data-required="true">
                    <label><?= GetMessage('CAPTCHA_LABEL') ?></label>
                    <img class="captcha-image captcha-reload"
                        src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>"
                        alt="captcha"
                        width="110"
                        height="33"
                    />
                    <input type="hidden" name="<?= $arResult['FORM_NAME'] ?>[CAPTCHA_TOKEN]"
                        value="<?= $arResult['CAPTCHA'] ?> "/>
                    <input type="text" class="form-control" name="<?= $arResult['FORM_NAME'] ?>[CAPTCHA]"
                        value="<?= $arResult['FORM']['CAPTCHA'] ?>"/>
                </div>
            <?php endif; ?>

            <?php if ($arParams['USE_CSRF'] == 'Y'): ?>
                <input type="hidden" name="<?= $arResult['FORM_NAME'] ?>[CSRF]" value="<?= $arResult['CSRF'] ?>"/>
            <?php endif; ?>

            <input
                class="btn1 btn-red"
                type="submit"
                data-send-text="<?= GetMessage('FILED_SEND_SUBMIT') ?>"
                data-default-text="<?= GetMessage('FILED_SUBMIT') ?>"
                value="<?= GetMessage('FILED_SUBMIT') ?>"
            />

        <?php endif ?>


    </form>
</div>

<?php if ($_REQUEST['fancybox'] === 'true'): ?>
    <script src="<?= $templateFolder ?>/script.js"></script>
<?php endif ?>

<?php if (!$arResult['IS_AJAX'] || $_REQUEST['fancybox'] === 'true'): ?>
    <script type="text/javascript">
        var formGenerator = new FormGenerator({
            formContainer: '#form-container',
            ajaxMode: <?= ($arParams['AJAX'] == 'Y') ? 'true' : 'false' ?>,
            captchaImg: '.captcha-image',
            captchaReload: '.captcha-reload',
            uri: '<?= POST_FORM_ACTION_URI ?>'
        });
        formGenerator.init();
    </script>
<?php endif; ?>

<?php if ($_REQUEST['fancybox'] === 'true'): ?>

<?php endif ?>