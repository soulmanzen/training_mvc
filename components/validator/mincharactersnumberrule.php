<?php

class MinCharactersNumberRule implements RuleInterface
{
    private $error;
    private $numberOfCharacters;

    /**
     * MinCharactersNumberRule constructor.
     * @param $numberOfCharacters
     */
    public function __construct($numberOfCharacters = 4)
    {
        $this->numberOfCharacters = $numberOfCharacters;
    }


    /**
     * @param array $array
     * @param string $field
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $array, string $field)
    {
        if (mb_strlen($array[$field]) < $this->numberOfCharacters) {
            $this->error = ucfirst($field)." must contain at least $this->numberOfCharacters characters";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}