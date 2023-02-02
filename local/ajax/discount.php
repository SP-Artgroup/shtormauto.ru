<?
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

    use Bitrix\Main\Context;
    use Bitrix\Main\Loader;
    use Bitrix\Sale;
    use Bitrix\Sale\Internals;
    global $APPLICATION;
    global $USER;

    $request = Context::getCurrent()->getRequest();
    $idProduct = $request->get('idProduct');
    $couponError = '';

/*
    $idProductArray = array();
    array_push($idProductArray, $idProduct);

    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    $discountCheck = $arUser['UF_SKIDKA_SDAT_STARIY_AKKAMULYATOR'];

    $discountCheck = explode(", ", $discountCheck);

if (in_array($idProduct,$discountCheck)) {

 $discountCheck = array_diff($discountCheck, $idProductArray);

} else {
     array_push($discountCheck, $idProduct);
}
   $discountCheck = implode(", ", $discountCheck); 


    $userId = $USER::GetID();
    $user = new CUser;
    $fields= Array(
        "ACTIVE"            => "Y",
        "UF_SKIDKA_SDAT_STARIY_AKKAMULYATOR"      => $discountCheck,
    );

    if($userId > 0) {
    $user->Update($userId, $fields);
    }
*/


    if (Loader::includeModule('iblock') && $idProduct) {
        $arSelect = ['IBLOCK_SECTION_ID'];
        $arFilter = ["IBLOCK_ID" => IBLOCK_ID_CATALOG, "ID" => $idProduct];
        $res = CIBlockElement::GetList(["SORT"=>"ASC"], $arFilter, false, ["nPageSize"=>1], $arSelect)->getNext();
        if($res){
            $idSection = $res["IBLOCK_SECTION_ID"];
        };
    }

    $entityClass = \SP\MainClass::getHighloadBlockEntityClass(HLBLOCK_SECTIONS_DISCOUNTS);

    $idSections = [];
    $resSection = CIBlockSection::GetNavChain(false, $idSection);
    while ($section = $resSection->GetNext()) {
        array_push($idSections, $section["ID"]);
    }

    $sectionDiscount = $entityClass::getList([
        'select' => ['UF_DISCOUNT'],
        'filter' => ['UF_ID_SECTION' => $idSections]
    ])->Fetch();

    if ($sectionDiscount) {
        $discountValuePrec = $sectionDiscount['UF_DISCOUNT'];
    };

    if (Loader::includeModule('sale') && isset($discountValuePrec)) {
        $idUserBasket = Sale\Fuser::getId();
        $codeCoupon = "$idUserBasket-$idProduct";
        $couponsData = Sale\DiscountCouponsManager::getData($codeCoupon);

        //переводим скидку из процентов в валюту
        $oBasket = Sale\Basket::loadItemsForFUser(
            $idUserBasket,
            \Bitrix\Main\Context::getCurrent()->getSite()
        );
        foreach ($oBasket as $basketItem) {
            if ($basketItem->getProductId() == $idProduct) {
                $discountValueCur = $basketItem->getPrice() * $discountValuePrec / 100;
            }
        }

        if ($couponsData["ID"] == 0) {
            $arActions["CLASS_ID"] = "CondGroup";
            $arActions["DATA"]["All"] = "AND";
            $arActions["CHILDREN"][0]["CLASS_ID"] = "ActSaleBsktGrp";
            $arActions["CHILDREN"][0]["DATA"]["Type"] = "Discount";
            $arActions["CHILDREN"][0]["DATA"]["Value"] = $discountValueCur;
            $arActions["CHILDREN"][0]["DATA"]["Unit"] = "CurAll";
            $arActions["CHILDREN"][0]["DATA"]["All"] = "OR";
            $arActions["CHILDREN"][0]["DATA"]["True"] = "True";

            $arActions["CHILDREN"][0]["CHILDREN"][0]["CLASS_ID"] = "CondIBElement";
            $arActions["CHILDREN"][0]["CHILDREN"][0]["DATA"]["logic"] = "Equal";
            $arActions["CHILDREN"][0]["CHILDREN"][0]["DATA"]["value"] = $idProduct;

            $arConditions["CLASS_ID"] = "CondGroup";
            $arConditions["DATA"]["All"] = "AND";
            $arConditions["DATA"]["True"] = "True";
            $arConditions["CHILDREN"] = [];

            $arFields = [
                "LID" => "s1",
                "NAME" => $codeCoupon,
                "CURRENCY" => "RUB",
                "ACTIVE" => "Y",
                "USER_GROUPS" => [2],
                "ACTIVE_FROM" => "",
                "ACTIVE_TO" => "",
                'PRIORITY' => 1,
                'SORT' => 100,
                'LAST_DISCOUNT' => 'N',
                'LAST_LEVEL_DISCOUNT' => 'N',
                'XML_ID' => '',
                "CONDITIONS" => $arConditions,
                'ACTIONS' => $arActions
            ];

            $discountID = \CSaleDiscount::Add($arFields);

            if ($discountID > 0) {
                $couponFields = [
                    "DISCOUNT_ID" => $discountID,
                    "COUPON" => $codeCoupon,
                    "ACTIVE" => "Y",
                    "TYPE" => 1,
                    "MAX_USE" => 0
                ];
                // добавляем новый купон
                $addCouponRes = Internals\DiscountCouponTable::add($couponFields);
                if ($addCouponRes->isSuccess()) {
                    // применяем купон
                    Sale\DiscountCouponsManager::add($codeCoupon);
                } else {
                    $couponError .= $addCouponRes->getErrorMessages();
                }
            } else {
                $ex = $APPLICATION->GetException();
                $couponError .= 'Ошибка при создании нового правила скидок: ' . $ex->GetString();
            }
        } else {
            $idDiscoun = $couponsData['DISCOUNT_ID'];
            Internals\DiscountTable::delete($idDiscoun);
        }
    }

    $APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket",
        "basket-new",
        [
            "ACTION_VARIABLE" => "basket_action",
            "COLUMNS_LIST" => [
                0 => "NAME",
                1 => "DELETE",
                2 => "PRICE",
                3 => "QUANTITY",
                4 => "SUM",
            ],
            "COMPONENT_TEMPLATE" => "basket-new",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "HIDE_COUPON" => "N",
            "OFFERS_PROPS" => "",
            "PATH_TO_ORDER" => "/personal/order/make/",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "Y",
            "USE_PREPAYMENT" => "N",
            "CORRECT_RATIO" => "N",
            "AUTO_CALCULATION" => "Y",
            "USE_GIFTS" => "N",
            "COLUMNS_LIST_EXT" => [
                0 => "PREVIEW_PICTURE",
                1 => "DISCOUNT",
                2 => "DELETE",
                3 => "DELAY",
                4 => "TYPE",
                5 => "SUM",
            ],
            "COMPATIBLE_MODE" => "Y",
            "ADDITIONAL_PICT_PROP_26" => "-",
            "ADDITIONAL_PICT_PROP_32" => "-",
            "BASKET_IMAGES_SCALING" => "adaptive",
            // Custom
            'COUPON_ERROR' => $couponError,
            'DISCOUNT_CHECK' => $discountCheck
        ],
        false
    );

    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
