<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Eddy GUENARD" />

    <link rel="stylesheet" href="../CSS/stylePanier.css" />
    <link rel="stylesheet" href="../CSS/styleCommun.css" />
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

    <div class="clear"></div><br><br><br><br><br>
    <div class="container content-container">
        <section id="bordure1">
            <h2 class="text-center">Votre Panier </h2>
            <div id="Recap"></div>

            <br>
            <div class="form__group field">
                <label for="nom" class="form__label">Nom : </label>
                <input type="input" class="form__field" placeholder="Nom" name="Nom" id='nom' required />

            </div>
            <div class="form__group field">
                <label class="form__label" for="tel">T??l??phone:</label>
                <input class="form__field" type="tel" placeholder="Tel" id="tel" name="tel" pattern="[0-9]{10}"
                    maxlength="10" required>

                <br>
                <small>Format: 12 34 56 78 90</small>
            </div>
            <br>
            <div>
                <p>A quelle heure souhaitez vous recuperer votre commande ?</p>
                <div id="horaire"></div>
            </div>
            <br>
            <div>
                <button class="button" onclick="ValidationEmporter();msgConf();">Commander</button>
                <button type="button" class="button"><a href="index.php">Annuler</a></button>
            </div>
        </section>
        <div id="messageBoxConf" style="display: none" class="messageBox centrer">
            <div id="hiddenField" style="display: none"></div>
            <h4 id="messageConf"></h4>
            <br>
            <button id="validButtonFalse" class="button" onclick='checkBox_close()'><a href="index.php">ok</a></button>
        </div>
    </div>
    <footer class="mt-auto footer-basic fixed-bottom">
        <div class="social">
            <a href="https://www.instagram.com/_hom_burger_/?hl=fr%22%3E">
                <i class="fa fa-instagram" aria-hidden="true"></i>

            </a>
            <a href="https://twitter.com/hom_burger%22%3E">
                <i class="fa fa-twitter"></i>
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
</body>

</html>



<script>
RecapCommande();
gethoraire();
//getDate();

function RecapCommande() {
    var Recap = JSON.parse(localStorage.getItem("PanierJson"));
    var strgRecap = "";
    var prixtot = 0;
    var quantBurg = 0;
    var burgerpromo = 0;
    for (let i = 0; i < Recap.length; i++) {
        strgRecap += "<br><strong>" + Recap[i]["name"] + "</strong>" +
            "<br>Quantit??: " + Recap[i]["quantity"] + "<br>Prix Unitaire: " + Recap[i]["price"] + "??" +
            "<br>Prix total: " + (parseInt(Recap[i]["price"]) * parseInt(Recap[i]["quantity"]) + "??") +
            "<br>----------";

        /* quantBurg = quantBurg + Recap[i]["quantity"];
         if(quantBurg % 6 != 0) {
             quantBurg += 6 - (quantBurg % 6);
             strgRecap += "<br>-" + Recap[i]["price"] + "??";
             burgerpromo = burgerpromo + 1;
             console.log(burgerpromo);
         }*/
        prixtot = (parseInt(Recap[i]["price"]) * parseInt(Recap[i]["quantity"] - burgerpromo)) + prixtot;

    }
    strgRecap += "<br>Prix de votre commande: " + prixtot + "??";
    console.log(strgRecap);
    document.getElementById("Recap").innerHTML = strgRecap;
}

function ValidationEmporter() {
    console.log("INSERT INTO commande (NomCom, TelCom, HeureDispo) " + "VALUE('" + document.getElementById("nom")
        .value + "', '" + document.getElementById("tel").value + "', '14:50:00')");
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
        type: 'POST',
        data: {
            fonction: 'insert', //fonction ?? executer
            requete: "INSERT INTO commande (NomCom, TelCom, HeureDispo) " + "VALUE('" + document.getElementById(
                    "nom").value + "', '" + document.getElementById("tel").value + "', '" + document
                .getElementById("temps-select").value + "')",

        },
        success: function(data) {
            console.log(data);

        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
        type: 'POST',
        data: {
            fonction: 'select', //fonction ?? executer
            requete: "SELECT MAX(NumCom) FROM commande",
        },
        success: function(data) {
            var NumComMax = JSON.parse(data);

            var Recap = JSON.parse(localStorage.getItem("PanierJson"));
            var strgRecap = "";
            var value = '';
            for (let i = 0; i < Recap.length; i++) {
                value += "('" + Recap[i]["id"] + "','" + Recap[i]["name"] + "','" + Recap[i]["quantity"] +
                    "','" + Recap[i]["taille"] + "','" + (parseInt(NumComMax[0]['MAX(NumCom)']) + 1) +
                    "','" + Recap[
                        i][
                        "IngBase1"
                    ] + "','" + Recap[i]["IngBase2"] + "','" + Recap[i]["IngBase3"] + "','" + Recap[i][
                        "IngBase4"
                    ] + "','" + Recap[i]["IngOpti1"] + "','" + Recap[i]["IngOpti2"] + "','" + Recap[i][
                        "IngOpti3"
                    ] + "','" + Recap[i]["IngOpti4"] + "')";
                if ((i + 1) < Recap.length) {
                    value += ",";
                }
            }
            $.ajax({
                url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??es
                type: 'POST',
                data: {
                    fonction: 'insert', //fonction ?? executer
                    requete: "INSERT INTO detail (IdProd_Produit, NomProd, Quant, Taille, NumCom, IngBase1, IngBase2, IngBase3, IngBase4, IngOpt1, IngOpt2, IngOpt3, IngOpt4)VALUES " +
                        value,
                },
                success: function(data) {
                    console.log(data);

                },
                error: function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                }
            });

        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}


function gethoraire() {
    var d = new Date();
    console.log(d);
    d.setSeconds(0);
    let temps = '<select name="temps" id="temps-select">'
    for (i = 0; i < 12; i++) {
        d.setMinutes(d.getMinutes() + 15);
        let date = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        temps += '<option value="' + date + '">' + date + '</option>';
    }
    temps += '</select>';
    document.getElementById("horaire").innerHTML = temps;
}

/*function getDate() {
    var d = new Date();
    console.log(d);
    let day = '<select name="day" id="day-select">'
    let date = d.getYear() + '-' + d.getMonth() + '-' + d.getDay();
    day += '<option value="' + date + '">' + date + '</option>';
    day += '</select>';

}*/

function msgConf() {
    document.getElementById("messageBoxConf").style.display = "block";
    document.getElementById("messageConf").innerHTML = "COMMANDE VALIDE ! <br>Votre commande est au nom de " +
        document
        .getElementById("nom").value + "<br>Vous pourrez la retirer a partir de " + document.getElementById(
            "temps-select").value + ".";
}

function checkBox_close() {
    document.getElementById("messageBoxConf").style.display = "none";
}
</script>