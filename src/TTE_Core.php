<?php

class TTE_Core
{

    const SEVERITY_EXCEPTION = "Exception";
    const SEVERITY_WARNING = "Warning";

    /**
     * @param string $variableName
     */
    protected function undefinedVariableException(string $variableName)
    {
        $variableName = str_replace(['{', '}', '@'], '', $variableName);
        $this->render_error_template("Undefined variable name " . $variableName, self::SEVERITY_EXCEPTION);
    }

    /**
     * @param $variables
     * @param $template
     */
    protected function unusedParametersException($variables, $template)
    {
        foreach ($variables as $variable)
            $this->render_error_template("Variable $variable passed but not used in template $template.", self::SEVERITY_WARNING);
    }

    /**
     * @param $templateName
     */
    protected function templateNotFoundException($templateName)
    {
        $this->render_error_template("Attempted to load template that doesnt exist. Template name: $templateName", self::SEVERITY_EXCEPTION);
    }

    private function render_error_template($errorMessage, $severity)
    {
        require_once "templates/error_template.php";
    }
}