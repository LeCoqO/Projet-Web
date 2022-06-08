<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Eddy GUENARD" />
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

    </h1>
</header>

<body>

    <div class="container content-container">
        <section id="bordure1">
            <h2 class="text-center">Votre Panier </h2>
            <div id="Recap"></div>




            <h2>Information de livraison</h2>
            <form>
                <br>
                <div class="form__group field">
                    <label for="nom" class="form__label">Nom : </label>
                    <input type="input" class="form__field" placeholder="Nom" name="Nom" id='nom' required />

                </div>
                <div class="form__group field">
                    <label for="Adresse" class="form__label">Adresse : </label>
                    <input class="form__field" type="text" placeholder="Adresse" id="adr" name="Adresse" value="" size="20" maxlength="20" required>

                </div>
                <div class="form__group field">
                    <label for="CodePostal" class="form__label">CodePostal : </label>
                    <input class="form__field" type="text" placeholder="CodePostal" id="post" name="CodePostal" value="" size="20" maxlength="5" required>

                </div>
                <div class=" form__group field">
                    <label class="form__label" for="Ville">Ville : </label>
                    <input class="form__field" type="input" placeholder="Ville" name="Ville" id='ville' required />

                </div>
                <div class="form__group field">
                    <label class="form__label" for="tel">Téléphone: </label>
                    <input class="form__field" type="tel" placeholder="Tel" id="tel" name="tel" pattern="[0-9]{10}" maxlength="10" required>

                    <br>
                    <small>Format: 12 34 56 78 90</small>
                </div>
                <br>
                <div>
                    <p>A quelle heure souhaitez vous etre livré ?
                    <div id="horaire"></div>
                </div>
                <br>
                <div>
                    <button class="button" onclick="Validationlivraison();msgConf();">Commander</button>
                    <button type="button" class="button"><a href="IndextestTT.php">Annuler</a></button>
                </div>
            </form>
        </section>
        <div id="messageBoxConf" style="display: none" class="messageBox centrer">
            <div id="hiddenField" style="display: none"></div>
            <h4 id="messageConf"></h4>
            <br>
            <button id="validButtonFalse" class="button" onclick='checkBox_close()'><a href="IndextestTT.php">ok</a></button>
        </div>
    </div>
</body>

<footer id="piedPage">
    <a href="#" class="espaceTxt">Home</a>
    <a href="#" class="espaceTxt">About</a>
    <a href="#" class="espaceTxt">Privacy Policy</a>
    <p class="copyright">Hom'burger © 2022</p>
</footer>
<script>
    RecapCommande();
    gethoraire();

    function RecapCommande() {
        var Recap = JSON.parse(localStorage.getItem("PanierJson"));
        console.log(Recap);
        var strgRecap = "";
        var prixtot = 0;
        console.log(Recap);
        for (let i = 0; i < Recap.length; i++) {
            strgRecap += "<br><strong>" + Recap[i]["name"] + "</strong>" +
                "<br>Quantité: " + Recap[i]["quantity"] + "<br>Prix Unitaire: " + Recap[i]["price"] + "Є" + "<br>Prix total: " + (parseInt(Recap[i]["price"]) * parseInt(Recap[i]["quantity"]) + "Є") + "<br>Prix livraison: " + 5 + "Є" +
                "<br>----------";
            prixtot = (parseInt(Recap[i]["price"]) * parseInt(Recap[i]["quantity"]) + 5) + prixtot;

        }
        strgRecap += "<br>Prix de votre commande: " + prixtot + "Є";
        console.log(strgRecap);
        document.getElementById("Recap").innerHTML = strgRecap;
    }



    function Validationlivraison() {
        //console.log("INSERT INTO commande (NomCom, TelCom, AdrCom, CPCom,VilleCom,HeureDispo) " + "VALUE('" + document.getElementById("nom").value + "', '" + document.getElementById("tel").value + "', '" +
        //document.getElementById("adr").value + "', '" + document.getElementById("post").value + "', '" + document.getElementById("ville").value + "', '" + document.getElementById("temps-select").value + "')"); 
        $.ajax({
            url: 'ajax_Bdd.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'update', //fonction à executer
                requete: "INSERT INTO commande (NomCom, TelCom, AdrCom, CPCom,VilleCom,HeureDispo) " +
                    "VALUE('" + document.getElementById("nom").value + "', '" + document.getElementById("tel").value + "', '" +
                    document.getElementById("adr").value + "', '" + document.getElementById("post").value + "', '" + document.getElementById("ville").value + "', '" + document.getElementById("temps-select").value + "')",
            },
            success: function(data) {
                console.log(data);

            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
        $.ajax({
            url: 'ajax_Bdd.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'requete', //fonction à executer
                requete: "SELECT MAX(NumCom) FROM commande",
            },
            success: function(data) {
                var NumComMax = JSON.parse(data);
                parseInt(NumComMax[0]) == parseInt(NumComMax[0]['MAX(NumCom)'] + 1);
                console.log(NumComMax);

                var Recap = JSON.parse(localStorage.getItem("PanierJson"));
                var strgRecap = "";
                var value = '';
                for (let i = 0; i < Recap.length; i++) {
                    value += "('" + Recap[i]["id"] + "','" + Recap[i]["name"] + "','" + Recap[i]["quantity"] + "','" + Recap[i]["taille"] + "','" + NumComMax[0]['MAX(NumCom)'] + "','" + Recap[i]["IngBase1"] + "','" + Recap[i]["IngBase2"] + "','" + Recap[i]["IngBase3"] + "','" + Recap[i]["IngBase4"] + "','" + Recap[i]["IngOpti1"] + "','" + Recap[i]["IngOpti2"] + "','" + Recap[i]["IngOpti3"] + "','" + Recap[i]["IngOpti4"] + "')";
                    if ((i + 1) < Recap.length) {
                        value += ",";
                    }
                }
                $.ajax({
                    url: 'ajax_Bdd.php', //toujours la même page qui est appelées
                    type: 'POST',
                    data: {
                        fonction: 'update', //fonction à executer
                        requete: "INSERT INTO detail (IdProd_Produit, NomProd, Quant, Taille, NumCom, IngBase1, IngBase2, IngBase3, IngBase4, IngOpt1, IngOpt2, IngOpt3, IngOpt4)VALUES " + value,
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

    function msgConf() {
        document.getElementById("messageBoxConf").style.display = "block";
        document.getElementById("messageConf").innerHTML = "COMMANDE VALIDE ! <br>Votre commande vous sera livré a " + document.getElementById("temps-select").value + ".";
    }

    function checkBox_close() {
        document.getElementById("messageBoxConf").style.display = "none";
    }

</script>

</html>
