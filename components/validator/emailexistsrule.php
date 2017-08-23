<?php

class EmailExistsRule implements RuleInterface
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
        if ($this->userModel->getByEmail($array[$field])) {
            $this->error = "User with such email already exists";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}