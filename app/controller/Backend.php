<?php
	namespace app\controller;

	require_once('app/P4_model/PostsManager.php');
	require_once('app/P4_model/CommentsManager.php');
	require_once('app/P4_model/MembersManager.php');

	class Backend
	{
		function chaptersBO($n_page)
		{
			$chapterPerPage = 10;
			$chaptersManager = new \app\P4_model\PostsManager();
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
			$chapters= $chaptersManager->getChaptersDesc($start, $chapterPerPage);
		    require('view/backend/postsView.php');
		}

		function getChapter($id_chapter)
		{
			$chaptersManager = new \app\P4_model\PostsManager();

			$chapterLine= $chaptersManager -> getChapter($id_chapter);

			if($chapterLine)
			{
		   		require('view/backend/updatePostsView.php');
		   	} else
		   	{
		   		$_SESSION['flashMsgError'] = 'Ce chapitre n\'existe pas.';
		        require('view/backend/updatePostsView.php');
		   	}
		}

		function changeChapter($id_chapter, $title, $content)
		{
			$chaptersManager = new \app\P4_model\PostsManager();

			$changeChapterLine= $chaptersManager -> updateChapter($id_chapter, $title, $content);
			$chapterLine= $chaptersManager -> getChapter($id_chapter);

			if($changeChapterLine)
			{
				$_SESSION['flashMsg'] = 'Ce chapitre a pu être modifié.';
		   		require('view/backend/updatePostsView.php');
		   	} else
		   	{
		   		$_SESSION['flashMsgError'] = 'Ce chapitre n\'a pas pu être modifié';
		   		require('view/backend/updatePostsView.php');
		   	}
		}

		function createChapters($title, $content)
		{
			$chaptersManager = new \app\P4_model\PostsManager();
			$chapters= $chaptersManager -> newChapter($title, $content);

		    if ($chapters === false) {
		        $_SESSION['flashMsgError'] = 'Impossible d\'ajouter le chapitre !';
		        header('Location:index.php?action=chapterBO');
		    }
		    else {
		    	$_SESSION['flashMsg'] = 'Le chapitre a bien été ajouté';
		        header('Location:index.php?action=chapterBO');
		    }
		}

		function deleteChapter($id_chapter)
		{
			$chaptersManager = new \app\P4_model\PostsManager();
			$chapters= $chaptersManager -> softDeleteChapter($id_chapter);

		    if ($chapters === false) {
		        $_SESSION['flashMsgError'] = 'Impossible de supprimer le chapitre !';
		        header('Location:index.php?action=chapterBO');
		    }
		    else {
		    	$_SESSION['flashMsg'] = 'Le chapitre a bien été supprimé';
		        header('Location:index.php?action=chapterBO');
		    }
		}

		function draftChapter($id_chapter)
		{
			$chaptersManager = new \app\P4_model\PostsManager();
			$chapters= $chaptersManager -> hideChapter($id_chapter);

		    if ($chapters === false) {
		        $_SESSION['flashMsgError'] = 'Impossible de mettre le chapitre en brouillon !';
		        header('Location:index.php?action=chapterBO');
		    }
		    else {
		    	$_SESSION['flashMsg'] = 'Le chapitre a bien été ajouté en brouillon';
		        header('Location:index.php?action=chapterBO');
		    }
		}

		function repostChapter($id_chapter)
		{
			$chaptersManager = new \app\P4_model\PostsManager();
			$chapters= $chaptersManager -> validateChapter($id_chapter);

		    if ($chapters === false) {
		        $_SESSION['flashMsgError'] = 'Impossible de mettre en ligne le chapitre !';
		        header('Location:index.php?action=chapterBO');
		    }
		    else {
		    	$_SESSION['flashMsg'] = 'Le chapitre a bien été reposté';
		        header('Location:index.php?action=chapterBO');
		    }
		}

		function deleteComment($id_comment)
		{
			$commentManager = new \app\P4_model\CommentsManager();

		    $affectedLines = $commentManager->hideComment($id_comment);

		    if ($affectedLines === false) {
		        $_SESSION['flashMsgError'] = 'Impossible de supprimer le commentaire !';
		        header('Location:index.php?action=admin');
		    }
		    else {
		    	$_SESSION['flashMsg'] = 'Le commentaire a bien été supprimé';
		        header('Location:index.php?action=admin');
		    }
		}

		function validateComment($id_comment)
		{
			$commentManager = new \app\P4_model\CommentsManager();

		    $affectedLines = $commentManager->validComment($id_comment);

		    if ($affectedLines === false) {
		        $_SESSION['flashMsgError'] = 'Impossible de valider le commentaire !';
		        header('Location:index.php?action=admin');
		    }
		    else {
		    	$_SESSION['flashMsg'] = 'Le commentaire a bien été validé';
		        header('Location:index.php?action=admin');
		    }
		}
	}