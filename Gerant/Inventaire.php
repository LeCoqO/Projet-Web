<?php
ob_start();
session_start();
if (!$_SESSION['valid']) {
    header('Location: login.php');
}
//pour reset: $_SESSION['valid']=false;
?>
<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="LUSTIERE Quentin" />
    <link rel="stylesheet" href="../CSS/styleGerant.css">
    <link rel="stylesheet" href="../CSS/styleCommun.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <title>HOMBURGER - GERANT</title>

    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        th,
        td {
            padding: 10px 20px;
            border: 1px solid #000;
        }
    </style>

</head>

<header>
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
            <div class="container">
                <a class="navbar-brand" style="text-transform: uppercase">
                    Hom'Burger
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
<br><br><br><br><br><br>

<body>
    <hr>
    <div class="container content-container">
        <main role="main">
            <section>
                <h2 class="text-center">Interface G??rant</h2>
                <div class="row text-center">
                    <div class="column4">
                        <button class="button" onclick=window.location.href="Consult_Stocks.php">Retour</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href="Ajout_ingredient.php">Ajouter
                            Ingr??dient</button>
                    </div>
                    <div class="column4">
                        <button class="button" onclick=window.location.href="Gestion_Fournisseur.php">Ajout
                            Fournisseur</button>
                    </div>
                    <div class="column4">
                        <button id='maj' class="button">Mettre ?? jour Stocks</button>
                    </div>
                </div>
            </section>
            <br>
            <div class="containert text-center">
                <!---//container content-container row text-center--->
                <div id=requete class="column3">

                </div>
                <div class="column3">
                    <div id="qte" class="">
                        <label>Quantit?? th??orique : </label>
                    </div>
                </div>
                <div class="column3">
                    <label>Quantit?? r??elle : </label>
                    <input id='qteReelle' class="petitInput" type="number" value="200" maxlength="4" style="width: 55px">
                    <label id='unite2'>Grammes</label>
                </div>
            </div>
            <script>
                /*
                TRES SEMBLABLE A AJOUT_STOCK, SE REFERER A CETTE DERNIERE POUR LES COMMENTAIRES
                */

                var laFonction = $.ajax({
                    url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction ?? executer
                        requete: 'SELECT NomIng,IdIng,StockReel,Unite FROM ingredient',
                    }
                });

                laFonction.done(function(msg) {

                    console.log(msg);

                    let resultats = JSON.parse(msg);

                    selectIng = document.createElement('select');

                    selectIng[0] = new Option("--Ingr??dient--", "", false, false);

                    for (i = 0; i < resultats.length; i++) {
                        selectIng[i + 1] = new Option(resultats[i]['NomIng'], resultats[i]['IdIng'], false, false);
                    };

                    selectIng.id = 'selectIng';
                    selectIng.class = 'column';
                    selectIng.onChange = 'appel(this.value)';

                    document.getElementById('requete').appendChild(selectIng);

                    $("#selectIng").click(function() {
                        appel($("#selectIng").val());
                    })

                    $("#maj").click(function() {
                        update($("#selectIng").val(), $("#qteReelle").val());
                    })

                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });

                let labelQteActuelle = document.createElement('label');
                let labelUniteActuelle = document.createElement('label');

                document.getElementById('qte').appendChild(labelQteActuelle);
                document.getElementById('qte').appendChild(labelUniteActuelle);


                function update($produit, $qte) {
                    var produit = $produit;
                    var qte = $qte;
                    var laFonction = $.ajax({
                        url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
                        type: 'POST',
                        data: {
                            fonction: 'update', //fonction ?? executer
                            requete: 'UPDATE ingredient SET StockReel =' + qte + ' WHERE IdIng =' + produit + ';'
                        }
                    });

                    laFonction.done(function(msg) {

                        alert('Base mise ?? jour.');

                        appel(produit);

                    });
                    laFonction.fail(function(dataSQL, statut) {
                        alert("error sqlConnect.js : " + dataSQL.erreur);
                    });
                }

                function appel($id) {
                    $.ajax({
                        url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e                  
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction ?? executer
                            requete: 'SELECT StockReel,Unite FROM ingredient WHERE IdIng =' + $id + ';',
                        },
                        success: function(data) {
                            let resultats = JSON.parse(data);
                            try {
                                labelQteActuelle.innerHTML = resultats[0]["StockReel"];
                                labelUniteActuelle.innerHTML = '&nbsp;' + resultats[0]['Unite'];
                                document.getElementById('unite2').innerHTML = resultats[0]['Unite'];
                                document.getElementById('qteReelle').value = resultats[0]['StockReel'];
                            } catch (error) {
                                console.log(error);
                            }
                        },
                        error: function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        }
                    });
                }
                appel(0);
            </script>
        </main>
    </div>
    <footer class="mt-auto footer-basic fixed-bottom">
        <div class="social">
            <a href="https://www.instagram.com/_hom_burger_/?hl=fr">
                <i class="fa fa-instagram" aria-hidden="true"></i>

            </a>
            <a href="https://twitter.com/hom_burger">
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