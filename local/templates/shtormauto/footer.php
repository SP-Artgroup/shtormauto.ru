<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use SP\Component as SPComponent;

IncludeTemplateLangFile(__FILE__);
?>

<!--если каталог-->
<?
if (CSite::InDir('/catalog/')) {?>
			</div>
<?}
?>
<?if ($showPageHeader && $APPLICATION->GetCurPage()!=='/index.php' && $APPLICATION->GetCurPage()!=='/bonus/index.php'){?>
	</article>
<?}?>
<!--если каталог-->
	</div><!-- content-wrapper-->
</div><!-- container-->
<footer class="footer">
	<div class="container">
		<div class="row flex-column flex-lg-row">
			<div class="col-lg-3">
				<div class="row">
					<div class="col-md-4 col-lg-12">
						<a href="/">
							 <?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/footer_logo.php"
								)
							);?>                             
						</a>
						<div class="copyright-text">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/copy.php"
								)
							);?>   
						</div>
						<a href="https://www.pokupay.ru/credit_terms" class="link-sberbank" target="_blank" title="Покупай со сбером">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/pokupay_logo_color.png" title="Покупай со сбером" alt="Покупай со сбером">
						</a>
					</div>
					<div class="col-md-8 d-none d-md-flex d-lg-none justify-content-end">
						<div class="footer-menu footer-menu--margin-top-0">
							<h3 class="footer-menu__heading">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"named_area",
								Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"NAME" => "Приложение",
								"PATH" => "/include/footer_app.php"
								)
							);?>                                   
							</h3>
							<div class="footer-menu__apps">
							<a
								class="appstore-link"
								href="https://itunes.apple.com/ru/app/stormavto/id1183266373?mt=8"
								target="_blank">
							<img alt="Доступно в AppStore" src="<?=SITE_TEMPLATE_PATH?>/images/footer/app-store.svg" />
							</a>
							<a class="googleplay-link" href="https://play.google.com/store/apps/details?id=ru.shtormauto.app" target="_blank">
								<img alt="Доступно в Google Play" src="<?=SITE_TEMPLATE_PATH?>/images/footer/googleplay.svg">
							</a>                                
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="col-lg-9">
				<div class="footer-menu-wrapper row">
					<div class="col-6 col-md-4 col-xl-3">
						<div class="footer-menu">
							<h3 class="footer-menu__heading">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"named_area",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"NAME" => "Заголовок меню",
									"PATH" => "/include/footer_menu_title1.php"
								)
							);?>                                       
							</h3>
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottom", 
								Array(
									"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
									"CHILD_MENU_TYPE" => "bottom1",	// Тип меню для остальных уровней
									"DELAY" => "N",	// Откладывать выполнение шаблона меню
									"MAX_LEVEL" => "1",	// Уровень вложенности меню
									"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
									"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
									"MENU_CACHE_TYPE" => "A",	// Тип кеширования
									"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
									"ROOT_MENU_TYPE" => "bottom1",	// Тип меню для первого уровня
									"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
									"COMPONENT_TEMPLATE" => ".default"
								),
								false
							);?>
						</div>
					</div>
					<div class="col-6 col-md-4 col-xl-3">
						<div class="footer-menu">
							<h3 class="footer-menu__heading">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"named_area",
								Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"NAME" => "Заголовок меню",
								"PATH" => "/include/footer_menu_title2.php"
								)
							);?>                                         
							</h3>
							<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
									"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
											"CHILD_MENU_TYPE" => "bottom2",	// Тип меню для остальных уровней
											"DELAY" => "N",	// Откладывать выполнение шаблона меню
											"MAX_LEVEL" => "1",	// Уровень вложенности меню
											"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
											"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
											"MENU_CACHE_TYPE" => "A",	// Тип кеширования
											"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
											"ROOT_MENU_TYPE" => "bottom2",	// Тип меню для первого уровня
											"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
											"COMPONENT_TEMPLATE" => ".default"
									),
									false
							);?>
						</div>
					</div>
					<div class="col-md-4 col-xl-3">
						<div class="footer-menu footer-menu--contacts">
							<h3 class="footer-menu__heading">Контакты</h3>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"named_area",
								Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"NAME" => "Контакты",
								"PATH" => "/include/footer_contacts.php"
								)
							);?>  
						</div>
					</div>
					<div class="col-xl-3 d-block d-md-none d-lg-block">
						<div class="footer-menu">
							<h3 class="footer-menu__heading">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"named_area",
								Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"NAME" => "Приложение",
								"PATH" => "/include/footer_app.php"
								)
							);?>                                 
							</h3>
							<div class="footer-menu__apps">
							<a
								class="appstore-link"
								href="https://itunes.apple.com/ru/app/stormavto/id1183266373?mt=8"
								target="_blank">
								<img alt="Доступно в Google Play" src="<?=SITE_TEMPLATE_PATH?>/images/footer/app-store.svg">
							</a>
							<a class="googleplay-link" href="https://play.google.com/store/apps/details?id=ru.shtormauto.app" target="_blank">
								<img alt="Доступно в Google Play" src="<?=SITE_TEMPLATE_PATH?>/images/footer/googleplay.svg">
							</a>     
							</div>
						</div>
					</div>
				</div>
			</div>            
		</div>
	</div>
<!--регистрация-->
<div class="modal modal-auth micromodal-slide" id="modal-registration" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
	<div class="modal__container" role="dialog" aria-modal="true">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.register", 
			"modal_register_form", 
			Array(
				"REQUIRED_FIELDS" => array(	// Поля, обязательные для заполнения
						0 => 'NAME', 
						1 => "EMAIL",
						2 => 'PERSONAL_MOBILE', 
				),
				"SET_TITLE" => "N",	// Устанавливать заголовок страницы
				"SHOW_FIELDS" => array(	// Поля, которые показывать в форме
						0 => 'LOGIN', 
						1 => 'NAME', 
						2 => 'LAST_NAME', 
						3 => 'EMAIL', 
						4 => 'PERSONAL_MOBILE', 
						5 => 'PASSWORD', 
						6 => 'CONFIRM_PASSWORD'
				),
				"AUTH" => "Y",  // Автоматически авторизовать пользователей
				"SUCCESS_PAGE" => "",	// Страница окончания регистрации
				"USER_PROPERTY" => "",	// Показывать доп. свойства
				"USER_PROPERTY_NAME" => "",	// Название блока пользовательских свойств
				"USE_BACKURL" => "Y",	// Отправлять пользователя по обратной ссылке, если она есть
			),
			false
		);?>
	</div>
  </div>
</div>
<!--восстановление пароля-->
<div class="modal modal-auth micromodal-slide" id="modal-restore-pass" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
	<div class="modal__container" role="dialog" aria-modal="true">
	  <header class="modal__header">
		<h2 class="modal__title">
		  Забыли пароль ?
		</h2>
		<button class="modal__close" aria-label="Close modal" ><i class="icon i-close" data-micromodal-close></i></button>
	  </header>
		<?$APPLICATION->IncludeComponent( "bitrix:system.auth.forgotpasswd", 
		"forgot_modal_window", 
		Array() 
		);
		?>
	</div>
  </div>
</div>
<!--восстановление пароля-->    
<!--вы зарегистрированы-->
<button id='modal-registration-ok-button' data-micromodal-trigger="modal-registration-ok" style='display: none;'></button>
<div class="modal modal-auth micromodal-slide" id="modal-registration-ok" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
	<div class="modal__container" role="dialog" aria-modal="true">
	  <header class="modal__header">
		<h2 class="modal__title">
		  Регистрация
		</h2>
		<button class="modal__close" aria-label="Close modal" ><i class="icon i-close" data-micromodal-close></i></button>
	  </header>
	   <div class='text-ok'> Вы успешно зарегистрированы </div>
	</div>
  </div>
</div>
<!--вы зарегистированы-->    
</footer>
<div class="arrow-up"><i class="icon i-arrow-up"></i></div>
<script>
	$('#modal-registration').on('submit','#form-registration',function(e){
		e.preventDefault();
		var form_backurl = $(this).find('input[name="backurl"]').val();
		$.ajax({
			type: "POST",
			url: '/ajax/registration.php',
			data: $('#form-registration').serialize(),
			//timeout: 3000,
			beforeSend: function(){
				$('.modal-auth__buttons').css({"opacity":0.6});
            	$('input[name="register_submit_button"]').css({"pointer-events":"none"});
        	},
			error: function(request,error) {
				$('.modal-auth__buttons').css({"opacity":1});
            	$('input[name="register_submit_button"]').css({"pointer-events":"auto"});
				if (error == "timeout") {
					alert('timeout');
				}
				else {
					alert('Error! Please try again!');
				}
			},
			success: function(data) {
				$('.modal-auth__buttons').css({"opacity":1});
            	$('input[name="register_submit_button"]').css({"pointer-events":"auto"});
				if (data == "OK"){
					$("#modal-registration-ok-button").click();
				}else{
					var error = $(data).find('.reg_error').prevObject[0].innerHTML,
						captcha = $(data).find('.captcha-group')[0].innerHTML;
					$("#modal-registration .reg_error").html(error);
					$("#modal-registration .captcha-group").html(captcha);
				}
			}
		});
	});
	$(".modal-auth__restore-pass").click(function(){
		$("#modal-auth").removeClass("is-open");
	});
	$(".modal-auth__signup-block button").click(function(){
		$("#modal-auth").removeClass("is-open");
	});	
</script>
</main>                                        

<?if (!\SP\Config::get('tpl_NoYandexMetrikaEtc')): ?>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63217239-14"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-63217239-14');
	</script>

	<!-- BEGIN JIVOSITE CODE {literal} -->
	<!--<script type='text/javascript'>
	(function(){ var widget_id = 'dV2RLLLryG';var d=document;var w=window;function l(){
	var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>-->
	<!-- {/literal} END JIVOSITE CODE -->

	<?php // Кнопка онлайн записи на услуги  ?>

	<?$APPLICATION->IncludeComponent(
		"sp-artgroup:onlinerecord", 
		".default", 
		array(
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"IBLOCK_ID" => "15",
			"IBLOCK_TYPE" => "forms",
			"SEF_MODE" => "N",
			"COMPONENT_TEMPLATE" => ".default",
			"IBLOCK_TYPE_ID" => "services",
			"PROPERTY" => "ID_WIDGET"
		),
		false
	);?>
<?endif ?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
	function LoadAjaxForm(formMain, url, type) {
		var form = document.getElementById(formMain)
		var formData = new FormData(form);
		$.ajax({
			url: url,
			type: "POST",
			contentType: false, // важно - убираем форматирование данных по умолчанию
			processData: false, // важно - убираем преобразование строк по умолчанию
			data: formData,
			success: function (data) {
				if (type == 'subscribe') {
					$('.subscription__form').addClass('hide');
					$('.subscription__done').removeClass('hide');
				}
				if (type == 'feedback') {
					if (data == 'OK') {
						$('.feedback-sidebar__initial').removeClass('visible');
						$('.feedback-sidebar__sended').addClass('visible');
					} else {
						$('.feedback-sidebar__sended').find('h3').html("Ваше сообщение не отправлено.");
						$('.feedback-sidebar__sended').find('.feedback-sidebar__description').html(data);
						$('.feedback-sidebar__initial').removeClass('visible');
						$('.feedback-sidebar__sended').addClass('visible');
					}
				}
			},
			error: function () {
				$('#' + formMain).append('<div>Ошибка отправки формы. Попробуйте еще раз. </div>');
			}
		});
	}
	/*после ошибки все в исходное состояние*/
	$(function () {
		$(".feedback-sidebar__link-more").click(function () {
			$('.feedback-sidebar__sended').find('h3').html("Ваше сообщение отправлено.");
			$('.feedback-sidebar__sended').find('.feedback-sidebar__description').html("Мы ответим Вам в самое ближайщее время.");
		})
	})
</script>  
</main>
</body>
</html>