<?php

use Bitrix\Main\Loader;

$spPath = '/local/classes/sp';

Loader::registerAutoloadClasses(null, [
    'SP\\City'      => $spPath . '/city.php',
    'SP\\Catalog'   => $spPath . '/catalog.php',
    'SP\\Store'     => $spPath . '/store.php',
    'SP\\Component' => $spPath . '/component.php',
    'SP\\Shop'      => $spPath . '/shop.php',
    'Shtormauto'    => '/local/classes/shtormauto.php',

    '\SP_Log'   	  => $spPath . '/SP_Log.php',
    '\SP\Config'      => $spPath . '/Config.php',
    '\SP\MainClass'   => $spPath . '/MainClass.php',
]);

unset($spPath);

$docRoot = Bitrix\Main\Application::getInstance()->getDocumentRoot();

foreach ([
    '/local/php_interface/include/constants.php',
    '/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php',
    '/local/php_interface/include/agent_clear_cache.php',
    '/local/php_interface/include/seo.php',
    '/local/php_interface/include/handlers.php',
    '/local/php_interface/include/functions.php'
] as $includePath) {

    if (file_exists($docRoot . $includePath)) {
        include $docRoot . $includePath;
    }
}

unset($docRoot, $includePath);
