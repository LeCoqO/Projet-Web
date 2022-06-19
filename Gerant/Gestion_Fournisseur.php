<?php
ob_start();
session_start();
if (!$_SESSION['valid']) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestions des fournisseurs</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/styleCommun.css">
    <link rel="stylesheet" type="text/css" href="../CSS/styleLivreur.css">
    <meta name="author" content="PAGE Lilian" />
    <meta name="description" content="Statistique" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
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
                                <a class="nav-link" href="../Gerant/">Gérant</a>
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
    <br><br><br><br><br><br>
    <div>
        <h2 class="text-center">Interface Gérant</h2>
        <div id="tabfournisseur">

        </div>
        <div>
            <button type='button' class="button text-center" style="margin: 40px; margin-left: 40%;" id='NewFournisseur'
                onclick="location.href = 'Creation_Fournisseur.php'">
                Créé un nouveau fournisseur</input>
        </div>
    </div>
    <script>
    $.ajax({
        url: '../STOCK_REQUETE.php',
        type: 'POST',
        data: {
            fonction: 'select',
            requete: "SELECT * FROM fournisseur Where DateArchivFourn IS NULL"
        },
        success: function(data) {
            console.log(data);
            var resultats = JSON.parse(data);
            console.log(resultats);

            var string = "<FONT face='arial'><div class='container'><CENTER>" +
                "<div class='table'>" +
                "<div class='table-header' bgcolor='grey' align='center'>" +
                "<div class='header__item'> <a id='NomFourn'  class='filter__link' href='#'>Fourn</a></div>" +
                "<div class='header__item'> <a id='Adresse' class='filter__link' href='#'>Adr</a></div>" +
                "<div class='header__item'> <a id='CodePostal' class='filter__link' href='#'>CP</a></div>" +
                "<div class='header__item'> <a id='Ville' class='filter__link' href='#'>Ville</a></div>" +
                "<div class='header__item'> <a id='Tel' class='filter__link' href='#'>Tel</a></div>" +
                "<div class='header__item'> <a id='Tel' class='filter__link' href='#'>Mail</a></div>" +
                "<div class='header__item'> <a id='Modif' class='filter__link' href='#'>Modif</a></div>" +
                "<div class='header__item'> <a id='Suppr' class='filter__link' href='#'>Sup</a></div>" +
                "</div><div class='table-content'>";


            console.log(resultats[0]['NomProd']);


            for (let i = 0; i < resultats.length; i++) {
                console.log('in loop: ' + i);

                string += '<div class="table-row">' +
                    "<div class='table-data'>" + resultats[i]['NomFourn'] + "</div>" +
                    "<div class='table-data'>" + resultats[i]['AdresseFourn'] + "</div>" +
                    "<div class='table-data'>" + resultats[i]['CPFourn'] + "</div>" +
                    "<div class='table-data'>" + resultats[i]['VilleFourn'] + "</div>" +
                    "<div class='table-data'>" + resultats[i]['TelFourn'] + "</div>" +
                    "<div class='table-data'>" + resultats[i]['MailFourn'] + "</div>" +
                    "<div class='table-data'> <input type='image' id='image' class='inputImage' src = '../img/engrenage.png' width = '45px' height = '45px' onclick = 'modif(this)' ></input > </div > " +
                    "<div class='table-data'> <input type='image' id='image' class=''src = '../img/supprimer.png' width = '45px' height = '45px' onclick = 'suppressionFournisseur(this)' ></input > </div > " +
                    "</div > ";

            }
            string += '</div>' + '</CENTER>' + '</div>' + '</FONT>';

            document.getElementById("tabfournisseur").innerHTML = string;
        },
        error: function(dataSQL, statut) {
            alert("error sqlConinputImagenect.js : " + dataSQL.erreur);
        }
    });

    function suppressionFournisseur(boutton) {

        let laDate = new Date();
        laDate = laDate.getFullYear() + "-" + (laDate.getMonth() + 1) + "-" + laDate.getDate();

        let row = boutton.parentNode.parentNode;
        let NomFourn = row.firstChild.innerHTML;

        $.ajax({
            url: '../STOCK_REQUETE.php',
            type: 'POST',
            data: {
                fonction: 'Update',
                requete: "UPDATE fournisseur SET DateArchivFourn = '" + laDate + "' WHERE NomFourn = '" +
                    NomFourn + "'"
            },
            success: function(data) {
                //console.log(data);
                location.reload();
            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
    }

    function modif(e) {
        //Récupère le parent de la ligne qude l'on modifi
        let row = e.parentNode.parentNode;

        localStorage.setItem('NomFourn', row.childNodes[0].innerHTML);
        localStorage.setItem('AdrFourn', row.childNodes[1].innerHTML);
        localStorage.setItem('CPFourn', row.childNodes[2].innerHTML);
        localStorage.setItem('VilleFourn', row.childNodes[3].innerHTML);
        localStorage.setItem('TelFourn', row.childNodes[4].innerHTML);
        localStorage.setItem('MailFourn', row.childNodes[5].innerHTML);
        location.href = 'Modification_Fournisseur.php';
    }
    </script>

    <footer class="footer-basic">
        <div class="social">
            <a href="https://www.instagram.com/_hom_burger_/?hl=fr">
                <i class="fa fa-instagram"></i>
            </a>
            <a href="https://twitter.com/hom_burger">
                <i class="fa fa-twitter"></i>
            </a>
        </div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item">
                <a href="equipe.html">Notre équipe</a>
            </li>
            <li class="list-inline-item"><a href="#">A propos</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Hom'Burger © 2022</p>
    </footer>
</body>

</html>