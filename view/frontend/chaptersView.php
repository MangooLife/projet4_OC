<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book" ?>

<?php ob_start(); ?>
	
	<p>Chapitres</p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>