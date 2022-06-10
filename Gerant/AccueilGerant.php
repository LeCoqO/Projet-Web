<?php
ob_start();
session_start();
if (!$_SESSION['valid']) {
    header('Location: login.php');
}
//pour reset: $_SESSION['valid']=false;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="LUSTIERE Quentin" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <title>HOMBURGER - GERANT</title>

    <style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    th,
    td {
        padding: 10px 20px;
        border: 1px solid #000;
    }

    .column {
        clear: both;
    }
    </style>

</head>
<header>

    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
            <div class="container">
                <a class="navbar-brand" style="text-transform: uppercase;">
                    Hom'Burger
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Fruits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sea food</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vegetables</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <img class="imgNavbar" src="./img/logo.png">
                </div>
            </div>
        </nav>
    </div>
</header>
<br><br><br><br><br>

<body class="d-flex flex-column min-vh-100">


    <div class="center-div">
        <div id="div_stat" class="block_Menu" style="margin-left: 7%;">
            <div id="div_button_stat" class="sous_block_Menu">
                <button class="button BoutonAccueil" onclick=window.location.href='Statistique.php'>Statistique</button>
            </div>
        </div>
        <div id="div_Stocks" class="block_Menu">
            <div class="sous_block_Menu">
                <button class="button BoutonAccueil" onclick=window.location.href='Consult_Stocks.php'>Stocks</button>
            </div>
        </div>
        <div id="div_Recettes" class="block_Menu">
            <div class="sous_block_Menu">
                <button class="button BoutonAccueil" onclick=window.location.href='recette.php'>Recettes</button>
            </div>
        </div>
    </div>


    <footer class="mt-auto footer-basic fixed-bottom">
        <div class="social">
            <a href="https://www.instagram.com/_hom_burger_/?hl=fr">
                <i class="fa fa-instagram" aria-hidden="true"></i>

            </a>
            <a href="https://twitter.com/hom_burger">
                <i class="fa fa-twitter"></i>
            </a>
        </div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item">
                <a href="equipe.html">Notre équipe</a>
            </li>
            <li class="list-inline-item"><a href="#">A propos</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Hom'Burger © 2022</p>
    </footer>
</body>

</html>