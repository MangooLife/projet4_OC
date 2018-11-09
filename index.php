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
					if(isset($_GET['id_chapter']))
					{
						chapter();
					}
					break;
				// case: 'addComment':
					// break;
				// case: 'changeCommnent':
					// break;
				// case: 'deleteComment':
					// break;
				// case: 'signalComment':
					// break
				// case: 'login':
					// break;
				// case: 'logout':
					// break;
				// case: 'registration':
					// break;
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