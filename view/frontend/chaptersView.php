<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book" ?>

<?php ob_start(); ?>
	
	<h2>Chapitres</h2>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>