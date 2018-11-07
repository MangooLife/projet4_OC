<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "cover" ?>

<?php ob_start(); ?>
	
<a href="index.php?action=chapters">Lire le roman</a>	

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>