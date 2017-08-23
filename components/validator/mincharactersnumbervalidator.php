<?php

class MinCharactersNumberValidator implements ValidatorInterface
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
        $numberOfCharacters = 4;

        if (mb_strlen($array[$field]) < $numberOfCharacters) {
            $this->error = ucfirst($field)." must contain at least $numberOfCharacters characters";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}