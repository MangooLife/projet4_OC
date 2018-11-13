<?php
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
					chapters();
					break;
				case 'chapter':
					if(isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
					{
						chapter();
					} else 
					{
						chapters();	
					}
					break;
				case 'addComment':
					if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
		                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
		                    comments($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
		                } else {
		                    throw new Exception('Tous les champs ne sont pas remplis !');
		                    // require('view/errorCommentaire.php');
		                }
		            }
		            else {
		                throw new Exception('Aucun identifiant de billet envoyé');
		            }
					break;
				case 'signalComment':
					if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
		                if (isset($_GET['id_comment']) && $_GET['id_comment']) {
		                    signal();
		                } else {
		                    throw new Exception('Une erreur s\'est glissée dans votre demande...');
		                    // require('view/errorCommentaire.php');
		                }
		            }
		            else {
		                throw new Exception('Une erreur s\'est glissée dans votre demande...');
		            }
					break;
				case 'deleteComment':
			        if(isset($_GET['admin']) && $_GET['admin'] == 1)
					{
						if (isset($_GET['id_comment']) && $_GET['id_comment']) {
			                deleteComment();
			            } else {
			                throw new Exception('Le commentaire n\'a pas pu être supprimé');
			            	// require('view/errorCommentaire.php');
			            }
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
					break;
				case 'valideComment':
				    if(isset($_GET['admin']) && $_GET['admin'] == 1)
					{
						if (isset($_GET['id_comment']) && $_GET['id_comment']) {
			                validateComment();
			            } else {
			                throw new Exception('Le commentaire n\'a pas pu être validé');
			            	// require('view/errorCommentaire.php');
			            }
			        }
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette partie du site');
					}
					break;
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
						login();
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
						registration();
					}
					else
					{
						throw new Exception('Une erreur est parvenue lors de votre inscription.');
					}
					break;
				case 'admin':
					if(isset($_GET['admin']) && $_GET['admin'] == 1)
					{
						admin();
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
		echo $errorMessage;
    	// require('view/errorView.php');
	}