<?php

namespace Wecanit\Project\Hlblock;

class TyreHlBlock extends Base
{
    protected $name = 'Tyre';

    const VENDOR_FIELD = 'UF_VENDOR';
    const MODEL_FIELD = 'UF_MODEL';
    const YEAR_FIELD = 'UF_YEAR';
    const MODIFICATION_FIELD = 'UF_MODIFICATION';

    public function __construct()
    {
        parent::__construct();
    }
}