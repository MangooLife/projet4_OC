<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link rel="icon" type="image/png" href="#" sizes="32x32" />
        <title><?= $title ?></title>
        <!--******************************** Feuilles de style ********************************-->
        <!-- FontAwesome --> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
        <!-- Bootstrap CSS et JS --> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Style CSS -->        
        <link href="../projet4.vthamarai.com/public/css/style.css" rel="stylesheet" />   
    </head>
        
    <body class="book">

        <header>
            <nav class="navbar sticky-top navbar-light bg-light">
              <a class="navbar-brand" href="index.php?action=cover">Billet simple pour l'Alaska <i class="fas fa-feather-alt"></i></a>
              <span class="buttonsHeader">
                <a class="navbar-brand" href="index.php?action=chapters"><i class="fas fa-book"></i></a>
                <a class="navbar-brand" href="index.php?action=chapters"><i class="far fa-window-maximize"></i></a>
                <a class="navbar-brand" href="index.php?action=admin&amp;admin=<?=$_SESSION['is_admin']?>"><i class="fas fa-comments"></i></a>
                <a class="navbar-brand" href="#"><i class="fas fa-edit"></i></a>
                <?php if(isset($_SESSION['pseudo'])) 
                    {
                ?>
                        <a class="navbar-brand" href="index.php?action=logout"><i class="fas fa-power-off on"></i></a>
                <?php
                    } else
                    {
                ?>
                        <a class="navbar-brand" href="index.php?action=connexion"><i class="fas fa-power-off off"></i></a>
                <?php 
                    }
                ?>
              </span>
            </nav>
        </header>

        <?= $content ?>

        <footer>
            <div class="infoAuthor">
                <h3>
                    A propos de l'auteur</i>
                </h3>
                <p>
                    Jean Forteroche né le 12 décembre 1960, écrit ses premiers romans à l'âge de 18 ans.
                    Après le succès de <span class='titleNovel'>"Pas de choix - oui ou oui"</span>, il nous revient avec un format original 
                    dédié exclusivement aux lecteurs du web : <span class='titleNovel'>"Billet simple pour l'Alaska"</span>.
                <p>
            </div>
            <div class="infoSite">
                <h3>
                    Informations 
                </h3>
                <ul>
                    <li><a class="navbar-brand" href="index.php?action=cover">Résumé</a></li>
                    <li><a class="navbar-brand" href="index.php?action=chapters">Chapitres</a></li>
                    <li><a class="navbar-brand" href="#">Se connecter</a></li>
                </ul>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>