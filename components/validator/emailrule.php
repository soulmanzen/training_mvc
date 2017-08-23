<?php

class EmailRule implements RuleInterface
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
        if (!filter_var($array[$field], FILTER_VALIDATE_EMAIL)) {
            $this->error = ucfirst($field)." must be written in correct way";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}