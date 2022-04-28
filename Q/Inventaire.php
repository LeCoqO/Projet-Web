<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>BulgarKing</title>
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
                        <button class="button" onclick=window.location.href="Consult_Stocks.php">Retour</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href="Ajout_ingredient.php">Ajouter Ingrédient</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href="Index.php">Ajout Fournisseur</button>
                    </div>
                    <div class="column4">
                        <button id='maj' class="button">Mettre à jour Stocks</button>
                    </div>
                </div>
            </section>
            <br>
            <div class="container content-container row text-center">
                <div id=requete class="column">

                </div>
                <div class="column">
                    <div id="qte" class="">
                        <label>Quantité théorique : </label>
                    </div>
                </div>
                <div class="column">
                    <label>Quantité réelle : </label>
                    <input id='qteReelle' class="petitInput" type="number" value="200" maxlength="4" style="width: 55px">
                    <label id='unite2'>Grammes</label>
                </div>
            </div>
            <script>
                var laFonction = $.ajax({
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT NomIng,IdIng,StockReel,Unite FROM ingredient',
                    }
                });

                laFonction.done(function(msg) {

                    console.log(msg);

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

                    $("#selectIng").click(function() {
                        appel($("#selectIng").val());
                    })

                    $("#maj").click(function() {
                        update($("#selectIng").val(), $("#qteReelle").val());
                    })

                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });

                let labelQteActuelle = document.createElement('label');
                let labelUniteActuelle = document.createElement('label');

                document.getElementById('qte').appendChild(labelQteActuelle);
                document.getElementById('qte').appendChild(labelUniteActuelle);


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
                                labelQteActuelle.innerHTML = resultats[id - 1]["StockReel"];
                                labelUniteActuelle.innerHTML = '&nbsp;' + resultats[id - 1]['Unite'];
                                document.getElementById('unite2').innerHTML = resultats[id - 1]['Unite'];
                                document.getElementById('qteReelle').value = resultats[id - 1]['StockReel'];
                            } catch (error) {
                                console.log(error);
                            }
                        },
                        error: function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        }
                    });
                }
                appel(0);
            </script>
        </main>
    </div>
</body>

</html>