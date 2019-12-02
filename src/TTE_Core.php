<?php

class TTE_Core
{

    /**
     * @param $variableName
     * @throws Exception
     */
    public static function undefinedVariableException($variableName)
    {
        $variableName = str_replace(['{', '}', '@'], '', $variableName);
        throw new Exception("Undefined variable name ".$variableName);
    }
}