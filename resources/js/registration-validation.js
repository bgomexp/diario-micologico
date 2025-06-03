"use strict";

//Validación en el momento de submit
document.querySelector("#btnCrearCuenta").addEventListener("click", e => {
    let errores = false;

    //Evitamos el submit
    e.preventDefault()

    //Tomamos los datos
    let nombre = document.querySelector("#name").value.trim();
    let apellidos = document.querySelector("#surname").value.trim();
    let email = document.querySelector("#email").value.trim();
    let password = document.querySelector("#password").value;
    let passwordConfirmation = document.querySelector("#password_confirmation").value;

    //Validamos el nombre
    if (nombre=="") {
        document.querySelector("#nameErrors").innerText = "El nombre es obligatorio";
        campoInvalido(document.querySelector("#name"));
        errores = true;
    }else if(nombre.length > 50) {
        document.querySelector("#nameErrors").innerText = "El nombre no puede superar los 50 caracteres";
        campoInvalido(document.querySelector("#name"));
        errores = true;
    }else if(!/^['A-Za-zÁÉÍÓÚáéíóúÑñüÜçÇ\-\s]+$/.test(nombre)) {
        document.querySelector("#nameErrors").innerText = "El nombre solo puede contener letras, espacios, guiones y apóstrofos";
        campoInvalido(document.querySelector("#name"));
        errores = true;
    }else{
        document.querySelector("#nameErrors").innerText = "";
        campoValido(document.querySelector("#name"));
    }

    //Validamos los apellidos
    if(apellidos.length > 80) {
        document.querySelector("#surnameErrors").innerText = "Los apellidos no pueden superar los 80 caracteres";
        campoInvalido(document.querySelector("#surname"));
        errores = true;
    }else if((apellidos!="") && (!/^['A-Za-zÁÉÍÓÚáéíóúÑñüÜçÇ\-\s]+$/.test(apellidos))) {
        document.querySelector("#surnameErrors").innerText = "Los apellidos solo pueden contener letras, espacios, guiones y apóstrofos";
        campoInvalido(document.querySelector("#surname"));
        errores = true;
    }else{
        document.querySelector("#surnameErrors").innerText = "";
        campoValido(document.querySelector("#surname"));
    }

    //Validamos el email
    if (email=="") {
        document.querySelector("#emailErrors").innerText = "El correo electrónico es obligatorio";
        campoInvalido(document.querySelector("#email"));
        errores = true;
    }else if(email.length > 254) {
        document.querySelector("#emailErrors").innerText = "El correo no puede superar los 254 caracteres";
        campoInvalido(document.querySelector("#email"));
        errores = true;
    }else if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.querySelector("#emailErrors").innerText = "El correo introducido no tiene un formato válido";
        campoInvalido(document.querySelector("#email"));
        errores = true;
    }else{
        document.querySelector("#emailErrors").innerText = "";
        campoValido(document.querySelector("#email"));
    }

    //Validamos la contraseña
    if (password=="") {
        document.querySelector("#passwordErrors").innerText = "La contraseña es obligatoria";
        campoInvalido(document.querySelector("#password"));
        errores = true;
    }else if(password.length > 100) {
        document.querySelector("#passwordErrors").innerText = "La contraseña no puede superar los 100 caracteres";
        campoInvalido(document.querySelector("#password"));
        errores = true;
    }else{
        document.querySelector("#passwordErrors").innerText = "";
        campoValido(document.querySelector("#password"));
    }

    //Validamos la confirmación de la contraseña
    if (passwordConfirmation=="") {
        document.querySelector("#confirmPasswordErrors").innerText = "La confirmación de la contraseña es obligatoria";
        campoInvalido(document.querySelector("#password_confirmation"));
        errores = true;
    }else if(password!=passwordConfirmation) {
        document.querySelector("#confirmPasswordErrors").innerText = "Las contraseñas deben coincidir";
        campoInvalido(document.querySelector("#password_confirmation"));
        errores = true;
    }else{
        document.querySelector("#confirmPasswordErrors").innerText = "";
        campoValido(document.querySelector("#password_confirmation"));
    }

    //Si no hay errores, enviamos el formulario al servidor
    if (!errores) {
        document.querySelector("#formRegistro").submit();
    }
});


//Validación del formato del nombre cuando se sale del campo
document.querySelector("#name").addEventListener("blur", e => {
    //Tomamos el dato
    let name = document.querySelector("#name").value.trim();
    //Validamos
    if((name!="")&&(!/^['A-Za-zÁÉÍÓÚáéíóúÑñüÜçÇ-\s]+$/.test(name))) {
        document.querySelector("#nameErrors").innerText = "El nombre solo puede contener letras, espacios, guiones y apóstrofos";
        campoInvalido(document.querySelector("#name"));
    }else if(name.length > 50){
        document.querySelector("#nameErrors").innerText = "El nombre no puede superar los 50 caracteres";
        campoInvalido(document.querySelector("#name"));
    }else{
        document.querySelector("#nameErrors").innerText = "";
        campoValido(document.querySelector("#name"));
    }
});

//Validación del formato de los apellidos cuando se sale del campo
document.querySelector("#surname").addEventListener("blur", e => {
    //Tomamos el dato
    let apellidos = document.querySelector("#surname").value.trim();
    //Validamos
    if((apellidos!="")&&(!/^['A-Za-zÁÉÍÓÚáéíóúÑñüÜçÇ-\s]+$/.test(apellidos))) {
        document.querySelector("#surnameErrors").innerText = "Los apellidos solo pueden contener letras, espacios, guiones y apóstrofos";
        campoInvalido(document.querySelector("#surname"));
    }else if(apellidos.length > 80){
        document.querySelector("#surnameErrors").innerText = "Los apellidos no pueden superar los 80 caracteres";
        campoInvalido(document.querySelector("#surname"));
    }else{
        document.querySelector("#surnameErrors").innerText = "";
        campoValido(document.querySelector("#surname"));
    }
});

//Validación del formato del email cuando se sale del campo
document.querySelector("#email").addEventListener("blur", e => {
    //Tomamos el dato
    let email = document.querySelector("#email").value.trim();
    //Validamos
    if((email!="")&&(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))) {
        document.querySelector("#emailErrors").innerText = "El correo introducido no tiene un formato válido";
        campoInvalido(document.querySelector("#email"));
    }else{
        document.querySelector("#emailErrors").innerText = "";
        campoValido(document.querySelector("#email"));
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