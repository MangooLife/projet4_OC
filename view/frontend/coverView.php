<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>

<?php ob_start(); ?>

	<section class="infoCover">
		<h1>Billet simple pour l'Alaska <i class="fas fa-feather-alt"></i></h1>

		<p> 
			Une Vénus en bronze a été découverte dans la petite ville d’Ille. Cette étonnante statue, d’une étrange beauté, hante les imaginations, 
			déchaîne les passions, alors que se préparent les noces du jeune Alphonse et de Mlle de Puygarrig. Est-elle une bienveillante représentation 
			de la déesse de l’Amour, comme l’affirment les archéologues ? Est-elle maléfique, comme le prétendent les habitants du village ? Les curieuses 
			inscriptions gravées sur son socle apporteront-elles une réponse aux mystérieux événements qui bouleversent la région ? - Auteur : Prosper Mérimée -

			<span class="author">Un roman de Jean Forteroche</span>
		</p>

		<div class="buttonNovel">
			<a class="btn btn-lg btn-secondary" href="index.php?action=chapters">Lire le roman ></a>
		</div>
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>