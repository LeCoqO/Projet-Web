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
                        <button class="button" onclick=window.location.href='Consult_Stocks.php'>Retour</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Ajout_ingredient.php'>Ajouter Ingrédient</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='index.php'>Ajout Fournisseur</button>
                    </div>
                    <div class="column4">
                        <button class="button">Mettre à jour Stocks</button>
                    </div>
                </div>
            </section>
            <div class="clear"></div>
            <br>
            <div class="container content-container row text-center">
                <div id=requete class="column2">

                </div>
                <div id="qte" class="column2">
                </div>
            </div>
            <div class="clear"></div>
            <div class="container content-container row text-center">
                <label class="column2">Quantité reçue :</label>
                <div>
                    <input type="number" value="200" class="noMarginPadding" style="width:55px">
                    <label id='unite2'>Grammes</label>
                </div>
            </div>
            <script>
                var laFonction = $.ajax({
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT NomIngred,IdIngred,StockReel,Unite FROM ingredient',
                    }
                });

                laFonction.done(function(msg) {

                    console.log(msg);

                    let resultats = JSON.parse(msg);

                    selectIng = document.createElement('select');

                    selectIng[0] = new Option("--Ingrédient--", "", false, false);

                    for (i = 0; i < resultats.length; i++) {
                        selectIng[i + 1] = new Option(resultats[i]['NomIngred'], resultats[i]['IdIngred'], false, false);
                    };

                    selectIng.id = 'selectIng';
                    selectIng.class = 'column2';
                    selectIng.onChange = 'appel(this.value)';
                    selectIng.style = 'width:300px';


                    document.getElementById('requete').appendChild(selectIng);

                    listeners();
                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });

                function listeners() {
                    $("#selectIng").click(function() {
                        appel($("#selectIng").val());
                    })
                };


                let labelChampActuelle = document.createElement('label');
                document.getElementById("qte").appendChild(labelChampActuelle);

                let labelQteActuelle = document.createElement('label');
                let labelUniteActuelle = document.createElement('label');

                document.getElementById('qte').appendChild(labelQteActuelle);
                document.getElementById('qte').appendChild(labelUniteActuelle);

                function appel($id) {
                    var id = $id;
                    console.log($id);
                    console.log(id);
                    $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction à executer
                            requete: 'SELECT StockReel,Unite FROM ingredient',
                        },
                        success: function(data) {
                            let resultats = JSON.parse(data);
                            labelChampActuelle.innerHTML = "Quantité actuelle :&nbsp;";
                            labelQteActuelle.innerHTML = resultats[id - 1]["StockReel"];
                            labelUniteActuelle.innerHTML = '&nbsp;' + resultats[id - 1]['Unite'];
                            document.getElementById('unite2').innerHTML = resultats[id - 1]['Unite'];
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
