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
            <div class="clear"></div>

            <br>
            <table>
                <tr>
                    <td>
                        Aliment
                    </td>
                    <td>
                        Quantité
                    </td>
                </tr>
                <tr>
                    <td>
                        Alim 1
                    </td>
                    <td>
                        50g
                    </td>
                </tr>
                <tr>
                    <td>
                        Alim 2
                    </td>
                    <td>
                        2qté
                    </td>
                </tr>
            </table>
        </main>
    </div>
</body>

</html>