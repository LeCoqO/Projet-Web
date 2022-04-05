const view = new ol.View({
    center: [0, 0],
    zoom: 2,
});


console.log("Connexion...");
Gp.Services.getConfig({
    apiKey: "s2585d4s59s8u0fqv35j9x7x",
    onSuccess: go
});
function go() {
    console.log("Connected");

    var map = new ol.Map({
        layers: [
            new ol.layer.GeoportalWMTS({
                layer: "GEOGRAPHICALGRIDSYSTEMS.MAPS",
            })
        ],
        target: 'map',
        view: view,
    });
    var routeControl = new L.geoportalControl.Route({ //http://ignf.github.io/geoportal-extensions/ol-latest/jsdoc/ol.control.Route.html
        collapsed: true,
        draggable: true
    });
    map.addControl(routeControl);
}
/** L.Routing.control({
  waypoints: [
    L.latLng(57.74, 11.94),
    L.latLng(57.6792, 11.949)
  ]
}).addTo(map);*/

const geolocation = new ol.Geolocation({            //https://openlayers.org/en/latest/examples/geolocation.html
    // enableHighAccuracy must be set to true to have the heading value.
    trackingOptions: {
        enableHighAccuracy: true,
    },
    projection: view.getProjection(),
});
el('track').addEventListener('change', function () {
    geolocation.setTracking(this.checked);
    console.log(positionFeature);
    console.log(accuracyFeature);
});

geolocation.on('change', function () {
    el('accuracy').innerText = geolocation.getAccuracy() + ' [m]';
    el('altitude').innerText = geolocation.getAltitude() + ' [m]';
    el('altitudeAccuracy').innerText = geolocation.getAltitudeAccuracy() + ' [m]';
    el('heading').innerText = geolocation.getHeading() + ' [rad]';
    el('speed').innerText = geolocation.getSpeed() + ' [m/s]';
});

geolocation.on('error', function (error) {
    const info = document.getElementById('info');
    info.innerHTML = error.message;
    info.style.display = '';
});
const accuracyFeature = new ol.Feature();
geolocation.on('change:accuracyGeometry', function () {
    accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
});

const positionFeature = new ol.Feature();
positionFeature.setStyle(
    new ol.style.Style({
        image: new ol.style.Circle({
            radius: 6,
            fill: new ol.style.Fill({
                color: '#3399CC',
            }),
            stroke: new ol.style.Stroke({
                color: '#fff',
                width: 2,
            }),
        }),
    })
);
geolocation.on('change:position', function () {
    const coordinates = geolocation.getPosition();
    positionFeature.setGeometry(coordinates ? new ol.geom.Point(coordinates) : null);
});



//--------------------------------------------------------
function afficherItineraire(aButton) {
    //var map = document.getElementById("map");
    if (document.getElementsByClassName("cmd-selected").length > 0) {
        document.getElementsByClassName("cmd-selected")[0].classList.remove("cmd-selected");
    }
    aButton.classList.add("cmd-selected");

    initMap();
}

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