<?php

class CarApi extends CBitrixComponent
{
    public function executeComponent()
    {
        $arDefaultUrlTemplates404 = array(
            'get' => 'index.php',
        );

        $arDefaultVariableAliases404 = array();

        $arComponentVariables = ['get'];

        $arVariables = array();

        $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, []);
        $arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, []);

        $engine = new CComponentEngine($this);
        $componentPage = $engine->guessComponentPath(
            $this->arParams['SEF_FOLDER'],
            $arUrlTemplates,
            $arVariables
        );

        if (!$componentPage) {
            LocalRedirect('/404.php');
        }

        CComponentEngine::InitComponentVariables(
            $componentPage,
            $arComponentVariables,
            $arVariableAliases,
            $arVariables
        );

        $this->IncludeComponentTemplate($componentPage);
    }
}