<?
namespace SP;

/*
    http://dev-shtormauto.ru/local/components/sp-artgroup/tyre.selection/test.php
*/

class Test {

    private static $component = null;

    public static function run($component) {
        echo "<pre>\n";

        self::$component = $component;

        $oper = \SP\MainClass::getFromRequest('oper');
        if ($oper === null) {
            $oper = 'default';
        }

        switch ($oper) {
            case 'getFields':
                $fields = $component->getFields();
                \SP_Log::consoleLog($fields, '$fields');
                break;
                   
            case 'default':
                self::fDefault();
                break;

            default:
                echo 'oper not found';
        } // switch
        
        echo "\n\n<br><hr><br>\n oper: {$oper}";
        
        // #################################################
        
        echo "</pre>\n";
    } // function

    private static function fDefault() {
        echo 'Default<br>';
        
        $component = self::$component;

        if (0) {
            $res = self::fAnalyse();
            self::fLog($res, 'fAnalyse');
        }

        if (1) {
            $tyreOrWheel = 'akkumulyatory';
            if (0) {
                $arFields = [
                    'VENDOR'       => 'Toyota',
                    'MODEL'        => '4Runner',
                    'YEAR'         => 'IV Рестайлинг 2005 - 2009',
                    'MODIFICATION' => '4.0 (245 л.с.)',
                ];
            }
            if (1) {
                $arFields = [
                    'VENDOR'       => 'Toyota',
                    'MODEL'        => 'Chaser',
                    'YEAR'         => 'IV (X80) 1988 - 1992',
                    'MODIFICATION' => '2.0 (135 л.с.)',
                ];
            }
            $res = $component->getFilterBattery([
                'tyreOrWheel' => $tyreOrWheel,
                'arFields'    => $arFields,
            ]);
            self::fLog($res, 'getFilter');

            $t_arFilter = $res['filter'];
            $t_arFilter['IBLOCK_ID']  = \SP\Config::get('iblock_main_catalog_id');

            self::fLog($t_arFilter, '$t_arFilter');

            $res = \CIBlockElement::GetList(
                $t_arOrder          = ['SORT' => 'ASC'],
                $t_arFilter,
                $t_arGroupBy        = false,
                $t_arNavStartParams = ["nTopCount" => 20],
                $t_arSelectFields   = ['ID']
            );
            while ($ar = $res->Fetch()) {
                self::fLog($ar);
            }
        }

        if (0) {
            if (1) {
                $tyreOrWheel = 'akkumulyatory';
                $arFields = [
                    'VENDOR'       => 'Toyota',
                    'MODEL'        => 'Corolla',
                    'YEAR'         => 'III (E30, E40, E50, E60) 1972 - 1980',
                    'MODIFICATION' => '1.2 (54 л.с.)',
                ];
            } else {
                $tyreOrWheel = 'wheel';
                $arFields = [
                    'VENDOR'       => 'toyota',
                    'MODEL'        => 'chaser',
                    'YEAR'         => '1989',
                    'MODIFICATION' => '1.8i (SX80) IV (X80)',
                ];
            }
            $res = $component->getFilter([
                'tyreOrWheel' => $tyreOrWheel,
                'arFields'    => $arFields,
            ]);
            self::fLog($res, 'getFilter');
        }

        if (0) {
            $tyreOrWheel = 'wheel';
            $arFields = [
                'VENDOR'       => 'toyota',
                'MODEL'        => 'chaser',
                'YEAR'         => '1989',
                'MODIFICATION' => '',
            ];
            $res = $component->getData([
                'tyreOrWheel' => $tyreOrWheel,
                'arFields'    => $arFields,
            ]);
            self::fLog($res, 'getData');
        }

        if (0) {
            $res = $component->get_listsBattery([
                //'flagClearCache' => true,
                //'cache_time'     => 3,
                //'key'            => 'vendor',
            ]);
            self::fLog($res, 'get_listsBattery');
            $res = $component->get_listsBattery([
                //'flagClearCache' => true,
                //'cache_time'     => 3,
                //'key'            => 'vendor',
            ]);
            self::fLog($res, 'get_listsBattery');
        }

        if (0) {
            $res = $component->get_arLists();
            self::fLog($res, 'get_arLists');
        }

    } // function

    private static function fAnalyse() {
        $entityClass = \SP\MainClass::getHighloadBlockEntityClass( \SP\Config::get('hlblock_battery_id') );

        $arFieldName_1 = [
            'UF_VENDOR',
            'UF_MODEL',
            'UF_YEAR',
            'UF_MODIFICATION',
        ];

        $arFieldName_2 = [
            // UF_POLARITY
            'UF_TYPE',

            'UF_CAPACITY_FROM',
            'UF_CAPACITY_TO',
            'UF_AMPERAGE_FROM',
            'UF_AMPERAGE_TO',

            'UF_LEN_FROM',
            'UF_LEN_TO',
            'UF_WIDTH_FROM',
            'UF_WIDTH_TO',
            'UF_HEIGHT_FROM',
            'UF_HEIGHT_TO',
        ];

        $res = $entityClass::getList([
            'order' => [
                'UF_VENDOR',
                'UF_MODEL',
                'UF_YEAR',
                'UF_MODIFICATION',
                'ID',
            ],
        ]);

        $n          = 0;
        $nSameModel = 0;
        $count = [
            'n_1' => 0,
            'n_2' => 0,
        ];
        $ar_Prev = null;

        while ($ar = $res->Fetch()) {
            $n++;
            if ($n >= 100) {
                //break;
            }
            //self::fLog($ar);

            if ($ar_Prev) {
                $flag = true;

                foreach ($arFieldName_1 as $fieldName) {
                    if ($ar[ $fieldName ] != $ar_Prev[ $fieldName ]) {
                        $flag = false;
                        $count['n_1']++;
                        break;
                    }
                }

                if (!$flag) {
                    $nSameModel = 0;
                } else {
                    // Та же модель
                    $count['n_2']++;
                    $nSameModel++;

                    if ($nSameModel > 1) {
                        echo $ar['ID'] .' $nSameModel > 1';
                        return;
                    }

                    foreach ($arFieldName_2 as $fieldName) {
                        if ($ar[ $fieldName ] != $ar_Prev[ $fieldName ]) {
                            echo $ar['ID'] .' другие параметры';
                            return;
                        }
                    }

                    if ($ar_Prev['UF_POLARITY'] == 1 and $ar['UF_POLARITY'] == 2) {
                    } else {
                        echo $ar['ID'] .' POLARITY';
                        return;
                    }
                }
            } //

            $ar_Prev = $ar;
        } //
        
        print_r($count);
    } // function

    private static function fLog($msg, $label=null) {
        \SP_Log::consoleLog($msg, $label);
    } //

} // class

/*
### Таблица akb ###

SELECT UF_VENDOR, UF_MODEL, UF_YEAR, UF_MODIFICATION, COUNT(*) AS cnt FROM akb
GROUP BY UF_VENDOR, UF_MODEL, UF_YEAR, UF_MODIFICATION
HAVING cnt > 2

На 22-02-2021

22418 всего
17598 cnt=1
2410  cnt=2
0     cnt>2

2410*2=4820 "дублирующихся" записей.
Т.е. для 2410 моделей по две записи: все параметры (UF_CAPACITY_FROM, UF_CAPACITY_TO, ...) одинаковые кроме POLARITY.
Т.о. если для одной модели две записи, то POLARITY может быть "1" или "2".

*/
