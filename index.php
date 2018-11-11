<?php
	require('controller/frontend.php');

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
				// case 'changeCommnent':
					// break;
				// case 'deleteComment':
					// break;
				// case 'signalComment':
					// break
				case 'connexion':
					connexion();
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