<?php

class TTE_Core
{

    /**
     * @param string $variableName
     * @throws Exception
     */
    protected static function undefinedVariableException(string $variableName)
    {
        $variableName = str_replace(['{', '}', '@'], '', $variableName);
        throw new Exception("Undefined variable name " . $variableName);
    }

    /**
     * @param $variables
     * @param $template
     * @throws Exception
     */
    protected static function unusedParametersException($variables, $template)
    {
        foreach ($variables as $variable)
            throw new Exception("Variable $variable passed but not used in template $template.");
    }

    protected function templateNotFoundException($templateName)
    {
        throw new Exception("Attempted to load template that doesnt exist. Template name: $templateName");
    }
}