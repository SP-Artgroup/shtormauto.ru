<?php
class CJsonHelper {
    public static function sendAjax($value){
        ob_end_clean();
        ob_start();
        echo \Bitrix\Main\Web\Json::encode($value);
        ob_end_flush();
        exit();
    }
}