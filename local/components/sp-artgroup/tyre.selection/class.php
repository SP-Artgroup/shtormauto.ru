<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*
    Для заполнения списков автомобилей ('VENDOR', 'MODEL', 'YEAR', 'MODIFICATION') используется hlblock_tyre_id. 
    Предполагается что в hlblock_tyre_id и в hlblock_wheel_id одинаковый набор моделей авто.

    2021-02-17 Для аккумуляторов используется hlblock_battery_id. Там тоже 'VENDOR', 'MODEL', 'YEAR', 'MODIFICATION'

    Применение фильтра в файле \local\templates\shtormauto\components\sp-artgroup\catalog\new2-catalog\section_horizontal.php
*/

class TyreSelection extends CBitrixComponent {
    private static $arLists_cache_time = 36000000;
    private static $arLists            = [];
    private static $listsBattery       = [];

    public function onPrepareComponentParams($arParams) {
        $result = [
            'flagTest' => ($arParams['flagTest']) ?? false,

            'CACHE_TYPE'    => $arParams['CACHE_TYPE'],
            'CACHE_TIME'    => isset($arParams['CACHE_TIME']) ? $arParams['CACHE_TIME'] : 36000000,

            'OPER'                  => isset($arParams['OPER']) ? $arParams['OPER'] : 'render',
            'TYRE_OR_WHEEL'         => isset($arParams['TYRE_OR_WHEEL']) ? $arParams['TYRE_OR_WHEEL'] : false,
            'TYRE_SELECTION_FILTER' => isset($arParams['TYRE_SELECTION_FILTER']) ? $arParams['TYRE_SELECTION_FILTER'] : false,
        ];
        //$result['CACHE_TYPE'] ='N';

        self::$arLists_cache_time = $result['CACHE_TIME'];

        return array_merge($arParams, $result);
    }

    public function executeComponent() {
        $arParams = &$this->arParams;
        $arResult = &$this->arResult;

        \Bitrix\Main\Loader::registerAutoLoadClasses(null, [
            '\SP\Test' => $this->GetPath() .'/include/Test.php',
        ]);

        if ($arParams['flagTest']) {
            \SP\Test::run($this);
            return;
        }

        switch ($arParams['OPER']) {
            case 'getData':
                $tyreOrWheel = \SP\MainClass::getFromRequest('tyreOrWheel');
                $arFields    = \SP\MainClass::getFromRequest(['VENDOR', 'MODEL', 'YEAR']);
                $res = self::getData([
                    'tyreOrWheel' => $tyreOrWheel,
                    'arFields'    => $arFields,
                ]);
                echo json_encode($res);
                return;
            /* Уже не используется
            case 'getFilter':
                $arFields = \SP\MainClass::getFromRequest(['VENDOR', 'MODEL', 'YEAR', 'MODIFICATION']);
                foreach ($arFields as $key => $value) {
                    if ($value === null) {
                        return;
                    }
                }
                $tyreOrWheel = $arParams['TYRE_OR_WHEEL'];
                return self::getFilter(['arFields'=>$arFields, 'tyreOrWheel'=>$tyreOrWheel]);
            */
        } //

        // Отрисовка формы (часть формы)

        $arFieldName = ['VENDOR', 'MODEL', 'YEAR', 'MODIFICATION'];
        $arResult['arFields'] = \SP\MainClass::getFromRequest($arFieldName);
        
        // ### Данные для select-ов (
        $arResult['arDataForFormFields'] = [];

        $flagSetFilter = true;
        foreach ($arResult['arFields'] as $fieldName => $value) {
            if ($value === null) {
                $flagSetFilter = false;
                $arResult['arDataForFormFields'][ $fieldName ] = [];
            }
        }

        $arVendor   = [];
        $hlblock_id = 0;

        switch ($arParams['TYRE_OR_WHEEL']) {
            case 'tyre':
            case 'wheel':
                $res        = self::get_arLists();
                $arVendor   = $res['tyre_vendor'];
                $hlblock_id = \SP\Config::get('hlblock_tyre_id');
                break;
            case 'akkumulyatory':
                $arVendor   = self::get_listsBattery(['key' => 'vendor']);
                $hlblock_id = \SP\Config::get('hlblock_battery_id');
                break;
            default:
                echo 'Неверное значение TYRE_OR_WHEEL';
                return;
        } //

        if (!$flagSetFilter) {
            // Не все поля заполнены - значит ничего не заполнено - очистим

            if ($this->StartResultCache()) {
                $arResult['arDataForFormFields']['VENDOR'] = $arVendor;

                foreach ($arResult['arFields'] as $fieldName => $value) {
                    $arResult['arFields'][ $fieldName ] = null;
                }
                
                //self::fLog_2(date('h:i:s'), 1);

                $this->IncludeComponentTemplate();
            }

        } else {
            // Заполнены все поля
            
            if ($arParams['TYRE_SELECTION_FILTER']) {
                // Параметры фильтра для данной модели
                $res = [];
                switch ($arParams['TYRE_OR_WHEEL']) {
                    case 'tyre':
                    case 'wheel':
                        $res = self::getFilter([
                            'arFields'    => $arResult['arFields'],
                            'tyreOrWheel' => $arParams['TYRE_OR_WHEEL'],
                        ]);
                        break;
                    case 'akkumulyatory':
                        $res = self::getFilterBattery([
                            'arFields'    => $arResult['arFields'],
                            'tyreOrWheel' => $arParams['TYRE_OR_WHEEL'],
                        ]);
                        break;
                } //

                $GLOBALS[ $arParams['TYRE_SELECTION_FILTER'] ] = $res;

                //self::fLog_2($res, 'filter');
            } //

            // Получим списки для 'MODEL', 'YEAR', 'MODIFICATION'
            $entityClass = \SP\MainClass::getHighloadBlockEntityClass($hlblock_id);
            $filter = [
                "=UF_VENDOR" => $arResult['arFields']['VENDOR'],
            ];

            for ($i=1; $i<=3; $i++) {
                $fieldName   = $arFieldName[ $i ];
                $ufFieldName = "UF_{$fieldName}";

                $res = $entityClass::getList([
                    'select' => [ $ufFieldName ],
                    'group'  => [ $ufFieldName ],
                    'order'  => [ $ufFieldName ],
                    'filter' => $filter,
                ]);
                while ($item = $res->Fetch()) {
                    $arResult['arDataForFormFields'][ $fieldName ][] = $item[ $ufFieldName ];
                }

                $filter["={$ufFieldName}"] = $arResult['arFields'][ $fieldName ];
            }

            // Список для 'VENDOR'
            $arResult['arDataForFormFields']['VENDOR'] = $arVendor;

            //self::fLog_2(date('h:i:s'), 2);

            $this->IncludeComponentTemplate();
        } //
        // ### )

        //self::fLog_2(date('h:i:s'), '3');
    } // function

    public static function get_arLists($flagClearCache=false) {
        if (!$flagClearCache and self::$arLists) {
            return self::$arLists;
        }

        if (!$flagClearCache) {
            $flagClearCache = (\SP\MainClass::getFromRequest('clear_cache') == 'Y');
        }

        $arLists = [];
    
        // Проверим кеш
        $cache_id  = 'ar_lists__tyre_selection';
        $cache_dir = '/sp_lists_cache/' . $cache_id;

        $obCache = new \CPHPCache;

        if ($flagClearCache) {
            $obCache->CleanDir($cache_dir); // Очистка кеша
        }

        if ($obCache->InitCache(self::$arLists_cache_time, $cache_id, $cache_dir)) {
            // Берем из кеша
            $arLists = $obCache->GetVars();
            
        } elseif ($obCache->StartDataCache()) {
            // Создаем списки

            \Bitrix\Main\Loader::includeModule('iblock');

            try {
                // Предполагается что дублей нет. Т.е. в DIAMETR нет двух значений "14". Исключение - 'PCD'.
                $arPropertyCode = [
                    'DIAMETR',                    // Диаметр шины / диска
                    'SHIRINA',                    // Ширина шины
                    'PROFIL',                     // Высота профиля шины
                    'SHIRINA_LEGKOVOGO_DISKA',    // Ширина диска
                    'VYLET_LEGKOVOGO_DISKA_ET',   // Вылет диска
                    'PCD',                        // PCD диска
                ];
                foreach ($arPropertyCode as $propertyCode) {
                    $res = \CIBlockPropertyEnum::GetList(
                        ['SORT'=>'ASC', 'ID'=>'ASC'],
                        ['IBLOCK_ID' => \SP\Config::get('iblock_main_catalog_id'), 'CODE' => $propertyCode]
                    );
                    while ($arItem = $res->Fetch()) {
                        //print_r( $arItem ); exit;
                        $arLists['str_for_debug'][ $propertyCode ][ $arItem['ID'] ] = $arItem['VALUE']; // Для отладки

                        if (in_array( $arItem['VALUE'], ['*', 'N'] )) {
                            // "Странные" значения "*" не нужны. "N" в 'VYLET_LEGKOVOGO_DISKA_ET' тоже не нужно.
                            continue;
                        }

                        if ($propertyCode != 'PCD') {
                            $value = $arItem['VALUE'];
                            $arLists[ $propertyCode ][ $value ] = $arItem['ID'];

                        } else {
                            /*  PCD # 4x100; 4x100/4x108; 4x108; 4х114.3
                                $arLists['PCD'] = [
                                    4 => [
                                        100   => [10001, 10002],
                                        108   => [10003, 10007],
                                        114.3 => [10005],
                                    ],
                                ]
                            */
                            $ar = explode('/', $arItem['VALUE']);
                            foreach ($ar as $value) {
                                $ar_2 = explode('x', $value);
                                if (count($ar_2) == 2) {
                                    $arLists[ $propertyCode ][ $ar_2[0] ][ $ar_2[1] ][] = $arItem['ID'];
                                }
                            }
                        }
                    }
                } //

                // tyre: vendor
                $arLists['tyre_vendor'] = [];
                $entityClass = \SP\MainClass::getHighloadBlockEntityClass( \SP\Config::get('hlblock_tyre_id') );
                $res = $entityClass::getList([
                    'select' => ['UF_VENDOR'],
                    'group'  => ['UF_VENDOR'],
                    'order'  => ['UF_VENDOR'],
                ]);
                while ($item = $res->Fetch()) {
                    $arLists['tyre_vendor'][] = $item['UF_VENDOR'];
                }            

            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }

            $arLists['date'] = date("Y-m-d H:i:s");
            
            // Запишем в кеш
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cache_dir);
            $CACHE_MANAGER->RegisterTag( 'iblock_id_'. \SP\Config::get('iblock_main_catalog_id') );
            $CACHE_MANAGER->EndTagCache();
            $obCache->EndDataCache( $arLists );
        } //
        
        self::$arLists = $arLists;
        
        return self::$arLists;
    } // function

    public static function getData($params) {
        /*  getData([
                'tyreOrWheel' => $tyreOrWheel,
                'arFields'    => $arFields,
            ])
        */
        $result = [
            'error_msg' => '',
            'items'     => [],
        ];

        $arFields = $params['arFields'];

        switch ($params['tyreOrWheel']) {
            case 'tyre':
            case 'wheel':
                $hlblock_id = \SP\Config::get('hlblock_tyre_id');
                break;
            case 'akkumulyatory':
                $hlblock_id = \SP\Config::get('hlblock_battery_id');
                break;
            default:
                $result['error_msg'] = 'tyreOrWheel';
                return $result;
        } //

        $entityClass = \SP\MainClass::getHighloadBlockEntityClass($hlblock_id);

        $arParams    = [];
        $ufFieldName = '';

        $arFields['MODIFICATION'] = null;

        foreach ($arFields as $fieldName => $value) {
            $ufFieldName = "UF_{$fieldName}";

            if ($value === null or $fieldName == 'MODIFICATION') {
                $arParams['select'] = [$ufFieldName];
                $arParams['group']  = [$ufFieldName];
                $arParams['order']  = [$ufFieldName];
                break;
            }

            $arParams['filter'][ "={$ufFieldName}" ] = $value;
        }

        $res = $entityClass::getList($arParams);
        while ($item = $res->Fetch()) {
            $result['items'][] = $item[ $ufFieldName ];
        }            

        return $result;
    } // function

    public static function getFilter($arParams) {
        $arFields    = $arParams['arFields'];
        $tyreOrWheel = $arParams['tyreOrWheel'];
        
        $arResult = [
            'filter'                  => [],
            'specification_raw'       => [],
            'specification_formatted' => [],
            'tyreOrWheel'             => $tyreOrWheel,
        ];

        $arFilter = [
            'LOGIC' => 'OR',
        ];

        $arLists = self::get_arLists();

        if ($tyreOrWheel == 'tyre') {
            $entityClass = \SP\MainClass::getHighloadBlockEntityClass( \SP\Config::get('hlblock_tyre_id') );

            $arSelect = [
                'ID',
                'UF_DIAMETER',
                'UF_WIDTH',
                'UF_PROFILE',
            ];
        } else {
            // wheel
            $entityClass = \SP\MainClass::getHighloadBlockEntityClass( \SP\Config::get('hlblock_wheel_id') );

            $arSelect = [
                'ID',
                'UF_DIAMETER',
                'UF_WIDTH',
                'UF_ET',
                'UF_LZ',
                'UF_PCD',
            ];
        }
        $res = $entityClass::getList([
            'select' => $arSelect,
            'filter' => [
                '=UF_VENDOR'       => $arFields['VENDOR'],
                '=UF_MODEL'        => $arFields['MODEL'],
                '=UF_YEAR'         => $arFields['YEAR'],
                '=UF_MODIFICATION' => $arFields['MODIFICATION'],
            ],
            'order' => 'ID',
        ]);
        while ($item = $res->Fetch()) {
            $arResult['specification_raw'][] = $item;

            foreach ($item as $key => $value) {
                if ($value == '') {
                    // Не все поля записи заполнены ("кривая" база) - пропускаем
                    continue 2;
                }
                $item[ $key ] = (string) (float) $value; // Убираем лишние нули после запятой
            }
            $arResult['specification_formatted'][] = $item;

            if ($tyreOrWheel == 'tyre') {
                if (isset($arLists['DIAMETR'][ $item['UF_DIAMETER'] ])
                    and isset($arLists['SHIRINA'][ $item['UF_WIDTH'] ])
                    and isset($arLists['PROFIL'][ $item['UF_PROFILE'] ])
                ) {
                    $arFilter[] = [
                        'PROPERTY_DIAMETR' => $arLists['DIAMETR'][ $item['UF_DIAMETER'] ],
                        'PROPERTY_SHIRINA' => $arLists['SHIRINA'][ $item['UF_WIDTH'] ],
                        'PROPERTY_PROFIL'  => $arLists['PROFIL' ][ $item['UF_PROFILE'] ],
                    ];
										
                }
            } else {
                // wheel
                if (isset($arLists['DIAMETR'][ $item['UF_DIAMETER'] ])
                    and isset($arLists['VYLET_LEGKOVOGO_DISKA_ET'][ $item['UF_ET'] ])
                    and isset($arLists['PCD'][ $item['UF_LZ'] ][ $item['UF_PCD'] ])
                    and isset($arLists['SHIRINA_LEGKOVOGO_DISKA'][ $item['UF_WIDTH'] ])
                    ) {
                    $arFilter[] = [
                        'PROPERTY_DIAMETR'                  => $arLists['DIAMETR'][ $item['UF_DIAMETER'] ],
                        'PROPERTY_VYLET_LEGKOVOGO_DISKA_ET' => $arLists['VYLET_LEGKOVOGO_DISKA_ET'][ $item['UF_ET'] ],
                        'PROPERTY_PCD'                      => $arLists['PCD'][ $item['UF_LZ'] ][ $item['UF_PCD'] ],
                        'PROPERTY_SHIRINA_LEGKOVOGO_DISKA' => $arLists['SHIRINA_LEGKOVOGO_DISKA'][ $item['UF_WIDTH'] ],
                    ];
                }
            }
        }
        if (count($arFilter) > 1) {
            $arResult['filter'] = $arFilter;
        } else {
            // Нет данных: либо данные для этой модели в БД не заполнены ("кривая" БД), либо нет таких значений в инфоблоке (например ширина "999")
            $arResult['filter'] = ['ID' => 0];
        }

        return $arResult;
    } // function

    public static function getFilterBattery($arParams) {
        $arFields    = $arParams['arFields'];
        $tyreOrWheel = $arParams['tyreOrWheel'];
        
        $arResult = [
            'filter'                  => ['ID' => 0],
            'specification_raw'       => [],
            'specification_formatted' => [],
            'tyreOrWheel'             => $tyreOrWheel,
            'debug_info'              => [],
        ];

        try {
            $arFilter = [];

            $properties = self::get_listsBattery(['key' => 'properties']);

            $arFieldNameToPropertyName = [
                'CAPACITY' => 'AKKUMULYATOR_EMKOST',
                'AMPERAGE' => 'AKKUMULYATOR_PUSKOVOY_TOK',
                'LEN'      => 'AKKUMULYATOR_DLINNA',
                'WIDTH'    => 'AKKUMULYATOR_SHIRINA',
                'HEIGHT'   => 'AKKUMULYATOR_VYSOTA',
            ];

            $arFieldTitle = [
                'CAPACITY' => 'Емкость',
                'AMPERAGE' => 'Пусковой ток',
                'LEN'      => 'Длина',
                'WIDTH'    => 'Ширина',
                'HEIGHT'   => 'Высота',
            ];

            $arSelect = [
                'ID',
                'UF_POLARITY',
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

            $entityClass = \SP\MainClass::getHighloadBlockEntityClass( \SP\Config::get('hlblock_battery_id') );

            // Если для одной модели две записи, то POLARITY для первой "1", для второй "2". Остальные параметры одинаковые. См. include/Test.php

            $res = $entityClass::getList([
                'select' => $arSelect,
                'filter' => [
                    '=UF_VENDOR'       => $arFields['VENDOR'],
                    '=UF_MODEL'        => $arFields['MODEL'],
                    '=UF_YEAR'         => $arFields['YEAR'],
                    '=UF_MODIFICATION' => $arFields['MODIFICATION'],
                ],
                'order' => 'ID',
                'limit' => 2,
            ]);

            while ($item = $res->Fetch()) {
                $arResult['specification_raw'][] = $item;
            }

            if (!$arResult['specification_raw']) throw new Exception('not found'); // Не ожидается

            $item = $arResult['specification_raw'][0];

            // Свойства "от-до"
            foreach ($arFieldNameToPropertyName as $fieldName => $propertyName) {
                $arTmp = [];

                foreach ($properties[ $propertyName ] as $propValue => $propValueId) {
                    if ($propValue >= $item["UF_{$fieldName}_FROM"] and $propValue <= $item["UF_{$fieldName}_TO"]) {
                        $arTmp[] = $propValueId;
                        $arResult['debug_info'][ $propertyName ][] = $propValue;
                    }
                }

                if (!$arTmp) throw new Exception("Для {$fieldName} нет соответствующего значения {$propertyName}");

                $arFilter[ "PROPERTY_{$propertyName}" ] = $arTmp;

                $arResult['specification_formatted'][ $fieldName ] = $arFieldTitle[ $fieldName ] .': '. $item["UF_{$fieldName}_FROM"] .' - '. $item["UF_{$fieldName}_TO"];
            } //

            // Тип клемм
            $value = ($properties['AKKUMULYATOR_TIP_KLEM'][ $item['UF_TYPE'] ]) ?? 0;
            if (!$value) throw new Exception("Для UF_TYPE нет соответствующего значения AKKUMULYATOR_TIP_KLEM");
            $arFilter['=PROPERTY_AKKUMULYATOR_TIP_KLEM'] = $value;
            
            $arType = [
                1 => 'Европейский',
                2 => 'Азиатский',
                3 => 'Плоский',
                4 => 'Американский',
            ];
            $arResult['specification_formatted']['TYPE'] = 'Тип клемм: '. $arType[ $item['UF_TYPE'] ];

            // Полярность
            $str = '';
            if (count($arResult['specification_raw']) == 1) {
                $value = ($properties['AKKUMULYATOR_POLYARNOST'][ $item['UF_POLARITY'] ]) ?? 0;
                if (!$value) throw new Exception("Для UF_POLARITY нет соответствующего значения AKKUMULYATOR_POLYARNOST");
                $arFilter['=PROPERTY_AKKUMULYATOR_POLYARNOST'] = $value;
                
                $str = ($item['UF_POLARITY'] == 1) ? 'Прямая' : 'Обратная';
            } else {
                $str = 'Прямая / Обратная';
            }

            $arResult['specification_formatted']['POLARITY'] = "Полярность: {$str}";

            $arResult['filter'] = $arFilter;

        } catch (Exception $e) {
            $arResult['debug_info'][] = $e->getMessage();
        } //

        return $arResult;
    } // function

    public static function get_listsBattery($params=[]) {
        /*  get_listsBattery([
                'flagClearCache' => true,
                'cache_time'     => 3600 * 10,
                'key'            => 'vendor',
            ])
        */
    
        $flagClearCache = ($params['flagClearCache']) ?? false;
        $cache_time     = ($params['cache_time'])     ?? self::$arLists_cache_time; //36000000;
    
        $lists = &self::$listsBattery;
    
        if (!$flagClearCache) {
            $flagClearCache = (\SP\MainClass::getFromRequest('clear_cache') == 'Y');
        }
    
        if ($flagClearCache or !$lists) {
    
            $cache_id  = 'one';
            $cache_dir = '/sp/TyreSelection/get_listsBattery';
    
            $obCache = new \CPHPCache;
    
            if ($flagClearCache) {
                $obCache->Clean($cache_id, $cache_dir); // Очистка кеша
            }
    
            if ($obCache->InitCache($cache_time, $cache_id, $cache_dir)) {
                // Берем из кеша
                $lists = $obCache->GetVars();
                
            } elseif ($obCache->StartDataCache()) {

                \Bitrix\Main\Loader::includeModule('iblock');

                // ### Свойства. Тип "список"
                $lists['properties'] = [];

                $arPropertyCode = [
                    'AKKUMULYATOR_POLYARNOST',
                    'AKKUMULYATOR_TIP_KLEM',
                    'AKKUMULYATOR_EMKOST',
                    'AKKUMULYATOR_PUSKOVOY_TOK',
                    'AKKUMULYATOR_DLINNA',
                    'AKKUMULYATOR_SHIRINA',
                    'AKKUMULYATOR_VYSOTA',
                ];

                foreach ($arPropertyCode as $propertyCode) {
                    $res = \CIBlockPropertyEnum::GetList(
                        $t_arOrder  = ['VALUE'=>'ASC'],
                        $t_arFilter = ['IBLOCK_ID' => \SP\Config::get('iblock_main_catalog_id'), 'CODE' => $propertyCode]
                    );
                    while ($item = $res->Fetch()) {
                        $value = (int) $item['VALUE'];
                        $lists['properties'][ $propertyCode ][ $value ] = $item['ID'];
                    }
                } //
                // ### )

                // ### vendor (
                $lists['vendor'] = [];

                $entityClass = \SP\MainClass::getHighloadBlockEntityClass( \SP\Config::get('hlblock_battery_id') );

                $res = $entityClass::getList([
                    'select' => ['UF_VENDOR'],
                    'group'  => ['UF_VENDOR'],
                    'order'  => ['UF_VENDOR'],
                ]);
                while ($item = $res->Fetch()) {
                    $lists['vendor'][] = $item['UF_VENDOR'];
                }            
                // ### )

                $lists['date'] = date('Y-m-d H:i:s');
                
                // Запишем в кеш
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache($cache_dir);
                $CACHE_MANAGER->RegisterTag( 'iblock_id_'. \SP\Config::get('iblock_main_catalog_id') );
                $CACHE_MANAGER->EndTagCache();
                $obCache->EndDataCache($lists);
            } //
        } //
    
        $result = [];
    
        if (empty($params['key'])) {
            $result = $lists;
        } else {
            $result = ($lists[ $params['key'] ]) ?? [];
        } //
    
        return $result;
    } // function
    
    /*
    private static function fLog($msg, $label=null) {
        \SP_Log::fLog($msg, $label, ['prefix'=>'tyre_selection']);
    } //
    */

    private static function fLog_2($msg, $label=null) {
        \SP_Log::consoleLog( $msg, $label );
    } //

} // class
