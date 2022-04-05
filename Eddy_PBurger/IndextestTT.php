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
        <h2 class="text-center">Nos Incontournables: </h2>
        <section id="burger" class="burger ">
            <div id='ListeBurgerIncontournable'></div>   <!-- Burger incontournable-->
        </section>
        <div class="clear"><br><br><br></div>
        <section>
            <div id='ListeBurger'></div>
            <div id='ListeBurger'></div>
            <div id='ListeBurger'></div>
            <div id='ListeBurger'></div>
            <div id='ListeBurger'></div>
            
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
    var menu = {
        "Nomburger": "",
    };
    var commande = [];

    for (var i = 0; i < $("h3").length; i++) {
        $("h3")[i].addEventListener('click', function(e) {
            if ((this.className).includes("tacos-size")) {
                tabtacosSize = document.getElementsByClassName("tacos-size");
                for (let i = 0; i < tabtacosSize.length; i++) {
                    tabtacosSize[i].classList.remove("size-selected");
                }
                this.classList.add("size-selected");
            }
            if (document.getElementsByClassName("size-selected")[0]) {
                if ((this.className).includes("tacos-viande")) {
                    if (document.getElementsByClassName("size-selected")[0].id == "M") {
                        if ((this.className).includes("tacos-viande-selected")) {
                            this.classList.remove("tacos-viande-selected");
                        } else {
                            if ($(".tacos-viande-selected").length >= 1) {
                                $(".tacos-viande-selected")[0].classList.remove("tacos-viande-selected");
                            }
                            this.classList.add("tacos-viande-selected");
                        }
                    }
                    if (document.getElementsByClassName("size-selected")[0].id == "L") {
                        if ((this.className).includes("tacos-viande-selected")) {
                            this.classList.remove("tacos-viande-selected");
                        } else {
                            if ($(".tacos-viande-selected").length < 1) {
                                this.classList.add("tacos-viande-selected");
                            } else if ($(".tacos-viande-selected").length == 1) {
                                this.classList.add("tacos-viande-selected");
                            }
                        }
                    }
                    if (document.getElementsByClassName("size-selected")[0].id == "XL") {
                        if ((this.className).includes("tacos-viande-selected")) {
                            this.classList.remove("tacos-viande-selected");
                        } else {
                            if ($(".tacos-viande-selected").length < 1) {
                                this.classList.add("tacos-viande-selected");
                            } else if ($(".tacos-viande-selected").length == 1) {
                                this.classList.add("tacos-viande-selected");
                            } else if ($(".tacos-viande-selected").length == 2) {
                                this.classList.add("tacos-viande-selected");
                            }
                        }
                    }
                }
                if ((this.className).includes("tacos-sauce")) {
                    if (document.getElementsByClassName("tacos-viande-selected")[0]) {
                        if ((this.className).includes("tacos-sauce-selected")) {
                            this.classList.remove("tacos-sauce-selected");
                        } else {
                            let tabTacosSauce = document.getElementsByClassName("tacos-sauce");
                            for (let i = 0; i < tabTacosSauce.length; i++) {
                                tabTacosSauce[i].classList.remove("tacos-sauce-selected");
                            }
                            this.classList.add("tacos-sauce-selected");
                        }
                    }
                }
                if ((this.className).includes("tacos-supplement")) {
                    if (document.getElementsByClassName("tacos-sauce-selected")[0]) {
                        if ((this.className).includes("tacos-supplement-selected")) {
                            this.classList.remove("tacos-supplement-selected");
                        } else {
                            if ($(".tacos-supplement-selected").length < 1) {
                                //menu["supplements"]["supplement1"] = this.id;
                                this.classList.add("tacos-supplement-selected");
                            } else if ($(".tacos-supplement-selected").length == 1) {
                                // menu["supplements"]["supplement2"] = this.id;
                                this.classList.add("tacos-supplement-selected");
                            }
                        }
                    }
                }
                if ((this.className).includes("tacos-boisson")) {
                    tabtacosBoisson = document.getElementsByClassName("tacos-boisson");
                    for (let i = 0; i < tabtacosBoisson.length; i++) {
                        tabtacosBoisson[i].classList.remove("boisson-selected");
                    }
                    this.classList.add("boisson-selected");
                }
            }

        })
    }
    /*
        function genererMenuJSON() {
            if (document.getElementsByClassName("choixburger")[0] {
                    menu["burger"] = document.getElementsByClassName("choixburger")[0].id;
                    console.log(menu);
                    commande.push(menu);
                    resetMenu();

                } else {
                    alert("Panier vide");
                }
            }

            function resetMenu() {
                menu = {
                    "choixburger": "",
                };
                let tabburger = document.getElementsByClassName("choixburger");
                for (let i = 0; i < tabTacosSize.length; i++) {
                    tabTacosSize[i].classList.remove("choixburger");

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
    */
    function formatCommande(commande) {
        var strgCommande = "";
        console.log(commande);
    }
    /*       commande = [{ //debug
                    "size": "M",
                    "viandes": {
                        "viande1": "poulit",
                        "viande2": "",
                        "viande3": ""
                    },
                    "sauce": "algé",
                    "supplements": {
                        "supplement1": "fromage",
                        "supplement2": ""
                    },
                    "boisson": "eau"
                }];
                for (let i = 0; i < commande.length; i++) {
                    strgCommande += "<strong>MENU n°" + (i + 1) + "</strong>" +
                        "<br>Size: " + commande[i]["size"] + "<br>Viandes: ";
                    for (let j = 0; j < 2; j++) {
                        if (commande[i]["viandes"]["viande" + (j + 1)]) {
                            strgCommande += commande[i]["viandes"]["viande" + (j + 1)];
                        }
                    };
                    strgCommande += "<br>Sauce: " + commande[i]["sauce"] + "<br>Supplements: ";
                    for (let h = 0; h < 1; h++) {
                        if (commande[i]["supplements"]["supplement" + (h + 1)]) {
                            strgCommande += commande[i]["supplements"]["supplement" + (h + 1)];
                        }
                    };
                    strgCommande += "<br>Boisson: " + commande[i]["boisson"] + "<br><br>";
                }
                return strgCommande;
            }

            function sidebar_open() {
                document.getElementById("mySidebar").style.display = "block";
            }

            function sidebar_close() {
                document.getElementById("mySidebar").style.display = "none";
            }
*/

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
            selectCondition: 'Incontournable = 1',
            whereValue: '',
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
