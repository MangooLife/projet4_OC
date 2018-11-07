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
					getCover();
					break;
				case 'chapters':
					getChapters();
					break;
				// case: 'chapter'
				// break;
				// case: 'addComment':
				// break;
				// case: 'changeCommnent':
				// break;
				// case: 'deleteComment':
				// break;
				default:
					getCover();
			}
		}	
		else
		{
			getCover();
		}
	} 
	catch(Exception $e)
	{
		$errorMessage = $e->getMessage();
    	require('view/errorView.php');
	}