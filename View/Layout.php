<?php
use Systeme\Session;

new Session();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <meta property="og:title" content="B" />
        <meta property="og:description" content="B" />
        <title>accueil</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/71336045e0.js"></script>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <div class="container" id="content_body">
            <header class="row" id="content_header">
                <nav class="navbar fixed-top navbar-expand-lg navbar-dark pink scrolling-navbar" id="navbar-header">
                    <a class="navbar-brand" href="accueil"><strong>Likes Pictures</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="accueil">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="galerie">Galerie</a>
                            </li>
                            <?php
                            if (array_key_exists('name', $_SESSION)) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="profil">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ajout">Ajout</a>
                            </li>
                            <?php
                            } else{
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion">Connexion</a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
        <footer>
            <nav id="social_network">
                <a href="https://www.facebook.com/sharer/sharer.php?u=http://projetformation.four.projetformationduhauvelle.fr/"><span class="fab fa-facebook-f" aria-hidden="true"></span></a>
                <a href="https://twitter.com/intent/tweet/?url=http://projetformation.four.projetformationduhauvelle.fr/"><span class="fab fa-twitter" aria-hidden="true"></span></a>
            </nav>
            <p>Copyright / Projet formation 2019</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>