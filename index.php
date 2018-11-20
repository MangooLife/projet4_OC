<?php
	session_start();
	require('app/controller/Frontend.php');
	require('app/controller/Backend.php');

	$backend = new \app\controller\Backend();
	$frontend = new \app\controller\Frontend();

	try
	{
		if(isset($_GET['action']))
		{
		
			$action = $_GET['action'];

			switch ($action)
			{
				case 'cover':
					$frontend->cover();
					break;
				case 'mentionsLegales':
					$frontend->legalMentions();
					break;
				case 'chapters':
					if(isset($_GET['page']) && $_GET['page'] > 0)
					{
						$frontend->chapters($_GET['page']);
					} else 
					{
						header('Location:index.php?action=chapters&page=1');
					}
					break;
				case 'chapter':
					if(isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
					{
						$frontend->chapter($_GET['id_chapter']);
					} else 
					{
						throw new Exception('Ce chapitre n\'existe pas...');    	
					}
					break;
				case 'chapterBO':
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if(isset($_GET['page']) && $_GET['page'] > 0)
						{
							$backend->chaptersBO($_GET['page']);
						} else 
						{
							header('Location:index.php?action=chapterBO&page=1');
						}
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				case 'createChapter':
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (!empty($_POST['title']) && !empty($_POST['content'])) {
							$backend->createChapters($_POST['title'], $_POST['content']);
			            } else {

		   					$_SESSION['flashMsgError'] = 'Ce chapitre n\'a pas pu être ajouté. Il manque du contenu.';
		   					header('Location:index.php?action=chapterBO&page=1');
			            }	
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}	
					break;
				case 'updateChapter':
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_chapter']) && $_GET['id_chapter']) {
							$backend->getChapter( $_GET['id_chapter']);
			            } else {
			                throw new Exception('Le chapitre n\'a pas pu être chargé');
			            }	
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				case 'changeChapter':
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_chapter']) && $_GET['id_chapter'] && !empty($_POST['title']) && !empty($_POST['content'])) {
							$backend->changeChapter( $_GET['id_chapter'], $_POST['title'], $_POST['content']);
			            } else {
			                throw new Exception('Le chapitre n\'a pas pu être changé');
			            }	
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				case 'deleteChapter': 
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_chapter']) && $_GET['id_chapter']) {
							$backend->deleteChapter($_GET['id_chapter']);
			            } else {
			                throw new Exception('Le chapitre n\'a pas pu être supprimé');
			            }	
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}	
					break;
				case 'draftChapter': 
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_chapter']) && $_GET['id_chapter']) {
							$backend->draftChapter($_GET['id_chapter']);
			            } else {
			                throw new Exception('Le chapitre n\'a pas pu être mis en brouillon');
			            }	
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}	
					break;
				case 'repostChapter': 
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_chapter']) && $_GET['id_chapter']) {
							$backend->repostChapter($_GET['id_chapter']);
			            } else {
			                throw new Exception('Le chapitre n\'a pas pu être remis en ligne');
			            }	
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}	
					break;
				case 'addComment':
					if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
		                if (!empty($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) {
		                    $frontend->comments($_GET['id_chapter'], $_SESSION['pseudo'], $_POST['comment']);
		                } else {
		                    throw new Exception('Tous les champs ne sont pas remplis !');
		                }
		            }
		            else {
		                throw new Exception('Aucun identifiant de billet envoyé');
		            }
					break;
				case 'signalComment':
					if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
		                if (isset($_GET['id_comment']) && $_GET['id_comment']) {
		                    $frontend->signal($_GET['id_comment'], $_GET['id_chapter']);
		                } else {
		                    throw new Exception('Une erreur s\'est glissée dans votre demande...');
		                }
		            }
		            else {
		                throw new Exception('Une erreur s\'est glissée dans votre demande...');
		            }
					break;
				case 'deleteComment':
			        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_comment']) && $_GET['id_comment']) {
			                $backend->deleteComment($_GET['id_comment']);
			            } else {
			                throw new Exception('Le commentaire n\'a pas pu être supprimé');
			            }
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				case 'valideComment':
				    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						if (isset($_GET['id_comment']) && $_GET['id_comment']) {
			                $backend->validateComment($_GET['id_comment']);
			            } else {
			                throw new Exception('Le commentaire n\'a pas pu être validé');
			            }
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				case 'connexion':
					if(!isset($_SESSION['pseudo']))
					{
						$frontend->connexion();
					} else 
					{
						header('Location:index.php?action=chapters');
					}
					break;
				case 'login':
					if(!empty($_POST['pseudo']) && !empty($_POST['mdp']))
					{
						$frontend->login($_POST['pseudo'], $_POST['mdp']);
					}	
					else
					{
						throw new Exception('Une erreur est parvenue lors de votre connexion.');
					}
					break;
				case 'logout':
					$frontend->logout();
					break;
				case 'registration':
					if(!empty($_POST['pseudo_reg']) && !empty($_POST['mail_reg']) && !empty($_POST['mdp_reg']))
					{
						$frontend->registration($_POST['pseudo_reg'], $_POST['mail_reg'], $_POST['mdp_reg']);
					}
					else
					{
						throw new Exception('Une erreur est parvenue lors de votre inscription.');
					}
					break;
				case 'admin':
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						$frontend->admin($_SESSION['is_admin']);
					}
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				default:
					$frontend->cover();
			}
		}	
		else
		{
			$frontend->cover();
		}
	} 
	catch(Exception $e)
	{
		$errorMessage = $e->getMessage();
    	require('view/errorView.php');
	}