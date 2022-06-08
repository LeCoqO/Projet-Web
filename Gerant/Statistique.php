<!DOCTYPE html">
<html lang="fr">

<head>
    <title>Statistique</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="author" content="PAGE Lilian" />
    <meta name="description" content="Statistique" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <header>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- Navigation -->
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
                <div class="container">
                    <a class="navbar-brand" style="text-transform: uppercase;">
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
                                <a class="nav-link" href="#">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Fruits</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Sea food</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Vegetables</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                        <img class="imgNavbar" style="width: 50px;" src="./img/logo.png">
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <br><br><br><br><br><br>
    <fieldset style="margin-left: 3%;">
        <legend>
            <h2>Configuration :</h2>
        </legend>
        <div class="Choix row">
            <div class="column2 form__group field left">
                <select id="Datation" onchange="choixTypeDate()" class="form__field" size="1" name="prog">
                    <option value="ChoixDate1" selected>Libre</option>
                    <option value="ChoixDate2">Mois</option>
                    <option value="ChoixDate3">Année</option>
                </select>
                <label class="form__label" for="Datation">Datation:</label>
            </div>
            <div id="Diagramme" class="column2 form__group field left">
                <select id="DiagrammeType" class="form__field" size="1" name="prog">
                    <option selected>pie</option>
                    <option>bar</option>
                </select>
                <label class="form__label" for="DiagrammeType">Type diagramme:</label>
            </div>
            <div id="option" class="column2 form__group field left">
            </div>
        </div>
        <div id="ChoixDate1" class="ChoixDate Choix roww">
            <div class="form__group field left column2">
                <input type="date" class="form__field" id="start" name="DateDebut" min="2022-01-01"
                    value="<?php echo choixDate("-2 month"); ?>" max="<?php echo choixDate("-1 days"); ?>">
                <label class="form__label" for="DateDebut" class="cat">Date de début:</label>
            </div>
            <div class="form__group field left column2">
                <input type="date" class="form__field" id="end" name="DateFin" min="2022-01-02">
                <label class="form__label" for="DateFin">Date de fin:</label>
            </div>
        </div>
        <div id="ChoixDate2" class="ChoixDate Choix roww cacher">
            <div class="form__group field left column2">
                <input type="month" id="Mois" class="form__field" min="2022-01">
                <label class="form__label" for="Mois">Année et Mois:</label>
            </div>
        </div>
        <div id="ChoixDate3" class="ChoixDate Choix roww cacher">
            <div class="form__group field left column2">
                <input id="Annee" type="number" class="form__field" min="2022" max="2099" step="1" value="2022" />
                <label class="form__label" for="Annee">Année:</label>
            </div>
        </div>
        <div>
            <button class="button left" onclick="afficherStatistique()">Envoyer</button>
        </div>
    </fieldset>
    <div id=chart style="margin-left: 33%;">
        <canvas id="myChart" style="width:100%;max-width:700px"> </canvas>
    </div>

    <script type="text/javascript">
    let laDate = new Date();
    date = laDate.getFullYear() + "-" + 0 + (laDate.getMonth() + 1);
    document.getElementById("Mois").setAttribute("max", date);
    document.getElementById("Mois").setAttribute("value", date);

    date = laDate.getFullYear() + "-" + 0 + (laDate.getMonth() + 1) + "-" + 0 + laDate.getDate();
    document.getElementById("end").setAttribute("max", date);
    document.getElementById("end").setAttribute("value", date);

    afficherStatistique()

    $.ajax({
        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'select', //fonction à executer
            requete: 'SELECT NomProd FROM produit'
        },
        success: function(data) {
            var resultats = JSON.parse(data);
            console.log(data);
            var stringOption =
                '<label for="Choi categorie" class="form__label" class="cat">Categorie:</label>' +
                '<select id="langage" class="form__field" size=1 name="prog">' +
                '<option selected>Toutes</option>';

            for (let i = 0; i < resultats.length; i++) {
                stringOption += "<option>" + resultats[i]['NomProd'] + "</option>";
            }
            stringOption += '</select>';
            document.getElementById("option").innerHTML = stringOption;
        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

    function afficherStatistique() {
        $.ajax({
            url: 'STOCK_REQUETE.php', //toujours le même fichier qui est appelée
            type: 'POST',
            data: {
                fonction: 'select', //fonction à executer
                requete: "SELECT NomProd, SUM(Quant) AS Quant FROM detail WHERE DateArchivDet >= '" +
                    document.getElementById("start").value + "' And DateArchivDet <= '" +
                    document.getElementById("end").value + "' GROUP BY NomProd"
            },
            success: function(data) {
                $('#myChart').remove();
                $("#chart").append('<canvas id="myChart" style="width:100%;max-width:700px"> </canvas>');
                var resultats = JSON.parse(data);
                var xValues = [];
                var yValues = [];
                var diagramme = document.getElementById("DiagrammeType").value;
                var barColors = ["#fa0505", "#0e2ddd", "#6bdd0e", "#0eddd3", "#dd950e",
                    "#ddda0e", "#dd0e5d", "#8d038d", "#6d1a1a", "#6567d1"
                ];
                for (let i = 0; i < resultats.length; i++) {
                    xValues.push(resultats[i]['NomProd']);
                    yValues.push(resultats[i]['Quant']);
                }
                new Chart("myChart", {
                    type: diagramme,
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
    }

    function choixTypeDate() {

        let divShown = document.getElementById("Datation").value;
        console.log(divShown);

        let test = document.querySelectorAll(".ChoixDate");
        test.forEach(e => {
            console.log(e);
            e.classList.add("cacher")
        });
        console.log($("#" + divShown));
        $("#" + divShown).removeClass("cacher");
    }

    <?php
        function choixDate($strtotime)
        {
            return date('Y-m-d', strtotime($strtotime));
        }
        ?>
    </script>
    <br><br><br>
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