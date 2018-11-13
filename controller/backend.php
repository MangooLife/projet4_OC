<?php
	require_once('app/P4_model/ChaptersManager.php');
	require_once('app/P4_model/CommentManager.php');
	require_once('app/P4_model/ConnexionManager.php');

	function deleteComment()
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->hideComment($_GET['id_comment']);
	    $affectedLines = $commentManager->checkedComment($_GET['id_comment']);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible de supprimer le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=admin&admin='.$_GET['admin']);
	    }
	}

	function validateComment()
	{
		$commentManager = new \app\P4_model\CommentManager();

	    $affectedLines = $commentManager->validComment($_GET['id_comment']);
	    $affectedLines = $commentManager->checkedComment($_GET['id_comment']);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible de valider le commentaire !');
	    }
	    else {
	        header('Location:index.php?action=admin&admin='.$_GET['admin']);
	    }
	}