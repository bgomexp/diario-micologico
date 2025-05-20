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
        <!--<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input datepicker datepicker-format="dd-mm-yyyy" id="fecha" name="fecha" type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full ps-10 p-2.5" placeholder="Selecciona una fecha">-->
        <input type="text" name="fecha" class="input h-10 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-0 focus:ring-0 focus:border-lime-500 block w-full px-3 py-1.5 placeholder:text-gray-500" placeholder="Selecciona una fecha" id="flatpickr-date" value="{{ old('fecha') ? \Carbon\Carbon::parse(old('fecha'))->format('d-m-y') : '' }}" />
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('fecha') }}</p>
    </div>
    
    <div class="w-1/2">
      <label for="lugar" class="block text-sm/6 font-medium text-gray-900">Lugar</label>
      <div class="mt-2">
        <input id="lugar" name="lugar" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" placeholder="Introduce un lugar" value="{{old('lugar')}}">
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('lugar') }}</p>
    </div>
  </div>

  <div class="mt-5">
    <label for="encontrados" class="block text-sm/6 font-medium text-gray-900">Ejemplares encontrados</label>
    <div id="encontrados" class="mt-2">
      <div class="block w-full rounded-lg bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300">
        <div id="divEjemplares">

          @if (!old('setas'))
          <div class="fila flex justify-between gap-2 my-2 border-b border-gray-900/10 pb-2"> <!--Esto es lo que se añade y quita-->
            <div class="w-full">
              <select name = "setas[0][especie]"
                data-select='{
                "placeholder": "<span class=\"text-gray-500 text-sm\">Selecciona una especie</span>",
                "searchPlaceholder": "Buscar...",
                "searchNoResultText": "No hay resultados",
                "searchNoResultClasses": "text-gray-500 text-sm mx-2.5",
                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 sm:text-sm/6",
                "hasSearch": true,
                "searchClasses": "w-full mt-1 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 sm:text-sm/6",
                "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                "optionClasses": "text-sm advance-select-option selected:select-active hover:bg-gray-50 selected:bg-lime-100 selected:text-lime-700",
                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                "extraMarkup": "<span class=\"icon-[tabler--caret-up-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                }'
                class="hidden">
                <option value="">Choose</option>
                @foreach ($especies as $especie)
                  <option value="{{ $especie->id }}">{{ $especie->genero.substr($especie->especie, 2)." (".$especie->nombre_comun.")" }}</option>    
                @endforeach
              </select>
            </div>

            <div class="w-1/5">
              <input type="number" name="setas[0][cantidad]" value="1" min="1" class="w-full rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
            </div>
            <div class="flex px-1">
              <button type="button" class="cursor-pointer text-sm font-medium text-red-600 hover:underline">Eliminar</button>
            </div>
          </div>
          @else
            @for ($i = 0; $i < count(old('setas')); $i++)
              @include('partials.fila-seta')
            @endfor
          @endif
        </div>
        @if ($errors->has('setas.*.especie'))
          <p class="text-red-500 text-xs italic my-2"> Deben indicarse una especie y una cantidad en todos los registros</p> <!--TODO que en caso de error se recuerden las setas-->
        @endif
        <div class="flex">
          <button type="button" id="btnAnadirEjemplar" class="cursor-pointer focus:outline-none text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-sm text-sm py-1 px-2">Añadir ejemplar</button>
        </div>  
      </div>
    </div>
  </div> 

  <div class="mt-5">
    <label for="comentarios" class="block text-sm/6 font-medium text-gray-900">Comentarios</label>
    <div class="mt-2">
      <textarea name="comentarios" id="comentarios" rows="10" class="block w-full rounded-md bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400  focus:outline-1 focus:-outline-offset-1 focus:ring-0 focus:outline-lime-500 sm:text-sm/6">{{old('comentarios')}}</textarea>
    </div>
  </div>
  <div class="mt-5 flex justify-end">
    <x-submit-button>Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('entradas.index')}}">Descartar</x-secondary-link-button>
  </div>  
</form>
</main>

@yield('content')
</x-layout>
<template id="fila-template">
  {!! str_replace('__INDEX__', '__REEMPLAZAR__', view('partials.fila-seta', compact('especies'))->render()) !!}
</template>