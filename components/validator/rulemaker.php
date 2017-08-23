<?php

/**
 * Class RuleMaker
 * makes rules for Rule
 */
class RuleMaker
{
    /**
     * preset rules to compare with
     */
    private $defaultRules = [
        'name' => ['NotEmptyRule'],
        'email' => ['NotEmptyRule', 'EmailRule'],
        'amount' => ['IntegerRule'],
        'id' => ['IntegerRule'],
        'alias' => ['NotEmptyRule'],
        'title' => ['NotEmptyRule'],
        'content' => ['NotEmptyRule'],
        'login' => ['NotEmptyRule'],
        'role' => ['NotEmptyRule'],
        'password' => ['NotEmptyRule', 'MinCharactersNumberRule', 'DataMatchRule'],
    ];

    /**
     * @var array of rules fo Rule
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