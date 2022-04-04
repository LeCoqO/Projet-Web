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
                        <button class="button" onclick=window.location.href='commande_fournisseur.php'>Retour</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href=''>Commander</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href=''>Supprimer</button>
                    </div>
                </div>
            </section>
            <div class='clear'></div>



            <br>
            <div>
                <article>
                    <div class="left">
                        <h3><a href="">link text</a></h3>
                        <div class="bonCompact">
                            <div class="left">Date d'émission : XX/XX/XXXX</div>
                            <div class="right">Date livraison prévue : XX/XX/XXXX</div>
                            <div class="clear left">Nom Ingrédient</div>
                            <div class=right>Quantité Unité</div><br>
                            <div class="clear">Fournisseur</div>
                            <div class="text-center">
                                PRIX TOTAL HT : XXX€
                            </div>
                        </div>
                    </div>
                    <div class="right vertical-center">
                        <input class="" type="checkbox" checked>
                    </div>
                </article>
            </div>
        </main>
    </div>
</body>

</html>
