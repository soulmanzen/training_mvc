<?php

class DataMatchRule implements RuleInterface
{
    private $error;
    private $field2;

    /**
     * DataMatchRule constructor.
     * set field to compare
     * @param $field2
     */
    public function __construct($field2 = 'confirm_password')
    {
        $this->field2 = $field2;
    }

    /**
     * @param array $array
     * @param string $field
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $array, string $field)
    {

        if ($array[$field] != $array[$this->field2]) {
            $this->error = ucfirst($field)."s do not match";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}