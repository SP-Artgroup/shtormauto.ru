<?
/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
*/
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
die();
?>
<header class="header-content header-content--orders">
    <div class="header-content__col">
        <h1 class="header-content__heading"><?$APPLICATION->ShowTitle();?></h1>
    </div>
    <div class="header-content__col">
    <?$APPLICATION->IncludeComponent(
            "bitrix:menu", 
            "guaranty", 
            array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "guaranty",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "guaranty"
            ),
            false
    );?>
    </div>
</header>
<div class="bx-auth-profile content-form-body content-form-body--user-profile">
    <?ShowError($arResult["strProfileError"]);?>
    <?
    if ($arResult['DATA_SAVED'] == 'Y')
    ShowNote(GetMessage('PROFILE_DATA_SAVED'));
    ?>
    <script type="text/javascript">
        <!--
    var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
    {
                echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
    }
    else
    {
                $arResult["opened"] = "reg";
        echo "'reg'";
        }
            ?>];
            //-->
            
                var cookie_prefix = '<?= $arResult["COOKIE_PREFIX"] ?>';
                </script>
    <form method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
        <?= $arResult["BX_SESSION_CHECK"] ?>
        <input type="hidden" name="lang" value="<?= LANG ?>" />
        <input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
         <div class="content-form content-form--margin-bottom-69 form-container">
        <div class="user-profile-upload">
            <?if ($arResult["arUser"]["PERSONAL_PHOTO"]){?>
            <div class="user-profile-upload__image"><?= $arResult["arUser"]["PERSONAL_PHOTO_HTML"] ?></div>
            <?}else{?>
            <div class="user-profile-upload__image" style="background-image: url(http://placehold.it/100x100)"></div>
            <?}?>
            <div class="profile-file-upload-block">
                <div class="file-name"></div>
                <label class="btn btn-white user-profile-upload__button">Загрузить новое фото <input name="PERSONAL_PHOTO" class=typefile  type="file" /></label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="NAME" class="form-input" value="<?= $arResult["arUser"]["NAME"] ?>" placeholder="Имя" />
                    <label for="userProfileFirstName" class="form-label">Имя</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="LAST_NAME" class="form-input" value="<?= $arResult["arUser"]["LAST_NAME"] ?>" placeholder="Фамилия"/>
                    <label for="userProfileLastName" class="form-label">Фамилия</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="PERSONAL_MOBILE" class="form-input" data-masked="+7 (999) 999-99-99" value="<?= $arResult["arUser"]["PERSONAL_MOBILE"] ?>" placeholder="+7 (999) 999-99-99" />
                    <label for="userProfilePhone" class="form-label">Телефон</label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="EMAIL" class="form-input" value="<? echo $arResult['arUser']['EMAIL']?>" placeholder="your@email.co"/>
                    <label for="userProfileEmail" class="form-label">Почта</label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <input type="password" name="NEW_PASSWORD"class="form-input" value="" autocomplete="off" placeholder="•••••••••"/>
                    <label for="userProfileFirstPassword" class="form-label">Новый пароль</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="password" name="NEW_PASSWORD_CONFIRM" class="form-input" value="" autocomplete="off" placeholder="•••••••••"/>
                    <label for="userProfileLastPassword" class="form-label">Повторите пароль</label>
                </div>
            </div>
        </div>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="save" value="<?= GetMessage("MAIN_SAVE"); ?>" class="btn btn-dark content-form-body__button">
        </div>
    </form>
</div>
<script>
$(function(){
    $(document).on("input", "input[name='PERSONAL_PHOTO']", function(){
        $(".file-name").html($(this).val());
    })
})
</script>