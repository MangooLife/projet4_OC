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

	function registration(){
		$connexionManager = new \app\P4_model\ConnexionManager();
		$affectedMember = $connexionManager -> registrationMember($_POST['pseudo_reg'], $_POST['mail_reg'], $_POST['mdp_reg']);

		if ($affectedMember === false) {
	        throw new Exception('Impossible d\'ajouter le membre. Il est possible que le pseudo ou l\'email existe déjà');
	    }
	    else {
	        header('Location:index.php?action=chapters');
	    }
	}

	function login(){
		$connexionManager = new \app\P4_model\ConnexionManager();
		$loginMember = $connexionManager -> connexionMember($_POST['pseudo']);

		$isPasswordCorrect = password_verify($_POST['mdp'], $loginMember['password']);

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
			        header('Location:index.php?action=chapters');
			    } else if($loginMember['is_admin'] == 1)
			    {
					session_start();
			        $_SESSION['id'] = $loginMember['id'];
			        $_SESSION['is_admin'] = $loginMember['is_admin'];
			        $_SESSION['pseudo'] = $loginMember['pseudo'];
			       	header('Location:index.php?action=admin&admin='.$loginMember['is_admin']);
			    }
		    }
		    else {
		        throw new Exception('Le mot de passe est incorrect');
		    }
		}
	}

	function admin()
	{
		if(isset($_GET['admin']) && $_GET['admin'] == 1)
		{
			session_start();

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

		if($chapter['online'] == 1)
		{
	   		require('view/frontend/bookView.php');
	   	} else
	   	{
	   		throw new Exception('Ce chapitre n\'existe pas.');
	   	}
	}

	function comments($postId, $author, $comment)
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->addComment($postId, $author, $comment);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible d\'ajouter le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=chapter&id_chapter='.$postId);
	    }
	} 

	function signal()
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->signalComment($_GET['id_comment']);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible de signaler le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=chapter&id_chapter='.$_GET['id_chapter']);
	    }

	}