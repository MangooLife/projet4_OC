<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>
<?php $bodyClass = "book"; ?>

<?php ob_start(); ?>

	<section class='story'>
		<h1>Modifier mon chapitre - <?= $chapterLine['title'] ?></h1>
		<form class='updatePost' action='index.php?action=changeChapter&amp;id_chapter=<?= $chapterLine['id'] ?>' method='POST'>
			<label for='title'>Titre</label><input type='text' name='title' id='title' placeholder='Titre' class='form-control' value='<?= $chapterLine['title'] ?>' required/><br/>
			<label for='content'>Contenu</label><textarea name='content' id='content' rows='10' class='form-control'><?= $chapterLine['content'] ?></textarea>
			<input type='submit' class='btn btn-success' value='Changer'/>
		</form>
	</section>

<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?>