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
    </style>

</head>
<header>
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
            <div class="container">
                <a class="navbar-brand" style="text-transform: uppercase">
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
                            <a class="nav-link" href="../Accueil/">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Cuisine/">Cusinier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Gerant/">Gérant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Livreur/">Livreur</a>
                        </li>
                    </ul>
                    <img class="imgNavbar" src="../img/logo.png" />
                </div>
            </div>
        </nav>
    </div>
</header>

<br>
<br>
<br>

<body>
    <hr>
    <div class="container content-container">
        <main role="main">
            <section>
                <h2 class="text-center">Interface Gérant</h2>
                <div class="row text-center">
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Index.php'>Retour</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Ajout_stock.php'>Ajouter stocks</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Inventaire.php'>Inventaire</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='commande_fournisseur.php'>Passer
                            commande</button>
                    </div>
                </div>
            </section>
            <div class="clear">
                <br>
            </div>
            <div id="tableauProduit" style="margin-bottom: 240px;">
                <script text/javascript>
                //DMD A LA BASE DES LES PRODUITS ET LEUR STOCK VIA AJAX->PHP->MySQL 
                $.ajax({
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT NomIng,StockReel,Unite FROM ingredient',
                    },
                    success: function(data) {
                        let resultats = JSON.parse(data);
                        let table = document.createElement('table');
                        let thead = document.createElement('thead');
                        let tbody = document.createElement('tbody');

                        table.appendChild(thead);
                        table.appendChild(tbody);

                        document.getElementById('tableauProduit').appendChild(table);

                        let ligne_0 = document.createElement('tr');
                        let caseTop_1 = document.createElement('th');
                        caseTop_1.innerHTML = "Article";
                        let caseTop_2 = document.createElement('th');
                        caseTop_2.innerHTML = "Quantité";

                        ligne_0.appendChild(caseTop_1);
                        ligne_0.appendChild(caseTop_2);
                        thead.appendChild(ligne_0);

                        for (i = 0; i < resultats.length; i++) {
                            var randomLigne = document.createElement('tr');
                            randomLigne.id = 'ligne' + (i + 1);
                            let caseRandom1 = document.createElement('th');
                            caseRandom1.innerHTML = resultats[i]['NomIng'];
                            let caseRandom2 = document.createElement('th');
                            caseRandom2.innerHTML = resultats[i]['StockReel'] + ' ' + resultats[i]['Unite'];

                            tbody.appendChild(randomLigne);
                            document.getElementById('ligne' + (i + 1)).appendChild(caseRandom1);
                            document.getElementById('ligne' + (i + 1)).appendChild(caseRandom2);
                        };
                    },
                    error: function(dataSQL, statut) {
                        alert("error sqlConnect.js : " + dataSQL.erreur);
                    }
                });
                </script>
            </div>
        </main>
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