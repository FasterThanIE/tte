<?php

require_once "TTE_Core.php";

class TTE extends TTE_Core
{

    /**
     * Environment for development. Used for debugging
     */
    const ENV_DEV = 0;

    /**
     * Environment for production
     */
    const ENV_PROD = 1;

    /**
     * Do not use session data, this is default value
     */
    const TEMPLATE_SESSION_NONE = 0;

    /**
     * Use only session data while rendering a template
     */
    const TEMPLATE_SESSION_FULL = 1;

    /**
     * Use some of the data from the session, while grabbing all missing data from the parameters sent
     */
    const TEMPLATE_SESSION_PARTIAL = 2;

    /**
     * @var int
     */
    private $sessionType = self::TEMPLATE_SESSION_FULL;

    /**
     * @var array
     */
    private $unusedParams = [];

    private $env = self::ENV_DEV;


    /**
     * @param string $templateName
     * @param array $params
     * @return $this
     * @throws Exception
     */
    public function render(string $templateName, array $params = [])
    {

        set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
        {
            throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
        }, E_WARNING);

        try
        {
            $file = file_get_contents($templateName);
        }
        catch (Exception $e)
        {
            $this->templateNotFoundException($templateName);
        }


        preg_match_all('/{(\w+)}/', $file, $matchedData);

        $varsFound = [];
        $replacedWith = [];

        $this->unusedParams = array_diff(array_keys($params), array_values($matchedData[1]));

        foreach ($matchedData[0] as $index => $value)
        {
            if(isset($params[$matchedData[1][$index]]))
            {
                $varsFound[] = $value;
                $replacedWith[] = $params[$matchedData[1][$index]];
            }
            else
            {
                $this->undefinedVariableException($value);
            }

        }

        if($this->env == self::ENV_DEV)
        {
            $this->unusedParametersException($this->unusedParams, $templateName);
        }

        echo str_replace($varsFound, $replacedWith, $file);
        return $this;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function useSessionData(int $type = self::TEMPLATE_SESSION_FULL)
    {
        $this->sessionType = $type;
        return $this;
    }


}