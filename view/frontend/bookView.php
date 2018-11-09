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
		<p class='dotEndChap'> <i class="fas fa-circle"></i></p>
</section>

	<div class="comments">
		<div class='formComment'>
	    	<h2> Laisser un commentaire</h2>
	    	<form action='#' method='POST'>
	    		<label for='pseudo'>Pseudo : </label><input type='type' id='pseudo' class="form-control" value='Admin'size='49' disabled/><br/>
	    		<label for='comment'>Commentaire :</label><textarea id='comment' class="form-control" placeholder='Commentaire' rows='3' cols='50' disabled>Veuillez vous connecter ou vous inscrire. Merci.</textarea><br>
	    		<input type='submit' value='Valider'/>
	    	</form>
	    </div>
    	<div class='listComments'>
    		<?php
    			while($comment = $comments -> fetch()) 
			    {
	    	?>
		    			<p><span><?= htmlspecialchars($comment['author'])?></span> a écrit le <?= $comment['comment_date_fr']?> : <i class="fas fa-exclamation-circle"></i> <i class="fas fa-heart"></i></p>
			    		<p><?= htmlspecialchars($comment['comment'])?></p>
			    		<hr/>
	    	<?php 
			    }
			    $comments->closeCursor();
	    	?>
    	</div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBook.php'); ?>