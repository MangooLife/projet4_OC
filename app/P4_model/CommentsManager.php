<?php
	namespace app\P4_model;

	require_once("app/P4_model/Manager.php");

	class CommentsManager extends Manager
	{
		
		public function getAllComments()
		{
			$db = $this->dbConnect();
			$comments = $db->query('SELECT p.title posts_title, p.id posts_id, c.comment comment_txt, c.management comment_management, c.is_valid comment_valid, c.is_hide comment_hide, c.id comment_id, c.author comment_author, DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%i\') comment_date
									FROM posts p
									INNER JOIN comments c
									ON p.id = c.id_posts 
									ORDER BY c.comment_date DESC');
            return $comments;
		} 

		public function getSignalComments()
		{
			$db = $this->dbConnect();
			$comments = $db->query('SELECT p.title posts_title, p.id posts_id, c.comment comment_txt, c.management comment_management, c.is_valid comment_valid, c.is_hide comment_hide, c.id comment_id, c.author comment_author, DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%i\') comment_date
									FROM posts p
									INNER JOIN comments c
									ON p.id = c.id_posts 
									WHERE c.report = 1 AND c.management=0
									ORDER BY c.comment_date DESC');

            return $comments;
		} 

		public function getComments($postId)
		{
			$db = $this->dbConnect();
			$comments = $db->prepare('SELECT id, author, comment, report, management, is_hide, is_valid, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE id_posts = ? ORDER BY comment_date DESC');
            $comments->execute(array($postId));

            return $comments;
		}

		public function addComment($postId, $author ,$comment)
		{
			$db = $this->dbConnect();
            $comments = $db->prepare('INSERT INTO comments(id_posts, author, comment, comment_date, report, management, is_hide, is_valid) VALUES(?, ?, ?, NOW(), 0, 0, 0, 0)');
            $affectedLines = $comments->execute(array($postId, $author, $comment));

            return $affectedLines;
		}

		public function signalComment($commentId)
		{
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE comments SET report=1 WHERE id=:id');
			$req -> execute(array(
					'id' => $commentId
				));

			return $req;
		}

		public function hideComment($commentId){
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE comments SET is_hide=1, is_valid=0, management=1 WHERE id=:id');
			$req -> execute(array(
					'id' => $commentId
				));

			return $req;
		}

		public function validComment($commentId){
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE comments SET is_valid=1, is_hide=0, management=1 WHERE id=:id');
			$req -> execute(array(
					'id' => $commentId
				));

			return $req;
		}
	}