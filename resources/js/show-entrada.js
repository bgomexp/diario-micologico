"use strict";

const confirmDialog =  document.querySelector("#confirmDialog");

//Botón eliminar
document.querySelector("#btnEliminar").addEventListener("click", function(){
  confirmDialog.showModal();
});

//Botón cancelar eliminar
document.querySelector("#btnCancelarEliminar").addEventListener("click", function(){
  confirmDialog.close();
});