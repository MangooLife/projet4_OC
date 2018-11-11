<?php
	namespace app\P4_model;

	require_once("app/P4_model/Manager.php");

	class CommentManager extends Manager
	{
		public function getComments($postId)
		{
			$db = $this->dbConnect();
			$comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date_fr FROM comments WHERE id_posts = ? ORDER BY comment_date DESC');
            $comments->execute(array($postId));

            return $comments;
		}

		public function addComment($postId, $author ,$comment)
		{
			$db = $this->dbConnect();
            $comments = $db->prepare('INSERT INTO comments(id_posts, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
            $affectedLines = $comments->execute(array($postId, $author, $comment));

            return $affectedLines;
		}
	}