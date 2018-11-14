<?php
	require_once('app/P4_model/ChaptersManager.php');
	require_once('app/P4_model/CommentManager.php');
	require_once('app/P4_model/ConnexionManager.php');

	function cover()
	{
	    require('view/frontend/coverView.php');
	}

	function connexion()
	{
	    require('view/frontend/userLoginView.php');
	}

	function registration($pseudo_reg, $mail_reg, $mdp_reg){
		$connexionManager = new \app\P4_model\ConnexionManager();
		$affectedMember = $connexionManager -> registrationMember($pseudo_reg, $mail_reg, $mdp_reg);

		if ($affectedMember === false) {
	        throw new Exception('Impossible d\'ajouter le membre. Il est possible que le pseudo ou l\'email existe déjà');
	    }
	    else {
	    	$successMsg = "Vous êtes bien inscrit. Veuillez vous connecter pour profiter pleinement de la section commentaire.";
	        header('Location:index.php?action=connexion');
	    }
	}

	function login($pseudo, $mdp){
		$connexionManager = new \app\P4_model\ConnexionManager();
		$loginMember = $connexionManager -> connexionMember($pseudo);

		$isPasswordCorrect = password_verify($mdp, $loginMember['password']);

		if ($loginMember === false)
		{
		    throw new Exception('Impossible de se connecter. Veuillez vérifier votre pseudo ou mot de passe.');
		}
		else
		{
		    if ($isPasswordCorrect) {
		    	if($loginMember['is_admin'] == 0)
		    	{
			        session_start();
			        $_SESSION['id'] = $loginMember['id'];
			        $_SESSION['is_admin'] = $loginMember['is_admin'];
			        $_SESSION['pseudo'] = $loginMember['pseudo'];
			        header('Location:index.php?action=chapters&page=1');
			    } else if($loginMember['is_admin'] == 1)
			    {
					session_start();
			        $_SESSION['id'] = $loginMember['id'];
			        $_SESSION['is_admin'] = $loginMember['is_admin'];
			        $_SESSION['pseudo'] = $loginMember['pseudo'];
			       	header('Location:index.php?action=admin');
			    }
		    }
		    else {
		        throw new Exception('Le mot de passe est incorrect');
		    }
		}
	}

	function admin($admin)
	{
		if(isset($admin) && $admin == 1)
		{

			$commentManager = new \app\P4_model\CommentManager();
	    	$allSignalComments = $commentManager->getSignalComments();
	    	$allComments = $commentManager->getAllComments();

			require('view/backend/adminView.php');
		} else 
		{
			throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
		}
	}

	function logout()
	{ 
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location:index.php?action=connexion');
	}

	function chapters($n_page)
	{
		// $chaptersManager = new \app\P4_model\ChaptersManager();
		// $chapters= $chaptersManager -> getChapters();
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
	    require('view/frontend/chaptersView.php');
	}

	function chapter($id_chapter)
	{
		$chaptersManager = new \app\P4_model\ChaptersManager();
		$commentManager = new \app\P4_model\CommentManager();

		$chapter= $chaptersManager -> getChapter($id_chapter);
		$comments = $commentManager -> getComments($id_chapter);

		if($chapter['online'] == 1)
		{
	   		require('view/frontend/bookView.php');
	   	} else
	   	{
	   		throw new Exception('Ce chapitre n\'existe pas.');
	   	}
	}

	function comments($id_chapter, $author, $comment)
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->addComment($id_chapter, $author, $comment);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible d\'ajouter le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=chapter&id_chapter='.$id_chapter);
	    }
	} 

	function signal($id_comment, $id_chapter)
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->signalComment($id_comment);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible de signaler le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=chapter&id_chapter='.$id_chapter);
	    }

	}