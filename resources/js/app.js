"use strict";

import "flyonui/flyonui"
//import flatpickr from "flatpickr"
//import { Spanish } from "flatpickr/dist/l10n/es.js"

//Página de creación de entradas
if (window.location.href.endsWith("entradas/crear")) {
  
  //Contador para las filas
  let contador = 1;
  
  //*
  // Para añadir una nuevo ejemplar
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
}

