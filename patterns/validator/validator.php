<?php

/**
 * Class Validator
 * main validator that uses tiny validators to validate an array according to the rules.
 */
class Validator implements ValidatorInterface
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
     */
    public function validate(array $array)
    {
        foreach ($array as $field => $value) {
            if (array_key_exists($field, $this->rules)) {
                foreach ($this->rules[$field] as $validator) {
                    $validator->validate([$array, $field]);
                    if ($validator->getErrors()) {
                        $this->errors[] = $validator->getErrors();
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