<?php

namespace Wecanit\Project\Hlblock;

class AlternateHlBlock extends Base
{
    protected $name = 'AlternateModels';

    const NAME_FIELD = 'UF_NAME';
    const ALTERNATE_FIELD = 'UF_ALTERNATE';

    public function __construct()
    {
        parent::__construct();
    }
}