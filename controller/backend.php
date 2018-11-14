<?php
	require_once('app/P4_model/ChaptersManager.php');
	require_once('app/P4_model/CommentManager.php');
	require_once('app/P4_model/ConnexionManager.php');

	function chaptersBO($n_page)
	{
		$chapterPerPage = 4;
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$chaptersTotal = $chaptersManager -> getAllChapters();
		$pagesTotal = ceil($chaptersTotal['total']/$chapterPerPage);

		if(isset($n_page) && !empty($n_page) && ($n_page>0) && ($n_page<= $pagesTotal))
		{
			$n_page = intval($n_page);
			$pageCurrent = $n_page;
		} else 
		{
			$pageCurrent = 1;
		}
		$start = ($pageCurrent - 1) * $chapterPerPage;
		$chapters= $chaptersManager->getChapters($start, $chapterPerPage);
	    require('view/backend/postsView.php');
	}

	function getChapter($id_chapter)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();

		$chapterLine= $chaptersManager -> getChapter($id_chapter);

		if($chapterLine)
		{
	   		require('view/backend/updatePostsView.php');
	   	} else
	   	{
	   		throw new Exception('Ce chapitre n\'existe pas.');
	   	}
	}

	function changeChapter($id_chapter, $title, $content)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();

		$changeChapterLine= $chaptersManager -> updateChapter($id_chapter, $title, $content);
		$chapterLine= $chaptersManager -> getChapter($id_chapter);

		if($changeChapterLine)
		{
	   		require('view/backend/updatePostsView.php');
	   	} else
	   	{
	   		throw new Exception('Ce chapitre n\'a pas pu être modifié');
	   	}
	}

	function createChapters($title, $content)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$chapters= $chaptersManager -> newChapter($title, $content);

	    if ($chapters === false) {
	        throw new Exception('Impossible d\'ajouter le chapitre !');
	    }
	    else {
	        header('Location:index.php?action=chapterBO&page=1');
	    }
	}

	function deleteChapter($id_chapter)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$chapters= $chaptersManager -> deleteFOChapter($id_chapter);

	    if ($chapters === false) {
	        throw new Exception('Impossible de supprimer le chapitre !');
	    }
	    else {
	        header('Location:index.php?action=chapterBO&page=1');
	    }
	}

	function draftChapter($id_chapter)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$chapters= $chaptersManager -> hideChapter($id_chapter);

	    if ($chapters === false) {
	        throw new Exception('Impossible de mettre le chapitre en brouillon !');
	    }
	    else {
	        header('Location:index.php?action=chapterBO&page=1');
	    }
	}

	function repostChapter($id_chapter)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$chapters= $chaptersManager -> validateChapter($id_chapter);

	    if ($chapters === false) {
	        throw new Exception('Impossible de mettre en ligne le chapitre !');
	    }
	    else {
	        header('Location:index.php?action=chapterBO&page=1');
	    }
	}

	function deleteComment($id_comment)
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->hideComment($id_comment);
	    $affectedLines = $commentManager->checkedComment($id_comment);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible de supprimer le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=admin');
	    }
	}

	function validateComment($id_comment)
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->validComment($id_comment);
	    $affectedLines = $commentManager->checkedComment($id_comment);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible de valider le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=admin');
	    }
	}