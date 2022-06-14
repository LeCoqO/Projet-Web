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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <!--Fullscreen map-->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
</head>

<br><br><br>
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
    <div id="select_Livreur" value='1'></div>

</header>

<br>
<br>
<br>

<body>
    <br>
    <div id="tableauCommande"></div>


    <div class="text-center inputGroup">
        <input type="checkbox" id="cmd_livree" name="cmd_livree" />
        <label for="cmd_livree">Commande Livrée</label>

    </div>

    <div id="infoItinéraire"></div>
    <div id="zoneMap">
        <div id="map" class="map"></div>
    </div>

    <br><br><br>
    <div class="footer-basic">
        <footer>
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
    </div>
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
    //Cette fonction modifie le statut (EtatLivraison) et le livreur de la commande où l'on
    //modifie la valeur de celle ci dans la liste déroulante
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
            url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'update', //fonction à executer
                requete: 'UPDATE commande SET EtatLivraison = "' + statut + '", IdLiv = "' + IdLivreur + '" WHERE NumCom LIKE ' + ncom,
            },
            success: function(data) {
                location.reload();
            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
    }


    //checkbox qui afficher les commandes déjà livrées ou non
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
</script>

<script type="module" src="./script_livreur.js"></script>

</html>