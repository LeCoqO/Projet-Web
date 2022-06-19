var latDestination;
var lngDestination;
var lat;
var lng;
var map = L.map('map').setView([46, 2.5], 5);

console.log("Connexion...");
//Connexion à l'API
Gp.Services.getConfig({
    apiKey: "s2585d4s59s8u0fqv35j9x7x",
    onSuccess: go
});
//Lorsque l'API est connectée on ajoute la map sur la page
function go() {
    console.log("Connected");
    map = map,
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
}

//récupere la valeur stockée dans le cache d'une checkbox qui défini si on affiche ou pas dans 
//le tableau les commandes déjà livrées
var conditionSelect;
if (localStorage.getItem('cmd_livree') == 'true') {
    conditionSelect = "";
} else {
    conditionSelect = "WHERE EtatLivraison NOT LIKE 'T'";
}
//console.log(conditionSelect);
//récupere les commandes dans la bdd et l'affiche dans un tableau
$.ajax({
    url: 'ajax_Bdd.php', //toujours la même page qui est appelée
    type: 'POST',
    data: {
        fonction: 'requete', //fonction à executer
        requete: 'SELECT * FROM commande ' + conditionSelect,
        //add a where EtatCde LIKE 'fini' (cest l'etat de preparation  du cuisto)
    },
    success: function (data) {
        //console.log("success");
        var resultats = JSON.parse(data);
        var string = '';
        //console.log(resultats);
        string += '<FONT face="arial"><div class="container"><CENTER>' +
            '<div class="table">' +
            "<div class='table-header' bgcolor='grey' align='center'>" +
            "<div class='header__item'> <a id='ncom' class='filter__link' href='#'>Numéro Commande</a></div>" +
            "<div class= 'header__item'> <a id='ncli' class='filter__link' href='#'>Nom Client</a></div >" +
            "<div class='header__item'> <a id='date' class='filter__link' href='#'>TEL</a></div>" +
            "<div class='header__item'> <a id='iti' class='filter__link' href='#'>Adresse</a></div>" +
            "<div class='header__item'> <a id='prix' class='filter__link' href='#'>Prix</a></div>" +
            "<div class='header__item'> <a id='heure' class='filter__link' href='#'>Heure de Livraison</a></div>" +
            "<div class='header__item'> <a id='statut' class='filter__link' href='#'>Statut</a></div>" +
            '</div>' +
            '<div class="table-content">';
        for (let i = 0; i < resultats.length; i++) {
            var stringOption = "<select class='select_Statut select_Statut_N' onChange='selectStatut(this)'>"
                + "<option class='select_Statut_N' value='N'";
            if (resultats[i]['EtatLivraison'] == "N") { stringOption += "selected='selected'"; }
            stringOption += ">Libre</option><option class='select_Statut_E' value='E'";
            if (resultats[i]['EtatLivraison'] == "E") { stringOption += "selected='selected'"; }
            stringOption += ">En cours</option> <option class= 'select_Statut_T' value = 'T'";
            if (resultats[i]['EtatLivraison'] == "T") { stringOption += "selected='selected'"; }
            stringOption += ">Livrée</option></select>";

            string += '<div class="table-row">'
                + "<div class='table-data'>" + resultats[i]['NumCom'] + "</div>"
                + "<div class='table-data'>" + resultats[i]['NomCom'] + "</div>"
                + "<div class='table-data'>" + resultats[i]['TelCom'] + "</div>"
                + "<div class='table-data buttonItineraire'>" + resultats[i]['AdrCom'] + "</div>"
                + "<div class='table-data'>" + resultats[i]['TotalTTC'] + "</div>"
                + "<div class='table-data'>" + resultats[i]['HeureDispo'] + "</div>"
                + "<div class='table-data'>"
                + stringOption
                + "</div></div>";
        }
        string += '</div></CENTER></div></FONT>';
        document.getElementById("tableauCommande").innerHTML = string;
        setupTab(['ncom', 'ncli', 'date', 'iti', 'prix', 'statut']);
        setupAdresseCalulItineraire();


    },
    error: function (dataSQL, statut) {
        alert("error sqlConnect.js : " + dataSQL.erreur);
    }
});



//Cette fontion convertie une adresse en latitude et longitude
function convertAdressToLatLng(address) {
    return new Promise((resolve, reject) => {
        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + address, function (data) {
            latDestination = data[0].boundingbox[0];
            lngDestination = data[0].boundingbox[2];
        });

        setTimeout(() => {
            console.log("Address found!");
            resolve();

        }, 5000
        );
    });
}


const view = new ol.View({
    center: [46, 3.5],
    zoom: 4,
});

//--------------------------------------------------------
//Cette fonction ajoute la fonctionnalité clicable des Adresse pour calculer itinéraire
function setupAdresseCalulItineraire() {
    document.querySelectorAll('.buttonItineraire').forEach(item =>
        item.addEventListener('click', async e => {
            //supprime l'ancien itinéraire s'il existe
            if (document.getElementsByClassName("leaflet-control").length > 0) {
                document.getElementsByClassName("leaflet-control")[0].remove();
                let boxes = document.querySelectorAll(".leaflet-interactive");
                boxes.forEach(box => {
                    box.remove();
                });
                let shadows = document.querySelectorAll(".leaflet-marker-shadow");
                shadows.forEach(shadow => {
                    shadow.remove();
                });
                if (document.getElementsByClassName("ready")[0]) {
                    document.getElementsByClassName("ready")[0].classList.remove("ready");
                }
            }
            if (document.getElementsByClassName("cmd-selected").length > 0) {
                document.getElementsByClassName("cmd-selected")[0].classList.remove("cmd-selected");
            }
            e.target.parentElement.classList.add("notReady");
            console.log("e.target.parent(): ", e.target.parentElement);

            //Géolocalise l'utilisateur
            document.getElementById("infoItinéraire").innerHTML = "Localisation en cours...";
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;
                });

            } else {
                alert("Désolé, votre moteur de recherche ne supporte pas la géolocalisation HTML5.");
            }

            await convertAdressToLatLng(item.innerHTML);
            e.target.parentElement.classList.remove("notReady");
            e.target.parentElement.classList.add("ready");
            console.log("latDest: " + latDestination);
            console.log("lngDest: " + lngDestination);
            console.log("lat: " + lat);
            console.log("lng: " + lng);
            document.getElementById("infoItinéraire").innerHTML = "Localisation terminée !";

            document.getElementById("infoItinéraire").innerHTML = "Calcul de l'itinéraire en cours...";
            var routes = L.Routing.control({    // add a  route
                waypoints: [
                    L.latLng(lat, lng),
                    L.latLng(latDestination, lngDestination)
                ],
                routeWhileDragging: true
            });
            routes.addTo(map)
            document.getElementById("infoItinéraire").innerHTML = "Itinéraire défini !";

        })
    );
}

//Si l'id du livreur n'est pas dans le cache, on définit un lireur par défault
if (!localStorage.getItem("livreurConnected")) {
    localStorage.setItem("livreurConnected", 1);
    // console.log("Id livreur", localStorage.getItem("livreurConnected"));
}
//On récupère la liste des livreurs dans la bdd 
//et on la resort sous forme de liste déroulante qui onChange change le livreur connecté 
$.ajax({
    url: 'ajax_Bdd.php', //toujours la même page qui est appelée
    type: 'POST',
    data: {
        fonction: 'requete', //fonction à executer
        requete: 'SELECT * FROM livreur'
    },
    success: function (data) {
        //console.log("success");
        //console.log(data);
        var resultats = JSON.parse(data);
        //console.log(resultats[0]['IdLiv']);

        var string = "<select id='selectLivreur' onChange='setIdLivreur()' class='button right select_livreur'>";
        for (let e = 0; e < resultats.length; e++) {
            string += "<option value='" + resultats[e]['IdLiv'] + "'";
            if (localStorage.getItem("livreurConnected") == resultats[e]['IdLiv']) string += "selected='selected'";
            string += ">" + resultats[e]['PrenomLiv'] + " / " + resultats[e]['IdLiv'] + "</option>";
        }
        string += "</select>";

        document.getElementById("select_Livreur").innerHTML = string;
        //setupTab(['ncom', 'ncli', 'date', 'iti', 'prix', 'statut']);

    },
    error: function (dataSQL, statut) {
        alert("error sqlConnect.js : " + dataSQL.erreur);
    }
});

