<?php

namespace Wecanit\Project\Hlblock;

class NotFoundHlBlock extends Base
{
    protected $name = 'NotFoundAuto';

    const GRZ_FIELD = 'UF_GRZ';
    const VENDOR_FIELD = 'UF_VENDOR';
    const MODEL_FIELD = 'UF_MODEL';
    const YEAR_FIELD = 'UF_YEAR';
    const MODIFICATION_FIELD = 'UF_MODIFICATION';

    public function __construct()
    {
        parent::__construct();
    }
}