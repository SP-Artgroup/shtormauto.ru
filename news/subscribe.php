<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
$APPLICATION->AddChainItem("Управление подпиской");?>
<form name="subscribe" class="subscribe-form">
<h1>Управление подпиской</h1>
<?if(isset($_REQUEST["action"])){
    switch($_REQUEST["action"]){
        case "deleted":
            ShowNote("Подписка удалена!");
            break;
        case "subscribed":
            ShowNote("Вы успешно подписаны!<br />Чтобы отказаться от рассыки повторно введите свой email.");
            break;
    }
}
if(CModule::IncludeModule("subscribe")){
    if(isset($_REQUEST["ID"]) && isset($_REQUEST["delete"])){
        print_r($_GET);
        if(CSubscription::Delete($_REQUEST["ID"])){
            LocalRedirect($APPLICATION->GetCurPageParam("action=deleted", Array("ID", "delete")));
        }
    }
    if(isset($_REQUEST["EMAIL"])){
        $subscription = CSubscription::GetByEmail($_REQUEST["EMAIL"]);
        if($subscription->ExtractFields("str_")){
            $ID = (integer)$str_ID;?>
            <input type="hidden" name="ID" value="<?=$ID?>"> На данный адрес уже оформлена подписка.<br />
            Вы хотите отказаться от рассылки?<br />
            <input type="submit" name="delete" value="Да" class="button" /> <input type="submit" name="reset" value="Нет" class="button" />
        <?}else{
            $arFields = Array(
            "FORMAT" => "html",
            "EMAIL" => $_REQUEST["EMAIL"],
            "ACTIVE" => "Y",
            "RUB_ID" => Array(1),
            "CONFIRMED"=>"Y",
            "SEND_CONFIRM" => "N",
            );
            $subscr = new CSubscription;
            //can add without authorization
            $ID = $subscr->Add($arFields);
            if($ID>0){
                LocalRedirect($APPLICATION->GetCurPageParam("action=subscribed", Array("EMAIL")));
            }else{
                ShowError("Произошла ошибка: ".$subscr->LAST_ERROR."<br>");
            }
        }
    }else{?>
        Для подписки или отказа от рассылки, введите адрес электронной почты в поле ниже:<br />
        <input type="text" name="EMAIL" value="" class="text" /><br />
        <input type="submit" value="Отправить" class="button" />
    <?}
}
?>
</form>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>