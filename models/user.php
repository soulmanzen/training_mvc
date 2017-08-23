<?php

class User extends Model
{
    public function getByLogin($login)
    {
        $login = $this->db->escape($login);
        $sql = "SELECT * FROM `users` WHERE `login` = '$login';";
        $user = $this->db->query($sql);

        return isset($user[0]) ? $user[0] : null;
    }

    public function getList()
    {
        $sql = "SELECT * FROM `users`;";

        return $this->db->query($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1;";
        $result = $this->db->query($sql);

        return isset($result[0]) ? $result[0] : null;
    }

    public function getByEmail($email)
    {
        $email = $this->db->escape($email);
        $sql = "SELECT * FROM `users` WHERE `email` = '$email';";
        $user = $this->db->query($sql);

        return isset($user[0]) ? $user[0] : null;
    }

    public function getByCode($code)
    {
        $code = $this->db->escape($code);
        $sql = "SELECT * FROM `users` WHERE `activation` = '$code';";
        $user = $this->db->query($sql);

        return isset($user[0]) ? $user[0] : null;
    }


    public function save($data, $id = null)
    {
        $id = (int) $id;

        $login = $this->db->escape($data['login']);
        $email = $this->db->escape($data['email']);
        $role = $data['role'] ? $this->db->escape($data['role']) : 'user';
        $password = $this->db->escape($data['password']);
        $hash = md5(Config::get('salt').$password);
        $isActive = (Session::get('role') == 'admin') ? 1 : 0;
        $activation = md5($email.time());

        if (empty($password)) {
            $update_password = '';
        } else {
            $update_password = ", `password` = '$hash'";
        }

        if (empty($id)) {
            $sql = "INSERT INTO `users` (`login`, `email`, `role`, `password`, `is_active`, `activation`) 
                    VALUES ('$login', '$email', '$role', '$hash', '$isActive', '$activation');";
        } else {
            $sql = "UPDATE `users` 
                    SET `login` = '$login',
                    `email` = '$email',
                    `role` = '$role'$update_password
                    WHERE `id` = $id;";
        }

        return $this->db->query($sql);
    }

    public function activate($code)
    {
        $sql = "UPDATE `users` 
                SET `is_active` = '1'
                WHERE `activation` = '$code';";

        return $this->db->query($sql);
    }

    public function clearActivation($code)
    {
        $sql = "UPDATE `users` 
                SET `activation` = ''
                WHERE `activation` = '$code';";

        return $this->db->query($sql);
    }
}