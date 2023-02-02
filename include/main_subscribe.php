<?
CModule::IncludeModule('subscribe');
$aSubscr = CSubscription::GetUserSubscription();
?>

    <h4 class="subscription__heading">Подписаться на наши новости</h4>
    <form method="post" id="subscribeM" action="javascript:void(null);" enctype="multipart/form-data" onsubmit="LoadAjaxForm('subscribeM', '/ajax/subscribe.php', 'subscribe')"  >
        <div class="subscription__form <?if ($aSubscr['ID']>0){?>hide<?}?>">
            <input class="form-input" placeholder="Ваша эл. почта" name="email" type="text">
            <button class="btn btn-scarlet" type="submit"><i class="icon i-send"></i></button>
        </div>
        <div class="subscription__done <?if ($aSubscr['ID']==0){?>hide<?}?>">
            <i class="icon i-oil"></i>
            Вы подписались
        </div>
    </form>

