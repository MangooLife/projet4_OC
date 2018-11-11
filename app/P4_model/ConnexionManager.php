<?php 
	namespace app\P4_model;

    require_once("app/P4_model/Manager.php");

	class ConnexionManager extends Manager
	{
		function registrationMember($pseudo, $email, $password)
		{
			$db = $this->dbConnect();

			$pass_hache = password_hash($password, PASSWORD_DEFAULT);

			$req = $db->prepare('INSERT INTO members(id_user, pseudo, email, password, date_reg) VALUES(1, :pseudo, :email, :password, NOW())');
			$req->execute(array(
			    'pseudo' => $pseudo,
			    'email' => $email,
			    'password' => $pass_hache
			));

			return $req;
		}

		function connexionMember($pseudo)
		{
			$db = $this->dbConnect();

			$req = $db->prepare('SELECT id, pseudo, password FROM members WHERE pseudo = :pseudo');
			$req->execute(array(
			    'pseudo' => $pseudo
			));
			$resultat = $req->fetch();

			return $resultat;
		}
	}