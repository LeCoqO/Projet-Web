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
        <!--     <img src="./img/logo.png" class="logo" alt="" /> -->
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
        <section id="burger" class="burger ">
            <h2 class="text-center">Nos Incontournables </h2>
            <div id='ListeBurgerIncontournable'></div> <!-- Burger incontournable-->
        </section>
        <div class="clear"><br><br><br></div>
        <section>
            <h2 class="text-center">Nos Burgers </h2>
            <div id='ListeBurger'></div>

            <div class="clear"><br><br><br><br></div>
        </section>
        <button onclick="genererMenuJSON()">Ajouter au panier</button>
        <button><a href="Page_Livraison.php">Livraison</a></button>
        <button><a href="Page_AEmporter.php">A Emporter</a></button>
    </div>
    <div class="cache"></div>
</body>

<footer id="piedPage">
    <a href="#" class="espaceTxt">Home</a>
    <a href="#" class="espaceTxt">About</a>
    <a href="#" class="espaceTxt">Privacy Policy</a>
    <p class="copyright">Hom'burger © 2022</p>
</footer>

<script>
    var menu = [{
            "productId": "",
            "productName": "",
            "quantite": "",
        },

    ];
    var commande = [];

    function RecupPanier(e) {
        console.log(e);
        if ((this.className).includes("choixburger")) {
            tabburger = document.getElementsByClassName("choixburger");
            for (let i = 0; i < tabburger.length; i++) {
                tabburger[i].classList.remove("choixburger");
            }
            this.classList.add("choixburger");
        }
    }



    function genererMenuJSON() {
        if (document.getElementsByClassName("choixburger")[0]) {
            menu["productId"] = document.getElementsByClassName(RecupPanier)[0].id;
            menu["productName"] = document.getElementsByClassName(RecupPanier)[0].id;
            menu["quantite"] = document.getElementsByClassName(RecupPanier)[0].id;
            console.log(menu);
            commande.push(menu);
            resetMenu();

        } else {
            alert("Panier vide");
        }
    }

    function resetMenu() {
        var menu = [{
                "productId": "",
                "productName": "",
                "quantite": "",
            },

        ];
        var commande = [];
        let tabburger = document.getElementsByClassName("choixburger");
        for (let i = 0; i < tabburger.length; i++) {
            tabburger[i].classList.remove("choixburger");
        }
    }

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



    function formatCommande(commande) {
        var strgCommande = "";
        //console.log(commande);
        for (let i = 0; i < commande.length; i++) {
            strgCommande += "<br><strong>Menu n°" + (i + 1) + "</strong>" +
                "<br>" + commande[i]["productname"] + "<br>Quantité: " + commande[i]["quantite"];
            return strgCommande;
        }
    }


    //Liste BURGER
    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'selectProduit2Bdd', //fonction à executer
            base: 'physique',
            table: 'produit',
            selectCondition: '*',
            whereValue: '',
        },
        success: function(data) {
            //console.log(data);
            document.getElementById("ListeBurger").innerHTML = data;

            /* Recup = document.querySelectorAll(".item");
            for (var i = 0; i < Recup.length; i++) {
                Recup[i].addEventListener('click', function(e) {

                    if ((this.className).includes(".item")) {
                        tabburger = document.getElementsByClassName(".item");
                        for (let i = 0; i < tabburger.length; i++) {
                        tabburger[i].classList.remove(".item");
                    }
                        this.classList.add(".item");
                    }
                    console.log(this.id);
  
                })
            }*/

        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });



    //Burger Incontournable
    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'selectProduit2Bdd', //fonction à executer
            base: 'physique',
            table: 'produit',
            selectCondition: '*',
            whereValue: " WHERE Incontournable LIKE 'o'",
        },
        success: function(data) {
            //console.log(data);
            document.getElementById("ListeBurgerIncontournable").innerHTML = data;

        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

</script>

</html>
