<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>BulgarKing</title>
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
        <br /><a href="#" class="bar-item button">Accueil</a>
        <br /><a href="livreur.php" class="bar-item button">Livreur</a>
        <br /><a href="mentionLegale.html" class="bar-item button">Mention légale</a>
    </div>
    <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center ">
        <img src="./img/logo.png" class="logo" alt="" />
    </h1>
</header>

<body>
    <div id="panier" class="panier_fermee" onclick="showPanier()">
        <p id="content" class="text-center">
            <small>P<br>A<br>N<br>I<br>E<br>R</small>

        </p>
    </div>
    <!--class="container content-container"-->
    <div>
        <h2 class="text-center">Nos Incontournables: </h2>
        <section id="burger" class="burger ">
            <h6 class="choixburger">
                <div class="item">
                    <img src="./images/Burger1.jpg">
                    <div class="item-infos choixburger">
                        <h3>Légendaire</h3>
                        <hr>
                        <p>1 steak + bacon + chedar</p>
                        <p class="prix">4€00</p>
                    </div>
                    <img src="./images/panier.png" class="imgpanier choixburger" id="Burger Légendaire">
                </div>
            </h6>

            <div class="item">
                <img src="./images/Burger1.jpg">
                <div class="item-infos">
                    <h3>Villageois</h3>
                    <hr>
                    <p>1 steak + chedar + salade + oignons</p>
                    <p class="prix">5€00</p>
                </div>
                <img src="./images/panier.png" class="imgpanier ">
            </div>

            <div class="item">
                <img src="./images/Burger1.jpg">
                <div class="item-infos">
                    <h30>Basique</h30>
                    <hr>
                    <p>2 steaks + chedar</p>
                    <p class="prix">5€00</p>
                </div>
                <img src="./images/panier.png" class="imgpanier ">
            </div>

        </section>
        <div class="clear"><br><br><br></div>
        <section>
            <div class="item">
                <img src="./images/Burger1.jpg">
                <div class="item-infos">
                    <h3>Légendaire</h3>
                    <hr>
                    <p>1 steak + bacon + chedar</p>
                    <p class="prix">4€00</p>
                </div>
                <img src="./images/panier.png" class="imgpanier ">
            </div>
            <div class="item">
                <img src="./images/Burger1.jpg">
                <div class="item-infos">
                    <h3>Légendaire</h3>
                    <hr>
                    <p>1 steak + bacon + chedar</p>
                    <p class="prix">4€00</p>
                </div>
                <img src="./images/panier.png" class="imgpanier ">
            </div>
            <div class="item">
                <img src="./images/Burger1.jpg">
                <div class="item-infos">
                    <h3>Légendaire</h3>
                    <hr>
                    <p>1 steak + bacon + chedar</p>
                    <p class="prix">4€00</p>
                </div>
                <img src="./images/panier.png" class="imgpanier ">
            </div>

            <div class="clear"><br><br><br><br></div>
        </section>
        <button onclick="genererMenuJSON()">Ajouter au panier</button>
        <button><a href="Page_Livraison.php">Livraison</a></button>
        <button><a href="Page_AEmporter.php">A Emporter</a></button>
    </div>
</body>

<footer id="piedPage">
    <a href="#" class="espaceTxt">Home</a>
    <a href="#" class="espaceTxt">About</a>
    <a href="#" class="espaceTxt">Privacy Policy</a>
    <p class="copyright">Hom'burger © 2022</p>
</footer>

<script>
    function showPanier() {
        var lePanier = document.getElementById("panier");
        var panierContent = document.getElementById("content");
        if ((lePanier.className).includes("panier_fermee")) {
            lePanier.classList.remove("panier_fermee");
            lePanier.classList.add("panier_ouvert");
            panierContent.innerHTML = "PANIER" + formatCommande(commande);
        } else {
            lePanier.classList.remove("panier_ouvert");
            lePanier.classList.add("panier_fermee");
            panierContent.innerHTML = "<small>P<br>A<br>N<br>I<br>E<br>R</small>";
        }
    }


    function sidebar_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function sidebar_close() {
        document.getElementById("mySidebar").style.display = "none";
    }

    var menu = {
        "burger": "",
    };
    var commande = [];

    for (var i = 0; i < $("h6").length; i++) {
        $("h6")[i].addEventListener('click', function(e)) {
                if ((this.className).includes("choixburger")) {
                    tabBurger = document.getElementsByClassName("choixburger");
                    for (let i = 0; i < tabBurger.length; i++) {
                        tabBurger[i].classList.remove("choixburger");
                    }
                    this.classList.add("choixburger");
                }
            }
        }
    

    function genererMenuJSON() {
        if (document.getElementsByClassName("choixburger")[0] console.log(menu); commande.push(menu); resetMenu();

        }
        else {
            alert("Recette incomplette");
        }
    }

</script>

</html>
