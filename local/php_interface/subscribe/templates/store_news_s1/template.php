<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

global $SUBSCRIBE_TEMPLATE_RESULT;
$SUBSCRIBE_TEMPLATE_RESULT = false;

global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC = $arRubric;

global $APPLICATION;

$domain          = $_SERVER['HTTP_ORIGIN'];
$unsubscribeLink = $domain . '/news/subscribe.php';
$email           = $arRubric['FROM_FIELD'];

?>
<style>
body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: #000;
}
</style>

<table style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto; width: 850px;" border="1" bordercolor="#d1d1d1" cellpadding="0" cellspacing="0" >
<tbody>
<tr>
    <td style="border: none; padding-top: 23px; padding-right: 17px; padding-bottom: 24px; padding-left: 17px;" bgcolor="#bba7a5" height="83" width="850">
        <table cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td style="width:202.5pt;padding:0cm 0cm 0cm 1cm" bgcolor="#ffffff" width="270">
                <p class="MsoNormal">
                    <span style="font-size:10.5pt;font-family:&quot;helvetica neue&quot;;color:black"><img width="200" class="CToWUd" src="<?= $domain ?>/local/templates/shtormauto/images/logo.png" border="0"></span>
                </p>
            </td>
            <td style="font-weight: bold; text-align: center; font-size: 26px; color: #a21100;" bgcolor="#ffffff" height="75">
                 Новости сети магазинов Штормавто-Поул Позишн<br>
            </td>
        </tr>
        <tr>
            <td colspan="2" bgcolor="#a21100" height="11"></td>
        </tr>
        </tbody>
        </table>
    </td>
</tr>
<tr>
    <td style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;" bgcolor="#f7f7f7" valign="top" width="850">
        <p style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">
            <p><?$SUBSCRIBE_TEMPLATE_RESULT = $APPLICATION->IncludeComponent(
                'bitrix:subscribe.news',
                '.default',
                [
                    'SITE_ID'     => 's1',
                    'IBLOCK_TYPE' => 'news',
                    'ID'          => '',
                    'SORT_BY'     => 'ACTIVE_FROM',
                    'SORT_ORDER'  => 'DESC',
                ],
                null,
                [
                    'HIDE_ICONS' => 'Y',
                ]
            );?>
            </p>

            <span style="font-size: 12px; color: #666666;">Отписаться от новостей <a href="<?= $unsubscribeLink ?>" target="_blank" style="color: #666666;"><?= $unsubscribeLink ?></a></span>
        </p>
    </td>
</tr>
<tr>
    <td  style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 30px; padding-left: 44px;" bgcolor="#f7f7f7" height="40px" valign="top" width="850">
        <p style="border-top: 1px solid #d1d1d1; margin-bottom: 5px; margin-top: 0; padding-top: 20px; line-height:21px;">
             С уважением,<br>
             администрация <a href="<?= $domain ?>" target="_blank">Интернет-магазина Штормавто</a><br>
             E-mail: <a href="mailto:<?= $email ?>"><?= $email ?></a><br>
            <a href="https://www.instagram.com/shtormavto/?hl=ru" terget="_blank" style="display:inline-block; width: 45px; height: 45px; line-height: 0; font-size:0; text-decoration: none; margin-bottom: 5px; margin-top: 5px;">
                <span style="font-size:0; color:black">
                    <img width="45" src="<?= $domain ?>/local/templates/shtormauto/images/social_logo_instagram.png" border="0">
                </span>
            </a>
        </p>
    </td>
</tr>
</tbody>
</table>