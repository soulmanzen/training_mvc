<?php

/**
 * Class Validator
 * main validator that uses tiny validators to validate an array according to the rules.
 */
class Validator
{
    private $errors = [];

    /**
     * @var array of field => [validators]
     */
    private $rules;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param array $array
     * usually $_POST
     */
    public function validate(array $array)
    {
        foreach ($array as $field => $value) {
            if (array_key_exists($field, $this->rules)) {
                foreach ($this->rules[$field] as $rule) {
                    $rule->validate($array, $field);
                    if ($rule->getErrors()) {
                        $this->errors[] = $rule->getErrors();
                        break;
                    }
                }
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

}