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
        <br/><a href="#" class="bar-item button">Accueil</a>
        <br/><a href="livreur.php" class="bar-item button">Livreur</a>
        <br/><a href="mentionLegale.html" class="bar-item button">Mention légale</a>
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
        <main role="main">
            <section>
                <h2 class="text-center">Nos incontournables: </h2>
                <div class="row text-center">
                    <div class="column">Premier <img src="./img/logo.jpg" class="logo" alt="" width="33%"/></div>
                    <div class="column">deux <img src="./img/logo.jpg" class="logo" alt="" width="33%"/></div>
                    <div class="column">3 <img src="./img/logo.jpg" class="logo" alt="" width="33%"/></div>
                </div>
            </section>
            <div class="clear"><br><br><br></div>

            <h2 class="text-center">Tacos création:</h2>
            <img class="img-fluid" alt="Trois-Tacos" src="./img/Trois-Tacos-avion.jpg" width="50%">
            <section class="rigth">
                <article role="article center">
                    <h1 class="text-center">ÉTAPE 1</h1>
                    <h2 class="small text-center">Choisissez la taille</h2>
                    <h3 class="text-center tacos-size" id="M">
                        TAILLE M à partir de 5
                    </h3>
                    <p class="text-center">Une dose de viande au choix</p>
                    <h3 class="text-center tacos-size" id="L">
                        Taille L à partir de 7
                    </h3>
                    <p class="text-center">Double dose de viande au choix</p>
                    <h3 class="text-center tacos-size" id="XL">
                        Taille XL à partir de 9
                    </h3>
                    <p class="description text-center">Double tortilla + triple dose de viande au choix</p>
                </article>
            </section>
            <div class="clear"><br><br><br></div>

            <section class="left">
                <article class="left">
                    <h1 class="text-center">ÉTAPE 2</h1>
                    <h2 class="small text-center">Choisissez votre viande</h2>
                    <h3 class="text-center tacos-viande" id="Filet de poulet nature ou mariné">
                        Filet de poulet nature ou mariné
                    </h3>
                    <h3 class="text-center tacos-viande" id="Viande hachée">
                        Viande hachée
                    </h3>
                    <h3 class="text-center tacos-viande" id="Cordon Bleu">
                        Cordon Bleu
                    </h3>
                    <h3 class="text-center tacos-viande" id="Nuggets">
                        Nuggets
                    </h3>
                    <h3 class="text-center tacos-viande" id="Merguez">
                        Merguez
                    </h3>
                    <h3 class="text-center tacos-viande" id="Tenders">
                        Tenders
                    </h3>
                    <h3 class="text-center tacos-viande" id="Falafels">
                        Falafels
                    </h3>
                </article>
            </section>
            <img class="img-fluid right" alt="Viandes-03" src="./img/viandes-03.jpg" width="50%">
            <div class="clear"><br><br><br></div>

            <img class="img-fluid left" alt="Frites-sauce-02" src="./img/Frites-sauce-02.jpg" width="50%">

            <section class="rigth">
                <article class="col-md-6 d-flex flex-column justify-content-center">
                    <h1 class="text-center">ÉTAPE 3</h1>
                    <h2 class="small text-center">Choississez votre sauce</h2>
                    <h3 class="text-center tacos-sauce" id="Algerienne">
                        Algerienne
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Barbecue">
                        Barbecue
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Burger">
                        Burger
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Chili thai">
                        Chili thai
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Ketchup">
                        Ketchup
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Mayonnaise">
                        Mayonnaise
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Fuego">
                        Fuego
                    </h3>
                </article>
            </section>
            <div class="clear"><br><br><br></div>

            <img class="img-fluid rigth" alt="Garnitures-03" width="50%" src="./img/Garnitures-03.jpg" width="50%">

            <section class="rigth">
                <article class="col-md-6 d-flex flex-column justify-content-center">
                    <h1 class="text-center">Suppléments</h1>
                    <h3 class="text-center tacos-supplement" id="Emmental">
                        Emmental
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Gouda">
                        Gouda
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Cheddar">
                        Cheddar
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Raclette">
                        Raclette
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Boursin">
                        Boursin ®
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Chevre">
                        Chevre
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Mozzarella">
                        Mozzarella
                    </h3>
                    <h3 class="text-center tacos-supplement" id="Vache qui rit">
                        Vache qui rit ®
                    </h3>
                    <h3 class="text-center tacos-supplement" id="POIVRONNADE">
                        POIVRONNADE
                    </h3>
                    <h3 class="text-center tacos-supplement" id="POULET">
                        POULET
                    </h3>
                    <h3 class="text-center tacos-supplement" id="BOEUF FACON BACON FUME">
                        BOEUF FACON BACON FUME
                    </h3>
                    <h3 class="text-center tacos-supplement" id="JALAPENO &amp; CHEESE NUGGETS">
                        JALAPENO &amp; CHEESE NUGGETS
                    </h3>
                    <h3 class="text-center tacos-supplement" id="OIGNONS CARAMELISES">
                        OIGNONS CARAMELISES
                    </h3>
                    <h3 class="text-center tacos-supplement" id="LARDONS DE VOLAILLE">
                        LARDONS DE VOLAILLE
                    </h3>
                </article>
            </section>
            <div class="clear"><br><br><br></div>
            <img class="img-fluid left" alt="Ambiance-01" src="./img/ambiance-01.jpg" width="50%">

            <section class="rigth">
                <article class="col-md-6 d-flex flex-column justify-content-center">
                    <h1 class="text-center">Boissons</h1>
                    <h3 class="text-center tacos-boisson" id="Coca Cola">
                        Coca Cola®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Coca Cola Zero">
                        Coca Cola Zero®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Coca Cola Cherry">
                        Coca Cola Cherry®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Oasis Tropical">
                        Oasis Tropical®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Oasis Pomme cassis framboise">
                        Oasis® Pomme cassis framboise
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Cristaline Fraise">
                        Cristaline® Fraise
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Perrier">
                        Perrier®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Seven up mojito">
                        Seven up® mojito
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Lipton Ice Tea Peche">
                        Lipton Ice Tea® Peche
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Tropico">
                        Tropico®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Fanta Orange">
                        Fanta Orange®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Caprisun Multivitamine">
                        Caprisun® Multivitamine
                    </h3>
                    <h3 class="text-center tacos-boisson" id="MONSTER">
                        MONSTER®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Ice Tea Green Citron Vert">
                        Ice Tea® Green Citron Vert
                    </h3>
                    <h3 class="text-center tacos-boisson" id="FUZE TEA">
                        FUZE TEA®
                    </h3>
                    <h3 class="text-center tacos-boisson" id="Eau minerale">
                        Eau minerale
                    </h3>
                </article>
        </main>
        <div class="clear"><br><br><br></div>

        <button onclick="genererMenuJSON()">Ajouter au panier</button>

    </div>

</body>
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
            panierContent.innerHTML = formatCommande(commande);
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