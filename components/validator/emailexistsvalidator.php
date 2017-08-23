<?php

class EmailExistsValidator implements ValidatorInterface
{
    private $error;
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param array $args
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $args)
    {
        $array = $args[0];
        $field = $args[1];

        if ($this->userModel->getByEmail($array[$field])) {
            $this->error = "User with such email already exists";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}