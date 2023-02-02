<?php

IncludeModuleLangFile(__FILE__);

class wecanit_project  extends CModule
{
    public $MODULE_ID = "wecanit.project";
    public $MODULE_NAME;

    public function __construct() {
        $this->MODULE_NAME = "WeCanIT Project";
    }

    public function installFiles() {
        return true;
    }

    public function unInstallFiles() {
        return true;
    }

    public function DoInstall() {
        RegisterModule($this->MODULE_ID);
        $this->installFiles();
    }

    public function DoUninstall() {
        UnRegisterModule($this->MODULE_ID);
        $this->unInstallFiles();
    }
}
