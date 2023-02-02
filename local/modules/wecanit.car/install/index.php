<?php
IncludeModuleLangFile(__FILE__);

class wecanit_car  extends CModule
{
    public $MODULE_ID = "wecanit.car";
    public $MODULE_NAME;

    public function __construct() {
        $this->MODULE_NAME = "WeCanIt car";
    }

    public function InstallFiles() {
        return true;
    }

    public function UnInstallFiles() {
        return true;
    }

    public function DoInstall() {
        RegisterModule($this->MODULE_ID);
        $this->InstallFiles();
    }

    public function DoUninstall() {
        UnRegisterModule($this->MODULE_ID);
        $this->UnInstallFiles();
    }
}
