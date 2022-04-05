<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scriptCommun.js"></script>

    <title>Hom'burger</title>
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button><br>
        <br /><a href="index.php" class="bar-item button">Accueil</a><br>
        <br /><a href="livreur.php" class="bar-item button">Livreur</a><br>
        <br /><a href="mentionLegale.html" class="bar-item button">Mention légale</a><br>
    </div>
    <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center">
        <img src="./img/logo.jpg" class="logo" alt="" />
    </h1>
</header>

<body>
    <p class="text-center">
        <button class="button" onclick="liste_open()">Liste des recettes</button>
        <button class="button" onclick="creation_open()">Ajout d'une recette</button>

    </p>
    <!--
    <div id="panier" class="panier_fermee" onclick="showPanier()">
        <div id="contentOuv">R<br>E<br>C<br>E<br>T<br>T<br>E</div>
        <div id="contentFer"block><p>testteteteteateatzrgsdf</p></div>
    </div>
    -->
    <div id="test"></div>

<div id="test"></div>
    <div class="container content-container">
        <main id="main">
            <div id="tableauProduit"></div>
        </main>
        <main id="main2" style="display: none; width: 100%">
            <h2 class="text-center">Création d'un menu:</h2>
            <div class="left" style="margin-left: 18%;">
                <h2>Nom du menu</h2>
                <input class="text-center" type="text" id="name" name="name" required pain="10">
            </div>

            <div class="half left" style="margin-left: 15%;">
                <h2>Choisir une image</h2>
                <label for="mon_fichier">Sélectionnez le fichier à
                    télécharger <br>(extensions valides :'jpg' , 'jpeg' , 'gif' , 'png' -- max 1
                    Mo) :</label>
                <input class="button" type="file" name="picture" id="picture" onchange="previewPicture(this)" accept=".jpg, .png, .gif" required />
                <img class="image" style="max-height:150px;max-width:150px;">

            </div>

            <div class="clear"><br><br><br></div>

            <section class="left">
                <article role="article center">
                    <h2 class="text-center">Choisissez le pain</h2>
                    <div id="ingr_pain"></div>
                </article>
            </section>
            <section class="left">
                <article class="left">
                    <h2 class="text-center">Choisissez vos ingrédients <br /> principaux</h2>
                    <div id="ingr_princ"></div>
                </article>
            </section>

            <section class="left">
                <article class="left">
                    <h2 class="text-center">Choisissez vos ingrédients <br />secondaires</h2>
                    <div id="ingr_second"></div>

                </article>
            </section>
            <div class="clear"><br><br><br></div>
            <div id="preview" style="display: none;">
                <h2>Prévisualisation</h2>
                <div class="row text-center">
                    <div class="column previewRecette"></div>
                    <div class="column previewRecette"></div>
                    <div class="column previewRecette"></div>
                </div>
            </div>
            <button class="button" onclick="genererRecetteJSON()">Prévisualiser</button>
            <div class="clear"><br><br><br></div>

        </main>

    </div>
    <div class="clear"><br><br><br></div>
</body>
<script src="./script_recette.js"></script>

<script>


</script>

</html>