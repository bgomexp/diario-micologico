"use strict";

//***********************
// SELECCIÓN DE COORDENADAS EN EL MAPA
// *********************/

//Coordenadas iniciales de la ventana del mapa
const initialLat = 37.348233107188335;
const initialLng = -5.843708844167294;
let map = L.map('map').setView([initialLat, initialLng], 13);
let marker;
let customIcon = L.icon({
    iconUrl: '/images/marker-logo.png', 
    iconSize: [30, 40],                 
    iconAnchor: [15, 40],               
    popupAnchor: [0, -40]               
});

//Capa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

//Agregamos el control de geocodificación
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
        var center = e.geocode.center;
        map.setView(center, 14);

        if (marker) {
            marker.setLatLng(center);
        } else {
            marker = L.marker(center, { icon: customIcon }).addTo(map);
        }
        //Rellenamos los inputs ocultos
        document.getElementById('lat').value = center.lat;
        document.getElementById('lng').value = center.lng;
    })
    .addTo(map);

//Clics en el mapa
map.on('click', function(e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;

    //Colocamos el marcador
    if (marker) {
        marker.setLatLng([lat, lng]);
    } else {
        marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);
    }

    //Rellenamos los inputs ocultos
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;
});

//***********************
// UBICACIÓN ACTUAL
// *********************/

document.querySelector("#btnUbiActual").addEventListener("click", e => {
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(locationSuccess, locationError);
    } else {
    x.innerHTML = "Lo sentimos, la geolocalización no es compatible con este navegador.";
    }
});

function locationSuccess(position) {
    //Cambiamos la vista del mapa
    map.setView([position.coords.latitude, position.coords.longitude], 13);
    //Ponemos el puntero
    if (marker) {
        marker.setLatLng([position.coords.latitude, position.coords.longitude]);
    } else {
        marker = L.marker([position.coords.latitude, position.coords.longitude], { icon: customIcon }).addTo(map);
    }
    //Rellenamos los inputs ocultos
    document.getElementById('lat').value = position.coords.latitude;
    document.getElementById('lng').value = position.coords.longitude;
}

function locationError() {
  console.log("Lo sentimos, la ubicación no está disponible.");
}

//***********************
// BORRAR UBICACIÓN
// *********************/

document.querySelector("#btnResetUbi").addEventListener("click", e => {
    map.setView([initialLat, initialLng], 13);
    //Quitamos el puntero
    if (marker) {
       marker.remove();
       marker = null;
    }
    //Vaciamos los inputs ocultos
    document.getElementById('lat').removeAttribute("value");
    document.getElementById('lng').removeAttribute("value");
});