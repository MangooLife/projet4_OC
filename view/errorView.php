<?php $title = "Oops, Erreur - Billet simple pour l'Alaska"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

   	<section class='story'>
    	<h1><?= $errorMessage ?></h1>
		<p><a class="retour" href="index.php?action=covers"><i class="fas fa-arrow-circle-left"></i> Retour à l'accueil</a></p>
		<img src="./public/images/stop.jpg" alt='erreur 404' class='stopErreur'/>
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontend/templateBook.php'); ?>