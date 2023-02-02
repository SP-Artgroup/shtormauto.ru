<?php
class CTextHelper {
    public static function GetEnding($num, $one, $few, $many) {
        $val = $num % 100;

        if ($val > 10 && $val < 20) return $many;
        else {
            $val = $num % 10;
            if ($val == 1) return $one;
            elseif ($val > 1 && $val < 5) return $few;
            else return $many;
        }
    }
}


