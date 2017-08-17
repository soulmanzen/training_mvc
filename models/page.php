<?php

class Page extends Model
{
    public function getActiveUser()
    {
        $activeUser = Session::get('user');
        $sql = "SELECT * FROM `users` WHERE login = '$activeUser';";
        $result = $this->db->query($sql);

        return $result[0];
    }

    public function getList($onlyPublished = true)
    {
        $sql = "SELECT * FROM `pages`";

        if ($onlyPublished) {
            $sql .= " WHERE `is_published` = 1";
        }

        $sql .= ";";

        return $this->db->query($sql);
    }

    public function getByAlias($alias)
    {
        $alias = $this->db->escape($alias);
        $sql = "SELECT * FROM `pages` WHERE `alias` = '$alias' AND `is_published` = 1 LIMIT 1;";
        $result = $this->db->query($sql);

        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM `pages` WHERE `id` = '$id' LIMIT 1;";
        $result = $this->db->query($sql);

        return isset($result[0]) ? $result[0] : null;
    }

    public function getListByAuthorId()
    {
        $author_id = $this->getActiveUser()['id'];
        $sql = "SELECT * FROM `pages` WHERE `author_id` = '$author_id';";

        return $this->db->query($sql);
    }

    public function save($data, $id = null)
    {
        $id = (int) $id;

        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if (empty($id)) {
            $author_id = $this->getActiveUser()['id'];
            $sql = "INSERT INTO `pages` (`alias`, `title`, `content`, `is_published`, `author_id`) 
                    VALUES ('$alias', '$title', '$content', '$is_published', '$author_id');";
        } else {
            $sql = "UPDATE `pages` 
                    SET `alias` = '$alias',
                    `title` = '$title',
                    `content` = '$content',
                    `is_published` = '$is_published'
                    WHERE `id` = $id;";
        }

        return $this->db->query($sql);
    }

    public function deleteById($id)
    {
        $id = (int) $id;
        $sql = "DELETE FROM `pages` WHERE `id` = $id";

        return $this->db->query($sql);
    }
}