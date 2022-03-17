<!doctype html>
<html lang="fr">

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--
    <--IMPORT OpenLayers-->
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
    <script src="https://cdn.polyfill.io/v3/polyfill.min.js?features=fetch,requestAnimationFrame,Element.prototype.classList,TextDecoder"></script>

    <script src="https://unpkg.com/esri-leaflet@3.0.4/dist/esri-leaflet.js" integrity="sha512-oUArlxr7VpoY7f/dd3ZdUL7FGOvS79nXVVQhxlg6ij4Fhdc4QID43LUFRs7abwHNJ0EYWijiN5LP2ZRR2PY4hQ==" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js" integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w==" crossorigin=""></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="style.css">

    <script>
        
    </script>
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
        <div class="clear"></div>
        <a href="recette.php" class="bar-item button">Recette</a><br>
        <a href="#" class="bar-item button">Link 2</a><br>
        <a href="#" class="bar-item button">Link 3</a>
    </div>
    <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center ">
        <img src="./img/logo.png" class="logo" alt="" />
    </h1>
</header>

<body>
    <div id="tableauCommande"></div>
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

    .select_Statut_Libre {
        background: rgba(42, 41, 39, 0);
    }

    .select_Statut_En_Cours {
        background: rgb(228, 147, 26);
    }

    .select_Statut_Livree {
        background: cyan;
    }
</style>

<script>
   
function sidebar_open() {
    document.getElementById("mySidebar").style.display = "block";
}

function sidebar_close() {
    document.getElementById("mySidebar").style.display = "none";
}

function selectStatut(e) {
    //value du select
    let statut = e.value;
    //changement de la couleur
    e.className = "select_Statut select_Statut_" + statut;
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
            base: 'clicom',
            table: 'commande',
            condition: 'NCOM LIKE ' + ncom, //where condition
            champ: 'NCLI', // SET [nom du champ]   /Statut
            data: 'C400' //data statut
        },
        success: function(data) {
            refresh();
        },
        error: function(dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}
</script>


<script type="module" src="./script_livreur.js"></script>

</html>