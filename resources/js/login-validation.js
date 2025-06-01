"use strict";

//Validación en el momento de submit
document.querySelector("#btnIniciarSesion").addEventListener("click", e => {
    let errores = false;

    //Evitamos el submit
    e.preventDefault()

    //Tomamos los datos
    let email = document.querySelector("#email").value.trim();
    let password = document.querySelector("#password").value.trim();

    //Validamos el email
    if (email=="") {
        document.querySelector("#emailErrors").innerText = "El correo electrónico es obligatorio";
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
    }else{
        document.querySelector("#passwordErrors").innerText = "";
        campoValido(document.querySelector("#password"));
    }

    //Si no hay errores, enviamos el formulario al servidor
    if (!errores) {
        document.querySelector("#formLogin").submit();
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