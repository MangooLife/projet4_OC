<?php 
	namespace app\P4_model;

    require_once("app/P4_model/Manager.php");

	class ConnexionManager extends Manager
	{
		function registrationMember($pseudo, $email, $password)
		{
			$db = $this->dbConnect();

			$pass_hache = password_hash($password, PASSWORD_DEFAULT);

			// on recherche si ce login est déjà utilisé par un autre membre
			$req = $db->prepare('SELECT * FROM members WHERE email=:email OR pseudo=:pseudo');
			$req -> execute(array(
					'email' => $email,
					'pseudo' => $pseudo
				));
			$resultat = $req->fetch();

			if (!$resultat) {
				$member = $db->prepare('INSERT INTO members(is_admin, pseudo, email, password, date_reg) VALUES(0, :pseudo, :email, :password, NOW())');
				$member->execute(array(
				    'pseudo' => $pseudo,
				    'email' => $email,
				    'password' => $pass_hache
				));
			}
			else {
				$member = false;
			}

			return $member;
		}

		function connexionMember($pseudo)
		{
			$db = $this->dbConnect();

			$req = $db->prepare('SELECT id, is_admin, pseudo, password FROM members WHERE pseudo = :pseudo');
			$req->execute(array(
			    'pseudo' => $pseudo
			));
			$resultat = $req->fetch();

			return $resultat;
		}
	}