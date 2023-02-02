<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение товаров");

?><?$APPLICATION->IncludeComponent("bitrix:catalog.compare.result", "grid", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"NAME" => "CATALOG_COMPARE_LIST",	// Уникальное имя для списка сравнения
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
	"IBLOCK_ID" => "3",	// Инфоблок
	"FIELD_CODE" => array(	// Поля
		0 => "NAME",
		1 => "PREVIEW_PICTURE",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "ARTNUMBER",
		1 => "CHAR",
	),
	"OFFERS_FIELD_CODE" => "",	// Поля предложений
	"OFFERS_PROPERTY_CODE" => "",	// Свойства предложений
	"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
	"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
	"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
	"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
	"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
	"PRICE_CODE" => array(	// Тип цены
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
	"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
	"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
	"DISPLAY_ELEMENT_SELECT_BOX" => "N",	// Выводить список элементов инфоблока
	"ELEMENT_SORT_FIELD_BOX" => "name",	// По какому полю сортируем список элементов
	"ELEMENT_SORT_ORDER_BOX" => "asc",	// Порядок сортировки списка элементов
	"ELEMENT_SORT_FIELD_BOX2" => "id",	// Поле для второй сортировки списка элементов
	"ELEMENT_SORT_ORDER_BOX2" => "desc",	// Порядок второй сортировки списка элементов
	"HIDE_NOT_AVAILABLE" => "N",	// Не отображать в списке товары, которых нет на складах
	"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>