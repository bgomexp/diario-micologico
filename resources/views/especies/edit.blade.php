<x-layout title="Editar especie">
<main class="flex flex-col items-center mt-8">
  <div class="px-4 pt-3 mx-auto max-w-screen-md text-center lg:px-12">
    <x-titulomini>Editar especie</x-titulomini>
  </div>
<div class="w-full h-full flex flex-col items-center bg-brown-100">
<form id="formEspecie" class="2xl:w-1/2 xl:w-1/2 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/5 py-5 mt-2" method="post" action="{{route('especies.update', $especie->id)}}">
  @csrf
  @method('PUT')
  <div class="flex gap-3 justify-between w-full">
    <div class="w-1/3">
      <label for="genero" class="block text-sm/6 font-medium">Género</label>
      <div class="mt-2">
        <input id="genero" name="genero" type="text" class="block w-full h-10 rounded-lg bg-transparent border border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50" placeholder="Amanita" value="{{ old('genero') ? old('genero') : $especie->genero }}">
      </div>
      <p id="generoErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('genero') }}</p>
    </div>
    
    <div class="w-1/3">
      <label for="especie" class="block text-sm/6 font-medium">Especie</label>
      <div class="mt-2">
        <input id="especie" name="especie" type="text" class="block w-full h-10 rounded-lg bg-transparent border border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50" placeholder="A. muscaria" value="{{ old('especie') ? old('especie') : $especie->especie }}">
      </div>
      <p id="especieErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('especie') }}</p>
    </div>

    <div class="w-1/3">
      <label for="nombre_comun" class="block text-sm/6 font-medium">Nombre común</label>
      <div class="mt-2">
        <input id="nombre_comun" name="nombre_comun" type="text" class="block w-full h-10 rounded-lg bg-transparent border border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50" placeholder="Matamoscas" value="{{ old('nombre_comun') ? old('nombre_comun') : $especie->nombre_comun }}">
      </div>
      <p id="nombreComunErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('nombre_comun') }}</p>
    </div>
  </div>
  <div class="flex gap-3 justify-between w-full my-5">
    <div class="w-1/2">
      <label for="toxicidad" class="block text-sm/6 font-medium">Toxicidad</label>
      <div class="mt-2">
        <select name="toxicidad" id="toxicidad"
          data-select='{
            "placeholder": "<span class=\"text-brown-800 opacity-50 text-sm\">Selecciona una especie</span>",
            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
            "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-brown-100 border-brown-800 border-dashed px-3 py-1.5 text-sm text-brown-800 focus:ring-0 focus:border-brown-800 focus:shadow-none",
            "hasSearch": false,
            "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto bg-brown-100",
            "optionClasses": "text-sm text-brown-800 advance-select-option selected:select-active hover:bg-lightgreen selected:bg-mediumgreen selected:text-lime-900 selected:font-semibold",
            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
            "extraMarkup": "<span class=\"absolute end-3 top-1/2 -translate-y-1/2 pointer-events-none flex items-center justify-center\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-4 h-4 text-brown-800\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 9l-7 7-7-7\" /></svg></span>"
            }'
            class="hidden">
            <option value=""> </option>
            <option value="no tóxica" @if(old('toxicidad')!=null && old('toxicidad') == 'no tóxica') selected @elseif ($especie->toxicidad == 'no tóxica') selected @endif>No tóxica</option>
            <option value="tóxica" @if(old('toxicidad')!=null && old('toxicidad') == 'tóxica') selected @elseif ($especie->toxicidad == 'tóxica') selected @endif>Tóxica</option>
            <option value="mortal" @if(old('toxicidad')!=null && old('toxicidad') == 'mortal') selected @elseif ($especie->toxicidad == 'mortal') selected @endif>Mortal</option>
        </select>
      </div>
      <p class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('toxicidad') }}</p>
    </div>
    
    <div class="w-1/2">
      <label for="comestibilidad" class="block text-sm/6 font-medium">Comestibilidad</label>
      <div class="mt-2">
        <select name="comestibilidad" id="comestibilidad"
          data-select='{
            "placeholder": "<span class=\"text-brown-800 opacity-50 text-sm\">Selecciona una especie</span>",
            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
            "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-brown-100 border-brown-800 border-dashed px-3 py-1.5 text-sm text-brown-800 focus:ring-0 focus:border-brown-800 focus:shadow-none",
            "hasSearch": false,
            "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto bg-brown-100",
            "optionClasses": "text-sm text-brown-800 advance-select-option selected:select-active hover:bg-lightgreen selected:bg-mediumgreen selected:text-lime-900 selected:font-semibold",
            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
            "extraMarkup": "<span class=\"absolute end-3 top-1/2 -translate-y-1/2 pointer-events-none flex items-center justify-center\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-4 h-4 text-brown-800\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 9l-7 7-7-7\" /></svg></span>"
            }'
            class="hidden">
            <option value=""> </option>
            <option value="excelente comestible" @if(old('comestibilidad')!=null && old('comestibilidad') == 'excelente comestible') selected @elseif ($especie->comestibilidad == 'excelente comestible') selected @endif>Excelente comestible</option>
            <option value="excelente comestible con precaución" @if(old('comestibilidad')!=null && old('comestibilidad') == 'excelente comestible con precaución') selected @elseif ($especie->comestibilidad == 'excelente comestible con precaución') selected @endif>Excelente comestible con precaución</option>
            <option value="comestible" @if(old('comestibilidad')!=null && old('comestibilidad') == 'comestible') selected @elseif ($especie->comestibilidad == 'comestible') selected @endif>Comestible</option>
            <option value="comestible con precaución" @if(old('comestibilidad')!=null && old('comestibilidad') == 'comestible con precaución') selected @elseif ($especie->comestibilidad == 'comestible con precaución') selected @endif>Comestible con precaución</option>
            <option value="sin valor culinario" @if(old('comestibilidad')!=null && old('comestibilidad') == 'sin valor culinario') selected @elseif ($especie->comestibilidad == 'sin valor culinario') selected @endif>Sin valor culinario</option>
            <option value="no comestible" @if(old('comestibilidad')!=null && old('comestibilidad') == 'no comestible') selected @elseif ($especie->comestibilidad == 'no comestible') selected @endif>No comestible</option>
        </select>
      </div>
      <p class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('comestibilidad') }}</p>
    </div>
  </div>
  <div class="mt-5 flex justify-end gap-2">
    <x-submit-button id="btnGuardar">Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('especies.show', $especie->id)}}">Cancelar</x-secondary-link-button>
  </div>  
</form>
</div>
</main>
@if (app()->environment() !== 'testing')
  @push('scripts')
    @vite('resources/js/especies-form.js')
    @vite('resources/js/especies-validation.js')
  @endpush
@endif
</x-layout>
