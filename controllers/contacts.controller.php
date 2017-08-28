<?php

class ContactsController extends Controller
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index()
    {
    }


    public function index_ajax()
    {
        if ($_POST) {
            $ruleMaker = new RuleMaker($_POST);
            $rules = $ruleMaker->getRules();
            $rules['id'] = [new IntegerRule, new AuthorRule($this->model)];

            $validator = new Validator($rules);
            $validator->validate($_POST);
            $errors = $validator->getErrors();

            if (empty($errors)) {
                if ($this->model->save($_POST)) {
                    $this->data['message'] = 'Thank you! Your message was sent';

                } else {
                    $this->data['errors'][] = 'DB error! Message was not saved';
                }
            } else {
                $this->data['errors'] = $errors;
            }
        }
    }

    public function admin_index()
    {

    }
}