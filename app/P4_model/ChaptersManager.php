<?php
	namespace app\P4_model;

    require_once("app/P4_model/Manager.php");

    class ChaptersManager extends Manager
    {
        public function getChapters()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, title, SUBSTRING_INDEX(content,\' \', 50) AS excerpt, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY id LIMIT 0, 5');

            return $req;
        }

        public function getChapter($postId)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, title, content, online, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
            $req->execute(array($postId));
            $post = $req->fetch();

            return $post;
        }


    }