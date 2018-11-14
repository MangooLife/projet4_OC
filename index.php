<?php
	session_start();
	require('controller/frontend.php');
	require('controller/backend.php');

	try
	{
		if(isset($_GET['action']))
		{
		
			$action = $_GET['action'];

			switch ($action)
			{
				case 'cover':
					cover();
					break;
				case 'chapters':
					if(isset($_GET['page']) && $_GET['page'] > 0)
					{
						chapters($_GET['page']);
					} else 
					{
						throw new Exception('Il n\'y pas autant de chapitres...');
					}
					break;
				case 'chapter':
					if(isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
					{
						chapter($_GET['id_chapter']);
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
							chaptersBO($_GET['page']);
						} else 
						{
							throw new Exception('Il n\'y pas autant de chapitres...');
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
							createChapters($_POST['title'], $_POST['content']);
			            } else {
			                throw new Exception('Le chapitre n\'a pas pu être supprimé');
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
							getChapter( $_GET['id_chapter']);
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
							changeChapter( $_GET['id_chapter'], $_POST['title'], $_POST['content']);
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
							deleteChapter($_GET['id_chapter']);
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
							draftChapter($_GET['id_chapter']);
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
							repostChapter($_GET['id_chapter']);
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
		                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
		                    comments($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
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
		                    signal($_GET['id_comment'], $_GET['id_chapter']);
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
			                deleteComment($_GET['id_comment']);
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
			                validateComment($_GET['id_comment']);
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
						connexion();
					} else 
					{
						header('Location:index.php?action=chapters');
					}
					break;
				case 'login':
					if(!empty($_POST['pseudo']) && !empty($_POST['mdp']))
					{
						login($_POST['pseudo'], $_POST['mdp']);
					}	
					else
					{
						throw new Exception('Une erreur est parvenue lors de votre connexion.');
					}
					break;
				case 'logout':
					logout();
					break;
				case 'registration':
					if(!empty($_POST['pseudo_reg']) && !empty($_POST['mail_reg']) && !empty($_POST['mdp_reg']))
					{
						registration($_POST['pseudo_reg'], $_POST['mail_reg'], $_POST['mdp_reg']);
					}
					else
					{
						throw new Exception('Une erreur est parvenue lors de votre inscription.');
					}
					break;
				case 'admin':
					if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)
					{
						admin($_SESSION['is_admin']);
					}
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
				default:
					cover();
			}
		}	
		else
		{
			cover();
		}
	} 
	catch(Exception $e)
	{
		$errorMessage = $e->getMessage();
    	require('view/errorView.php');
	}