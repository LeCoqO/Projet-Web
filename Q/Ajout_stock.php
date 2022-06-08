<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="LUSTIERE Quentin" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>HOMBURGER - GERANT</title>
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
        <a href="commande.php" class="bar-item button">Commande</a><br>
        <a href="recette.php" class="bar-item button">Link 2</a><br>
        <a href="#" class="bar-item button">Link 3</a>
    </div>
    <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center ">
        <img src="img/logo.png" class="logo" alt="" />
    </h1>

</header>

<body>
    <hr>
    <div class="container content-container">
        <main role="main">
            <section>
                <h2 class="text-center">Interface Gérant</h2>
                <div class="row text-center">
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Consult_Stocks.php'>Retour</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Ajout_ingredient.php'>Ajouter Ingrédient</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='index.php'>Ajout Fournisseur</button>
                    </div>
                    <div class="column4">
                        <button id='maj' class="button">Mettre à jour Stocks</button>
                    </div>
                </div>
            </section>
            <div class="clear"></div>
            <br>
            <div class="container content-container row text-center">
                <div id='requete' class='column'>

                </div>
                <div id='qte' class='column'>
                </div>
                <div class="column">
                    <label>Quantité reçue :</label>
                    <div>
                        <input id=inputQte type="number" value="200" class="noMarginPadding" style="width:55px">
                        <label id='unite2'>Grammes</label>
                    </div>
                </div>
            </div>
            <script>
                var laFonction = $.ajax({ //DMD A LA BASE LA LISTE DES ID ING ET DE LEUR NOM
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT NomIng,IdIng FROM ingredient',
                    }
                });

                laFonction.done(function(msg) {

                    console.log(msg);

                    let resultats = JSON.parse(msg);

                    selectIng = document.createElement('select');

                    selectIng[0] = new Option("--Ingrédient--", "", false, false);
                                                                    //AFFICHAGE DES INFREDIENTS EN TANT QU'OPTION DANS UNE BALISE SELECT
                    for (i = 0; i < resultats.length; i++) {
                        selectIng[i + 1] = new Option(resultats[i]['NomIng'], resultats[i]['IdIng'], false, false);
                    };

                    selectIng.id = 'selectIng';
                    selectIng.class = '';
                    selectIng.onChange = 'appel(this.value)';
                    selectIng.style = 'width:300px';

                    document.getElementById('requete').appendChild(selectIng);

                    listeners();
                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });
                    //LISTENERS EN VUE D'UN CHANGEMENT DE PRODUIT, POUR AFFICHER LA QTE ETC
                    //ET POUR LANCER L'UPDATE DE LA QTE EN STOCK
                function listeners() {
                    $("#selectIng").click(function() {
                        appel($("#selectIng").val());
                    })

                    $("#maj").click(function() {
                        update($("#selectIng").val(), $("#inputQte").val());
                    })
                };
                    //FONCTION QUI VIENT METTRE LA BASE A JOUR AVEC LE NOUVEAU STOCK
                function update($produit, $qte) {
                    var produit = $produit;
                    var qte = $qte;
                    var laFonction = $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'update', //fonction à executer
                            requete: 'UPDATE ingredient SET StockReel =' + qte + ' WHERE IdIng =' + produit + ';'
                        }
                    });

                    laFonction.done(function(msg) {

                        alert('Base mise à jour.');

                        appel(produit);

                    });
                    laFonction.fail(function(dataSQL, statut) {
                        alert("error sqlConnect.js : " + dataSQL.erreur);
                    });
                }

                //CREATION DES CHAMPS OU APPARAISSENT LA QTE ET L'UNITE
                let labelChampActuelle = document.createElement('label');
                document.getElementById("qte").appendChild(labelChampActuelle);

                let labelQteActuelle = document.createElement('label');
                let labelUniteActuelle = document.createElement('label');

                document.getElementById('qte').appendChild(labelQteActuelle);
                document.getElementById('qte').appendChild(labelUniteActuelle);

                //FONCTION QUI VIENT COMPLETER LES CHAMPS UNITE ET QTE, APPELLE AVEC LE BON ID INGREDIENT
                function appel($id) {
                    var id = $id;
                    $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction à executer
                            requete: 'SELECT StockReel,Unite FROM ingredient',
                        },
                        success: function(data) {
                            let resultats = JSON.parse(data);
                            try {
                                labelChampActuelle.innerHTML = "Quantité actuelle :&nbsp;";
                                labelQteActuelle.innerHTML = resultats[id - 1]['StockReel'];
                                labelUniteActuelle.innerHTML = '&nbsp;' + resultats[id - 1]['Unite'];
                                document.getElementById('unite2').innerHTML = resultats[id - 1]['Unite'];
                            } catch (error) {
                                console.log(error);
                            }
                        },
                        error: function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        }
                    });
                }
                //APPEL DE LA FONCTION AVEC LE 1ER INGREDIENT DISPONIBLE
                appel(0);
            </script>
        </main>
    </div>
</body>

</html>