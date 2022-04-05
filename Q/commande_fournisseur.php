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
                <div id=choixIngredients class="column2">
                    <script>
                        $.ajax({
                            url: 'ajax_Bdd.php', //toujours la même page qui est appelée
                            type: 'POST',
                            data: {
                                fonction: 'selectListeIngredients', //fonction à executer
                                base: 'physique',
                                table: 'ingredient',
                                selectCondition: '*'
                            },
                            success: function(data) {
                                document.getElementById("choixIngredients").innerHTML = data;
                            },
                            error: function(dataSQL, statut) {
                                alert("error sqlConnect.js : " + dataSQL.erreur);
                            }
                        });

                    </script>
                </div>
                <div class="column2">
                    <input type="number" value="200" style="width: 55px">
                    <div id="unite">
                        Unités
                        <script>
                            function AppelApresIngredient($id) {
                                $.ajax({
                                    url: 'ajax_Bdd.php', //toujours la même page qui est appelée
                                    type: 'POST',
                                    data: {
                                        fonction: 'SelectUnite', //fonction à executer
                                        base: 'physique',
                                        table: 'ingredient',
                                        selectCondition: '*',
                                        id: $id,
                                    },
                                    success: function(data) {
                                        document.getElementById("unite").innerHTML = data;
                                    },
                                    error: function(dataSQL, statut) {
                                        alert("error sqlConnect.js : " + dataSQL.erreur);
                                    }
                                });
                            };

                        </script>
                    </div>
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
        </main>
    </div>
</body>

</html>
