<?php

use Wecanit\Car\UserCar;
use \Bitrix\Main\Localization\Loc;

class CarApiGet extends CBitrixComponent
{

    public function executeComponent ()
    {
        try {
            \Bitrix\Main\Loader::includeModule('wecanit.car');
            \Bitrix\Main\Loader::includeModule('wecanit.project');

            $car = new UserCar();

            $grz = strtoupper($this->request->get('grz'));

            if (!$grz) {
                throw new \Exception(Loc::GetMessage('GRZ_EMPTY'));
            }

            if (!$this->isValidGrz($grz)) {
                throw new \Exception(Loc::GetMessage('GRZ_NOT_VALID'));
            }

            $userCar = $car->getByGrz($grz);

            $this->arResult['RESULT'] = $userCar;
        } catch (Exception $e) {
            $this->arResult['RESULT'] = '';
            $this->arResult['ERROR'] = $e->getMessage();
        }

        $this->includeComponentTemplate();
    }

    private function isValidGrz(string $grz)
    {
        $matches = [];

        preg_match('/^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui', $grz, $matches);

        return !empty($matches);
    }
}