<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--IMPORT OpenLayers-->
    <link rel="stylesheet" href="\projectPHP\Projet WEB\libs\v6.12.0-dist\ol.css" type="text/css">
    <script src="\projectPHP\Projet WEB\libs\v6.12.0-dist\ol.js"></script>
    <!--IMPORT GpPluginOpenLayers-->
    <link rel="stylesheet" href="\projectPHP\Projet WEB\libs\GpPluginOpenLayers-3.2.7\GpPluginOpenLayers.css" type="text/css">
    <script src="\projectPHP\Projet WEB\libs\GpPluginOpenLayers-3.2.7\GpPluginOpenLayers.js"></script>
    <!--IMPORT geoportail Leaflet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <title>Livreur - Hom'burger</title>

    <link rel="stylesheet" href="style.css">
    <script src="scriptCommun.js"></script>

</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
        <div class="clear"></div>
        <a href="recette.php" class="bar-item button">Recette</a><br>
        <a href="#" class="bar-item button">Link 2</a><br>
        <a href="#" class="bar-item button">Link 3</a>
    </div>
    <button class="button left" onclick="sidebar_open()">&#9776;</button>

    <div id="select_Livreur" value='1'></div>

    <h1 class="text-center ">
        <img src="./img/logo.png" class="logo" alt="Hom'burger logo" />
    </h1>
</header>

<body>

    <div id="tableauCommande"></div>
    <div class="text-center">
        <p>
            <input type="checkbox" id="cmd_livree"/>
            <label>Commande Livrée</label>
        </p>
    </div>

    <div id="zoneMap">
        <div id="map" class="map"></div>
    </div>

    <a href="commande.php">Commande</a>
</body>

<!---style a ajouter au .css-->
<style>
    .select_Statut {
        width: 100%;
        height: 100%;
        outline: none;
    }

    .select_Statut_N {
        background: rgba(42, 41, 39, 0);
    }

    .select_Statut_E {
        background: rgb(228, 147, 26);
    }

    .select_Statut_T {
        background: cyan;
    }
</style>

<script>
    function selectStatut(e) {
        //value du select
        let statut = e.value;
        console.log(statut);

        //changement de la couleur
        e.className = "select_Statut select_Statut_" + statut;
        let IdLivreur = localStorage.getItem("livreurConnected");
        //div contenant le select
        let parentNode = e.parentNode
        //div(row du tableau qui contient la div contenant le select)
        let row = parentNode.parentNode
        //premiere div contenue dans la row soit le ncom
        let ncom = row.firstChild.innerHTML;
        // update statut de la commande dans bdd
        console.log(ncom);
        $.ajax({
            url: 'ajax_Bdd.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'updateBdd', //fonction à executer
                base: 'physique',
                table: 'commande',
                condition: 'NumCom LIKE ' + ncom, //where condition
                set: 'EtatLivraison = "' + statut + '", IdLivreur = "' + IdLivreur + '"',
            },
            success: function(data) {
                location.reload();
            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
    }


    //checkbox afficher commande déjà livrée ou non
    $(document).ready(function() {
        //console.log(localStorage.getItem('cmd_livree'));
        if (localStorage.getItem('cmd_livree') == 'true') {
            $("#cmd_livree").prop('checked', true);
        } else {
            $("#cmd_livree").prop('checked', false);
        }
    });
    $("#cmd_livree").click(function() {
        if ($(this).prop("checked")) {
            localStorage.setItem(this.id, true);
        } else {
            localStorage.setItem(this.id, false);
        }
        location.reload();

    });
    /*
        function setLocalValue(e) {
            console.log($('cmd_livree'));
            if ($('cmd_livree').is(":checked")) {
                localStorage.setItem(e.id, true);
            } else {
                localStorage.setItem($('cmd_livree').id, false);
            }
        }*/
    function setIdLivreur() {
        localStorage.setItem("livreurConnected", document.getElementById("selectLivreur").value);
        // console.log("Id livreur connected", localStorage.getItem("livreurConnected"));
    };
</script>

<script type="module" src="./script_livreur.js"></script>

</html>