<?php

class AuthorRule implements RuleInterface
{
    private $error;
    private $pageModel;

    /**
     * AuthorRule constructor.
     * @param $pageModel
     */
    public function __construct($pageModel)
    {
        $this->pageModel = $pageModel;
    }


    /**
     * @param array $array
     * @param string $field
     *
     * $array - validated array
     * $field - validated key of $array
     */
    public function validate (array $array, string $field)
    {
        $currentPage = $this->pageModel->getById($array[$field]);
        $pageAuthorId = $currentPage['author_id'];
        $userId = Session::get('userid');

        if ($pageAuthorId != $userId) {
            $this->error = "Stop hacking! You can not edit page that is not yours.";
        }
    }

    public function getErrors()
    {
        return $this->error;
    }
}