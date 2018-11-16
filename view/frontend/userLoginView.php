<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>

<?php ob_start(); ?>
	
	<section class='connexionPage'>
		<h1>Connexion à mon espace <i class="fas fa-user-circle"></i></h1>
		<div class='formConnexion'>
			<div class='connexion'>
				<h2>Connexion</h2>
				<form action='index.php?action=login' method='POST'>	
					<label for='pseudo'>Pseudo<br/><input type='text' id='pseudo' name='pseudo' required/></label><br/>
					<label for='mdp'>Mot de passe<br/><input type='password' id='mdp' name='mdp' required/></label><br/>
					<input type='submit' value='Connexion'/>
				</form>
				<hr/>
				<a class="retour" href="index.php?action=covers"><i class="fas fa-arrow-circle-left"></i> Retour résumé</a><br/>
				<a class="retour" href="index.php?action=chapters&amp;page=1"><i class="fas fa-arrow-circle-left"></i> Retour aux chapitres</a>
			</div>
			<div class='registration'>
				<h2>Inscription</h2>
				<form action='index.php?action=registration' method='POST'>	
					<label for='mail_reg'>Mail<br/><input type='email' id='mail_reg' name='mail_reg' placeholder='user@monmail.com' required/></label><br/>
					<label for='pseudo_reg'>Pseudo<br/><input type='text' id='pseudo_reg' name='pseudo_reg' placeholder='Min 6 caractères' required/></label><br/>
					<label for='mdp_reg'>Mot de passe<br/><input type='password' id='mdp_reg' name='mdp_reg' placeholder='Min 6 caractères' required/></label><br/>
					<input type='submit' value='Inscription'/>
				</form>
				<?php 
					if(!empty($successMsg))
					{
				?>
						<div class="alert alert-secondary" role="alert">
						  <?php echo $successMsg; ?>
						</div>
				<?php
					}
				?>
			</div>
		</div>
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>