<?php
$helpers = array(
    'CJsonHelper',
    'CTextHelper',
    'CAjaxHelper'
);
foreach($helpers as $h) {
    $file = $_SERVER["DOCUMENT_ROOT"]."/mobile_app/modules/helpers/".$h.".php";
    if(file_exists($file)) {
        require_once($file);
    }
}

$libs = array(
    "MobileDetect/Mobile_Detect"
);
foreach($libs as $l) {
    $file = $_SERVER["DOCUMENT_ROOT"]."/mobile_app/modules/libs/".$l.".php";
    if(file_exists($file)) {
        require_once($file);
    }
}


