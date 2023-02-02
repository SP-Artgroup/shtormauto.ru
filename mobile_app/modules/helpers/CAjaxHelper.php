<?php
class CAjaxHelper {
    public static function getCityShops(){
        $result = array("status" => false, "msg" => "Не найдено");
        $rsCity = CIBlockElement::GetList(array("name"=>"asc"),array("IBLOCK_ID"=>"15","ACTIVE"=>"Y"),false,false,array("ID","NAME"));
        $cities = [];
        while($arCity = $rsCity->Fetch()){
            $cities[$arCity["ID"]] = $arCity["NAME"];
        }
        $cityName = isset($_GET["CITY"]) ? trim($_GET["CITY"]) : false;
        $cityName = iconv("utf-8", "windows-1251", $cityName);
        if($cityName && in_array($cityName, $cities)) {
            $rsShops = CIBlockElement::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => "7", "ACTIVE" => "Y", "%PROPERTY_CITY" => $cityName), false, false, array("ID", "NAME", "PROPERTY_CITY"));
            if($rsShops->SelectedRowsCount()) {
                $result["status"] = true;
                $html = array();
                while($s = $rsShops->Fetch()) {
                    $html[] = "<option value='".$s['ID']."'>".$s["NAME"]."</option>";
                }
                $result["msg"] = $html;
            }
        }
        return $result;
    }

    public static function Add2Basket(){
        $result = array("status" => false, "msg" => "Не добавлено");
        if (isset($_POST["PRODUCT_ID"]) && $id = intval($_POST["PRODUCT_ID"])) {
            CModule::IncludeModule("catalog");
            $price = CPrice::GetList(array("ID" => "DESC"), array('PRODUCT_ID' => $id))->Fetch();
            $basket_id = Add2Basket($price["ID"], 1);
            if($basket_id) {
                $count = 1;
                $total = 0;
                if (CModule::includeModule("sale")) {
                    $sale = new CSaleBasket();
                    $fuser_id = $sale->GetBasketUserID();
                    $rsBasket = CSaleBasket::GetList(array("NAME" => "ASC"), array("LID" => SITE_ID, "ORDER_ID" => "NULL", 'FUSER_ID' => $fuser_id));
                    while($ar = $rsBasket->Fetch()) {
                        if($ar["PRODUCT_ID"] == $id) {
                            $count = intval($ar["QUANTITY"]);
                        }
                        $total += intval($ar["QUANTITY"]);
                    }
                }
                $_SESSION["CART"] = $total;
                $result = array("status" => true, "msg" => "Товар добавлен в корзину", "count" => $count, "total" => $total);
            }
        }
        return $result;
    }

    public static function NewsSubscribe(){
        $result = array("status" => false, "msg" => "Не добавлено");
        if (isset($_POST["EMAIL"]) && $email = trim($_POST["EMAIL"])) {
            CModule::IncludeModule("subscribe");
            $subscription = CSubscription::GetByEmail($email);
            if($s = $subscription->Fetch()){
                CSubscription::Delete($s["ID"]);
                $result = array("status" => true, "msg" => "Подписка удалена");
            } else {
                $arFields = array(
                    "FORMAT" => "html",
                    "EMAIL" => $email,
                    "ACTIVE" => "Y",
                    "RUB_ID" => array(1),
                    "CONFIRMED"=>"Y",
                    "SEND_CONFIRM" => "N",
                );
                $subscr = new CSubscription;
                //can add without authorization
                $ID = $subscr->Add($arFields);
                if($ID > 0){
                    $result = array("status" => true, "msg" => "Вы подписаны");
                } else {
                    $result = array("status" => false, "msg" => $subscr->LAST_ERROR);
                }
            }
        }
        return $result;
    }
}
