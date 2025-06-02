"use strict";

//Validación en el momento de submit
document.querySelector("#btnGuardar").addEventListener("click", e => {    
    let errores = false;

    //Evitamos el submit
    e.preventDefault()

    //Tomamos los datos que hay que validar
    let genero = document.querySelector("#genero").value.trim();
    let especie = document.querySelector("#especie").value.trim();
    let nombreComun = document.querySelector("#nombre_comun").value.trim();
    
    //Validamos el genero
    if (genero=="") {
        document.querySelector("#generoErrors").innerText = "El género es obligatorio";
        campoInvalido(document.querySelector("#genero"));
        errores = true;
    }else if(genero.length > 50) {
        document.querySelector("#generoErrors").innerText = "El género no puede superar los 50 caracteres";
        campoInvalido(document.querySelector("#genero"));
        errores = true;
    }else if(!/^[A-Za-zÁÉÍÓÚáéíóúÑñüÜ\s]+$/.test(genero)) {
        document.querySelector("#generoErrors").innerText = "El género solo puede contener letras y espacios";
        campoInvalido(document.querySelector("#genero"));
        errores = true;
    }else{
        document.querySelector("#generoErrors").innerText = "";
        campoValido(document.querySelector("#genero"));
    }

    //Validamos la especie
    if (especie=="") {
        document.querySelector("#especieErrors").innerText = "La especie es obligatoria";
        campoInvalido(document.querySelector("#especie"));
        errores = true;
    }else if(especie.length > 50) {
        document.querySelector("#especieErrors").innerText = "La especie no puede superar los 50 caracteres";
        campoInvalido(document.querySelector("#especie"));
        errores = true;
    }else if(!/^[A-ZÑÁÉÍÓÚ]\. [a-zñáéíóúü]+$/.test(especie)) {
        document.querySelector("#especieErrors").innerText = "La especie debe tener el formato correcto (p. ej.: A. muscaria)";
        campoInvalido(document.querySelector("#especie"));
        errores = true;
    }else{
        document.querySelector("#especieErrors").innerText = "";
        campoValido(document.querySelector("#especie"));
    }

    //Validamos el nombre común
    if(nombreComun.length > 100) {
        document.querySelector("#nombreComunErrors").innerText = "El nombre común no puede superar los 100 caracteres";
        campoInvalido(document.querySelector("#nombre_comun"));
        errores = true;
    }else if((nombreComun!="") && (!/^[A-Za-zÁÉÍÓÚáéíóúÑñüÜ\s]+$/.test(nombreComun))) {
        document.querySelector("#nombreComunErrors").innerText = "El nombre común solo puede contener letras y espacios";
        campoInvalido(document.querySelector("#nombre_comun"));
        errores = true;
    }else{
        document.querySelector("#nombreComunErrors").innerText = "";
        campoValido(document.querySelector("#nombre_comun"));
    }

    //Si no hay errores, enviamos el formulario al servidor
    if (!errores) {
        document.querySelector("#formEspecie").submit();
    }
});

//Validación del género cuando se sale del campo
document.querySelector("#genero").addEventListener("blur", e => {
    //Tomamos el dato
    let genero = document.querySelector("#genero").value.trim();
    //Validamos
    if(genero.length > 50) {
        document.querySelector("#generoErrors").innerText = "El género no puede superar los 50 caracteres";
        campoInvalido(document.querySelector("#genero"));
        errores = true;
    }else if((genero!="") && (!/^[A-Za-zÁÉÍÓÚáéíóúÑñüÜ\s]+$/.test(genero))) {
        document.querySelector("#generoErrors").innerText = "El género solo puede contener letras y espacios";
        campoInvalido(document.querySelector("#genero"));
        errores = true;
    }else{
        document.querySelector("#generoErrors").innerText = "";
        campoValido(document.querySelector("#genero"));
    }
});

//Validación de la especie cuando se sale del campo
document.querySelector("#especie").addEventListener("blur", e => {
    //Tomamos el dato
    let especie = document.querySelector("#especie").value.trim();
    //Validamos
    if(especie.length > 50) {
        document.querySelector("#especieErrors").innerText = "La especie no puede superar los 50 caracteres";
        campoInvalido(document.querySelector("#especie"));
        errores = true;
    }else if((especie!="") && (!/^[A-ZÑÁÉÍÓÚ]\. [a-zñáéíóúü]+$/.test(especie))) {
        document.querySelector("#especieErrors").innerText = "La especie debe tener el formato correcto (p. ej.: A. muscaria)";
        campoInvalido(document.querySelector("#especie"));
        errores = true;
    }else{
        document.querySelector("#especieErrors").innerText = "";
        campoValido(document.querySelector("#especie"));
    }
});

//Validación del nombre común cuando se sale del campo
document.querySelector("#nombre_comun").addEventListener("blur", e => {
    //Tomamos el dato
    let nombreComun = document.querySelector("#nombre_comun").value.trim();
    //Validamos
    if(nombreComun.length > 100) {
        document.querySelector("#nombreComunErrors").innerText = "El nombre común no puede superar los 100 caracteres";
        campoInvalido(document.querySelector("#nombre_comun"));
        errores = true;
    }else if((nombreComun!="") && (!/^[A-Za-zÁÉÍÓÚáéíóúÑñüÜ\s]+$/.test(nombreComun))) {
        document.querySelector("#nombreComunErrors").innerText = "El nombre común solo puede contener letras y espacios";
        campoInvalido(document.querySelector("#nombre_comun"));
        errores = true;
    }else{
        document.querySelector("#nombreComunErrors").innerText = "";
        campoValido(document.querySelector("#nombre_comun"));
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