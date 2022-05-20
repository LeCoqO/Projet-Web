<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link href="style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./scriptCommun.js"></script>

    <title>Hom'burger</title>



</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button><br>
        <a href="index.php" class="bar-item button">Accueil</a><br>
        <a href="livreur.php" class="bar-item button">Livreur</a><br>
        <a href="#" class="bar-item button">Recette</a><br>
        <a href="mentionLegale.html" class="bar-item button">Mention légale</a><br>
    </div>
    <button class="button_sidebar button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center">
        <img src="./img/logo.png" class="logo" alt="" />
    </h1>

</header>


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
                    <input class="text-center button" type="number" id="maximumOption" value="3" required>

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
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 text">
                        <h3>Hom'burger</h3>
                        <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula.
                            Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus.
                            Aliquam in arcu eget velit pulvinar dictum vel in justo.
                        </p>
                    </div>
                    <div class="col social">
                        <a href="#"><i class="icon ion-social-facebook"></i></a>
                        <a href="#"><i class="icon ion-social-twitter"></i></a>
                        <a href="#"><i class="icon ion-social-snapchat"></i></a>
                        <a href="#"><i class="icon ion-social-instagram"></i></a>
                    </div>
                </div>
                <p class="copyright">Hom'burger © 2022</p>
            </div>
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
            url: 'ajax_Bdd.php',
            type: 'POST',
            data: {
                fonction: 'Update',
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
                url: 'ajax_Bdd.php', //toujours la même page qui est appelée
                type: 'POST',
                data: {
                    fonction: 'requete', //fonction à executer
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
                        string += "</div><div class='table-data'>" + resultats[i]['PrixUHT'] + "</div><div class='table-data'>" +
                            "<input type = 'image' id = 'image' onclick = 'checkBox_open(" + resultats[i]['IdProd'] + ", true)'" +
                            "src = 'img/addButton.png' width = '45px' height = '45px' ></input > " +
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