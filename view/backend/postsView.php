<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

	<section class='story'>
		<h1>Gestion de mes chapitres</h1>

		<?php 
			if(!empty($_SESSION['flashMsg']) && isset($_SESSION['flashMsg']))
			{
		?>
				<div class="alert alert-info" role="alert">
					<?php 	
							echo $_SESSION['flashMsg'];
							unset($_SESSION['flashMsg']);
					?>
				</div>
		<?php
			}
		?>

		<p class='ajoutPost'><button><i class="fas fa-plus"></i> Ajouter un chapitre</button></p>

		<form class='formPost' action='index.php?action=createChapter' method='POST'>
			<label for='title'>Titre</label><input type='text' name='title' id='title' placeholder='Titre' class='form-control' required/><br/>
			<label for='content'>Contenu</label><textarea name='content' id='content' rows='10' class='form-control'></textarea>
			<input type='submit' class='btn btn-success' value='Envoyer'/>
			<input type='button' class='btn btn-danger annuler' value='Annuler'/>
		</form>

		<table class="table table-striped table-dark">
		  	<thead>
				<tr class="tableactivite">
				   	<th scope="col">
				    	Date
				    </th>
				    <th scope="col">
				    	Article / Extrait
				    </th>
				   	<th scope="col">
				      	Options
				    </th>
				</tr>
		  	</thead>
			<tbody>

		<?php 
			while($chapter = $chapters->fetch())
			{
				switch ($chapter['online'])
				{
						case 0:
		?>
							<tr class="scale-up-ver-center bg-warning">
							    <td class="font-weight-bold">
							      	<?= $chapter['creation_date_fr'] ?>
							    </td>
							    <td class="lien_tab">
							      	<a href="index.php?action=chapter&id_chapter=<?= $chapter['id'] ?>"><?=strip_tags($chapter['title']) ?></a><br/>
							      	<?= strip_tags($chapter['excerpt']) ?>
							    </td>
							    <td>
							      	<a href="index.php?action=repostChapter&amp;id_chapter=<?=$chapter['id']?>" class="btn btn-success"><i class="fas fa-check-square"></i></a>
							      	<a href="index.php?action=updateChapter&amp;id_chapter=<?=$chapter['id']?>" class="btn btn-primary"><i class="fas fa-pen update"></i></a>
							      	<button class="btn btn-danger" onclick="softDeleteFunction(<?= $chapter['id'] ?>,'<?= $chapter['title'] ?>')"><a id="softDeletePost"><i class="fas fa-trash-alt"></i></a></button>
							    </td>
						  	</tr>
	  
	  	<?php
	  						break;
	  					case 1:
	  	?>
	  						<tr class="scale-up-ver-center">
							    <td class="font-weight-bold">
							      	<?= $chapter['creation_date_fr'] ?>
							    </td>
							    <td class="lien_tab">
							      	<a href="index.php?action=chapter&id_chapter=<?= $chapter['id'] ?>"><?= strip_tags($chapter['title']) ?></a><br/>
							      	<?= strip_tags($chapter['excerpt']) ?>...
							    </td>
							    <td>
							      	<a href="index.php?action=draftChapter&amp;id_chapter=<?=$chapter['id']?>" class="btn btn-light"><i class="fas fa-file-contract"></i></a>
							      	<a href="index.php?action=updateChapter&amp;id_chapter=<?=$chapter['id']?>" class="btn btn-primary update"><i class="fas fa-pen update"></i></a>
							      	<button class="btn btn-danger" onclick="softDeleteFunction(<?= $chapter['id'] ?>,'<?= $chapter['title'] ?>')"><a id="softDeletePost"><i class="fas fa-trash-alt"></i></a></button>
							    </td>
						  	</tr>
	  	<?php
  						break;
  				}
  		?>
  					<script>
						function softDeleteFunction(numChapter, titleChapter) {
						    var msgConfirmation = confirm("Attention ! Voulez-vous vraiment supprimer ce chapitre "+titleChapter);
						    if (msgConfirmation == true) {
						        document.location.href="index.php?action=deleteChapter&id_chapter="+numChapter;
						    } 
						}
					</script>
		<?php
			}
			$chapters->closeCursor();
		?>
			</tbody>
		</table>

		<div>
		 	<ul class="pagination pagination-sm">
		 		<?php 
			 		for ($i=1; $i < $pagesTotal + 1; $i++) { 
			 			if($_GET['page'] == $i)
			 			{
			 	?>
							<li class="page-item disabled">
								<a class="page-link" href="index.php?action=chapterBO&amp;page=<?=$i?>" tabindex="-1"><?=$i?></a>
							</li>
				<?php
			 			} else 
			 			{
			 	?>
			 				<li class="page-item"><a class="page-link" href="index.php?action=chapterBO&amp;page=<?=$i?>"><?=$i?></a></li>
			 	<?php
			 			}
					}
				?>
		  	</ul>
		</div>

	</section>

<?php $content = ob_get_clean(); ?>
	<script src="./public/js/postSection.js"></script>
<?php require('adminTemplate.php'); ?>