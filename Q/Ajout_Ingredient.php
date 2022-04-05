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
                    <div class="column2">
                        <button class="button" onclick=window.location.href="Ajout_Stock.php">Retour</button>
                    </div>
                    <div class="column2">
                        <button class="button" onclick=window.location.href="">Confirmer l'ajout</button>
                    </div>
                </div>
            </section>

            <br>
            <div class="text-center">
                <div class="container content-container">
                    <div class="column2">
                        <input id="nom" type="text" value="Nom">
                        <label for="nom">Nom</label>
                    </div>
                    <div id=choixFournisseurs class="column2" style="width:300px">
                        <script>
                            $.ajax({
                                url: 'ajax_Bdd.php', //toujours la même page qui est appelée
                                type: 'POST',
                                data: {
                                    fonction: 'selectListeFournisseurs', //fonction à executer
                                    base: 'physique',
                                    table: 'fournisseur',
                                    selectCondition: '*'
                                },
                                success: function(data) {
                                    document.getElementById("choixFournisseurs").innerHTML = data;
                                },
                                error: function(dataSQL, statut) {
                                    alert("error sqlConnect.js : " + dataSQL.erreur);
                                }
                            });
                        </script>
                    </div>
                </div>
                <div class="clear">
                    <input type="checkbox" id="frais">
                    <label for="frais">Produit frais</label>
                </div>
                <div class="container content-container">
                    <div class="column">
                        <label>Quantité min : </label>
                        <input type="number" value="200">
                    </div>
                    <div id=choixUnites class="column">
                        <script>
                            $.ajax({
                                url: 'ajax_Bdd.php', //toujours la même page qui est appelée
                                type: 'POST',
                                data: {
                                    fonction: 'selectListeUnites', //fonction à executer
                                    base: 'physique',
                                    table: 'ingredient',
                                    selectCondition: 'Unite'
                                },
                                success: function(data) {
                                    document.getElementById("choixUnites").innerHTML = data;
                                },
                                error: function(dataSQL, statut) {
                                    alert("error sqlConnect.js : " + dataSQL.erreur);
                                }
                            });

                        </script>
                    </div>
                    <div class="column">
                        <input type="number" value="200" style="width: 55px" disabled>
                        <label>€</label>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
