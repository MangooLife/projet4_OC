<?php
	require_once('model/ChaptersManager.php');

	function cover()
	{
	    require('view/frontend/coverView.php');
	}

	function chapters()
	{

		$chaptersManager = new \model\ChaptersManager();
		$chapters= $chaptersManager -> getChapters();
	    require('view/frontend/chaptersView.php');
	}

	function chapter()
	{

		$chaptersManager = new \model\ChaptersManager();
		$chapter= $chaptersManager -> getChapter($_GET['id_chapter']);
	    require('view/frontend/bookView.php');
	}