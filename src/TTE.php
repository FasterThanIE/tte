<?php

require_once "TTE_Core.php";

class TTE extends TTE_Core
{

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
     * @param $templateName
     * @param array $params
     * @return $this
     * @throws Exception
     */
    public function render($templateName, $params = [])
    {
        $file = file_get_contents($templateName);
        preg_match_all('/{(\w+)}/', $file, $matchedData);

        $varsFound = [];
        $replacedWith = [];
        $missingData = [];

        foreach ($matchedData[0] as $index => $value)
        {
            if(isset($params[$matchedData[1][$index]]))
            {
                $varsFound[] = $value;
                $replacedWith[] = $params[$matchedData[1][$index]];
            }
            else
            {
                parent::undefinedVariableException($value);
            }

        }

        echo str_replace($varsFound, $replacedWith, $file);
        return $this;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function useSessionData($type = self::TEMPLATE_SESSION_FULL)
    {
        $this->sessionType = $type;
        return $this;
    }


}