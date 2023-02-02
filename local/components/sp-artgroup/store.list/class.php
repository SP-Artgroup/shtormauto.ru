<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use SP\Shop as SPShop;

/**
*
*/
class StoreList extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        if (empty($params['PRODUCT_ID']) && empty($params['PRODUCT_DATA'])) {
            throw new Exception('Параметр PRODUCT_ID или PRODUCT_DATA пуст');
        }

        $params['PRODUCT_ID'] = (int) $params['PRODUCT_ID'];

        return $params;
    }

    public function executeComponent()
    {
        if (
            !empty($this->arParams['PRODUCT_DATA']['STORES'])
            && !empty($this->arParams['PRODUCT_DATA']['AMOUNTS'])
        ) {

            $this->arResult = $this->arParams['PRODUCT_DATA'];

        } else {

            $prodId  = $this->arParams['PRODUCT_ID'];
            $amounts = SPShop::getProductAmount($prodId)[$prodId];

            $this->arResult = [
                'STORES'     => !empty($amounts)
                    ? SPShop::getShopData(array_keys($amounts))
                    : [],
                'AMOUNTS'    => $amounts,
                'PRODUCT_ID' => $prodId,
            ];
        }

        $this->includeComponentTemplate();
    }
}