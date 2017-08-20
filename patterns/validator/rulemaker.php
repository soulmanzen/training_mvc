<?php

/**
 * Class RuleMaker
 * makes rules for Validator
 */
class RuleMaker
{
    /**
     * preset rules to compare with
     */
    private $defaultRules = [
        'name' => ['NotEmptyValidator'],
        'email' => ['NotEmptyValidator', 'EmailValidator'],
        'amount' => ['IntegerValidator'],
        'id' => ['IntegerValidator'],
        'alias' => ['NotEmptyValidator'],
        'title' => ['NotEmptyValidator'],
        'content' => ['NotEmptyValidator'],
        'login' => ['NotEmptyValidator'],
        'role' => ['NotEmptyValidator'],
        'password' => ['NotEmptyValidator', 'MinCharactersNumberValidator', 'DataMatchValidator'],
    ];

    /**
     * @var array of rules fo Validator
     */
    private $rules = [];

    /**
     * RuleMaker constructor.
     * @param array $array usually $_POST
     * filling $rules
     */
    public function __construct($array)
    {
        foreach ($array as $key => $value) {
            if (array_key_exists($key, $this->defaultRules)) {
                foreach ($this->defaultRules[$key] as $defaultRule) {
                    $rule[] = new $defaultRule;
                }
                $this->rules[$key] = $rule;
                $rule = null;
            }
        }
    }

    public function getRules() {
        return $this->rules;
    }
}