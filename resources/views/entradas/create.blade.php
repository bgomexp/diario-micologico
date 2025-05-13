<x-layout title="Nueva entrada">
<main class="flex flex-col items-center">
<div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-1 text-3xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl xl:text-3xl">Nueva entrada</h2>
    </div>
<form class="2xl:w-1/2 xl:w-1/2 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/5" method="post" action="{{route('entradas.store')}}">
  @csrf
  @method('post')
  <div class="flex gap-3 justify-between w-full">
    <div class="w-1/2">
      <label for="fecha" class="block text-sm/6 font-medium text-gray-900">Fecha</label>  
      <div class="relative mt-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input datepicker id="fecha" name="fecha" type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full ps-10 p-2.5" placeholder="Selecciona una fecha">
      </div>
    </div>
    
    <div class="w-1/2">
      <label for="lugar" class="block text-sm/6 font-medium text-gray-900">Lugar</label>
      <div class="mt-2">
        <input id="lugar" name="lugar" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-lime-500 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" placeholder="Introduce un lugar">
      </div>
    </div>
  </div>

  <div class="mt-5">
    <label for="encontrados" class="block text-sm/6 font-medium text-gray-900">Ejemplares encontrados</label>
    <div id="encontrados" class="mt-2">
      <div class="block w-full rounded-lg bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300">
        <div id="divEjemplares">

          <div class="fila flex justify-between gap-2 my-2 border-b border-gray-900/10 pb-2"> <!--Esto es lo que se añade y quita-->
            <div class="dropdown-box w-4/5 relative">
              <div class="selected-item">
                <input type="text" name="seta[0][especie]" value="Selecciona una especie" readonly class="w-full border-1 border-gray-300 text-sm text-gray-500 rounded-lg cursor-pointer">
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
              <input type="number" name="seta[0][cantidad]" value="1" min="1" class="w-full border-1 border-gray-300 text-sm rounded-lg cursor-pointer">
            </div>
            <div class="flex px-1">
              <button type="button" class="cursor-pointer text-sm font-medium text-red-600 hover:underline">Eliminar</button>
            </div>
          </div>

        </div>
        <div class="flex">
          <button type="button" id="btnAnadirEjemplar" class="cursor-pointer focus:outline-none text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-sm text-sm py-1 px-2">Añadir ejemplar</button>
        </div>  
      </div>
    </div>
  </div> 

  <div class="mt-5">
    <label for="comentarios" class="block text-sm/6 font-medium text-gray-900">Comentarios</label>
    <div class="mt-2">
      <textarea name="comentarios" id="about" rows="10" class="block w-full rounded-md bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-1 focus:outline-lime-500 sm:text-sm/6"></textarea>
    </div>
  </div>
  <div class="mt-5 flex justify-end">
    <input type="submit" value="Guardar" class="cursor-pointer focus:outline-none text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-4">
  </div>  
</form>
</main>

@yield('content')
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</x-layout>