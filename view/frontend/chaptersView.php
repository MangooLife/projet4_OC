<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

   	<section class='story'>
    	<h1>CHAPITRES</h1>
		<?php 
			while($chapter = $chapters -> fetch())
			{
				if($chapter['online'] == 1)
				{
					echo '<div>';
					echo '<h2>' . strtoupper(strip_tags($chapter['title'])) . '</h2>';
					echo '<p>'.strip_tags($chapter['excerpt']).'...</p>';
					echo '<p><a href="index.php?action=chapter&amp;id_chapter='.$chapter['id'].'">Lire le chapitre</a></p>';
					echo '</div>';
				}
			}
			$chapters->closeCursor();
		?>	

		<div>
		 	<ul class="pagination pagination-sm">
		 		<?php 
			 		for ($i=1; $i < $pagesTotal + 1; $i++) { 
			 			if($_GET['page'] == $i)
			 			{
			 	?>
							<li class="page-item disabled">
								<a class="page-link" href="index.php?action=chapters&amp;page=<?=$i?>" tabindex="-1"><?=$i?></a>
							</li>
				<?php
			 			} else 
			 			{
			 	?>
			 				<li class="page-item"><a class="page-link" href="index.php?action=chapters&amp;page=<?=$i?>"><?=$i?></a></li>
			 	<?php
			 			}
					}
				?>
		  	</ul>
		</div>

	</section>

	
<?php $content = ob_get_clean(); ?>

<?php require('templateBook.php'); ?>


