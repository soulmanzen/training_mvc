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

    public function save($data, $id = null)
    {
        $id = (int) $id;

        $login = $this->db->escape($data['login']);
        $email = $this->db->escape($data['email']);
        $role = $this->db->escape($data['role']);
        $password = $this->db->escape($data['password']);
        $hash = md5(Config::get('salt').$password);

        if (empty($password)) {
            $update_password = '';
        } else {
            $update_password = ", `password` = '$hash'";
        }

        if (empty($id)) {
            $sql = "INSERT INTO `users` (`login`, `email`, `role`, `password`) 
                    VALUES ('$login', '$email', '$role', '$hash');";
        } else {
            $sql = "UPDATE `users` 
                    SET `login` = '$login',
                    `email` = '$email',
                    `role` = '$role'$update_password
                    WHERE `id` = $id;";
        }

        return $this->db->query($sql);
    }
}