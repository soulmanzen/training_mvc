<?php

class EmailValidator implements ValidatorInterface
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

        if (!filter_var($array[$field], FILTER_VALIDATE_EMAIL)) {
            $this->error = ucfirst($field)." must be written in correct way";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}