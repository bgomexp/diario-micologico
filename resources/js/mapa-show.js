"use strict";

//Coordenadas iniciales de la ventana del mapa
const initialLat = document.querySelector("#map").dataset.lat;
const initialLng = document.querySelector("#map").dataset.lng;
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

//Agregamos el marcador
marker = L.marker([initialLat, initialLng], { icon: customIcon }).addTo(map);