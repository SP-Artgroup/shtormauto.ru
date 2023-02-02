<?php
function dump1($var, $tofile, $all, $die) {
    global $USER;
    if ($tofile) {
        $filename = dirname(__FILE__) . '/dump.txt';
        if (!file_exists($filename)) {
            $f = fopen($filename, 'w+');
            file_put_contents($filename, var_export($var, true));
            fclose($f);
        }
    } else {
        if (($USER->IsAdmin()) || ($all == true)) {
            ?>
            <font style="text-align: left; font-size: 10px;">
            <pre>
                                    				<? var_dump($var);?>
            </pre>
            </font>
            <br />
            <?php
        }
    }
    if ($die) {
        die;
    }
}
function cmp_function2($a, $b){
    return ((int)$a['VALUE'] > (int)$b['VALUE']);
}

if($_REQUEST['banner_id'] != ''){
    CModule::IncludeModule("advertising");
    CAdvBanner::Click($_REQUEST['banner_id']);
}

?>