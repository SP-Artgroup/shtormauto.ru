<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$APPLICATION->IncludeComponent(
    "citfact:form",
    "service-enroll",
    Array(
        "ID" => IBLOCK_ID__TRUCK_FORM_ENROLL_SERVICE, // ID HL блока или обычного инфоблока
        "EVENT_NAME" => "FEEDBACK_FORM", // Название почтового события
        "EVENT_TEMPLATE" => "112", // Идентификатор почтового шаблона
        "EVENT_TYPE" => "", // Тип почтового события
        "BUILDER" => "",    // Класс отвечающий за генерацию данных о форме
        "STORAGE" => "",    // Класс отвечающий за сохраниение данных из формы
        "VALIDATOR" => "",  // Класс отвечающий за валидацию данных из формы
        "AJAX" => "Y",  // Включить AJAX режим
        "USE_CAPTCHA" => "N",   // Использовать каптчу
        "USE_CSRF" => "Y",  // Использовать CSRF
        "REDIRECT_PATH" => "",  // УРЛ адрес для перенаправления после успешного оформления
        "DISPLAY_FIELDS" => array(  // Словарь со списком полей которые нужно отобразить, если пустой отображаются все
            "SERVICE_TYPE",
            "COMMENT",
            "NAME",
        ),
        "ALIAS_FIELDS" => [
            'CLIENT_NAME' => 'Ваше Имя',
            'PHONE'       => 'Ваш телефон',
            'COMMENT'     => 'Ваш комментарий',
            'AUTO_INFO'   => 'Марка/модель автомобиля, год выпуска',
            'DATE'        => 'Выберите удобный день для посещения',
        ],
        "TYPE" => "IBLOCK", // Тип генератора
        "CACHE_TYPE" => "Y",    // Тип кеширования
        "CACHE_TIME" => "3600", // Время кеширования (сек.)
        "CACHE_GROUPS" => "Y",  // Учитывать права доступа
    ),
    false
);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
