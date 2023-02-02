<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусная программа");?><h1 class="bonus-program__heading">Бонусная программа</h1>
 <section class="bonus-program__section bonus-program__section--first">
<h3 class="bonus-program__section-heading">Проверить количество баллов</h3>
<div class="bonus-program__section-content">
	 Став владельцем дорожной карты Штормавто-Поул Позишн, вы получаете возможность оплачивать покупки и услуги бонусами, накопленными на карте. Номер карты – штрихкод, который на ней указан или номер телефона.&nbsp;
</div>
<div class="bonus-program-form form-container">
	<form action="<span id=" title="Код PHP: &lt;?=SITE_TEMPLATE_PATH?&gt;" class="bxhtmled-surrogate">
		<div class="bonus-program-form__wrapper">
			<div class="form-group">
 <input type="text" id="bonusProgramCardNumber" name="card_number" class="card_number form-input" placeholder="0000000000000"> <label for="bonusProgramCardNumber" class="form-label">Номер карты или номер телефона</label>
			</div>
			<div class="bonus_submit">
				 Проверить
			</div>
		</div>
		<div class="bonus-program-result">
		</div>
	</form>
</div>
 </section>
<h3 class="bonus-program__section"> </h3>
<h3 class="bonus-program__section-heading">Общие положения</h3>
<h2>Карта дает право ее держателю накапливать бонусы в размере от 3% до 5 % от стоимости каждого оплаченного чека при предъявлении карты в момент расчета, кроме товаров и услуг по избранным рекламным акциям;</h2>
<div class="bonus-program__section-content">
	<ol style="padding-left: 25px">
		<li>Карта выдается при единовременной покупке от 2500 рублей или по сумме чеков на 2500 рублей, но при условии, что покупки были совершены в период не более 6 месяцев;</li>
		<li>
		<p>
			 В момент первичной выдачи карты бонусы на совершенную покупку не начисляются.&nbsp;Начисление бонусов происходит со второй покупки.
		</p>
 </li>
		<li>Каждая карта идентифицируется по номеру телефона;</li>
		<li>При смене номера необходимо обратиться в магазин.</li>
		<li>Действие бонусных карт бессрочно!</li>
		<li>Списание бонуснов происходит посредствам смс.&nbsp;</li>
		<li>Если к вашей карте не подключены смс уведомления, сообщите нам. Можно обратиться в ближайший магазин "Штормавто" или написать по электронной почте: <a href="mailto:m.petrovskay@shtormauto.ru">m.petrovskay@shtormauto.ru</a></li>
		<li>Время подключения бонусной карты к смс информированию - 24 часа с момента подачи заявки.&nbsp;</li>
		<li>Бонусны не начисляются при покупке грузовых шин, грузовых дисков и грузовых аккумуляторов, индустриальных и с/х шин</li>
	</ol>
</div>
 <section class="bonus-program__section">
<h3 class="bonus-program__section-heading">Механизм начисления бонусов</h3>
<div class="bonus-program__section-content">
	 Бонусы на карту начисляются при оплате товаров и/или услуг. <br>
 <br>
	 Первоначальный размер бонуса составляет 3 %. Предъявляя дорожную карту автомаркета Штормавто-Поул Позишн при оплате товаров или услуг, вы получаете 3% от суммы покупки в виде бонусов. При этом: один бонус равен одному рублю. <br>
 <br>
	 Например: <br>
	 Сумма покупки = 2500 рублей. <br>
	 Бонусы, зачисляемые на карту = (2500*3)/100=75 бонусов. <br>
 <br>
	 1 уровень - 3 % - с 2 500 руб.<br>
	 2 уровень - 4 % - с 50 000 руб.<br>
	 3 уровень - 5 % - с 100 000 руб. <br>
 <br>
	 Бонус активируется через 10 дней. <br>
	 Оплатить бонусом можно не более 50 % покупки и/или услуги.
</div>
 </section> <section class="bonus-program__section">
<h3 class="bonus-program__section-heading">Дополнительные условия</h3>
<div class="bonus-program__section-content">
	 Производить оплату одной покупки бонусами с нескольких карт невозможно. При оплате счета можно использовать только одну бонусную карту.
	<ol style="padding-left: 25px">
		<li>При покупке товара или услуги на сумму, превышающую сумму бонусов, производится доплата наличными деньгами или оплата с помощью банковской карты;</li>
		<li>Бонусы начисляются только на суммы наличной оплаты или оплаты по банковским картам;</li>
		<li>Программа не действует на расчеты юридическими лицами и индивидуальными предпринимателями по средстам оплаты по счету</li>
		<li>Оплата бонусами, либо их начисление на карту невозможны без идентификации по номеру телефона посредствам смс;</li>
		<li>Для начисления бонусов покупатель при оплате счета должен проверку по номеру телефона до момента расчета;</li>
		<li>Накопленные бонусы не могут быть переведены в наличные деньги;</li>
		<li>В период проведений акций в магазинах карта не действует.</li>
		<li>При расчете по карте Халва бонусы не начисляются и не списываются.&nbsp;</li>
	</ol>
	 Дорожная карта действительна во всех магазинах Штормавто-Поул Позишн.
</div>
 </section> <br>
<script type="text/javascript">
$(document).ready(function(){
	$("body").on('click', '.bonus_submit', function(){
		$(".bonus-program-result").text("");
		$(".bonus-program-result").removeClass("res_msg_error");
		$(".bonus-program-result").removeClass("res_msg_good");
		if($("input[name=card_number]").val() != ""){
			$.ajax({
				type: 'POST',
				url: '<?=SITE_TEMPLATE_PATH?>/ajaxbonus.php',
				data: {ajaxtype: 'get_bonus', code: $("input[name=card_number]").val()}
			}).done(function(msg){
				console.log(msg);
				if($.trim(msg) != ""){
					$(".bonus-program-result").addClass("res_msg_good");
					$(".bonus-program-result").html("На данной карте накоплено <span class='scarlet'>"+msg+" бонусов</span>");
				}else{
					$(".bonus-program-result").addClass("res_msg_error");
					$(".bonus-program-result").text("Что-то пошло не так. Возможно вы ввели неверный номер карты или остаток по карте равен нулю.");
				}
			});
		}else{
			$(".bonus-program-result").addClass("res_msg_error");
			$(".bonus-program-result").text("Пожалуйста введите номер своей карты.");
		}
	});
});
</script><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>