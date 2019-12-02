<?php

class TTE_Core
{

    /**
     * @param string $variableName
     * @throws Exception
     */
    public static function undefinedVariableException(string $variableName)
    {
        $variableName = str_replace(['{', '}', '@'], '', $variableName);
        throw new Exception("Undefined variable name ".$variableName);
    }
}