<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book" ?>

<?php ob_start(); ?>

<section>
		<?php 
			echo '<h1>' . strtoupper($chapter['title']) . '</h1>';
			echo '<div>';
			echo $chapter['content'];
			echo '</div>';
		?>	
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateBook.php'); ?>