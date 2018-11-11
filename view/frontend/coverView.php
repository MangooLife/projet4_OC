<?php session_start() ?>
<?php $title = "Billet simple pour l'Alaska - Un roman de Jean Forteroche"; ?>

<?php ob_start(); ?>

	<section class="infoCover">
		<h1>Billet simple pour l'Alaska <i class="fas fa-feather-alt"></i></h1>

		<p> I only slept a few hours when I went to bed, and feeling that I could not sleep any more, got up. 
			I had hung my shaving glass by the window, and was just beginning to shave. Suddenly I felt a hand on my shoulder, 
			and heard the Count's voice saying to me, "Good-morning." I started, for it amazed me that I had not seen him, 
			since the reflection of the glass covered the whole room behind me. In starting I had cut myself slightly, but did not notice 
			it at the moment. Having answered the Count's salutation, I turned to the glass again to see how I had been mistaken. 
			This time there could be no error, for the man was close to me, and I could see him over my shoulder. But there was no. -

			<span class="author">Un roman de Jean Forteroche</span>
		</p>

		<div class="buttonNovel">
			<a class="btn btn-lg btn-secondary" href="index.php?action=chapters">Lire le roman ></a>
		</div>
	</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>