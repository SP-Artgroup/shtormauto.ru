<div class="col-sm-4 col-md-3">
    <div>
        <?
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.brandblock',
            '.default',
            array(
                'IBLOCK_TYPE'  => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID'    => $arParams['IBLOCK_ID'],
                'ELEMENT_ID'   => $arResult['ID'],
                'ELEMENT_CODE' => '',
                'PROP_CODE'    => $arParams['BRAND_PROP_CODE'],
                'CACHE_TYPE'   => $arParams['CACHE_TYPE'],
                'CACHE_TIME'   => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                'WIDTH'        => '',
                'HEIGHT'       => ''
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );
        ?>
    </div>
</div>