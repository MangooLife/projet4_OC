<?php $title = "Backoffice gérer mes commentaires -Billet simple pour l'Alaska"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

	<section class='story'>
		<h1>Gestion des commentaires</h1>

		<?php 
			if(!empty($_SESSION['flashMsg']) && isset($_SESSION['flashMsg']))
			{
		?>
				<div class="alert alert-success" role="alert">
					<?php 	
							echo $_SESSION['flashMsg'];
							unset($_SESSION['flashMsg']);
					?>
				</div>
		<?php
			} if(!empty($_SESSION['flashMsgError']) && isset($_SESSION['flashMsgError']))
			{
		?>
				<div class="alert alert-danger" role="alert">
					<?php 	
							echo $_SESSION['flashMsgError'];
							unset($_SESSION['flashMsgError']);
					?>
				</div>
		<?php
			}
		?>

		<h2>Les commentaires signalés </h2>

		<table class="table table-striped table-dark">
		  	<thead>
				<tr class="tableactivite">
				   	<th scope="col">
				    	Date
				    </th>
				    <th scope="col">
				    	Article
				    </th>
				    <th scope="col">
				      	Commentaire
				    </th>
				   	<th scope="col">
				      	Options
				    </th>
				</tr>
		  	</thead>
			<tbody>

			<?php while($comment = $allSignalComments->fetch())
				{
			?>	
				<tr class="scale-up-ver-center">
				    <td class="font-weight-bold">
				      	<?= $comment['comment_date'] ?>
				    </td>
				    <td class="lien_tab">
				     	<a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= htmlspecialchars($comment['posts_title']) ?></a>
				    </td>
				    <td>
				      	<?= htmlspecialchars($comment['comment_author']) ?><br/>
						<?= htmlspecialchars($comment['comment_txt']) ?>
				    </td>
				     <td>
				     	<a href="index.php?action=valideComment&amp;id_comment=<?=$comment['comment_id']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
				      	<a href="index.php?action=deleteComment&amp;id_comment=<?=$comment['comment_id']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
				    </td>
			  	</tr>
	  		<?php
				}
				$allSignalComments->closeCursor();
			?>
			</tbody>
		</table>

		<h2>Les commentaires reçus</h2>

		<table class="table table-striped table-dark">
		  	<thead>
				<tr class="tableactivite">
				   	<th scope="col">
				    	Date
				    </th>
				    <th scope="col">
				    	Article
				    </th>
				    <th scope="col">
				      	Auteur / Commentaire
				    </th>
				   	<th scope="col">
				      	Options
				    </th>
				</tr>
		  	</thead>
			<tbody>

		<?php 	while($comment = $allComments->fetch())
				{	
					if($comment['comment_valid']==1) 
					{
		?>
						<tr class="scale-up-ver-center bg-success">
						    <td class="font-weight-bold">
						      	<?= $comment['comment_date'] ?>
						    </td>
						    <td class="lien_tab">
						      	<a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= htmlspecialchars($comment['posts_title']) ?></a>
						    </td>
						    <td>
						      	<?= htmlspecialchars($comment['comment_author']) ?><br/>
						      	<?= htmlspecialchars($comment['comment_txt']) ?>
						    </td>
						    <td>
						    	<a class="btn btn-success"><i class="fas fa-check"></i></i></a>
						      	<a href="index.php?action=deleteComment&amp;id_comment=<?=$comment['comment_id']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
						    </td>
					  	</tr>
		<?php					
					} else if($comment['comment_hide']==1)
					{
		?>
							<tr class="scale-up-ver-center bg-warning">
							    <td class="font-weight-bold">
							      	<?= $comment['comment_date'] ?>
							    </td>
							    <td class="lien_tab">
							      	<a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= htmlspecialchars($comment['posts_title']) ?></a>
							    </td>
							    <td>
							      	<?= htmlspecialchars($comment['comment_author']) ?><br/>
							      	<?= htmlspecialchars($comment['comment_txt']) ?>
							    </td>
							    <td>
							      	<a href="index.php?action=valideComment&amp;id_comment=<?=$comment['comment_id']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
							    </td>
							 </tr>
		<?php
					} else
					{
		?>
						<tr class="scale-up-ver-center">
						    <td class="font-weight-bold">
						      	<?= $comment['comment_date'] ?>
						    </td>
						    <td class="lien_tab">
						      	<a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= htmlspecialchars($comment['posts_title']) ?></a>
						    </td>
						    <td>
						      	<?= htmlspecialchars($comment['comment_author']) ?><br/>
						      	<?= htmlspecialchars($comment['comment_txt']) ?>
						    </td>
						    <td>
						      	<a href="index.php?action=valideComment&amp;id_comment=<?=$comment['comment_id']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
						      	<a href="index.php?action=deleteComment&amp;id_comment=<?=$comment['comment_id']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>						    
						    </td>
						 </tr>
		<?php
	  				}
				}
				$allComments->closeCursor();
		?>
			</tbody>
		</table>
	</section>

<?php unset($_SESSION['lastUrl']);?>
<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?>