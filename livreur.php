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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
        <div class="clear"></div>
        <a href="index.php" class="bar-item button">Accueil</a><br>
        <a href="#" class="bar-item button">Livreur</a><br>
        <a href="recette.php" class="bar-item button">Recette</a><br>
        <a href="mentionLegale.html" class="bar-item button">Mention légale</a><br>
    </div>
    <button class="button_sidebar button left" onclick="sidebar_open()">&#9776;</button>

    <div id="select_Livreur" value='1'></div>

    <h1 class="text-center ">
        <img src="./img/logo.png" class="logo" alt="Hom'burger logo" />
    </h1>
</header>

<body>

    <div id="tableauCommande"></div>

    <div class="text-center inputGroup">
        <input type="checkbox" id="cmd_livree" name="cmd_livree" />
        <label for="cmd_livree">Commande Livrée</label>
    </div>


    <div id="zoneMap">
        <div id="map" class="map"></div>
    </div>

    <br><br><br>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item2">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item2">
                        <h3>About</h3>
                        <ul>
                            <li><a href="mentionLegale.html">Company</a></li>
                            <li><a href="mentionLegale.html">Team</a></li>
                            <li><a href="mentionLegale.html">Careers</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 item2 text">
                        <h3>Homburger</h3>
                        <p>Le French burger (burger à la française), à l’antipode du burger mexicain, est le produit phare de la marque ;
                            l’idée de combiner la cuisine rapide et traditionnelle française en apportant la french touch unique aux
                            recettes : l’unique sauce Moustache Hom'burger ravis les nombreux clients de la marque.<br /><br />
                        </p>
                    </div>
                    <div class="col item2 social">
                        <a href="https://twitter.com/hom_burger"><i class="icon ion-social-twitter"></i> </a>
                        <a href="https://www.instagram.com/_hom_burger_/?hl=fr"><i class="icon ion-social-instagram"></i></a>
                    </div>
                </div>
                <p class="copyright">Company Name © 2018</p>
            </div>
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
            url: 'ajax_Bdd.php', //toujours la même page qui est appelée
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