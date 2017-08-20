<?php

class NotEmptyValidator implements ValidatorInterface
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

        if (empty($array[$field])) {
            $this->error = ucfirst($field)." is required";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}