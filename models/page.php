<?php

class Page extends Model
{

    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->attach(new PageObserver());
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

    public function getListByPage($onlyPublished = true, $pageNumber)
    {
        $sql = "SELECT * FROM `pages`";

        if ($onlyPublished) {
            $sql .= " WHERE `is_published` = 1";
        }

        $pageNumber = $this->db->escape($pageNumber);
        $offset = ($pageNumber - 1) * Config::get('ITEMS_PER_PAGE');
        $limit = Config::get('ITEMS_PER_PAGE');

        $sql .= "LIMIT $offset, $limit;";

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
        $author_id = Session::get('userid');
        $sql = "SELECT * FROM `pages` WHERE `author_id` = '$author_id';";

        return $this->db->query($sql);
    }

    public function getListByAuthorIdByPage($pageNumber)
    {
        $author_id = Session::get('userid');
        $pageNumber = $this->db->escape($pageNumber);
        $offset = ($pageNumber - 1) * Config::get('ITEMS_PER_PAGE');
        $limit = Config::get('ITEMS_PER_PAGE');

        $sql = "SELECT * FROM `pages` WHERE `author_id` = '$author_id' LIMIT $offset, $limit;";

        return $this->db->query($sql);
    }

    public function getPagination($byAuthor = false)
    {
        $sql = "SELECT COUNT(`id`) as pagesCount FROM `pages`";

        if ($byAuthor) {
            $author_id = Session::get('userid');
            $sql .= "WHERE `author_id` = '$author_id'";
        }

        $sql .= ";";

        $this->db->query($sql);
        $pagesCount = $this->db->query($sql)[0]['pagesCount'];

        $links = [];
        if ($pagesCount > Config::get('ITEMS_PER_PAGE')) {
            $pages = ceil($pagesCount / Config::get('ITEMS_PER_PAGE'));
            for ($i = 1; $i <= $pages; $i++) {
                $links[] = $i;
            }
        }

        return $links;
    }

    public function save($data, $id = null)
    {
        $id = (int) $id;

        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if (empty($id)) {
            $author_id = Session::get('userid');
            $sql = "INSERT INTO `pages` (`alias`, `title`, `content`, `is_published`, `author_id`) 
                    VALUES ('$alias', '$title', '$content', '$is_published', '$author_id');";
        } else {
            $sql = "UPDATE `pages` 
                    SET `alias` = '$alias',
                    `title` = '$title',
                    `content` = '$content',
                    `is_published` = '$is_published'
                    WHERE `id` = $id;";
            if (Session::get('role') != 'admin') {
                $this->notify();
            }
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