<?php session_start() ?>
<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

<section class='story'>
		<?php 
			echo '<h1>' . strtoupper($chapter['title']) . '</h1>';
			echo '<p>';
			echo $chapter['content'];
			echo '</p>'; 
		?>
</section>

<section class="comments">
	<div class='formComment'>
    	<h2>Laisser un commentaire</h2>
    	<?php if(isset($_SESSION['pseudo'])) 
			{
    	?>
		    	<form action='index.php?action=addComment&amp;id_chapter=<?= $chapter['id'] ?>' method='POST'>
		    		<label for='author'>author : </label><input type='type' id='author' name='author' class="form-control" size='49' value='<?= htmlspecialchars($_SESSION['pseudo'])?>' readonly/><br/>
		    		<label for='comment'>Commentaire :</label><textarea id='comment' name='comment' class="form-control" placeholder='Un commentaire ?' rows='3' cols='50' required ></textarea><br>
		    		<input type='submit' value='Valider'/>
		    	</form>
		<?php 
			} else
			{
		?>
				<form action='#' method='POST'>
		    		<label for='author'>author : </label><input type='type' id='author' name='author' class="form-control" value='Admin'size='49' disabled/><br/>
		    		<label for='comment'>Commentaire :</label><textarea id='comment' name='comment' class="form-control" value='Veuillez vous connecter ou vous inscrire. Merci.' rows='3' cols='50' disabled>Veuillez vous connecter ou vous inscrire. Merci.</textarea><br>
		    		<input type='submit' value='Valider'/>
		    	</form>
		<?php
			}
		?>
    </div>
	<div class='listComments'>
		<?php
			while($comment = $comments -> fetch()) 
		    {	
		    	if($comment['report'] == 0)
		    	{
		?>
		    		<p><span><?= htmlspecialchars($comment['author'])?></span> 
	    				a écrit le <?= $comment['comment_date_fr']?> <i class='fas fa-exclamation-circle'></i> : 
	    			</p>
		    		<p><?= htmlspecialchars($comment['comment'])?> -
		    		<a href='index.php?action=signalComment&amp;id_chapter=<?= $chapter['id']?>&amp;id_comment=<?= $comment['id']?>'>
	    				Signaler le commentaire
	    			</a>
	    			</p>
		<?php
		    	} else 
		    	{
		    		switch ($comment['management']) 
		    		{
		    			case '0':
		?>
		    				<p><span><?= htmlspecialchars($comment['author'])?></span> 
			    				a écrit le <?= $comment['comment_date_fr']?> <i class='fas fa-eye'></i> :
			    			</p>
				    		<p><?= htmlspecialchars($comment['comment'])?></p>
				    		
		<?php
		    				break;
		    			case '1':
		?>
		    				<p><span> <?= htmlspecialchars($comment['author'])?></span> 
			    				a écrit le <?= $comment['comment_date_fr']?> <i class='fas fa-check-circle'></i> : 
			    			</p>
				    		<p><?= htmlspecialchars($comment['comment'])?></p>
		<?php
		    				break;
		    			case '2':
		?>
		    				<p><span><?= htmlspecialchars($comment['author'])?></span> 
			    				a écrit le <?= $comment['comment_date_fr']?> : 
			    			</p>
				    		<p><i class='fas fa-lock'></i> Commentaire supprimé.</p>
		<?php
		    				break;
		    		}
		    	}
		    	echo '<hr/>';
		    }
		    $comments->closeCursor();
    	?>
	</div>
</section>

<?php $content = ob_get_clean(); ?>
		<script src="./public/js/commentSection.js"></script>
		<script src="./public/js/main.js"></script>
<?php require('templateBook.php'); ?>