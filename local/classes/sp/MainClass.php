<?
namespace SP;

class MainClass {

    public static function getFromRequest( $fieldName ) {
        /*  \SP\MainClass::getFromRequest('fieldName');
            \SP\MainClass::getFromRequest(['fieldName_1', 'fieldName_2', ]);
        */
        
        if (is_array($fieldName)) {
            $result = [];
            foreach ($fieldName as $value) {
                $result[$value] = (isset($_REQUEST[ $value ])) ? $_REQUEST[ $value ] : null;
            }
        } else {
            $result = (isset($_REQUEST[ $fieldName ])) ? $_REQUEST[ $fieldName ] : null;
        }

        return $result;
    } // function

    public static function getHighloadBlockEntityClass( $highloadBlockId ) {
        \Bitrix\Main\Loader::includeModule('highloadblock');

        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById( $highloadBlockId )->fetch();
        $entity  = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock ); // Генерация класса
        $entityClass = $entity->getDataClass();
        
        return $entityClass;
    } // function

} // class