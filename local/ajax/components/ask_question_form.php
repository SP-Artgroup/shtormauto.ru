<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$APPLICATION->IncludeComponent(
    "citfact:form",
    "ask-question",
    Array(
        "ID" => IBLOCK_ID__TRUCK_FORM_ASK_QUESTION, // ID HL блока или обычного инфоблока
        "EVENT_NAME" => "FEEDBACK_FORM", // Название почтового события
        "EVENT_TEMPLATE" => "104", // Идентификатор почтового шаблона
        "EVENT_TYPE" => "", // Тип почтового события
        "BUILDER" => "",    // Класс отвечающий за генерацию данных о форме
        "STORAGE" => "",    // Класс отвечающий за сохраниение данных из формы
        "VALIDATOR" => "",  // Класс отвечающий за валидацию данных из формы
        "AJAX" => "Y",  // Включить AJAX режим
        "USE_CAPTCHA" => "N",   // Использовать каптчу
        "USE_CSRF" => "Y",  // Использовать CSRF
        "REDIRECT_PATH" => "",  // УРЛ адрес для перенаправления после успешного оформления
        "DISPLAY_FIELDS" => array(  // Словарь со списком полей которые нужно отобразить, если пустой отображаются все
            'PROPERTY_CONTACT',
        ),
        "ALIAS_FIELDS" => array(
            'NAME' => 'Имя',
        ),
        "TYPE" => "IBLOCK", // Тип генератора
        "CACHE_TYPE" => "Y",    // Тип кеширования
        "CACHE_TIME" => "3600", // Время кеширования (сек.)
        "CACHE_GROUPS" => "Y",  // Учитывать права доступа
    ),
    false
);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
