<?php

namespace Wecanit\Project\HlBlock;

use Bitrix\Highloadblock\HighloadBlockTable;

/**
 * Class Base
 * @package Wecan\Project\HlBlock
 */
abstract class Base
{
    protected $name;

    /**
     * Base constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        \Bitrix\Main\Loader::includeModule('highloadblock');

        if (!$this->name) {
            throw new \Exception("Hlblock by name: $this->name not found");
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \Bitrix\Main\ORM\Data\DataManager
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getClass(): string
    {
        $hlBlock = HighloadBlockTable::getList([
            'filter' => ['=NAME' => $this->name]
        ])->fetch();

        if (!$hlBlock) {
            throw new \Exception("Hlblock by name: $this->name not found");
        }

        $entity  = HighloadBlockTable::compileEntity( $hlBlock );

        return $entity->getDataClass();
    }
}