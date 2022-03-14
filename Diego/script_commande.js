var latDestination;
var lngDestination;
var lat;
var lng;
var map = L.map('map').setView([46, 2.5], 5);

function convertAdressToLatLng(address){
    return new Promise((resolve,reject)=>{
        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + address, function (data) {
            latDestination = data[0].boundingbox[0];
            lngDestination = data[0].boundingbox[2];
        });

        setTimeout(()=>{
            console.log("Adress found!");
            resolve();
        ;} , 5000
        );
    });
}
document.querySelectorAll('.buttonItineraire').forEach(item =>
    item.addEventListener('click', async e => {

        if (document.getElementsByClassName("cmd-selected").length > 0) {
            document.getElementsByClassName("cmd-selected")[0].classList.remove("cmd-selected");
        }
        e.target.style.backgroundColor="red";


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
            })
        } else {
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }

        await convertAdressToLatLng(item.innerHTML);
        e.target.style.backgroundColor="green";
        console.log("latDest: "+latDestination);
        console.log("lngDest: "+lngDestination);
        console.log("lat: "+lat);
        console.log("lng: "+lng);
        // not working supposed to delete the route if exist
        if (L.Routing.waypoints) {
            L.Routing.spliceWaypoints(0, 2); // <-- removes your route
        }
        if (routes != null) {
            map.removeControl(routes);
            L.Routing.control({ createMarker: function() { return null; } });
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

const view = new ol.View({
    center: [46, 3.5],
    zoom: 4,
});
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


function el(id) {
    return document.getElementById(id);
}

/*    JS TABLE        */
var properties = [
    'ncom',
    'ncli',
    'date',
    'iti'
];
$.each(properties, function (i, val) {
    var orderClass = '';
    $("#" + val).click(function (e) {
        e.preventDefault();
        $('.filter__link.filter__link--active').not(this).removeClass('filter__link--active');
        $(this).toggleClass('filter__link--active');
        $('.filter__link').removeClass('asc desc');

        if (orderClass == 'desc' || orderClass == '') {
            $(this).addClass('asc');
            orderClass = 'asc';
        } else {
            $(this).addClass('desc');
            orderClass = 'desc';
        }
        var parent = $(this).closest('.header__item');
        var index = $(".header__item").index(parent);
        var $table = $('.table-content');
        var rows = $table.find('.table-row').get();
        var isSelected = $(this).hasClass('filter__link--active');
        var isNumber = $(this).hasClass('filter__link--number');
        rows.sort(function (a, b) {
            var x = $(a).find('.table-data').eq(index).text();
            var y = $(b).find('.table-data').eq(index).text();
            if (isNumber == true) {
                if (isSelected) {
                    return x - y;
                } else {
                    return y - x;
                }
            } else {
                if (isSelected) {
                    if (x < y) return -1;
                    if (x > y) return 1;
                    return 0;
                } else {
                    if (x > y) return -1;
                    if (x < y) return 1;
                    return 0;
                }
            }
        });
        $.each(rows, function (index, row) {
            $table.append(row);
        });
        return false;
    });
});