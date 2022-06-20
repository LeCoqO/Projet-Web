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
    <meta name="author" content="Diego TORRES" />
    <link href="./style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />

    <script src="./scriptCommun.js"></script>

    <title>Hom'burger</title>



</head>

<br><br><br>
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
    <div id="loading">
        <div class="loader loader--style8 posMessage ">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewbox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                    <animate attributename="opacity" attributetype="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatcount="indefinite" />
                    <animate attributename="height" attributetype="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatcount="indefinite" />
                    <animate attributename="y" attributetype="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatcount="indefinite" />
                </rect>
                <rect x="8" y="10" width="4" height="10" fill="#333" opacity="0.2">
                    <animate attributename="opacity" attributetype="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatcount="indefinite" />
                    <animate attributename="height" attributetype="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatcount="indefinite" />
                    <animate attributename="y" attributetype="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatcount="indefinite" />
                </rect>
                <rect x="16" y="10" width="4" height="10" fill="#333" opacity="0.2">
                    <animate attributename="opacity" attributetype="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatcount="indefinite" />
                    <animate attributename="height" attributetype="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatcount="indefinite" />
                    <animate attributename="y" attributetype="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatcount="indefinite" />
                </rect>
            </svg>
        </div>
    </div>

    <div id="messageBox" style="display: none" class="messageBox centrer">
        <h4>Etes-vous sûr?</h4>
        <button id="validButtonTrue" class="button" onclick=''>Oui</button>
        <button id="validButtonFalse" class="button" onclick='checkBox_close()'>Non</button>

    </div>

    <p class="text-center">
        <button class="button" onclick="liste_open()">Liste des recettes</button>
        <button class="button" onclick="creation_open()">Ajout d'une recette</button>
    </p>

    <div class="container content-container">
        <main id="main">
            <div id="tableauProduit"></div>
            <div class="text-center">
                <div class="text-center inputGroup mediumWidth">
                    <input type="checkbox" id="recettes_Supprimees" name="recettes_Supprimees" onclick="afficherSuppri()" />
                    <label for="recettes_Supprimees">Recettes Supprimées</label>
                </div>
            </div>
            <div id="tableau_Recettes_Supprimees"></div>

        </main>
        <main id="main2" style="display: none; width: 100%">
            <h2 class="text-center gras">Création d'un menu:</h2>
            <br>
            <div class="row">
                <div class="column2">
                    <h2 class="gras">Nom du menu</h2>
                    <input class="text-center button" type="text" id="name" required>
                </div>
                <div class="column2">
                    <h2 class="gras">Prix</h2>
                    <input class="text-center button" type="number" id="price" value="10" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="column2">
                    <h2 class="gras">Nombres d'option maximum</h2>
                    <input class="text-center button" type="number" id="maximumOption" value="3" min="0" max="4" required>

                </div>
                <div class="column2">
                    <h2 class="gras">Taille</h2>
                    <select class="button" name="tailleChoice" id="tailleChoice">
                        <option value="">--Please choose an option--</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                    </select>
                </div>

            </div>
            <br>
            <div class="text-center inputGroup mediumWidth">
                <input type="checkbox" id="incontournableCheckbox" name="incontournableCheckbox" checked />
                <label for="incontournableCheckbox">Incontournable:</label>
            </div>

            <br>

            <div class="row">
                <div class="column2">
                    <h2 class="gras">Choisir une image</h2>
                    <label for="mon_fichier">Sélectionnez le fichier à
                        télécharger <br>(extensions valides :'jpg' , 'jpeg' , 'gif' , 'png' -- max 1
                        Mo) :</label>
                    <input class="button" type="file" name="picture" id="picture" onchange="previewPicture(this)" accept=".jpg, .png, .gif" required />
                </div>
                <div class="column2">
                    <img class="image" style="max-height:150px;max-width:150px;">
                </div>
            </div>
            <div class="half left" style="margin-left: 15%;">

            </div>

            <div class="clear"><br><br><br></div>

            <div class="column">
                <article role="article center">
                    <h2 class="text-center gras">Choisissez le pain</h2>
                    <div id="ingr_pain"></div>
                </article>
            </div>
            <div class="column">
                <article class="left">
                    <h2 class="text-center gras">Choisissez vos ingrédients <br /> principaux</h2>
                    <div id="ingr_princ"></div>
                </article>
            </div>

            <div class="column">
                <article class="left">
                    <h2 class="text-center gras">Choisissez vos ingrédients <br />secondaires</h2>
                    <div id="ingr_second"></div>

                </article>
            </div>
            <div class="clear"><br><br><br></div>
            <button class="button" onclick="genererRecetteJSON()">Prévisualiser et valider</button>
            <div id="preview" style="display: none;">
                <h2>Prévisualisation</h2>
                <div class="row text-center">
                    <div id="previewRecette"></div>
                    <!--<div class="column previewRecette"></div>
                    <div class="column previewRecette"></div>-->
                </div>


            </div>
            <button id="button_add_to_bdd" style="display: none;" class="button" onclick="addToBase()">Ajouter</button>

            <div class="clear"><br><br><br></div>

        </main>

    </div>
    <div class="clear"></div>
    <br><br><br>
    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="https://www.instagram.com/_hom_burger_/?hl=fr">
                    <i class="fa fa-instagram"></i>
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
    </div>
</body>
<script src="./script_recette.js"></script>

<script>
    //Cette fontion ajoute ou nullifie (en fonction du boolean) la date d'une recette dont l'id est passé en parametre
    function updateLine(idProd, bool) {
        let laDate;
        if (!bool) { //false
            laDate = new Date();
            laDate = "'" + laDate.getFullYear() + "-" + (laDate.getMonth() + 1) + "-" + laDate.getDate() + "'";
        } else {
            laDate = "NULL";
        }
        $.ajax({
            url: '../STOCK_REQUETE.php',
            type: 'POST',
            data: {
                fonction: 'update',
                requete: "UPDATE produit SET DateArchivProd = " + laDate + " WHERE IdProd = '" + idProd + "'",
            },
            success: function(data) {
                //console.log(data);
                location.reload();
            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
    }

    //Fonction qui récupere la liste des recettes inactives dans la bdd
    //et l'affiche dans un tableau
    function afficherSuppri() {
        if (document.getElementById("tableau_Recettes_Supprimees").innerHTML) {
            document.getElementById("tableau_Recettes_Supprimees").innerHTML = "";
        } else {
            $.ajax({
                url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
                type: 'POST',
                data: {
                    fonction: 'select', //fonction à executer
                    requete: 'SELECT * FROM produit WHERE DateArchivProd IS NOT NULL'
                },
                success: function(data) {
                    //console.log("success");
                    var resultats = JSON.parse(data);
                    console.log(resultats);

                    var string = "<FONT face='arial'><div class='container'><CENTER>" +
                        "<div class='table'>" +
                        "<div class='table-header' bgcolor='grey' align='center'>" +
                        "<div class='header__item'> <a id='recette' class='filter__link' href='#'>Numéro Recette</a></div>" +
                        "<div class= 'header__item'> <a id='nom' class='filter__link' href='#'>Nom recette</a></div>" +
                        "<div class='header__item'> <a id='ingr' class='filter__link' href='#'>Ingrédients</a></div>" +
                        "<div class='header__item'> <a id='prix' class='filter__link' href='#'>Prix</a></div>" +
                        "<div class='header__item'> <a id='rajouter' class='filter__link' href='#'>Rajouter</a></div>" +
                        "</div><div class='table-content'>";

                    for (let i = 0; i < resultats.length; i++) {
                        //console.log('in loop: ' + i);
                        string += '<div class="table-row">' +
                            "<div class='table-data'>" + resultats[i]['IdProd'] + "</div>" +
                            "<div class='table-data'>" + resultats[i]['NomProd'] + "</div>" +
                            "<div class= 'table-data'> ";
                        for (j = 1; j < parseInt(resultats[i]['NbIngBase']) + 1; j++) {
                            string += resultats[i]['IngBase' + j] + ", ";
                        }
                        for (k = 1; k < parseInt(resultats[i]['NbIngOpt']) + 1; k++) {
                            string += resultats[i]['IngOpti' + k] + ", ";
                        }
                        string += "</div><div class='table-data'>" + resultats[i]['PrixUHT'] +
                            "</div><div class='table-data'>" +
                            "<input type = 'image' id = 'image' onclick = 'checkBox_open(" + resultats[i][
                                'IdProd'
                            ] + ", true)'" +
                            "src = '../img/addButton.png' width = '45px' height = '45px' ></input > " +
                            "</div ></div>";
                    }
                    string += '</div>' + '</CENTER>' + '</div>' + '</FONT>';

                    document.getElementById("tableau_Recettes_Supprimees").innerHTML = string;
                    setupTab(['recette', 'nom', 'ingr', 'heure', 'prix']);
                },
                error: function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                }
            });
        }
    }
</script>

</html>