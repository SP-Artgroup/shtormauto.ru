<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'wecanit.car');

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

function ShowParamsHTMLByArray($arParams)
{
    foreach($arParams as $Option)
    {
        __AdmSettingsDrawRow(ADMIN_MODULE_NAME, $Option);
    }
}

$tabControl = new CAdminTabControl("tabControl", [
    [
        "DIV" => "edit1",
        "TAB" => Loc::getMessage("MAIN_TAB_SET"),
        "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET"),
    ]
]);

$arAllOptions = [
    "settings" => [
        ["WECAN_REPORTS_USERNAME", Loc::getMessage("WECAN_REPORTS_USERNAME"), "username", ["text", 100]],
        ["WECAN_REPORTS_PASSWORD", Loc::getMessage("WECAN_REPORTS_PASSWORD"), "password", ["text", 100]],
        ["WECAN_REPORTS_DOMAIN", Loc::getMessage("WECAN_REPORTS_DOMAIN"), "domain", ["text", 100]],
    ]
];

if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid())
{
    if(strlen($RestoreDefaults)>0)
    {
        COption::RemoveOption("iblock");
    }
    else
    {
        foreach($arAllOptions['settings'] as $arOption)
        {
            $name=$arOption[0];
            $val=$_REQUEST[$name];
            if($arOption[2][0]=="checkbox" && $val!="Y")
                $val="N";

            COption::SetOptionString(ADMIN_MODULE_NAME, $name, $val, $arOption[1]);
        }
    }
    if(strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0)
        LocalRedirect($_REQUEST["back_url_settings"]);
    else
        LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
}

$tabControl->begin();
?>
<form method="post" action="<?=sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID)?>">
    <?php $tabControl->BeginNextTab(); ?>
    <?php ShowParamsHTMLByArray($arAllOptions["settings"]); ?>
    <?php $tabControl->Buttons(); ?>
    <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
    <input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
    <?php if(strlen($_REQUEST["back_url_settings"])>0):?>
        <input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?php echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
        <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
    <?php endif?>
    <input type="submit" name="RestoreDefaults" title="<?php echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return confirm('<?php echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?php echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
    <?=bitrix_sessid_post();?>
</form>
<script>
    window.onload = function() {
        var logLink = document.getElementById("LOG_FILE_LINK");
        var logLinkValue = document.getElementsByName("LOG_FILE")[0].value;
        if (logLink && logLinkValue)
            logLink.setAttribute('href', logLinkValue);
    }
</script>
<?php
$tabControl->end();