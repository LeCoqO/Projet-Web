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
                <select class="column">
                    <option selected value="">--Ingrédient à commander--</option>
                    <option>Ingredient 1</option>
                    <option>Ingredient 2</option>
                </select>
                <div class="column">
                    <input type="number" value="200" style="width: 55px">
                </div>
                <label class="column">Grammes</label>
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
