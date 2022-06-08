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
        <button><a href="Page_Livraison.php" class="button-pannier">Livraison</a></button>
        <button><a href="Page_AEmporter.php" class="button-pannier">A Emporter</a></button>
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


        <div id="messageBoxPanier" style="display: none" class="messageBox centrer">
            <div id="hiddenField" style="display: none"></div>
            <h4 id="messagePanier">Quelle quantité désirez-vous?</h4>
            <br>
            <button id="validButtonTrue" class="button" onclick='increment(-1)'>-</button>
            <input id="quantity" class="button" type="number" name="quantity" value="1" min="1" max="100">
            <button id="validButtonFalse" class="button" onclick='increment(1)'>+</button>
            <br> <br>
            <button id="validButtonTrue" class="button" onclick='addToJson()'>Oui</button>
            <button id="validButtonFalse" class="button" onclick='checkBox_closePanier()'>Non</button>

        </div>
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
    var tabJson = [];

    var commande = [];

    function showPanier() {
        var lePanier = document.getElementById("panier");
        var panierContent = document.getElementById("content");
        if ((lePanier.className).includes("panier_fermee")) {
            lePanier.classList.remove("panier_fermee");
            lePanier.classList.add("panier_ouvert");
            panierContent.innerHTML = "<strong>PANIER</strong>" + formatCommande(tabJson);
        } else {
            lePanier.classList.remove("panier_ouvert");
            lePanier.classList.add("panier_fermee");
            panierContent.innerHTML = "<small>P<br>A<br>N<br>I<br>E<br>R</small>";

        }
    }



    function formatCommande(tabJson) {
        var strgCommande = "";
        var prixtot = 0 ;
        //console.log(commande);
        for (let i = 0; i < tabJson.length; i++) {
            strgCommande += "<br><strong>" + tabJson[i]["name"] + "</strong>" +
                "<br>Quantité: " + tabJson[i]["quantity"] + "<br>Prix Unitaire: " + tabJson[i]["price"] + "Є"+ "<br>Prix total: " + (parseInt(tabJson[i]["price"]) * parseInt(tabJson[i]["quantity"]) + "Є") +
                "<br>----------";
            
            
            prixtot = (parseInt(tabJson[i]["price"]) * parseInt(tabJson[i]["quantity"])) + prixtot;
            console.log(strgCommande);
            console.log(prixtot);
        }
        strgCommande += "<br>Prix de votre commande: " + prixtot + "Є";
        return strgCommande;
    }

    function addToJson() {
        let info = (document.getElementById("hiddenField").innerHTML).split("|");
        //console.log(info);
        let qty = document.getElementById("quantity").value;
        var quant = parseInt(qty);
        let found = false;
        for (e in tabJson) {
            if (tabJson[e].id == info[0]) {
                tabJson[e].quantity += quant;
                found = true;
            }
        }
        if (!found) {
            tabJson.push({
                "id": info[0],
                "name": info[1],
                "price": info[2],
                "quantity": quant,

            })
        }
        console.log(tabJson);
        var lePanier = document.getElementById("panier");
        var panierContent = document.getElementById("content");
        lePanier.classList.remove("panier_ouvert");
        lePanier.classList.add("panier_fermee");
        panierContent.innerHTML = "<small>P<br>A<br>N<br>I<br>E<br>R</small>";
    }

    function confChoix() {
        let value = [split[0], split[1], split[2]];
        document.getElementById("messageBoxPanier").style.display = "block";
        document.getElementById("messagePanier").innerHTML = "Combien de " + value[1] + " voulez-vous ajouter à votre commande?";
        document.getElementById("hiddenField").innerHTML = value[0] + "|" + value[1] + "|" + value[2];
    }

    function increment(value) {
        if (parseInt(document.getElementById("quantity").value) > 0 || value > 0) {
            let qty = parseInt(document.getElementById("quantity").value) + value;
            document.getElementById("quantity").value = qty;
        }
    }

    function checkBox_closePanier() {
        document.getElementById("messageBoxPanier").style.display = "none";
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
            //console.log(data);

            Recup = document.querySelectorAll(".item");
            for (var i = 0; i < Recup.length; i++) {
                Recup[i].addEventListener('click', function(e) {
                    split = (this.id).split('|');
                    confChoix();
                })
            }
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

            Recup = document.querySelectorAll(".item");
            for (var i = 0; i < Recup.length; i++) {
                Recup[i].addEventListener('click', function(e) {
                    split = (this.id).split('|');
                    confChoix();
                })
            }

        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

</script>

</html>
