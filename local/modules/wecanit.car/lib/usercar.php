<?php

namespace Wecanit\Car;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Localization\Loc;
use Wecanit\Project\Hlblock\AlternateHlBlock;
use Wecanit\Project\Hlblock\NotFoundHlBlock;
use Wecanit\Project\Hlblock\TyreHlBlock;

class UserCar
{
    /** @var array */
    private $car = [];
    private $request;
    private $tyreHlBlock;
    private $alternateHlBlock;
    private $notFoundHlBlock;

    public const VENDOR_KEY = 'vendor';
    public const MODEL_KEY = 'model';
    public const YEAR_KEY = 'year';
    public const POWER_KEY = 'power';
    public const WEIGHT_KEY = 'weight';
    public const FUEL_KEY = 'fuel';
    public const DRIVE_KEY = 'drive';
    public const BODY_KEY = 'body';

    private const COOKIE_PREFIX = 'storm_';

    private const KEYS = [self::VENDOR_KEY, self::MODEL_KEY, self::YEAR_KEY, self::POWER_KEY,
                          self::WEIGHT_KEY, self::FUEL_KEY, self::DRIVE_KEY, self::BODY_KEY];

    public function __construct()
    {
        \Bitrix\Main\Loader::includeModule('wecanit.project');

        $this->request = Context::getCurrent()->getRequest();
        $this->tyreHlBlock = new TyreHlBlock();
        $this->alternateHlBlock = new AlternateHlBlock();
        $this->notFoundHlBlock = new NotFoundHlBlock();
    }

    /**
     * @param string $grz
     * @return array|string[]
     * @throws \Bitrix\Main\SystemException
     */
    public function getByGrz(string $grz): array
    {
        $reports = new Report();

        $report = $reports->getReportByGrz(strtoupper($grz));
        $userCar = $this->getCarFromReport($report);

        $autoWithModifications = $this->getAutoWithModifications(
            $userCar[self::VENDOR_KEY],
            $userCar[self::MODEL_KEY],
            $userCar[self::YEAR_KEY]
        );

        if (empty($autoWithModifications)) {
            $this->addAutoToNotFound($grz, $userCar);
            throw new \Exception(Loc::GetMessage('CAR_NOT_FOUND'));
        }

        if (!empty($userCar[self::BODY_KEY])) {
            $bodyParams = explode('-', $userCar[self::BODY_KEY]);

            if (is_array($bodyParams) && count($bodyParams) === 1) {
                $bodyParams = explode(' ', $bodyParams[0]);
            }

            $modification = array_shift($bodyParams);

            $isModification = false;

            foreach ($autoWithModifications['modifications'] as $item) {
                if (strripos($item, $modification)) {
                    $userCar[self::BODY_KEY] = $item;
                    $isModification = true;
                }
            }

            if (!$isModification) {
                unset($userCar[self::BODY_KEY]);
            }
        }

        $userCar[self::VENDOR_KEY] = $autoWithModifications[self::VENDOR_KEY];
        $userCar[self::MODEL_KEY] = $autoWithModifications[self::MODEL_KEY];

        if (empty($userCar[self::BODY_KEY])) {
            $userCar['modifications'] = $autoWithModifications['modifications'];
        }

        $this->car = $userCar;

        $this->saveToCookie();

        return $this->car;
    }

    /**
     * @param array $report
     * @return array|string[]
     */
    private function getCarFromReport(array $report): array
    {
        $car = [];

        foreach (self::KEYS as $key) {
            if ($report[$key]) {
                $car[$key] = $report[$key];
            }
        }

        return $car;
    }

    /**
     * @return array
     */
    public function getFromCookie(): array
    {
        $car = [];

        foreach (self::KEYS as $key) {
            $cookieValue = $this->request->getCookie(self::COOKIE_PREFIX . $key);

            if ($cookieValue) {
                $car[$key] = $cookieValue;
            }
        }

        if (empty($car[self::VENDOR_KEY]) || empty($car[self::MODEL_KEY]) || empty($car[self::YEAR_KEY])) {
            return [];
        }

        return $car;
    }

    /**
     * @throws \Bitrix\Main\SystemException
     */
    private function saveToCookie(): void
    {
        if (!empty($this->car[self::VENDOR_KEY])
            && !empty($this->car[self::MODEL_KEY])
            && !empty($this->car[self::YEAR_KEY]))
        {
            foreach (self::KEYS as $key) {
                $this->saveInCookie($key, $this->car[$key]);
            }
        }
    }

    /**
     * @param string $key
     * @param $value
     * @throws \Bitrix\Main\SystemException
     */
    public function saveInCookie(string $key, $value): void
    {
        $cookie = new Cookie(self::COOKIE_PREFIX . $key, $value);

        Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
    }

    /**
     * @param string $grz
     * @param array $auto
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private function addAutoToNotFound(string $grz, array $auto): void
    {
        $notFoundHlBlock = $this->notFoundHlBlock->getClass();

        $fieldsToAdd = [
            self::VENDOR_KEY => $this->notFoundHlBlock::VENDOR_FIELD,
            self::MODEL_KEY => $this->notFoundHlBlock::MODEL_FIELD,
            self::YEAR_KEY => $this->notFoundHlBlock::YEAR_FIELD,
            self::BODY_KEY => $this->notFoundHlBlock::MODIFICATION_FIELD,
        ];

        $transformedValues = [];

        foreach ($auto as $fieldName => $value) {
            if (isset($fieldsToAdd[$fieldName])) {
                $transformedValues[$fieldsToAdd[$fieldName]] = $value;
            }
        }

        $transformedValues[$this->notFoundHlBlock::GRZ_FIELD] = $grz;

        $isAutoInHlBlock = (bool) $notFoundHlBlock::getList([
            'filter' => [
                $this->notFoundHlBlock::GRZ_FIELD => $transformedValues[$this->notFoundHlBlock::GRZ_FIELD],
            ]
        ])->getSelectedRowsCount();

        if (empty($isAutoInHlBlock)) {
            $notFoundHlBlock::add($transformedValues);
        }
    }

    /**
     * @param string $value
     * @return string
     */
    private function getInLatinString(string $value): string
    {
        $charset = mb_detect_encoding($value);

        $unicodeString = \iconv($charset, "UTF-8", $value);

        return str_replace(['А', 'Е', 'О', 'С', 'М', 'Т'], ['A', 'E', 'O', 'C', 'M', 'T'], $unicodeString);
    }

    /**
     * @param string $vendor
     * @param string $model
     * @param int $year
     * @return array
     */
    public function getAutoWithModifications(string $vendor, string $model, int $year): array
    {
        $TyreHBClass = $this->tyreHlBlock->getClass();
        $alternateHBlockClass = $this->alternateHlBlock->getClass();

        $vendorValue = $this->getInLatinString($vendor);
        $modelValue = $this->getInLatinString($model);

        $filterForAlternate = [
            $this->alternateHlBlock::ALTERNATE_FIELD => [$vendorValue, $modelValue]
        ];

        $alternateNames = $alternateHBlockClass::getList([
            'filter' => $filterForAlternate,
        ])->fetchAll();

        foreach ($alternateNames as $alternateName) {
            if (is_array($alternateName[$this->alternateHlBlock::ALTERNATE_FIELD])) {
                if (in_array($modelValue, $alternateName[$this->alternateHlBlock::ALTERNATE_FIELD])) {
                    $modelValue = $alternateName[$this->alternateHlBlock::NAME_FIELD];
                }

                if (in_array($vendorValue, $alternateName[$this->alternateHlBlock::ALTERNATE_FIELD])) {
                    $vendorValue = $alternateName[$this->alternateHlBlock::NAME_FIELD];
                }
            }
        }

        list($vendorFilter) = explode(' ', trim($vendorValue)) ?? [''];

        $filter = [
            $this->tyreHlBlock::VENDOR_FIELD => $vendorFilter,
            $this->tyreHlBlock::MODEL_FIELD => $modelValue,
            $this->tyreHlBlock::YEAR_FIELD  => $year,
        ];

        $auto = [];

        $res = $TyreHBClass::getList([
            'filter' => $filter,
            'group'  => [$this->tyreHlBlock::MODIFICATION_FIELD],
            'select' => [
                $this->tyreHlBlock::MODIFICATION_FIELD,
                $this->tyreHlBlock::VENDOR_FIELD,
                $this->tyreHlBlock::MODEL_FIELD,
                $this->tyreHlBlock::YEAR_FIELD,
            ]
        ]);

        while ($ob = $res->Fetch()) {
            $auto[self::VENDOR_KEY] = $ob[$this->tyreHlBlock::VENDOR_FIELD];
            $auto[self::MODEL_KEY] = $ob[$this->tyreHlBlock::MODEL_FIELD];
            $auto['modifications'][] = $ob[$this->tyreHlBlock::MODIFICATION_FIELD];
        }

        return $auto;
    }
}