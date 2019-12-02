<?php


class TTE
{

    /**
     * @var array
     */
    private $vars = [];


    /**
     * @param $templateName
     * @param array $data
     */
    public function render($templateName, $data = [])
    {
        $file = file_get_contents($templateName);
        preg_match_all('/{\$(\w+)}/', $file, $matchedData);

        $varsFound = [];
        $replacedWith = [];

        foreach ($matchedData[0] as $index => $value)
        {
            $varsFound[] = $value;
            $replacedWith[] = $data[$matchedData[1][$index]];
        }

        echo str_replace($varsFound, $replacedWith, $file);
    }


}