<?php

class NotEmptyRule implements RuleInterface
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
        if (empty($array[$field])) {
            $this->error = ucfirst($field)." is required";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}