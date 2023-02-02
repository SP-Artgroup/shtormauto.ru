<?
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use SP\Shop as SPShop;

ShtormautoAction::getInstance()->executeComponent();

class ShtormautoAction
{
    private $error = [];

    //Здесь хранится экземпляр класса
    private static $_Instance;

    // Корзина до изменений
    private $basket;

    public static function getInstance()
    {
        //Проверяем был ли создан объект ранее
        if (!self::$_Instance) {
            //Если нет, то создаем его
            self::$_Instance = new self();
        }
        //Возвращаем объект
        return self::$_Instance;
    }

    //переменная для хранения имени шаблона, на разных этапах используются разные шаблоны
    //private $templatePage = '';

    public function executeComponent()
    {
        global $arParams;
        global $USER, $DB, $APPLICATION;

        $this->Init();

        $this->templatePage    = '';
        $this->compareName     = 'CATALOG_COMPARE_LIST';
        $this->ProductIblockID = 3;

        if (sizeof($this->error) == 0) {
            $action = '';

            if (isset($this->arParams['action'])) {
                $action = $this->arParams['action'];
            }

            if (isset($_REQUEST['action'])) {
                $action = $_REQUEST['action'];
            }

            switch ($action) {
                case 'add_to_basket':
                    $arResult = $this->AddToBasket();
                    break;
                case 'basket_change_quantity':
                    $arResult = $this->BasketChangeQuantity();
                    break;
                case 'add_to_compare':
                    $arResult = $this->AddToCompare();
                    break;
                case 'delete_from_compare':
                    $arResult = $this->DeleteFromCompare();
                    break;
                case 'add_to_delay':
                    $arResult = $this->AddToDelay();
                    break;
                default:
                    $arResult = $this->GetData();
                    break;
            }
        }

        $this->arResult           = $arResult;
        $this->arResult['ERRORS'] = array_merge($this->error, $arResult['ERRORS']);

        echo json_encode($this->arResult);
    }

    public function Init()
    {
        global $USER;
    }

    //Изменение количества в корзине
    public function BasketChangeQuantity()
    {
        global $USER, $DB, $APPLICATION;

        $arResult = [
            'ERRORS' => [],
        ];

        Loader::includeModule('catalog');
        Loader::includeModule('sale');

        $context = Context::getCurrent();
        $request = $context->getRequest();
        $post    = $request->getPostList();

        if (!$basket_id = intval($_REQUEST['basket_id'])) {
            $arResult['ERRORS']['basket_id'] = 'Не задан id товара';
            return $arResult;
        }

        if (!$quantity = intval($_REQUEST['quantity'])) {
            $arResult['ERRORS']['quantity'] = 'Не задано количество';
            return $arResult;
        }

        if (!$shopId = intval($_REQUEST['store_id'])) {
            $arResult['ERRORS']['store_id'] = 'Не выбран склад';
            return $arResult;
        }

        $basket     = $this->getBasket();
        $basketItem = $basket->getItemById($basket_id);

        if ($basketItem) {

            $productId = $basketItem->getProductId();

            if (!$this->checkQuantity($productId, $shopId, $quantity, false)) {
                $arResult['ERRORS']['quantity'] = 'Невозможно добавить данное количество товара';
                return $arResult;
            }

            if (!CSaleBasket::Update($basket_id, ['QUANTITY' => $quantity])) {

                if ($ex = $APPLICATION->GetException()) {
                    $arResult['ERRORS'][] = $ex->GetString();
                }

            }
        } else {
            $arResult['ERRORS']['basket_id'] = 'Товар не найден';
        }

        //получение количества товаров в корзине
        if (count($arResult['ERRORS']) <= 0) {

            $arBasketItems = [];
            $total_price   = 0;

            $dbBasketItems = CSaleBasket::GetList(
                [
                    'NAME' => 'ASC',
                    'ID'   => 'ASC',
                ],
                [
                    'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                    'LID'      => SITE_ID,
                    'ORDER_ID' => 'NULL',
                    'DELAY'    => 'N',
                    'CAN_BUY'  => 'Y',
                ],
                false,
                false,
                ["ID", "NAME", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "PRODUCT_PRICE_ID", "QUANTITY", "DELAY", "CAN_BUY",
                "PRICE", "WEIGHT", "DETAIL_PAGE_URL", "NOTES", "CURRENCY", "VAT_RATE", "CATALOG_XML_ID",
                "PRODUCT_XML_ID", "SUBSCRIBE", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS", "TYPE", "SET_PARENT_ID"]
            );

            $basketItems = [];
            $allSum      = 0;
            $allWeight   = 0;

            while ($dbItem = $dbBasketItems->fetch()) {
                $allSum        += ($dbItem["PRICE"] * $dbItem["QUANTITY"]);
                $allWeight     += ($dbItem["WEIGHT"] * $dbItem["QUANTITY"]);
                $basketItems[] = $dbItem;
            }

            // Расчёт скидок

            $arOrder = array(
               'SITE_ID'      => SITE_ID,
               'USER_ID'      => $USER->GetID(),
               'ORDER_PRICE'  => $allSum, // сумма всей корзины
               'ORDER_WEIGHT' => $allWeight, // вес всей корзины
               'BASKET_ITEMS' => $basketItems // товары сами
            );

            $arOptions = [
                'COUNT_DISCOUNT_4_ALL_QUANTITY' => "Y",
            ];

            $arErrors = [];

            CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);

            foreach ($arOrder['BASKET_ITEMS'] as $arItems) {

                $arBasketItems[] = $arItems;
                $total_price     += $arItems['PRICE'] * $arItems['QUANTITY'];

                if ($basket_id == $arItems['ID']) {

                    Loader::includeModule('currency');

                    $arResult['added_product'] = [
                        'basketId'  => $arItems['ID'],
                        'productId' => $arItems['PRODUCT_ID'],
                        'quantity'  => $arItems['QUANTITY'],
                        // 'price'     => $arItems['PRICE'],
                        'formatSum' => "&#8381;".((int) $arItems['PRICE'] * $arItems['QUANTITY']),
 /*                       'formatSum' => CCurrencyLang::CurrencyFormat(
                            (int) $arItems['PRICE'] * $arItems['QUANTITY'], 'RUB'
                        ),*/
                        'props'     => [],
                    ];
                }
            }

            $arResult['basket_count'] = 'Товаров: ' . sizeof($arBasketItems);
            $arResult['basket_price'] = "&#8381;".$total_price;
        }

        return $arResult;
    }

    //Добавление товара в корзину
    public function AddToBasket()
    {
        Loader::includeModule('catalog');
        Loader::includeModule('sale');

        global $APPLICATION;

        $context = Context::getCurrent();
        $request = $context->getRequest();
        $post    = $request->getPostList();

        $arResult = [
            'ERRORS' => [],
        ];

        $productId = intval($post['product_id']);
        $quantity  = intval($post['quantity']);
        $shopId    = intval($post['store_id']); // 'store_id' is a 'shop_id' (legacy)

        if (!$productId) {
            $arResult['ERRORS']['product_id'] = 'Не задан id товара';
        }

        if (!$quantity) {
            $quantity = 1;
        }

        $arRewriteFields = [];
        $arProductParams = [];

        if (!$shopId) {
            $arResult['ERRORS']['store_id'] = 'Не выбран склад';
            return $arResult;
        }

        if (!$this->checkQuantity($productId, $shopId, $quantity)) {
            $arResult['ERRORS']['store_amount'] = 'Невозможно добавить данное количество товара';
            return $arResult;
        }

        if ($storeName = SPShop::getShopData($shopId)[$shopId]['NAME']) {
            $arProductParams[] = [
                'NAME'  => $storeName,
                'CODE'  => 'STORE_ID',
                'VALUE' => $shopId,
            ];
        }

        if (isset($_REQUEST['price_id']) && intval($_REQUEST['price_id'])) {
            $arRewriteFields['PRODUCT_PRICE_ID'] = intval($_REQUEST['price_id']);
        }

        // Добавление товара в корзину
        if (!$productBasketId = Add2BasketByProductID($productId, $quantity, $arRewriteFields, $arProductParams)) {
            if ($ex = $APPLICATION->GetException()) {
                $arResult['ERRORS'][] = $ex->GetString();
            }

        }

        //получение количества товаров в корзине
        if (count($arResult['ERRORS']) <= 0) {
            $arBasketItems = [];

            $total_price   = 0;
            $dbBasketItems = CSaleBasket::GetList(
                [
                    'NAME' => 'ASC',
                    'ID'   => 'ASC',
                ],
                [
                    'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                    'LID'      => SITE_ID,
                    'ORDER_ID' => 'NULL',
                    'DELAY'    => 'N',
                    'CAN_BUY'  => 'Y',
                ],
                false,
                false,
                ['ID', 'PRODUCT_ID', 'PRICE', 'QUANTITY']
            );
            while ($item = $dbBasketItems->Fetch()) {

                if ((int) $item['ID'] === $productBasketId) {

                    $arResult['added_product'] = [
                        'basketId'  => $item['ID'],
                        'productId' => $item['PRODUCT_ID'],
                        'quantity'  => $item['QUANTITY'],
                        'props'     => [],
                    ];
                }

                $arBasketItems[] = $item;
                $total_price += $item['PRICE'] * $item['QUANTITY'];
            }

            $arResult['basket_count'] = 'Товаров: ' . count($arBasketItems);
            $arResult['basket_price'] = "&#8381;".$total_price;
        }

        return $arResult;
    }

    //Добавление товара в отложенные
    public function AddToDelay()
    {
        global $USER, $DB, $APPLICATION;

        $arResult           = [];
        $arResult['ERRORS'] = [];

        CModule::IncludeModule('catalog');
        CModule::IncludeModule('sale');

        $quantity = 1;

        if (intval($_REQUEST['product_id'])) {
            $product_id = intval($_REQUEST['product_id']);
        } else {
            $arResult['ERRORS']['product_id'] = 'Не задан id товара';
        }

        $arSelect = ['ID', 'NAME', 'DETAIL_PAGE_URL'];
        $arFilter = ['ID' => $product_id];
        $res      = CIBlockElement::GetList([], $arFilter, false, ['nTopCount' => 1], $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields  = $ob->GetFields();
            $arProduct = $arFields;

            $arPrice = CCatalogProduct::GetOptimalPrice($product_id, $quantity, $USER->GetUserGroupArray(), $renewal);
            if (!$arPrice || count($arPrice) <= 0) {
                if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($product_id, $quantity, $USER->GetUserGroupArray())) {
                    $quantity = $nearestQuantity;
                    $arPrice  = CCatalogProduct::GetOptimalPrice($product_id, $quantity, $USER->GetUserGroupArray(), $renewal);
                }
            }
            //dump($arPrice);
            if (is_array($arPrice) && sizeof($arPrice) > 0) {
                $fUserID = CSaleBasket::GetBasketUserID(true);
                $fUserID = IntVal($fUserID);

                $arFields = [
                    'PRODUCT_ID'       => $product_id,
                    'PRODUCT_PRICE_ID' => $arPrice['PRICE']['ID'],
                    'PRICE'            => $arPrice['PRICE']['PRICE'],
                    'CURRENCY'         => $arPrice['PRICE']['CURRENCY'],
                    'WEIGHT'           => 0,
                    'QUANTITY'         => $quantity,
                    'LID'              => 's1',
                    'DELAY'            => 'Y',
                    'CAN_BUY'          => 'Y',
                    'NAME'             => $arProduct['NAME'],
                    'MODULE'           => 'sale',
                    'NOTES'            => '',
                    'DETAIL_PAGE_URL'  => $arProduct['DETAIL_PAGE_URL'],
                    'FUSER_ID'         => $fUserID,
                ];
                //dump($arFields);
                CSaleBasket::Add($arFields);
            }
        }

        $delay_products          = MasterSU::GetInstance()->GetDelayProducts();
        $arResult['delay_count'] = sizeof($delay_products);

        return $arResult;
    }

    //Получение данных об количестве товара в корзине, в отложенных, в сравнении
    public function GetData()
    {
        global $USER, $DB, $APPLICATION;

        $arResult           = [];
        $arResult['ERRORS'] = [];

        CModule::IncludeModule('catalog');
        CModule::IncludeModule('sale');

        $arResult['compare_count'] = sizeof($_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS']);

        $arBasketItems = [];
        $arDelayItems  = [];

        $total_price   = 0;
        $dbBasketItems = CSaleBasket::GetList(
            [
                'NAME' => 'ASC',
                'ID'   => 'ASC',
            ],
            [
                'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                'LID'      => SITE_ID,
                'ORDER_ID' => 'NULL',
                // "DELAY" => "N",
            ],
            false,
            false,
            ['ID', 'DELAY', 'PRICE', 'QUANTITY']
        );
        while ($arItems = $dbBasketItems->Fetch()) {
            if ($arItems['DELAY'] == 'Y') {
                $arDelayItems[] = $arItems;
            } else {
                $arBasketItems[] = $arItems;
                $total_price += $arItems['PRICE'] * $arItems['QUANTITY'];
            }
        }

        $arResult['basket_count'] = 'Товаров: ' . sizeof($arBasketItems);
        $arResult['basket_price'] = "&#8381;".$total_price;
        $arResult['delay_count']  = sizeof($arDelayItems);

        return $arResult;
    }

    public function DeleteFromCompare()
    {
        global $USER, $DB, $APPLICATION;

        $arResult           = [];
        $arResult['ERRORS'] = [];

        CModule::IncludeModule('catalog');
        CModule::IncludeModule('sale');

        if (intval($_REQUEST['product_id'])) {
            $product_id = intval($_REQUEST['product_id']);
        } else {
            $arResult['ERRORS']['product_id'] = 'Не задан id товара';
        }

        if (isset($_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS'][$product_id])) {
            unset($_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS'][$product_id]);
        }

        $arResult['compare_count'] = sizeof($_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS']);

        return;
    }

    public function AddToCompare()
    {
        global $USER, $DB, $APPLICATION;

        $arResult           = [];
        $arResult['ERRORS'] = [];

        CModule::IncludeModule('catalog');
        CModule::IncludeModule('sale');

        if (intval($_REQUEST['product_id'])) {
            $product_id = intval($_REQUEST['product_id']);
        } else {
            $arResult['ERRORS']['product_id'] = 'Не задан id товара';
        }

        if (!isset($_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS'][$product_id])) {
            $arOffers         = CIBlockPriceTools::GetOffersIBlock($this->ProductIblockID);
            $OFFERS_IBLOCK_ID = $arOffers ? $arOffers['OFFERS_IBLOCK_ID'] : 0;

            $arSelect = [
                'ID',
                'IBLOCK_ID',
                'IBLOCK_SECTION_ID',
                'NAME',
                'DETAIL_PAGE_URL',
            ];
            $arFilter = [
                'ID'                => $product_id,
                'IBLOCK_LID'        => SITE_ID,
                'IBLOCK_ACTIVE'     => 'Y',
                'ACTIVE_DATE'       => 'Y',
                'ACTIVE'            => 'Y',
                'CHECK_PERMISSIONS' => 'Y',
                'MIN_PERMISSION'    => 'R',
            ];
            $arFilter['IBLOCK_ID'] = ($OFFERS_IBLOCK_ID > 0 ? [$this->ProductIblockID, $OFFERS_IBLOCK_ID] : $this->ProductIblockID);

            $rsElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

            //$rsElement->SetUrlTemplates($arParams["DETAIL_URL"]);
            if ($arElement = $rsElement->GetNext()) {
                $arMaster = false;
                if ($arElement['IBLOCK_ID'] == $OFFERS_IBLOCK_ID) {
                    $rsMasterProperty = CIBlockElement::GetProperty($arElement['IBLOCK_ID'], $arElement['ID'], [], ['ID' => $arOffers['OFFERS_PROPERTY_ID'], 'EMPTY' => 'N']);
                    if ($arMasterProperty = $rsMasterProperty->Fetch()) {
                        $rsMaster = CIBlockElement::GetList(
                            []
                            , [
                                'ID'        => $arMasterProperty['VALUE'],
                                'IBLOCK_ID' => $arMasterProperty['LINK_IBLOCK_ID'],
                                'ACTIVE'    => 'Y',
                            ]
                            , false, false, $arSelect);
                        //$rsMaster->SetUrlTemplates($arParams["DETAIL_URL"]);
                        $arMaster = $rsMaster->GetNext();
                    }
                }
                if ($arMaster) {
                    $arMaster['PARENT_ID']                                                      = $product_id;
                    $arMaster['NAME']                                                           = $arElement['NAME'];
                    $arMaster['DELETE_URL']                                                     = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=DELETE_FROM_COMPARE_LIST&id=' . $arMaster['ID'], ['action', 'id']));
                    $_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS'][$product_id] = $arMaster;
                } else {
                    $arElement['PARENT_ID']                                                     = $product_id;
                    $arElement['DELETE_URL']                                                    = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=DELETE_FROM_COMPARE_LIST&id=' . $arElement['ID'], ['action', 'id']));
                    $_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS'][$product_id] = $arElement;
                }
            } else {
                $arResult['ERRORS']['product'] = 'Товар не найден';
            }
        }

        $arResult['compare_count'] = sizeof($_SESSION[$this->compareName][$this->ProductIblockID]['ITEMS']);

        return $arResult;
    }

    /**
     * Проверяет возможно ли добавить данное количество товара в корзину
     * @param  int    $productId ID товара
     * @param  int    $shopId    ID магазина
     * @param  int    $quantity  Количество товара
     * @param  bool   $isAddMode Режим проверки (добавление кол-ва или установка кол-ва)
     * @return bool
     */
    private function checkQuantity(int $productId, int $shopId, int $quantity, bool $isAddMode = true)
    {
        $shopQuantity = 0;

        if ($rawStoreAmount = SPShop::getProductAmount($productId, $shopId)) {
            $shopQuantity = $rawStoreAmount[$productId][$shopId];
        };

        if (!$shopQuantity) {
            return false;
        }

        $basket = $this->getBasket();

        $basketQuantity = 0;

        if ($isAddMode) {
            foreach ($basket as $item) {

                if ((int) $item->getProductId() !== $productId) {
                    continue;
                }

                $props = $item->getPropertyCollection()->getPropertyValues();

                if (isset($props['STORE_ID']) && (int) $props['STORE_ID']['VALUE'] === $shopId) {
                    $basketQuantity = intval($item->getQuantity());
                }
            }
        }

        if ($quantity > ($shopQuantity - $basketQuantity)) {
            return false;
        }

        return true;
    }

    /**
     * Используется для мемоизации корзины до изменений
     * @return Bitrix\Sale\Basket
     */
    private function getBasket()
    {
        if ($this->basket) {
            return $this->basket;
        }

        $basket = Basket::loadItemsForFUser(
            Fuser::getId(),
            Context::getCurrent()->getSite()
        )
            ->getOrderableItems();

        return $this->basket = $basket;
    }

}

//if (!function_exists('BasketNumberWordEndings'))
//{
function BasketNumberWordEndings($num, $lang = false, $arEnds = false)
{
    if ($lang === false) {
        $lang = LANGUAGE_ID;
    }

    if ($arEnds === false) {
        $arEnds = ['ов', 'ов', '', 'а'];
    }

    if ($lang == 'ru') {
        if (strlen($num) > 1 && substr($num, strlen($num) - 2, 1) == '1') {
            return $arEnds[0];
        } else {
            $c = IntVal(substr($num, strlen($num) - 1, 1));
            if ($c == 0 || ($c >= 5 && $c <= 9)) {
                return $arEnds[1];
            } elseif ($c == 1) {
                return $arEnds[2];
            } else {
                return $arEnds[3];
            }

        }
    } elseif ($lang == 'en') {
        if (IntVal($num) > 1) {
            return 's';
        }
        return '';
    } else {
        return '';
    }
}

//}