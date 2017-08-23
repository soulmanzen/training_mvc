<?php

class LoginExistsRule implements RuleInterface
{
    private $error;
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param array $array
     * @param string $field
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $array, string $field)
    {
        if ($this->userModel->getByLogin($array[$field])) {
            $this->error = "User with such login already exists";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}