<?php

class PagesController extends Controller
{
    /**
     * PagesController constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new Page();
    }

    public function index()
    {
        $this->data['pages'] = $this->model->getList();
    }

    public function view()
    {
        if (isset($this->params[0])) {
            $alias = strtolower($this->params[0]);
            $this->data['page'] =  $this->model->getByAlias($alias);
            if (empty($this->data['page'])) {
                header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
                echo "Error 404";
                exit;
            }
        } else {
            throw new Exception('Page name is required');
        }
    }

    public function admin_index()
    {
        $this->data['pages'] = Session::get('user') != 'admin' ? $this->model->getListByAuthorId() : $this->model->getList(false);
    }

    public function admin_edit()
    {
        if ($_POST) {

            $ruleMaker = new RuleMaker($_POST);
            $rules = $ruleMaker->getRules();

            $validator = new Validator($rules);
            $validator->validate($_POST);
            $errors = $validator->getErrors();

            if (empty($errors)) {
                if ($this->model->save($_POST, $_POST['id'])) {
                    Session::setFlash('Page was edited');
                } else {
                    Session::setFlash('DB error! Page was not saved');
                }
                Router::redirect('/admin/pages');
            } else {
                Session::setFlash('Validation errors:<br>'.implode('<br>', $errors));
            }
        }

        if (isset($this->params[0])) {
            $id = (int) $this->params[0];
            if (!$this->isAuthor($id)) {
                header($_SERVER['SERVER_PROTOCOL']." 403 Forbidden");
                echo "Access denied";
                exit;
            }
            $this->data['page'] = $this->model->getById($id);
        } else {
            Session::setFlash('Empty page ID');
            Router::redirect('/admin/pages');
        }
    }

    public function admin_delete()
    {
        if (isset($this->params[0])) {
            $id = (int) $this->params[0];
            if (!$this->isAuthor($id)) {
                throw new Exception('You cannot delete page that is not yours!');
            }
            $this->model->deleteById($id);
        } else {
            Session::setFlash('Empty page ID');
        }

        Router::redirect('/admin/pages');
    }

    public function admin_add()
    {
        if ($_POST) {

            $ruleMaker = new RuleMaker($_POST);
            $rules = $ruleMaker->getRules();

            $validator = new Validator($rules);
            $validator->validate($_POST);
            $errors = $validator->getErrors();

            if (empty($errors)) {
                if ($this->model->save($_POST)) {
                    Session::setFlash('New page was created');
                } else {
                    Session::setFlash('DB error! Page was not saved');
                }
                Router::redirect('/admin/pages');
            } else {
                Session::setFlash('Validation errors:<br>'.implode('<br>', $errors));
            }
        }
    }

    private function isAuthor($id)
    {
        $page = $this->model->getById($id);
        $activeUser = $this->model->getActiveUser();

        return ($activeUser['role'] == 'admin') || ($page['author_id'] == $activeUser['id']);
    }
}