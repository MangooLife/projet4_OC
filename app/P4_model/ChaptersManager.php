<?php
	namespace app\P4_model;

    require_once("app/P4_model/Manager.php");

    class ChaptersManager extends Manager
    {
        public function getChapters($start, $end)
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, title, SUBSTRING_INDEX(content,\' \', 50) AS excerpt, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, online, is_delete FROM posts WHERE is_delete=0 ORDER BY id LIMIT '.$start.','.$end);

            return $req;
        }

        public function getAllChapters()
        {
            $db = $this->dbConnect();
            $chaptersTotalReq = $db -> query ('SELECT COUNT(*) AS total FROM posts');
            $chaptersTotal = $chaptersTotalReq -> fetch();
            return $chaptersTotal;
        }

        public function getChapter($postId)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, title, content, online, is_delete, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE id = ?');
            $req->execute(array($postId));
            $post = $req->fetch();

            return $post;
        }

        public function getLastChapter()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id FROM posts WHERE online=1 ORDER BY id DESC LIMIT 1');
            $post = $req->fetch();

            return $post;
        }

        public function newChapter($title, $content){
            $db = $this->dbConnect();
            $posts = $db->prepare('INSERT INTO posts(author, title, content, creation_date, online, is_delete) VALUES(\'admin\', ?, ?, NOW(), 1, 0)');
            $affectedLines = $posts->execute(array($title, $content));

            return $affectedLines;
        }

        public function updateChapter($postId, $title, $content){
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE posts SET title=:title, content=:content WHERE id=:id');
            $req -> execute(array(
                    'title' => $title,
                    'content' => $content,
                    'id' => $postId
                ));

            return $req;
        }

        public function softDeleteChapter($postId)
        {
            $db = $this->dbConnect();
            $chapter = $db->prepare('UPDATE posts SET is_delete=1, online=0 WHERE id=:id');
            $affectedLines = $chapter->execute(array(
                    'id'=>$postId
                ));

            return $affectedLines;
        }

        public function hideChapter($postId)
        {
            $db = $this->dbConnect();
            $chapter = $db->prepare('UPDATE posts SET online=0 WHERE id=:id');
            $affectedLines = $chapter->execute(array(
                    'id'=>$postId
                ));

            return $affectedLines;
        }

        public function validateChapter($postId)
        {
            $db = $this->dbConnect();
            $chapter = $db->prepare('UPDATE posts SET online=1 WHERE id=:id');
            $affectedLines = $chapter->execute(array(
                    'id'=>$postId
                ));

            return $affectedLines;
        }

    }