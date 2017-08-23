<?php

class IntegerRule implements RuleInterface
{
    private $error;

    /**
     * @param array $array
     * @param string $field
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $array, string $field)
    {
        if (!ctype_digit(strval($array[$field]))) {
            $this->error = ucfirst($field)." must be an integer";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}