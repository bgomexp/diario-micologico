"use strict";

//Página de creación de entradas
if (window.location.href.endsWith("entradas/crear")) {

    const dropdown = document.querySelector(".dropdown-box");
    const dropdownContent = document.querySelector(".dropdown-content");
    const selectedItem = document.querySelector(".selected-item");
    const dropdownItems = document.querySelectorAll(".dropdown-item");
    const searchInput = document.querySelector(".search-input input");

    let indexInputEspecie = 1; //Para las líneas de input de especie que se van añadiendo

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
    
    //Añadir una nuevo ejemplar
    document.querySelector("#btnAnadirEjemplar").addEventListener("click", e => {
        
        const divEjemplares = document.querySelector("#divEjemplares");
        let lineaNueva = `
        <div class="fila flex justify-between gap-2 my-2 border-b border-gray-900/10 pb-2"> <!--Esto es lo que se añade y quita-->
            <div class="dropdown-box w-4/5 relative">
              <div class="selected-item">
                <input type="text" name="seta[${indexInputEspecie}][especie]" value="Selecciona una especie" readonly class="w-full border-1 border-gray-300 text-sm text-gray-500 rounded-lg cursor-pointer">
              </div>
              <div class="dropdown-content shadow-xl rounded-lg w-full max-h-75 overflow-auto absolute z-10 bg-white">
                <div class="search-input p-1">
                  <input type="text" class="w-full border-1 border-gray-300 text-gray-600 text-sm rounded-lg">
                </div>
                <ul>
                  <li class="active dropdown-item text-sm py-1 px-2 cursor-pointer hover:bg-gray-100">Selecciona una especie</li>
                  @foreach ($especies as $especie)
                    <li class="dropdown-item text-sm py-1 px-2 cursor-pointer hover:bg-gray-100">{{ $especie->genero.substr($especie->especie, 2)." (".$especie->nombre_comun.")" }}</li>      
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="w-1/10">
              <input type="number" name="seta[${indexInputEspecie}][cantidad]" value="1" min="1" class="w-full border-1 border-gray-300 text-sm rounded-lg cursor-pointer">
            </div>
            <div class="flex px-1">
              <button type="button" class="text-sm font-medium text-red-600 hover:underline">Eliminar</button>
            </div>
          </div>`;
        //Creamos el div y lo rellenamos
        let div = document.createElement('div');
        div.innerHTML = lineaNueva;
        console.log(div);
        divEjemplares.appendChild(div);
        //Aumentamos el índice
        indexInputEspecie++;
        //FIXME El desplegable no funciona. Hay que modificar su funcionamiento
    });
    
}

