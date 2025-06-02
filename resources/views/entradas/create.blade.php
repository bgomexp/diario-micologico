<x-layout title="Nueva entrada">
<main class="flex flex-col items-center mt-8">
  <div class="px-1 pt-3 mx-0.5 max-w-screen-md text-center lg:px-12">
    <x-titulomini>Nueva entrada</x-titulomini>
  </div>
  <div class="w-full h-full flex flex-col items-center bg-brown-100">
<form id="formEntrada" class="2xl:w-1/2 xl:w-1/2 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/5 py-5 mt-2" method="post" action="{{route('entradas.store')}}">
  @csrf
  @method('post')
  <div class="flex flex-wrap sm:flex-nowrap gap-3 justify-between w-full">
    <div class="w-full">
      <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>  
      <div class="relative mt-2">
        <input type="text" name="fecha" class="input h-10 bg-transparent text-brown-800 border border-brown-800 border-dashed text-sm rounded-lg focus:outline-0 focus:ring-0 focus:border-solid block w-full px-3 py-1.5 placeholder:text-brown-800 placeholder:opacity-50 focus:shadow-none" placeholder="Selecciona una fecha" id="flatpickr-date" value="{{ old('fecha') ? \Carbon\Carbon::parse(old('fecha'))->format('d-m-y') : '' }}" />
      </div>
      <p id="fechaErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('fecha') }}</p>
    </div>
    
    <div class="w-full">
      <label for="lugar" class="block text-sm/6 font-medium">Lugar</label>
      <div class="mt-2">
        <input id="lugar" name="lugar" type="text" class="block w-full h-10 rounded-lg bg-transparent border border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50" placeholder="Introduce un lugar" value="{{old('lugar')}}">
      </div>
      <p class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('lugar') }}</p>
    </div>
  </div>

  <div class="mt-5">
    <label for="encontrados" class="block text-sm/6 font-medium">Ejemplares encontrados</label>
    <div id="encontrados" class="mt-2">
      <div class="block w-full rounded-lg px-3 py-1.5 text-base border-1 border-brown-400">
        <div id="divEjemplares">

          @if (!old('setas'))
          <div class="fila flex flex-wrap sm:flex-nowrap justify-between gap-2 my-2 border-b border-brown-800/10 pb-2"> <!--Esto es lo que se añade y quita-->
            <div class="w-full">
              <label for="setas[0][especie]" class="block text-sm/6 font-medium">Especie</label>
              <select name = "setas[0][especie]" id="setas[0][especie]"
                data-select='{
                "placeholder": "<span class=\"text-brown-800 opacity-50 text-sm\">Selecciona una especie</span>",
                "searchPlaceholder": "Buscar...",
                "searchNoResultText": "No hay resultados",
                "searchNoResultClasses": "text-brown-800 text-sm mx-2.5",
                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                "toggleClasses": "h-9 advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-brown-100 border-brown-800 border-dashed px-3 py-1.5 text-sm text-brown-800 focus:ring-0 focus:border-brown-800 focus:shadow-none",
                "hasSearch": true,
                "searchClasses": "w-full mt-1 rounded-lg bg-transparent border-brown-800 px-3 py-1.5 text-sm text-brown-800 focus:ring-0 focus:border-brown-800",
                "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto bg-brown-100",
                "optionClasses": "text-sm text-brown-800 advance-select-option selected:select-active hover:bg-lightgreen selected:bg-mediumgreen selected:text-lime-900 selected:font-semibold",
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

            <div class="w-full sm:w-auto flex">
              <div class="w-full">
                <label for="setas[0][cantidad]" class="block text-sm/6 font-medium">Cantidad</label>
                <input type="number" name="setas[0][cantidad]" id="setas[0][cantidad]" value="1" min="1" class="w-full h-9 bg-transparent rounded-lg border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50">
              </div>
              <div class="flex flex-col-reverse items-center px-3 mb-2.5 w-auto">
                <button type="button" class="cursor-pointer text-sm font-medium text-amber-700 hover:underline">Eliminar</button>
              </div>
            </div>
          </div>
          @else
            @foreach (old('setas') as $i => $seta)
              @include('partials.fila-seta', ['index' => $i, 'data' => $seta])
            @endforeach
          @endif
        </div>
        @if ($errors->has('setas.*.especie'))
          <p class="text-amber-600 text-xs italic my-2"> Deben indicarse una especie y una cantidad en todos los registros</p>
        @endif
        <p id="especiesErrors" class="text-amber-600 text-xs italic my-2"></p>
        <div class="flex">
          <button type="button" id="btnAnadirEjemplar" class="cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-sm text-sm py-1 px-2">Añadir ejemplar</button>
        </div>  
      </div>
    </div>
  </div> 

  <div class="mt-5">
    <label for="comentarios" class="block text-sm/6 font-medium">Comentarios</label>
    <div class="mt-2">
      <textarea name="comentarios" id="comentarios" rows="10" class="block w-full rounded-md bg-transparent border-brown-800 border-dashed px-3 py-1.5 text-sm focus:outline-1 focus:-outline-offset-1 focus:ring-0 focus:border-solid">{{old('comentarios')}}</textarea>
    </div>
  </div>
  <div class="mt-5 flex justify-end gap-2">
    <x-submit-button id="btnGuardar">Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('entradas.index')}}">Descartar</x-secondary-link-button>
  </div>  
</form>
</div>
</main>

@push('scripts')
  @vite('resources/js/entradas-form.js')
  @vite('resources/js/entradas-validation.js')
@endpush
</x-layout>
<template id="fila-template">
  {!! str_replace('__INDEX__', '__REEMPLAZAR__', view('partials.fila-seta', compact('especies'))->render()) !!}
</template>