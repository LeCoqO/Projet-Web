



var latDestination;
var lngDestination;
var lat;
var lng;
var map = L.map('map').setView([46, 2.5], 5);

console.log("Connexion...");
Gp.Services.getConfig({
    apiKey: "s2585d4s59s8u0fqv35j9x7x",
    onSuccess: go
});
function go() {
    console.log("Connected");
    map = map,
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
}

var conditionSelect;
if (localStorage.getItem('cmd_livree') == 'true') {
    conditionSelect = "";
} else {
    conditionSelect = "WHERE EtatLivraison NOT LIKE 'T'";
}
//console.log(conditionSelect);

$.ajax({
    url: 'ajax_Bdd.php', //toujours la même page qui est appelée
    type: 'POST',
    data: {
        fonction: 'selectBdd', //fonction à executer
        base: 'physique',
        table: 'commande',
        selectCondition: '*',
        whereValue: conditionSelect
        //add a where EtatCde LIKE 'fini' (cest l'etat de preparation  du cuisto)
    },
    success: function (data) {
        //console.log("success");
        //console.log(data);
        document.getElementById("tableauCommande").innerHTML = data;
        setupTab(['ncom', 'ncli', 'date', 'iti', 'prix', 'statut']);
        setupAdresseCalulItineraire();
    },
    error: function (dataSQL, statut) {
        alert("error sqlConnect.js : " + dataSQL.erreur);
    }
});




function convertAdressToLatLng(address) {
    return new Promise((resolve, reject) => {
        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + address, function (data) {
            latDestination = data[0].boundingbox[0];
            lngDestination = data[0].boundingbox[2];
        });

        setTimeout(() => {
            console.log("Adress found!");
            resolve();
            ;
        }, 5000
        );
    });
}


const view = new ol.View({
    center: [46, 3.5],
    zoom: 4,
});

/*
const geolocation = new ol.Geolocation({            //https://openlayers.org/en/latest/examples/geolocation.html
    // enableHighAccuracy must be set to true to have the heading value.
    trackingOptions: {
        enableHighAccuracy: true,
    },
    projection: view.getProjection(),
});

geolocation.on('change:position', function () {
    const coordinates = geolocation.getPosition();
    positionFeature.setGeometry(coordinates ? new ol.geom.Point(coordinates) : null);
});
*/
//--------------------------------------------------------

function setupAdresseCalulItineraire() {
    // ADD Adresse clickable pour calculer itinéraire
    document.querySelectorAll('.buttonItineraire').forEach(item =>
        item.addEventListener('click', async e => {

            if (document.getElementsByClassName("cmd-selected").length > 0) {
                document.getElementsByClassName("cmd-selected")[0].classList.remove("cmd-selected");
            }
            e.target.style.backgroundColor = "red";


            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;
                })
            } else {
                alert("Sorry, your browser does not support HTML5 geolocation.");
            }

            await convertAdressToLatLng(item.innerHTML);
            e.target.style.backgroundColor = "green";
            console.log("latDest: " + latDestination);
            console.log("lngDest: " + lngDestination);
            console.log("lat: " + lat);
            console.log("lng: " + lng);
            // not working supposed to delete the route if exist
            if (L.Routing.waypoints) {
                L.Routing.spliceWaypoints(0, 2); // <-- removes your route
            }
            if (routes != null) {
                map.removeControl(routes);
                L.Routing.control({ createMarker: function () { return null; } });
                routes = null;
            }
            var routes = L.Routing.control({    // add a  route
                waypoints: [
                    L.latLng(lat, lng),
                    L.latLng(latDestination, lngDestination)
                ],
                routeWhileDragging: true
            });
            routes.addTo(map)
            /*var obj = document.getElementById("zoneMap");
            var old = document.getElementById("map");
            obj.removeChild(old);
            document.getElementById('zoneMap').innerHTML = "<div id='map' class='map'></div>";
            Gp.Services.getConfig({
                apiKey: "s2585d4s59s8u0fqv35j9x7x",
                onSuccess: reload()
            });*/

        })
    );
}

//selectIdLivreur();
if (!localStorage.getItem("livreurConnected")) {
    localStorage.setItem("livreurConnected", 1);
    // console.log("Id livreur", localStorage.getItem("livreurConnected"));
}
$.ajax({
    url: 'ajax_Bdd.php', //toujours la même page qui est appelée
    type: 'POST',
    data: {
        fonction: 'selectLivreur', //fonction à executer
        base: 'physique',
        table: 'livreur',
        selectCondition: '*',
        IdLivreur: localStorage.getItem("livreurConnected")

    },
    success: function (data) {
        //console.log("success");
        //console.log(data);
        document.getElementById("select_Livreur").innerHTML = data;
        //setupTab(['ncom', 'ncli', 'date', 'iti', 'prix', 'statut']);

    },
    error: function (dataSQL, statut) {
        alert("error sqlConnect.js : " + dataSQL.erreur);
    }
});




//conditionAffichageLivree();

function conditionAffichageLivree() {
    if (!localStorage.getItem("cmd_livree")) {
        localStorage.setItem("cmd_livree", false);
        // console.log("Id livreur", localStorage.getItem("cmd_livree"));
    } else {
        localStorage.setItem("livreurConnected", document.getElementById("cmd_livree").value);
        // console.log("Id livreur connected", localStorage.getItem("livreurConnected"));
    };


    let conditionSelect;
    console.log($('cmd_livree'));
    if ($('cmd_livree').is(":checked")) {
        conditionSelect = "";

    } else {
        conditionSelect = "WHERE EtatLivraison NOT LIKE 'T'";
    }

};

