<?php

class NotificationsController extends Controller
{
    /**
     * NotificationsController constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new Notification();
    }

    public function admin_index()
    {
        if (Session::get('role') != 'admin') {
            header($_SERVER['SERVER_PROTOCOL']. "403 Forbidden");
            echo 'You have nothing to do here!';
            exit;
        } else {
            $this->data['pages'] = $this->model->getList();
        }
    }

    public function admin_delete()
    {
        if (isset($this->params[0])) {
            $id = (int) $this->params[0];
            if (Session::get('role') != 'admin') {
                header($_SERVER['SERVER_PROTOCOL']. " 404 Not Found");
                echo "NOT FOUND!!!";
                exit;
            }
            $this->model->deleteById($id);
        } else {
            Session::setFlash('Empty page ID');
        }

        Router::redirect('/admin/notifications');
    }
}