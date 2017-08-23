<?php

class UsersController extends Controller
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new User();
    }

    public function login()
    {
        if ($_POST) {
            $errors = [];

            if (empty($_POST['login'])) {
                $errors[] = 'Login is required';
            }

            if (empty($_POST['password'])) {
                $errors[] = 'Password is required';
            }

            if (empty($errors)) {
                $user = $this->model->getByLogin($_POST['login']);
                $hash = md5(Config::get('salt').$_POST['password']);
                if (!empty($user) && $user['password'] == $hash && $user['is_active'] == 1) {
                    Session::set('userid', $user['id']);
                    Session::set('user', $user['login']);
                    Session::set('role', $user['role']);
                    Session::set('is_active', $user['is_active']);
                    if (Session::get('role') == 'admin') {
                        Router::redirect('/admin');
                    } else {
                        Router::redirect('/');
                    }
                } else {
                    Session::setFlash('Login or password is wrong');
                }
            } else {
                Session::setFlash('Validation errors:<br>'.implode('<br>', $errors));
            }
        }
    }

    public function logout()
    {
        Session::clear('user');
        Session::clear('role');
        Session::clear('is_active');
        Router::redirect('/');
    }

    public function admin_index()
    {
        $this->data['users'] = $this->model->getList();
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
                    Session::setFlash('User was edited');
                } else {
                    Session::setFlash('DB error! User was not saved');
                }
                Router::redirect('/admin/users');
            } else {
                Session::setFlash('Validation errors:<br>'.implode('<br>', $errors));
            }
        }

        if (isset($this->params[0])) {
            $id = (int) $this->params[0];
            $this->data['user'] = $this->model->getById($id);
        } else {
            Session::setFlash('Empty user ID');
            Router::redirect('/admin/users');
        }
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
                    Session::setFlash('User was created');
                } else {
                    Session::setFlash('DB error! User was not saved');
                }
                Router::redirect('/admin/users');
            } else {
                Session::setFlash('Validation errors:<br>'.implode('<br>', $errors));
            }
        }
    }

    public function register()
    {
        if ($_POST) {
            $ruleMaker = new RuleMaker($_POST);
            $rules = $ruleMaker->getRules();
            $rules['email'] = [new NotEmptyRule, new EmailRule, new EmailExistsRule($this->model)];
            $rules['login'] = [new NotEmptyRule, new LoginExistsRule($this->model)];

            $validator = new Validator($rules);
            $validator->validate($_POST);
            $errors = $validator->getErrors();

            if (empty($errors)) {
                if ($this->model->save($_POST)) {
                    $activation = $this->model->getByEmail($_POST['email'])['activation'];
                    $link =  "<a href='http://mvc.loc/users/activate/$activation'>mvc.loc/activate/$activation</a>";
                    $to = $_POST['email'];
                    $subject = 'Confirm your email';
                    $body = "Please follow this link $link to confirm your email";
                    $mailer = new MailerFacade(new PHPMailer());
                    $mailer->sendConfirmation($to, $subject, $body);
                    Session::setFlash('User was created, check your email to confirm.');
                } else {
                    Session::setFlash('DB error! User was not saved');
                }
                Router::redirect('/');
            } else {
                Session::setFlash('Validation errors:<br>'.implode('<br>', $errors));
            }
        }
    }

    public function activate()
    {
        if (empty($this->params[0])) {
            Router::redirect('/');
        } else {
            $code = (string) $this->params[0];
            if ($this->model->getByCode($code)) {
                $this->model->activate($code);
                $this->model->clearActivation($code);

                Session::setFlash('Your account was successfully activated. You can login now.');
                Router::redirect('/');
            } else {
                Router::redirect('/');
            }
        }
    }
}