<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>BulgarKing</title>

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
                        <button class="button" onclick=window.location.href='AccueilGerant.php'>Retour</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Ajout_stock.php'>Ajouter stocks</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='Inventaire.php'>Inventaire</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href='commande_fournisseur.php'>Passer commande</button>
                    </div>
                </div>
            </section>
            <div class="clear">
                <br>
            </div>
            <div id="tableauProduit">
                <script text/javascript>
                    $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction à executer
                            requete: 'SELECT NomIngred,StockReel,Unite FROM ingredient',
                        },
                        success: function(data) {

                            console.log(data);

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
                                caseRandom1.innerHTML = resultats[i]['NomIngred'];
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
</body>

</html>
