<?php

class Notification extends Model
{
    public function getList()
    {
        $sql = "SELECT * FROM `notifications`;";

        return $this->db->query($sql);
    }

    public function deleteById($id)
    {
        $id = (int) $id;
        $sql = "DELETE FROM `notifications` WHERE `id` = $id";

        return $this->db->query($sql);
    }

    public function save($message)
    {
        $sql = "INSERT INTO `notifications` (`message`, `updated`) VALUES ('$message', NOW());";

        return $this->db->query($sql);
    }
}