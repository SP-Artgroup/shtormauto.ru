<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

$fields = $arResult['VIEW'];
?>

<div class="animated-modal modal-call" id="call">
    <form
        class="form-call"
        name="<?= $arResult['FORM_NAME'] ?>"
        action="<?= POST_FORM_ACTION_URI ?>"
        method="post"
        enctype="multipart/form-data"
        id="form-container"
    >
        <h2 class="line">Запись на сервис</h2>

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

            <div class="col-lg-7 col-md-7 col-sm-12">

                <?php foreach ($arResult['groups']['left'] as $code): ?>

                    <?php $field = $fields[$code] ?>

                    <?php if ($code === 'DATE'): ?>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker'>
                                <?php
                                $APPLICATION->IncludeComponent(
                                    'citfact:form.view',
                                    $field['TYPE'],
                                    $field,
                                    $component
                                );
                                ?>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                    <?php else: ?>
                        <p class="<?= $field['TYPE'] ?>">
                            <?php
                            $APPLICATION->IncludeComponent(
                                'citfact:form.view',
                                $field['TYPE'],
                                $field,
                                $component
                            );
                            ?>
                        </p>
                    <?php endif ?>

                <?php endforeach ?>

            </div>

            <div class="col-lg-5">
                <div class="row checkbox">

                    <p class="caption">Выберите услугу:</p>

                    <?php foreach ($arResult['groups']['right'] as $code): ?>

                        <?php $field = $fields[$code] ?>

                        <?php
                        $APPLICATION->IncludeComponent(
                            'citfact:form.view',
                            $field['TYPE'],
                            $field,
                            $component
                        );
                        ?>

                    <?php endforeach ?>

                </div>

            </div>

            <p class="textarea">
                <?php
                $APPLICATION->IncludeComponent(
                    'citfact:form.view',
                    $fields['COMMENT']['TYPE'],
                    $fields['COMMENT'],
                    $component
                );
                ?>
            </p>

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

            <?php foreach ($arResult['groups']['hidden'] as $code): ?>

                <?php $field = $fields[$code] ?>

                <?php
                $APPLICATION->IncludeComponent(
                    'citfact:form.view',
                    $field['TYPE'],
                    $field,
                    $component
                );
                ?>

            <?php endforeach ?>

            <p class="submit">
                <input
                    class="btn1 btn-red"
                    type="submit"
                    data-send-text="<?= GetMessage('FILED_SEND_SUBMIT') ?>"
                    data-default-text="<?= GetMessage('FILED_SUBMIT') ?>"
                    value="<?= GetMessage('FILED_SUBMIT') ?>"
                />
            </p>

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