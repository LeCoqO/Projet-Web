<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="../CSS/stylePanier.css" />
    <link rel="stylesheet" href="../CSS/styleCommun.css" />
    <link href="https://fonts.googleapis.com/css2?family=Kenia&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <title>Hom'Burger</title>
</head>

<body>
    <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
                <div class="container">
                    <a class="navbar-brand" style="text-transform: uppercase">
                        Hom'Burger
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">
                                    Home
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Accueil/">Acceuil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Cuisine/">Cusinier</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Gerant/">G??rant</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Livreur/">Livreur</a>
                            </li>
                        </ul>
                        <img class="imgNavbar" src="../img/logo.png" />
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div id="panier" class="panier_fermee" onclick="showPanier()">
        <p id="content" class="text-center">
            <span style="color: white"><small>P<br>A<br>N<br>I<br>E<br>R</small></span>
        </p>
        <div class="styleButPanier">
            <button id="butpanierliv" style="display: none" class="right "><a href="Page_Livraison.php"
                    class="button-pannier ">Livraison</a></button>
            <button id="butpanieremp" style="display: none"><a href="Page_AEmporter.php" class="button-pannier">A
                    Emporter</a></button>
        </div>
    </div>
    <div>
        <section id="burger" class="burger">
            <h2 class="text-center">Nos Incontournables </h2>
            <div id='ListeBurgerIncontournable'></div> <!-- Burger incontournable-->
        </section>
        <div class="clear"></div>
        <section>
            <h2 class="text-center">Nos Burgers </h2>
            <div id='ListeBurger'></div>

            <div class="clear"><br><br><br><br></div>
        </section>
        <div id="messageBoxPanier" style="display: none" class="messageBox centrer">
            <div id="hiddenField" style="display: none"></div>
            <h4 id="messagePanier"></h4>
            <button id="validButtonTrue" class="button" onclick='increment(-1)'>-</button>
            <input id="quantity" class="button" type="number" name="quantity" value="1" min="1" max="100">
            <button id="validButtonFalse" class="button" onclick='increment(1)'>+</button>
            <br> <br>
            <br>
            <h4 id="MessageIngred"></h4>
            <div id="optioP1"></div>
            <div id="optioP2"></div>
            <br>
            <h4 id="MessageSauce"></h4>
            <div id="optioS1"></div>
            <div id="optioS2"></div>
            <br>
            <button id="validButtonTrue" class="button" onclick='addToJson()'>Oui</button>
            <button id="validButtonFalse" class="button" onclick='checkBox_closePanier()'>Non</button>
        </div>
    </div>



    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="https://www.instagram.com/_hom_burger_/?hl=fr%22%3E">
                    <i class=" fa fa-instagram"></i>
                </a>
                <a href="https://twitter.com/hom_burger%22%3E">
                    <i class=" fa fa-twitter"></i>
                </a>
            </div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item">
                    <a href="equipe.html">Notre ??quipe</a>
                </li>
                <li class="list-inline-item"><a href="#">A propos</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Hom'Burger ?? 2022</p>
        </footer>
    </div>
</body>

</html>

<script>
SelectIngredOptiS();
SelectIngredOptiP();

var tabJson = [];

var commande = [];

function showPanier() {
    var lePanier = document.getElementById("panier");
    var panierContent = document.getElementById("content");

    if ((lePanier.className).includes("panier_fermee")) {
        lePanier.classList.remove("panier_fermee");
        lePanier.classList.add("panier_ouvert");
        panierContent.innerHTML = "<strong>PANIER</strong>" + formatCommande(tabJson);
        document.getElementById("butpanierliv").style.display = "block";
        document.getElementById("butpanieremp").style.display = "block";
    } else {
        lePanier.classList.remove("panier_ouvert");
        lePanier.classList.add("panier_fermee");
        panierContent.innerHTML = "<span style = 'color: white'><small>P<br>A<br>N<br>I<br>E<br>R</small></span>";
        document.getElementById("butpanieremp").style.display = "none";
        document.getElementById("butpanierliv").style.display = "none";

    }
    var Recap = JSON.parse(localStorage.getItem("PanierJson"));
    console.log(Recap);

}



function formatCommande(tabJson) {
    var strgCommande = "";
    var prixtot = 0;
    //console.log(commande);
    for (let i = 0; i < tabJson.length; i++) {
        strgCommande += "<br><strong>" + tabJson[i]["name"] + "</strong>";
        if (tabJson[i]["IngOpti1"] !== "NULL") {
            strgCommande += "<br><i>" + tabJson[i]["IngOpti1"] + "</i>";
        }
        if (tabJson[i]["IngOpti2"] !== "NULL") {
            strgCommande += "<br><i>" + tabJson[i]["IngOpti2"] + "</i>";
        }
        if (tabJson[i]["IngOpti3"] !== "NULL") {
            strgCommande += "<br><i>" + tabJson[i]["IngOpti3"] + "</i>";
        }
        if (tabJson[i]["IngOpti4"] !== "NULL") {
            strgCommande += "<br><i>" + tabJson[i]["IngOpti4"] + "</i>";
        }
        strgCommande += "<br>Quantit??: " + tabJson[i]["quantity"] + "<br>Prix Unitaire: " + tabJson[i]["price"] + "??" +
            "<br>Prix total: " + (parseInt(tabJson[i]["price"]) * parseInt(tabJson[i]["quantity"]) + "??") +
            "<br>----------";
        prixtot = (parseInt(tabJson[i]["price"]) * parseInt(tabJson[i]["quantity"])) + prixtot;
        console.log(strgCommande);
        console.log(prixtot);
    }
    strgCommande += "<br>Prix de votre commande: " + prixtot + "??";
    return strgCommande;
    console.log(tabJson);
}

function addToJson() {
    let info = (document.getElementById("hiddenField").innerHTML).split("|");
    //console.log(info);
    let qty = document.getElementById("quantity").value;
    var quant = parseInt(qty);
    var Opti1 = document.getElementById("sauces-select").value;
    var Opti2 = document.getElementById("sauces2-select").value;
    var Opti3 = document.getElementById("Ingred-select").value;
    var Opti4 = document.getElementById("Ingred2-select").value;
    console.log(Opti1);
    console.log(Opti2);
    console.log(Opti3);
    console.log(Opti4);
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
            "taille": info[3],
            "IngBase1": info[4],
            "IngBase2": info[5],
            "IngBase3": info[6],
            "IngBase4": info[7],
            "IngOpti1": Opti1,
            "IngOpti2": Opti2,
            "IngOpti3": Opti3,
            "IngOpti4": Opti4,


        })
    }
    var lePanier = document.getElementById("panier");
    var panierContent = document.getElementById("content");
    lePanier.classList.remove("panier_ouvert");
    lePanier.classList.add("panier_fermee");
    panierContent.innerHTML = "<span style = 'color: white'><small>P<br>A<br>N<br>I<br>E<br>R</small></span>";
    localStorage.setItem("PanierJson", JSON.stringify(tabJson));
    document.getElementById("messageBoxPanier").style.display = "none";
}

function confChoix() {
    let value = [split[0], split[1], split[2], split[3], split[4], split[5], split[6], split[7], split[8], split[9],
        split[10], split[11]
    ];
    document.getElementById("messageBoxPanier").style.display = "block";
    document.getElementById("messagePanier").innerHTML = "Combien de " + value[1] +
        " voulez-vous ajouter ?? votre commande?";
    document.getElementById("MessageIngred").innerHTML = "Voulez-vous des ingr??dients suppl??mentaires ?(Max 2)";
    document.getElementById("MessageSauce").innerHTML = "Voulez-vous des sauces suppl??mentaires ?(Max 2)";
    document.getElementById("hiddenField").innerHTML = value[0] + "|" + value[1] + "|" + value[2] + "|" + value[3] +
        "|" + value[4] + "|" + value[5] + "|" + value[6] + "|" + value[7] + "|" + value[8] + "|" + value[9] + "|" +
        value[10] + "|" + value[11];
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
    url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
    type: 'POST',
    data: {
        fonction: 'selectProduit2Bdd', //fonction ?? executer
        base: 'homburger',
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
                console.log(Recup);
            })
        }
    },
    error: function(dataSQL, statut) {
        alert("error sqlConnect.js : " + dataSQL.erreur);
    }
});

//Burger Incontournable
$.ajax({
    url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
    type: 'POST',
    data: {
        fonction: 'selectProduit2Bdd', //fonction ?? executer
        base: 'homburger',
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

function SelectIngredOptiS() {
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
        type: 'POST',
        data: {
            fonction: 'select', //fonction ?? executer
            requete: "SELECT NomIng,Type FROM ingredient WHERE Type = 'S'"
        },
        success: function(data) {

            let ChoixOpti = JSON.parse(data);
            console.log(ChoixOpti);
            let sauces = '<select name="sauces" id="sauces-select">'
            let sauces2 = '<select name="sauces2" id="sauces2-select">'
            sauces += '<option value="NULL">---</option>';
            sauces2 += '<option value="NULL">---</option>';

            for (i = 0; i < ChoixOpti.length; i++) {
                sauces += '<option value="' + ChoixOpti[i]['NomIng'] + '">' + ChoixOpti[i]['NomIng'] +
                    '</option>';
                sauces2 += '<option value="' + ChoixOpti[i]['NomIng'] + '">' + ChoixOpti[i]['NomIng'] +
                    '</option>';
            }
            sauces += '</select>';
            sauces2 += '</select>';

            document.getElementById("optioS1").innerHTML = sauces;
            document.getElementById("optioS2").innerHTML = sauces2;



        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

}

function SelectIngredOptiP() {
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
        type: 'POST',
        data: {
            fonction: 'select', //fonction ?? executer
            requete: "SELECT NomIng,Type FROM ingredient WHERE Type = 'P'"
        },
        success: function(data) {

            let ChoixOpti = JSON.parse(data);
            console.log(ChoixOpti);
            let Ingred = '<select name="Ingred" id="Ingred-select">'
            let Ingred2 = '<select name="Ingred2" id="Ingred2-select">'
            Ingred += '<option value="NULL">---</option>';
            Ingred2 += '<option value="NULL">---</option>';

            for (i = 0; i < ChoixOpti.length; i++) {
                Ingred += '<option value="' + ChoixOpti[i]['NomIng'] + '">' + ChoixOpti[i]['NomIng'] +
                    '</option>';
                Ingred2 += '<option value="' + ChoixOpti[i]['NomIng'] + '">' + ChoixOpti[i]['NomIng'] +
                    '</option>';
            }
            Ingred += '</select>';
            Ingred2 += '</select>';

            document.getElementById("optioP1").innerHTML = Ingred;
            document.getElementById("optioP2").innerHTML = Ingred2;



        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

}
</script>