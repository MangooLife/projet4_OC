<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

<section class='story'>
	<h1>Bienvenue sur votre espace administrateur</h1>

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
		      <a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= $comment['posts_title'] ?></a>
		    </td>
		    <td>
		      <?= $comment['comment_txt'] ?>
		    </td>
		     <td>
		      <a href="index.php?action=deleteComment&amp;id_comment=<?=$comment['comment_id']?>&amp;admin=<?=$_SESSION['is_admin']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
		      <a href="index.php?action=valideComment&amp;id_comment=<?=$comment['comment_id']?>&amp;admin=<?=$_SESSION['is_admin']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
		    </td>
	  	</tr>
  
  	<?php
			}
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
		      Commentaire
		    </th>
		   	<th scope="col">
		      Options
		    </th>
		</tr>
	  	</thead>
		<tbody>

	<?php 	while($comment = $allComments->fetch())
			{	
				switch ($comment['comment_management']) 
				{
					case 1:
	?>
						<tr class="scale-up-ver-center bg-success">
						    <td class="font-weight-bold">
						      <?= $comment['comment_date'] ?>
						    </td>
						    <td class="lien_tab">
						      <a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= $comment['posts_title'] ?></a>
						    </td>
						    <td>
						      <?= $comment['comment_txt'] ?>
						    </td>
						     <td>
						      <a href="index.php?action=deleteComment&amp;id_comment=<?=$comment['comment_id']?>&amp;admin=<?=$_SESSION['is_admin']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
						    </td>
					  	</tr>
	<?php					
						break;
					case 2:
	?>
						<tr class="scale-up-ver-center bg-warning">
						    <td class="font-weight-bold">
						      <?= $comment['comment_date'] ?>
						    </td>
						    <td class="lien_tab">
						      <a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= $comment['posts_title'] ?></a>
						    </td>
						    <td>
						      <?= $comment['comment_txt'] ?>
						    </td>
						     <td>
						      <a href="index.php?action=valideComment&amp;id_comment=<?=$comment['comment_id']?>&amp;admin=<?=$_SESSION['is_admin']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
						    </td>
						 </tr>
	<?php
						break;
					default: 
	?>
						<tr class="scale-up-ver-center">
						    <td class="font-weight-bold">
						      <?= $comment['comment_date'] ?>
						    </td>
						    <td class="lien_tab">
						      <a href="index.php?action=chapter&id_chapter=<?= $comment['posts_id'] ?>"><?= $comment['posts_title'] ?></a>
						    </td>
						    <td>
						      <?= $comment['comment_txt'] ?>
						    </td>
						     <td>
						      <a href="index.php?action=valideComment&amp;id_comment=<?=$comment['comment_id']?>&amp;admin=<?=$_SESSION['is_admin']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
						      <a href="index.php?action=deleteComment&amp;id_comment=<?=$comment['comment_id']?>&amp;admin=<?=$_SESSION['is_admin']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>						    
						    </td>
						 </tr>
	<?php
  				}
			}
	?>
		</tbody>
	</table>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?>