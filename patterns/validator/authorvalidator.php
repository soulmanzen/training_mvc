<?php

class AuthorValidator implements ValidatorInterface
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
        $pageModel = new Page();
        $currentPage = $pageModel->getById($array[$field]);
        $pageAuthorId = $currentPage['author_id'];
        $userId = $pageModel->getActiveUser()['id'];

        if ($pageAuthorId != $userId) {
            $this->error = "Stop hacking! You can not edit page that is not yours.";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}