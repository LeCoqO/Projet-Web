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
                    <div class="column">
                        <button class="button" onclick=window.location.href='consult_stocks.php'>Retour</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href='bons_de_commandes.php'>Bons de commandes</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href=''>Emmetre un bon</button>
                    </div>
                </div>
            </section>
            <br>
            <div class='clear'></div>
            <div class="container content-container text-center">
                <div id=requete class="column2">
                </div>
                <div class="column2">
                    <input type="number" value="200" style="width: 55px">
                    <label id='unite2'>Grammes</label>
                </div>
            </div>
            <div class="clear"></div>

            <div class="container content-container text-center">
                <div class="column2">
                    <label>Date de livraison souhaitée</label>
                    <input type="date">
                </div>
                <div class="column2">
                    <label>Prix Total HT</label>
                    <input type="number" value="200" style="width: 55px" disabled>
                    <label>€</label>
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
                    let resultats = JSON.parse(msg);

                    selectIng = document.createElement('select');

                    selectIng[0] = new Option("--Ingrédient--", "", false, false);

                    for (i = 0; i < resultats.length; i++) {
                        selectIng[i + 1] = new Option(resultats[i]['NomIngred'], resultats[i]['IdIngred'], false, false);
                    };

                    selectIng.id = 'selectIng';
                    selectIng.class = 'column';
                    selectIng.onChange = 'appel(this.value)';

                    document.getElementById('requete').appendChild(selectIng);

                    $("#selectIng").click(function() {
                        appel($("#selectIng").val());
                    })
                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });

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
                            requete: 'SELECT Unite FROM ingredient',
                        },
                        success: function(data) {
                            let resultats = JSON.parse(data);
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
