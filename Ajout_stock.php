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
    <div>
        <label>Interface Gérant : Ajout Stocks</label>
        <br>
        <div class="boutonMenuGerant">
            <button>Retour</button>

            <button>Ajouter Ingrédient</button>

            <button>Ajouter Fournisseur</button>

            <button>Mettre à jour Stock</button>
        </div>
    </div>

    <br>
    <div>
        <select>
            <option selected value="">--Ingrédient à mettre a jour--</option>
            <option>Aliment 1 </option>
            <option>Aliment 2 </option>
        </select>

        <label>500</label>
        <label>Grammes</label>
    </div>
    <div>
        <label>Quantité reçue : </label>
        <input type="number" value="200">
        <label>Grammes</label>
    </div>
</body>

</html>
