"use strict";

import "flyonui/flyonui"
//import flatpickr from "flatpickr"
//import { Spanish } from "flatpickr/dist/l10n/es.js"


//Contador para las filas. Se inicializa a partir del índice del último elemento
document.querySelectorAll
let contador = obtenerUltimoIndice() + 1;

//*
// Para añadir un nuevo ejemplar
// */
document.querySelector("#btnAnadirEjemplar").addEventListener("click", e => {
    const template = document.getElementById('fila-template').innerHTML;
    // Reemplazamos el marcador del índice por el número correspondiente
    const htmlConIndice = template.replaceAll('__REEMPLAZAR__', contador);
    // Convertimos la cadena en nodo
    const div = document.createElement('div');
    div.innerHTML = htmlConIndice;
    const nuevaFila = div.firstElementChild;
    // Agregamos la fila al contenedor
    document.getElementById('divEjemplares').appendChild(nuevaFila);
    // Inicializamos el select
    window.HSStaticMethods.autoInit(["select"]);
    //Aumentamos el contador
    contador++;
});

document.getElementById('divEjemplares').addEventListener('click', function (event) {
    if (event.target && event.target.textContent === 'Eliminar') {
        // Buscamos el div de fila más cercano y lo eliminamos
        const fila = event.target.closest('.fila');
        if (fila) {
            fila.remove();
        }
    }
});

//*
// Método para calcular el índice de seta más alto de la página para inicializar el contador y evitar la duplicidad
// */
function obtenerUltimoIndice() {
    let indiceMayor = -1;
    //Recorremos los selects
    document.querySelectorAll('#divEjemplares select[name^="setas["]').forEach(select => {
        //Parseamos el name del select con una expresión regular
        const match = select.name.match(/^setas\[(\d+)\]/);
        if (match) {
            //Tomamos el índice
            const index = parseInt(match[1]);
            //Comprobamos si es el más alto de momento
            if (index > indiceMayor) indiceMayor = index;
        }
    });
    return indiceMayor;
}

/**** COSAS DE FLATPICKR ****/
window.addEventListener('load', function () {
    // Basic
    flatpickr('#flatpickr-date', {
        monthSelectorType: 'static',
        maxDate: "today",
        dateFormat: "d-m-Y"
    })
});
flatpickr.localize(flatpickr.l10ns.es);
flatpickr("#flatpickr-date");