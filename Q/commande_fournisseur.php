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
                    <div class="column">
                        <button class="button" onclick=window.location.href='consult_stocks.php'>Retour</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href='bons_de_commandes.php'>Bons de commandes</button>
                    </div>
                    <div class="column">
                        <button id='ok' class="button">Emettre un bon</button>
                    </div>
                </div>
            </section>
            <br>
            <div class='clear'></div>
            <div class="container content-container text-center">
                <div id=requete class="column2">
                </div>
                <div class="column2">
                    <input id='qte' type="number" min=0 value="200" style="width: 55px">
                    <label id='unite2'>Grammes</label>
                </div>
            </div>
            <div class="clear"></div>

            <div class="container content-container text-center">
                <div class="column2">
                    <label>Date de livraison souhaitée</label>
                    <input id='livraison' type="date">
                </div>
                <div class="column2">
                    <label>Prix Total HT</label>
                    <input id='total' type="number" value="0" style="width: 55px" disabled>
                    <label>€</label>
                </div>
            </div>
            <script>
                //RECUPERATION DES INGREDIENTS POUR LES PROPOSER DANS UN SELECT
                var laFonction = $.ajax({
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT IdIng,NomIng FROM ingredient',
                    }
                });

                laFonction.done(function(msg) {
                    let resultats = JSON.parse(msg);
                    selectIng = document.createElement('select');
                    selectIng[0] = new Option("--Ingrédient--", "", false, false);
                    for (i = 0; i < resultats.length; i++) {
                        selectIng[i + 1] = new Option(resultats[i]['NomIng'], resultats[i]['IdIng'], false, false);
                    };
                    selectIng.id = 'selectIng';
                    selectIng.class = 'column';
                    selectIng.onChange = 'appel(this.value)';
                    document.getElementById('requete').appendChild(selectIng);
                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });


                //LISTENERS EN VUE D'UN CHANGEMENT DE QTE OU DE PRODUIT, POUR CALCULER LE PRIX DYNAMIQUEMENT
                //ET POUR VALIDER LA CREATION DE COMMANDE
                function listeners() {
                    $(document).on("click change", "#qte, #selectIng", function() {
                        calculPrix($("#selectIng").val(), $("#qte").val());
                    })
                    $(document).on('click', '#ok', function() {
                        creationCommande();
                    })
                }

                //FONCTION QUI CREE UNE COMMANDE DANS LA BASE, AVEC LES CHAMPS DE LA PAGE
                function creationCommande() {
                    let dateAjd = new Date();
                    dateAjd = dateAjd.getFullYear() + "-" + (dateAjd.getMonth() + 1) + "-" + dateAjd.getDate();
                    var dateLiv = document.getElementById('livraison').value;
                    var ing = document.getElementById('selectIng').value;
                    //var fourn = document.getElementById('selectFourn').value;
                    var qte = document.getElementById('qte').value;

                    console.log('INSERT INTO commandefournisseur (`IdIng`, `NomFourn`, `QteComFourn`,`DateLivFourn`,`DateComFourn`) VALUES (' + ing + ',' + '"MyFoodnisseur"' + ',' + qte + ',"' + dateLiv + '","' + dateAjd + '");');

                    var laFonction = $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'insert', //fonction à executer
                            requete: 'INSERT INTO commandefournisseur (`IdIng`, `NomFourn`, `QteComFourn`,`DateLivFourn`,`DateComFourn`) VALUES (' + ing + ',' + '"MyFoodnisseur"' + ',' + qte + ',"' + dateLiv + '","' + dateAjd + '");',
                        }
                    });
                    laFonction.done(function(data) {
                        alert('Commande passée!');
                    });
                    laFonction.fail(function(dataSQL, statut) {
                        alert("error sqlConnect.js : " + dataSQL.erreur);
                    });

                }

                //FONCTION METTANT A JOUR LE PRIX
                function calculPrix($id, $qte) {
                    var id = $id;
                    var qte = $qte;
                    if (id != 0) {
                        var laFonction = $.ajax({
                            url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                            type: 'POST',
                            data: {
                                fonction: 'select', //fonction à executer
                                requete: 'SELECT PrixUHT_Moyen FROM ingredient WHERE IdIng = ' + id + ';',
                            }
                        });
                        laFonction.done(function(data) {
                            let resultats = JSON.parse(data);
                            let prix = resultats[0]['PrixUHT_Moyen'] * qte;
                            document.getElementById('total').value = prix;
                        });
                        laFonction.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });
                    }
                }

                //FONCTION APPELALNT LES RESTES D'INFORMATION SUR UN INGREDIENT
                function appel($id) {
                    var id = $id;
                    if (id != 0) {
                        var laFonction = $.ajax({
                            url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                            type: 'POST',
                            data: {
                                fonction: 'select', //fonction à executer
                                requete: 'SELECT StockMin,Unite FROM ingredient WHERE IdIng = ' + id + ';',
                            }
                        });
                        laFonction.done(function(data) {
                            let resultats = JSON.parse(data);
                            document.getElementById('unite2').innerHTML = resultats[0]['Unite'];
                            document.getElementById('qte').value = resultats[0]['StockMin']
                        });
                        laFonction.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });
                    }
                }

                //APPEL DES LISTENERS
                listeners();
            </script>
        </main>
    </div>

</html>