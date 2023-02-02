<?
/*
Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    '\SP_Log' => '/local/sp/SP_Log.php',
]);

\SP_Log::fLog( 'test' );
\SP_Log::fLog( 'test', 'label');
\SP_Log::fLog( 'test', 'label', ['prefix'=>'pr', 'ip'=>true, 'originator'=>'file.php'] );

\SP_Log::consoleLog( 'test', 'label');

    private static function fLog($msg, $label=null) {
        \SP_Log::fLog( $msg, $label, ['prefix'=>'init_php'] );
    } //

*/

class SP_Log {
    
    private static $postfix         = '';       // '_jklHJdfd543'
    private static $arHandleFileLog = [];
    
    private static function getHandleFileLog($prefix) {
        if (!isset(self::$arHandleFileLog[$prefix])) {
            $postfix = self::$postfix;
            $file = __dir__ . "/../../../log/{$prefix}{$postfix}.php";
            @self::$arHandleFileLog[$prefix] = fopen($file, 'a');
        }
        
        return self::$arHandleFileLog[$prefix];
    } //
    
    public static function fLog( $msg, $label=null, $params=[] ) {
        
        if (is_array( $msg )) {
            $msg = print_r( $msg, 1 );
        } elseif (is_bool($msg)) {
            $msg = ($msg) ? '#true#' : '#false#';
        } elseif (is_null($msg)) {
            $msg = '#null#';
        } elseif (!strlen($msg)) {
            $msg = '#empty#';
        }

        $ip         = (empty($params['ip']))         ? '' : "{$_SERVER['REMOTE_ADDR']} ";
        $originator = (empty($params['originator'])) ? '' : "{$params['originator']} ";
        $label      = ($label === null) ? '' : "{$label}: ";
        
        $prefix = (!isset($params['prefix'])) ? 'log' : $params['prefix'];
        $handleFileLog = self::getHandleFileLog($prefix);
        
        if ($handleFileLog) {
            $str = date('d-m-Y H:i:s') ." {$ip}{$originator}{$label}{$msg} \r\n";
            fwrite($handleFileLog, $str);
        }
        
        if (defined('SP_LOG_FLAG_LOG_TO_ALL') and SP_LOG_FLAG_LOG_TO_ALL) {
            $handleFileLog = self::getHandleFileLog('all');
            
            if ($handleFileLog) {
                $str = date('d-m-Y H:i:s') ." #{$prefix}# {$ip}{$originator}{$label}{$msg} \r\n";
                fwrite($handleFileLog, $str);
            }
        }
    } //

    public static function consoleLog( $msg, $label=null ) {
        if (is_array($msg)) {
            $msg = json_encode($msg);
        } else {
            if (is_bool($msg)) {
                $msg = ($msg) ? '#true#' : '#false#';
            } elseif (is_null($msg)) {
                $msg = '#null#';
            } elseif (!strlen($msg)) {
                $msg = '#empty#';
            }
            $msg = "'{$msg}'";
        } //
        
        echo '<script>';
        if ($label) {
            echo "console.log('{$label}' + ':');";
        }
        echo "console.log({$msg});";
        echo '</script>';
    } //

} // class
