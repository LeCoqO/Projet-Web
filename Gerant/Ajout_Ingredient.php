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
    <link rel="stylesheet" href="../CSS/styleGerant.css">
    <link rel="stylesheet" href="../CSS/styleCommun.css">
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
<br><br><br><br><br><br>

<body>
    <hr>
    <div class="container content-container">
        <main role="main">
            <section>
                <h2 class="text-center">Interface Gérant</h2>
                <div class="row text-center">
                    <div class="column2">
                        <button class="button" onclick=window.location.href="Ajout_Stock.php">Retour</button>
                    </div>
                    <div class="column2">
                        <button id='ok' class="button">Confirmer l'ajout</button>
                    </div>
                </div>
            </section>
            <br>
            <div class='clear'></div>
            <div class="container content-container row text-center">
                <div class="column3">
                    <label for="nom">Nom</label>
                    <input id="nom" type="text" placeholder="Nom">
                </div>
                <div id=choixFournisseurs class="column3">
                    <script>
                        //RECUPERATION DES FOURNISSEURS DANS LA BDD, POUR LES METTRE EN TANT QU'OPTION DANS UN SELECT
                        var laFonction = $.ajax({
                            url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
                            type: 'POST',
                            data: {
                                fonction: 'select', //fonction à executer
                                requete: 'SELECT NomFourn FROM fournisseur',
                            }
                        });
                        laFonction.done(function(msg) {
                            let resultats = JSON.parse(msg);
                            selectFourn = document.createElement('select');
                            selectFourn[0] = new Option("--Fournisseur--", "", false, false);

                            for (i = 0; i < resultats.length; i++) {
                                selectFourn[i + 1] = new Option(resultats[i]['NomFourn'], resultats[i]['NomFourn'],
                                    false, false);
                            };

                            selectFourn.id = 'selectFourn';
                            selectFourn.class = '';
                            selectFourn.onChange = '';
                            selectFourn.style = '';

                            document.getElementById('choixFournisseurs').appendChild(selectFourn);

                        });
                        laFonction.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });
                    </script>
                </div>
                <div class="column3">
                    <label for='inputQte'>Quantité min : </label>
                    <input id='inputQte' type="number" value="200">
                </div>
            </div>
            <div class="clear">
            </div>
            <div class="container content-container row text-center">
                <div class="column3">
                    <label for='inputPrix'>Prix UHT : </label>
                    <input id='inputPrix' type="number" value="0.00" min="0.00" max="1000.00" step="0.01">
                </div>
                <div id=choixUnites class="column3">
                    <script>
                        //RECUP DES UNITE POUR EN FAIRE LE MEME USAGE QUE LES FOURNISSEURS
                        var laFonction = $.ajax({
                            url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée 
                            type: 'POST',
                            data: {
                                fonction: 'select', //fonction à executer
                                requete: 'SELECT DISTINCT unite FROM ingredient',
                            }
                        });
                        laFonction.done(function(msg) {
                            console.log(msg);
                            let resultats = JSON.parse(msg);
                            selectUnite = document.createElement('select');
                            selectUnite[0] = new Option("--Unités--", "", false, false);

                            for (i = 0; i < resultats.length; i++) {
                                selectUnite[i + 1] = new Option(resultats[i]['unite'], resultats[i]['unite'], false,
                                    false);
                            };

                            selectUnite.id = 'selectUnite';
                            selectUnite.class = '';
                            selectUnite.onChange = '';
                            selectUnite.style = '';
                            document.getElementById('choixUnites').appendChild(selectUnite);

                        });
                        laFonction.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });
                    </script>
                </div>
                <div class="column3">
                    <label for="frais">Produit frais</label>
                    <input type="checkbox" id="frais">
                </div>
            </div>
            <script>
                //LISTENER SUR LE BOUTON POUR LANCER L'INSERTION, AVEC SELECTIONS DES DONNEES REMPLIES DANS LA PAGE
                $("#ok").click(function() {
                    insert($("#nom").val(),
                        "MyFoodnisseur",
                        $("#frais").val(),
                        $("#selectUnite").val(),
                        $("#inputQte").val(),
                        $("#inputPrix").val());
                })

                //INSERTION DANS LA BASE DE L'INGREDIENT CREE, AVEC LES DIFFERENTS CHAMPS REMPLIS DANS LA PAGE, VERIFICATION DES CHAMPS FAITE DANS LE HTML
                function insert($nom, $fournisseur, $estFrais, $unite, $qte, $puht) {
                    console.log('ok2');

                    var nom = '"' + $nom + '"';
                    var fournisseur = '"' + $fournisseur + '"';
                    if ($estFrais) {
                        var estFrais = '"T"';
                    } else {
                        var estFrais = '"F"';
                    }
                    var unite = $unite;
                    var qte = $qte;
                    var puht = $puht;
                    var laFonction = $.ajax({
                        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée             
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction à executer
                            requete: 'INSERT INTO ingredient(NomIng,Frais,Type,Unite,StockMin,StockReel,PrixUHT_Moyen,Q_A_Com,DateArchivIng) VALUES (' +
                                nom + ', ' + estFrais + ',' + '"S"' + ',"' + $unite + '",' + qte + ',0,' + puht +
                                ',0,NOW());'
                        }
                    });

                    laFonction.done(function(msg) {

                        alert('Produit ajouté.');

                    });
                    laFonction.fail(function(dataSQL, statut) {
                        alert("error sqlConnect.js : " + dataSQL.erreur);
                    });
                }
            </script>
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