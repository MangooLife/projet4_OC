<?php require './app/widget/Form.php' ?>
<?php $title = "Connexion à mon espace lecteur - Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>
	
	<section class='connexionPage'>
		<h1>Connexion à mon espace <i class="fas fa-user-circle"></i></h1>
		<?php 
			if(!empty($_SESSION['flashMsg']) && isset($_SESSION['flashMsg']))
			{
		?>
				<div class="alert alert-warning" role="alert">
					<?php 	
							echo $_SESSION['flashMsg'];
							unset($_SESSION['flashMsg']);
					?>
				</div>
		<?php
			}
			$form =new \app\widget\Form();
		?>
		<div class='formConnexion'>
			<div class='connexion'>
				<h2>Connexion</h2>
				<form action='index.php?action=login' method='POST'>
					<?php echo $form->input('Pseudo','text','pseudo'); ?>
					<?php echo $form->input('Mot de passe','password','mdp'); ?>
					<?php echo $form->submit('Connexion'); ?>
				</form>
				<hr/>
				<a class="retour" href="index.php?action=covers"><i class="fas fa-arrow-circle-left"></i> Retour à l'accueil</a><br/>
				<a class="retour" href="index.php?action=chapters&amp;page=1"><i class="fas fa-arrow-circle-left"></i> Retour aux chapitres</a>
			</div>
			<div class='registration'>
				<h2>Inscription</h2>
				<form action='index.php?action=registration' method='POST'>
					<?php echo $form->input('Mail','email','mail_reg',' johnDOE@mail.com'); ?>
					<?php echo $form->input('Pseudo','text','pseudo_reg', ' 6 caractères et plus'); ?>
					<?php echo $form->input('Mot de passe','password','mdp_reg', ' 6 caractères et plus'); ?>
					<?php echo $form->submit('Inscription'); ?>	
				</form>
			</div>
		</div>
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>