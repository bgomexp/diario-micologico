"use strict";

//Validación en el momento de submit
document.querySelector("#btnGuardar").addEventListener("click", e => {    
    let errores = false;
    let erroresEspecies= false;

    //Evitamos el submit
    e.preventDefault()

    //Tomamos los datos que hay que validar
    let fecha = document.querySelector("#flatpickr-date").value.trim();
    let especies = document.querySelectorAll('select[name$="[especie]"]');
    let cantidades = document.querySelectorAll('input[name$="[cantidad]"]');
    
    //Validamos la fecha (solo que esté, ya que la validez se comprueba mejor en el servidor)
    if (fecha=="") {
        document.querySelector("#fechaErrors").innerText = "La fecha es obligatoria";
        campoInvalido(document.querySelector("#flatpickr-date"));
        errores = true;
    }else{
        document.querySelector("#fechaErrors").innerText = "";
        campoValido(document.querySelector("#flatpickr-date"));
    }

    //Validamos las especies y cantidades (solo que estén rellenas)
    especies.forEach(campo => {
        if (campo.value == "") {
            erroresEspecies = true;
        }
    });
    cantidades.forEach(campo => {
        if (campo.value == "") {
            erroresEspecies = true;
        }
    });
    if (erroresEspecies) {
        document.querySelector("#especiesErrors").innerText = "Deben indicarse una especie y una cantidad en todos los registros";
    }

    //Si no hay errores, enviamos el formulario al servidor
    if (!errores && !erroresEspecies) {
        document.querySelector("#formEntrada").submit();
    }
});

function campoInvalido(campo) {
    campo.classList.remove("border-brown-800", "border-dashed");
    campo.classList.add("border-amber-600", "border-solid");
}

function campoValido(campo) {
    campo.classList.remove("border-amber-600", "border-solid");
    campo.classList.add("border-brown-800", "border-dashed");
}