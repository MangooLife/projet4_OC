<?php
	namespace app\controller;

	require_once('app/P4_model/PostsManager.php');
	require_once('app/P4_model/CommentsManager.php');
	require_once('app/P4_model/MembersManager.php');

	class Frontend
	{
		function cover()
		{
		    require('view/frontend/coverView.php');
		}

		function legalMentions()
		{
			require('view/frontend/legalView.php');
		}

		function connexion()
		{
		    require('view/frontend/userLoginView.php');
		}

		function registration($pseudo_reg, $mail_reg, $mdp_reg){
			$connexionManager = new \app\P4_model\MembersManager();

			$verificationPseudo = preg_match('#^.{6,}$#', $pseudo_reg);
			$verificationPassword = preg_match_all('#^.{6,}$#', $mdp_reg);

			if($verificationPseudo)
			{
				if($verificationPassword)
				{
					$affectedMember = $connexionManager -> registrationMember($pseudo_reg, $mail_reg, $mdp_reg);

					if ($affectedMember === false) {
				        $_SESSION['flashMsg'] = 'Impossible d\'ajouter le membre. Il est possible que le pseudo ou l\'email existe déjà';
				        header('Location:index.php?action=connexion');
				    }
				    else {
				    	$_SESSION['flashMsg'] = "Vous êtes bien inscrit. Vous pouvez désormais profiter de la section commentaire.";
				        $this->login($pseudo_reg, $mdp_reg);
				    }
				} else
				{
					$_SESSION['flashMsg'] = 'Votre mot de passe n\'est pas assez fort. Il faut au moins 6 caractères.';
					header('Location:index.php?action=connexion');
				}
			} else
			{
				$_SESSION['flashMsg'] = 'Votre pseudo n\'est pas assez long. Il faut au moins 6 caractères.';
				header('Location:index.php?action=connexion');
			}
		}

		function login($pseudo, $mdp){
			$connexionManager = new \app\P4_model\MembersManager();
			$loginMember = $connexionManager -> connexionMember($pseudo);

			$isPasswordCorrect = password_verify($mdp, $loginMember['password']);

			if ($loginMember === false)
			{
			    $_SESSION['flashMsg'] = 'Impossible de se connecter. Veuillez vérifier votre pseudo ou mot de passe.';
				header('Location:index.php?action=connexion');
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

				        if(!empty($_SESSION['lastUrl']) && isset($_SESSION['lastUrl']))
				        {
				        	header('Location:index.php?action=chapter&id_chapter='.$_SESSION['lastUrl']);
				        } else
				        {
				       		header('Location:index.php?action=chapters&page=1');
				       	}
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
			        $_SESSION['flashMsg'] = 'Le mot de passe est incorrect.';
			        header('Location:index.php?action=connexion');
			    }
			}
		}

		function admin($admin)
		{
			if(isset($admin) && $admin == 1)
			{

				$commentManager = new \app\P4_model\CommentsManager();
		    	$allSignalComments = $commentManager->getSignalComments();
		    	$allComments = $commentManager->getAllComments();

				require('view/backend/adminView.php');
			} else 
			{
				$_SESSION['flashMsgError'] = 'Vous n\'êtes pas autorisé à accéder à cette partie du site';
				header('Location:index.php?action=chapters&page=1');
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
			$chapters= $chaptersManager->getChapters($start, $chapterPerPage);
		    require('view/frontend/chaptersView.php');
		}

		function chapter($id_chapter)
		{
			$chaptersManager = new \app\P4_model\PostsManager();
			$commentManager = new \app\P4_model\CommentsManager();

			$chapter= $chaptersManager -> getChapter($id_chapter);
			$comments = $commentManager -> getComments($id_chapter);
			$lastChapter = $chaptersManager -> getLastChapter();

			$previousChapter = $chaptersManager -> getChapter($id_chapter-1);
			$totalPrevious = $id_chapter;
			for ($i=1; ($previousChapter == false  || $previousChapter['online']==0)&&$totalPrevious > 0; $i++) { 
				$totalPrevious = $id_chapter-$i;
				$previousChapter = $chaptersManager -> getChapter($totalPrevious);
			}

			$nextChapter = $chaptersManager -> getChapter($id_chapter+1);
			$totalNext = $id_chapter;
			for ($i=1; ($nextChapter == false || $nextChapter['online'] == 0) && $totalNext < $lastChapter['id']; $i++) { 
				$totalNext = $id_chapter+$i;
				$nextChapter = $chaptersManager -> getChapter($totalNext);
			}

			if($chapter['online'] == 1)
			{
				
		   		require('view/frontend/bookView.php');
		   	} else
		   	{
		   		$_SESSION['flashMsgError'] = 'Ce chapitre n\'existe pas.';
		   		header('Location:index.php?action=chapters');		   	}
		}

		function comments($id_chapter, $author, $comment)
		{
			$commentManager = new \app\P4_model\CommentsManager();

		    $affectedLines = $commentManager->addComment($id_chapter, $author, $comment);

		    if ($affectedLines === false) {
		    	$_SESSION['flashMsgError'] = 'Impossible d\'ajouter le commentaire !';
		   		header('Location:index.php?action=chapter&id_chapter='.$id_chapter.'#commentaires');
		    }
		    else {
		        header('Location:index.php?action=chapter&id_chapter='.$id_chapter.'#commentaires');
		    }
		} 

		function signal($id_comment, $id_chapter)
		{
			$commentManager = new \app\P4_model\CommentsManager();

		    $affectedLines = $commentManager->signalComment($id_comment);

		    if ($affectedLines === false) {
		    	$_SESSION['flashMsgError'] = 'Impossible de signaler le commentaire !';
		        header('Location:index.php?action=chapter&id_chapter='.$id_chapter.'#commentaires');
		    }
		    else {
		        header('Location:index.php?action=chapter&id_chapter='.$id_chapter.'#commentaires');
		    }

		}
	}