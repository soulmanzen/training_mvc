<?php

class DataMatchValidator implements ValidatorInterface
{
    private $error;


    /**
     * @param array $args
     * $array - validated array
     * $field - validated key of $array
     * $field2 - key in $array to compare $field with
     */
    public function validate (array $args)
    {
        $array = $args[0];
        $field = $args[1];
        $field2 = $field.'2';

        if ($array[$field] != $array[$field2]) {
            $this->error = ucfirst($field)."s do not match";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}