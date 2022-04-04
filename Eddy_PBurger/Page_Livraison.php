<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link rel="stylesheet" href="css/styles.css">
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

    <div class="container content-container">
        <section id="bordure1">
            <h2 class="text-center">Votre Panier </h2>
            <div class="clear"><br><br><br></div>
            <div class="row text-center">
                <div class="item">
                    <img src="./img/Burger1.jpg">
                    <div class="item-infos">
                        <h3>Légendaire</h3>
                        <hr>
                        <p>1 steak + bacon + chedar</p>
                        <p class="prix">4€00</p>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/Burger1.jpg">
                    <div class="item-infos">
                        <h3>Légendaire</h3>
                        <hr>
                        <p>1 steak + bacon + chedar</p>
                        <p class="prix">4€00</p>
                    </div>
                </div>
                <div class="item">
                    <img src="./img/Burger1.jpg">
                    <div class="item-infos">
                        <h3>Légendaire</h3>
                        <hr>
                        <p>1 steak + bacon + chedar</p>
                        <p class="prix">4€00</p>
                    </div>
                </div>
            </div>
            <h2>Information de livraison</h2>

            <form method="post">
                <div>
                    <p>A quelle heure souhaitez vous recuperer votre commande ?
                        <select name="taskOption" required>
                            <option valeur="" selected>--</option>
                            <option valeur="18.00">18h00</option>
                            <option valeur="18.15">18h15</option>
                            <option valeur="18.30">18h30</option>
                            <option valeur="18.45">18h45</option>
                        </select>
                    </p>
                </div>
                <div class="clear"></div>
                <div>
                    <input type="text" name="nom" placeholder="Entrez votre nom" required /><br />
                    <input type="text" name="prenom" placeholder="Entrez votre prenom" required /><br />
                    <input type="tel" id="tel" name="tel" pattern="[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}" placeholder="Entrez votre numéro de tel " required><small>Format: 12.34.56.78.90</small><br>
                    <input type="text" name="adresse" placeholder="Entrez l'adresse de livraison " required /><br />
                </div>
                <input type="submit" value="Commander" />
            </form>


            <?php
  // Vérifie qu'il provient d'un formulaire
  /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"]; 
    $email = $_POST["email"];
    
    if (!isset($name)){
      die("S'il vous plaît entrez votre nom");
    }
    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
      die("S'il vous plaît entrez votre adresse e-mail");
    }
    
    print "Salut " . $name . "!, votre adresse e-mail est ". $email;
  }*/
?>

        </section>
        <button onclick="genererMenuJSON()">Ajouter au panier</button>
        <button><a href="IndextestTT.php">Accueil</a></button>
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
        "size": "",
        "viandes": {
            "viande1": "",
            "viande2": "",
            "viande3": ""
        },
        "sauce": "",
        "supplements": {
            "supplement1": "",
            "supplement2": ""
        },
        "boisson": ""
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

    function genererMenuJSON() {
        if (document.getElementsByClassName("size-selected")[0] &&
            document.getElementsByClassName("tacos-viande-selected")[0] &&
            document.getElementsByClassName("tacos-sauce-selected")[0] &&
            document.getElementsByClassName("boisson-selected")[0]) {
            menu["size"] = document.getElementsByClassName("size-selected")[0].id;
            menu["viandes"]["viande1"] = document.getElementsByClassName("tacos-viande-selected")[0].id;
            if (document.getElementsByClassName("tacos-viande-selected")[1]) {
                menu["viandes"]["viande2"] = document.getElementsByClassName("tacos-viande-selected")[1].id;
            }
            if (document.getElementsByClassName("tacos-viande-selected")[2]) {
                menu["viandes"]["viande3"] = document.getElementsByClassName("tacos-viande-selected")[2].id;
            }
            menu["sauce"] = document.getElementsByClassName("tacos-sauce-selected")[0].id;
            if (document.getElementsByClassName("tacos-supplement-selected")[0]) {
                menu["supplements"]["supplement1"] = document.getElementsByClassName("tacos-supplement-selected")[0].id;
            }
            if (document.getElementsByClassName("tacos-supplement-selected")[1]) {
                menu["supplements"]["supplement2"] = document.getElementsByClassName("tacos-supplement-selected")[1].id;
            }
            //menu["supplements"]["supplement2"] =
            menu["boisson"] = document.getElementsByClassName("boisson-selected")[0].id
            console.log(menu);
            commande.push(menu);
            resetMenu();

        } else {
            alert("Recette incomplette");
        }
    }

    function resetMenu() {
        menu = {
            "size": "",
            "viandes": {
                "viande1": "",
                "viande2": "",
                "viande3": ""
            },
            "sauce": "",
            "supplements": {
                "supplement1": "",
                "supplement2": ""
            },
            "boisson": ""
        };
        let tabTacosSize = document.getElementsByClassName("tacos-size");
        for (let i = 0; i < tabTacosSize.length; i++) {
            tabTacosSize[i].classList.remove("size-selected");
        }
        let tabTacosViande = document.getElementsByClassName("tacos-viande");
        for (let i = 0; i < tabTacosViande.length; i++) {
            tabTacosViande[i].classList.remove("tacos-viande-selected");
        }
        let tabTacosSauce = document.getElementsByClassName("tacos-sauce");
        for (let i = 0; i < tabTacosSauce.length; i++) {
            tabTacosSauce[i].classList.remove("tacos-sauce-selected");
        }
        let tabTacosSupplement = document.getElementsByClassName("tacos-supplement");
        for (let i = 0; i < tabTacosSupplement.length; i++) {
            tabTacosSupplement[i].classList.remove("tacos-supplement-selected");
        }
        let boisson = document.getElementsByClassName("boisson-selected");
        boisson[0].classList.remove("boisson-selected");
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
        console.log(commande);
        /*commande = [{ //debug
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
        }];*/
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

</script>

</html>
