<?php use Bitrix\Main\Loader;
use Wecanit\Car\UserCar;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CarSelection extends CBitrixComponent {

    public function executeComponent() {
        $selectedCar = $this->getCar();
        $userCar = new UserCar();

        $body = $this->request->get('BODY');

        if ($body) {
            $selectedCar['body'] =  $body;
            $userCar->saveInCookie('body', $body);
        }

        if (empty($selectedCar)) {
            $this->arResult = [];
        } else {
            if (!$selectedCar[UserCar::BODY_KEY]) {
                $modifications = $userCar->getAutoWithModifications(
                    $selectedCar[UserCar::VENDOR_KEY],
                    $selectedCar[UserCar::MODEL_KEY],
                    $selectedCar[UserCar::YEAR_KEY]
                );

                if (empty($modifications) || empty($modifications['modifications'])) {
                    $selectedCar = [];
                } else {
                    $selectedCar['modifications'] = $modifications['modifications'];
                }
            }

            $this->arResult = $selectedCar;

            $this->arResult['NAME'] = $selectedCar[UserCar::VENDOR_KEY] . ' ' .
                $selectedCar[UserCar::MODEL_KEY] . ' (' . $selectedCar[UserCar::YEAR_KEY] . ' г.в.)';

            $this->arResult['ENGINE'] = $selectedCar[UserCar::WEIGHT_KEY] . 'cc, ' .
                $selectedCar[UserCar::POWER_KEY] . ' л.с., ' . $selectedCar[UserCar::FUEL_KEY];
        }

        $this->includeComponentTemplate();

        return $this->isSelectedCarInFilter($selectedCar);
    }

    /**
     * @param array $selectedCar
     * @return bool
     */
    private function isSelectedCarInFilter(array $selectedCar): bool
    {
        $filterVendor = $this->request->get('VENDOR');
        $filterModel = $this->request->get('MODEL');
        $filterYear = $this->request->get('YEAR');
        $filterBody = $this->request->get('MODIFICATION');

        return $selectedCar[UserCar::VENDOR_KEY] === $filterVendor
            && $selectedCar[UserCar::MODEL_KEY] === $filterModel
            && $selectedCar[UserCar::YEAR_KEY] === $filterYear
            && $selectedCar[UserCar::BODY_KEY] === $filterBody;
    }

    /**
     * @return array
     */
    private function getCar(): array
    {
        Loader::includeModule('wecanit.car');

        $userCar = new UserCar();

        return $userCar->getFromCookie();
    }
}
