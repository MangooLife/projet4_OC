<?php
	require_once('app/P4_model/ChaptersManager.php');
	require_once('app/P4_model/CommentManager.php');

	function cover()
	{
	    require('view/frontend/coverView.php');
	}

	function chapters()
	{

		$chaptersManager = new \app\P4_model\ChaptersManager();
		$chapters= $chaptersManager -> getChapters();
	    require('view/frontend/chaptersView.php');
	}

	function chapter()
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$commentManager = new \app\P4_model\CommentManager();

		$chapter= $chaptersManager -> getChapter($_GET['id_chapter']);
		$comments = $commentManager -> getComments($_GET['id_chapter']);

	    require('view/frontend/bookView.php');
	}