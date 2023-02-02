<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    'NAME'        => Loc::getMessage('SP_ARTGROUP_CITY_LIST_NAME'),
    'DESCRIPTION' => Loc::getMessage('SP_ARTGROUP_CITY_LIST_DESC'),
    'CACHE_PATH'  => 'Y',
    'PATH'        => [
        'ID'    => 'SP-ArtGroup',
        'NAME'  => Loc::getMessage('SP_ARTGROUP_VENDOR_NAME'),
    ],
];
