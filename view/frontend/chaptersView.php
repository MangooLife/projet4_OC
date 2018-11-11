<?php session_start(); ?>
<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

   	<section class='story'>
    	<h1>CHAPITRES</h1>
		<?php 
			while($chapter = $chapters -> fetch())
			{
				echo '<div>';
				echo '<h2>' . strtoupper($chapter['title']) . '</h2>';
				echo $chapter['excerpt'] . '...';
				echo '<a href="index.php?action=chapter&amp;id_chapter='.$chapter['id'].'"><br/>Lire le chapitre</a>';
				echo '</div>';
			}
			$chapters->closeCursor();
		?>	
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateBook.php'); ?>


