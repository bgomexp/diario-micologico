"use strict";
const dropdown = document.querySelector(".dropdown-box");
const dropdownContent = document.querySelector(".dropdown-content");
const selectedItem = document.querySelector(".selected-item");
const dropdownItems = document.querySelectorAll(".dropdown-item");
const searchInput = document.querySelector(".search-input input");

//Control de la apertura y el cierre del dropdown
window.addEventListener("click", e => {
    //Si el dropdown está desplegado
    if (dropdown.classList.contains("active")) {
        //Si se ha hecho clic fuera del desplegable, lo cerramos
        if (!dropdownContent.contains(e.target)) {
            closeDropdown();
        }
    }
    //Si está cerrado y se ha hecho clic en el elemento
    else if (selectedItem.contains(e.target)){
        openDropdown();
    }

    dropdownItems.forEach(item => {
        item.addEventListener("click", () => {
            //Desmarcamos todos los elementos
            dropdownItems.forEach(innerItem => {
                innerItem.classList.remove("active");
            })
            //Marcamos el seleccionado
            item.classList.add("active");
            //Cambiamos el valor del input del elemento seleccionado
            document.querySelector(".selected-item input").value = item.innerHTML;
            //Cerramos el desplegable
            closeDropdown();
        })
    })

    searchInput.addEventListener("keyup", () => {
        //Tomamos lo que ha introducido el usuario en la barra de búsqueda (en minúscula)
        const filtro = searchInput.value.toLocaleLowerCase();
        //Recorremos los elementos del desplegable para filtrar
        dropdownItems.forEach(item => {
            //Si el elemento contiene el filtro, se muestra. Si no, se oculta.
            if (item.innerHTML.toLocaleLowerCase().includes(filtro)) {
                item.classList.remove("hide");
            }else{
                item.classList.add("hide");
            }
        })
    })

});

//Cierre del desplegable
function closeDropdown() {
    dropdown.classList.remove("active");
}

//Apertura del desplegable
function openDropdown() {
    //Vaciamos el buscador
    searchInput.value = "";
    //Mostramos todas las opciones
    showAllOptions();
    //Abrimos el desplegable
    dropdown.classList.add("active");
}

//Mostrar todas las opciones
function showAllOptions() {
    dropdownItems.forEach(item => {
            item.classList.remove("hide");
        })
}
