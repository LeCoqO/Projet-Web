<!DOCTYPE html">
<html lang="fr">

<head>
    <title>Statistique</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="author" content="PAGE Lilian" />
    <meta name="description" content="Statistique" />
    <script src="scriptCommun.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>

<body>
    <header>
        <div class="sidebar" id="mySidebar">
            <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
            <a href="commande.php" class="bar-item button">Commande</a><br>
            <a href="recette.php" class="bar-item button">Link 2</a><br>
            <a href="#" class="bar-item button">Link 3</a>
        </div>
        <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
        <div class="right logo">
            <img src="./img/logo.png" class="text-center" alt="" width="100px" height="100px" />
        </div>
        <div>
            <br><br><br><br><br>
            <h1 id="TitreDuSite" class="gras text-center">Statistiques</h1>
        </div>

    </header>
    <fieldset class="left">
        <legend>
            <h2>Configuration :</h2>
        </legend>
        <form action="./traitInfo.php" method="post">
            <div>
                <label for="DateDebut" class="cat">Date de début:</label>
                <br>
                <input type="date" id="start" name="DateDebut" min="2022-01-01"
                    value="<?php echo choixDate("-2 month"); ?>" max="<?php echo choixDate("-1 days"); ?>">
            </div>
            <div>
                <label for="DateFin">Date de fin:</label>
                <br>
                <input type="date" id="end" name="DateFin" value="<?php echo choixDate("+0 days"); ?>" min="2022-01-02"
                    max="<?php echo choixDate("+0 days"); ?>">
                <br>
            </div>
            <div>
                <label for="Choi categorie" class="cat">Categorie:</label>
                <br>
                <select id="langage" size=1 name="prog">
                    <option>C</option>
                    <option>C++</option>
                    <option selected>Java</option>
                    <option>Python</option>
                    <option>PHP</option>
                </select>
                <br><br>
            </div>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </fieldset>
    <div id="chartContainer" class="right">

    </div>
    <script type="text/javascript">
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            title: {
                text: "Statistique de vente"
            },
            data: [{
                type: "pie",
                showInLegend: false,
                toolTipContent: "{y} - #percent %",
                legendText: "{indexLabel}",
                dataPoints: [{
                        y: 236,
                        indexLabel: "L'original"
                    },
                    {
                        y: 132,
                        indexLabel: "Poulet"
                    },
                    {
                        y: 41,
                        indexLabel: "Crosti patate"
                    },
                    {
                        y: 20,
                        indexLabel: "Kentuki"
                    },
                    {
                        y: 25,
                        indexLabel: "Steak frite"
                    },
                    {
                        y: 12,
                        indexLabel: "Vegatarien"
                    }
                ]
            }]
        });
        chart.render();
    }
    <?php
        function choixDate($strtotime)
        {
            return date('Y-m-d', strtotime($strtotime));
        }
        ?>
    </script>
</body>

</html>