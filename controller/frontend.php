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
	        throw new Exception('Impossible d\'ajouter le membre !');
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
		        session_start();
		        $_SESSION['id'] = $loginMember['id'];
		        $_SESSION['pseudo'] = $loginMember['pseudo'];
		        header('Location:index.php?action=chapters');
		    }
		    else {
		        throw new Exception('Le mot de passe est incorrect');
		    }
		}
	}

	function logout()
	{ 
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location:index.php?action=chapters');
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