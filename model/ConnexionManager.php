<?php 
	namespace projet4\model;

    require_once("model/Manager.php");

	class InscriptionMember extends Manager()
	{
		// Vérification de la validité des informations

		// Hachage du mot de passe
		$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

		// Insertion
		$req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
		$req->execute(array(
		    'pseudo' => $pseudo,
		    'pass' => $pass_hache,
		    'email' => $email));
	}

	class ConnexionMember extends Manager()()
	{
		//  Récupération de l'utilisateur et de son pass hashé
		$req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
		$req->execute(array(
		    'pseudo' => $pseudo));
		$resultat = $req->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

		if (!$resultat)
		{
		    echo 'Mauvais identifiant ou mot de passe !';
		}
		else
		{
		    if ($isPasswordCorrect) {
		        session_start();
		        $_SESSION['id'] = $resultat['id'];
		        $_SESSION['pseudo'] = $pseudo;
		        echo 'Vous êtes connecté !';
		    }
		    else {
		        echo 'Mauvais identifiant ou mot de passe !';
		    }
		}
	}
	/* <?php 
		session_start();

		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		setcookie('login', '');
		setcookie('pass_hache', '');
	*/