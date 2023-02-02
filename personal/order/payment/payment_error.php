<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Ошибка оплаты покупки");
$APPLICATION->SetTitle("Ощибка оплаты");
?> 
<div style="margin: 0px;"> 
	<h1 style="max-width: 990px; text-align: center;">Ошибка оплаты покупки</h1>
	<div style="font-size: 20px; line-height: normal; text-align:center;  margin-bottom: 20px;">
		Ой, кажется что-то пошло не так и вы не смогли оплатить вашу покупку.<br/>Попробуйте, пожалуйста, <a href="/catalog/">еще раз</a>или обратитесь к менеджеру и он обязательно поможет разобраться в ситуации.
	</div>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>