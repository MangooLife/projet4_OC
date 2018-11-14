<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width,initial-scale=1" />
		<link rel="icon" type="image/png" href="#" sizes="32x32" />
        <title><?= $title ?></title>
    	<!-- Metadescription nécessaire au SEO -->
		<meta name="description" content="Billet simple pour l'Alaska - Un roman de Jean Forteroche">
		<!-- Opengraph -->
		<meta property="og:title" content="Billet simple pour l'Alaska - Un roman de Jean Forteroche" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="#" />
		<meta property="og:image" content="#" />
		<!-- Twitter card -->
		<meta name='twitter:card' content='summary_large_image' />
		<meta name='twitter:site' content='@JeanForteroche' />
		<meta name='twitter:creator' content='@JeanForteroche' />
		<meta name='twitter:title' content="Billet simple pour l'Alaska" />
		<meta name='twitter:description' content="Billet simple pour l'Alaska - Un roman de Jean Forteroche" />
		<meta name='twitter:image' content='#' />
		<!--******************************** Feuilles de style ********************************-->
		<!-- FontAwesome --> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
		<!-- Bootstrap CSS et JS --> 
   		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   	<!-- Style CSS -->        
        <link href="./public/css/style.css" rel="stylesheet" />   
    </head>
        
    <body class='cover'>

        <?= $content ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>