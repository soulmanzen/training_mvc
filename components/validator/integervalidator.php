<?php

class IntegerValidator implements ValidatorInterface
{
    private $error;

    /**
     * @param array $args
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $args)
    {
        $array = $args[0];
        $field = $args[1];

        if (!ctype_digit(strval($array[$field]))) {
            $this->error = ucfirst($field)." must be an integer";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}