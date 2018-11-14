<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

   	<section class='story'>
    	<h1><?= $errorMessage ?></h1>
		<img src="./public/images/stop.jpg" alt='erreur 404' class='stopErreur'/>
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontend/templateBook.php'); ?>