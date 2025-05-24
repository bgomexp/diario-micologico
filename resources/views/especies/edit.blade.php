<x-layout title="Editar especie">
<main class="flex flex-col items-center">
<div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-1 text-3xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl xl:text-3xl">Editar especie</h2>
    </div>
<form class="2xl:w-1/2 xl:w-1/2 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/5" method="post" action="{{route('especies.store')}}">
  @csrf
  @method('PUT')
  <div class="flex gap-3 justify-between w-full">
    <div class="w-1/3">
      <label for="genero" class="block text-sm/6 font-medium text-gray-900">Género</label>
      <div class="mt-2">
        <input id="genero" name="genero" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" placeholder="Amanita" value="{{ old('genero') ? old('genero') : $especie->genero }}">
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('genero') }}</p>
    </div>
    
    <div class="w-1/3">
      <label for="especie" class="block text-sm/6 font-medium text-gray-900">Especie</label>
      <div class="mt-2">
        <input id="especie" name="especie" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" placeholder="A. muscaria" value="{{ old('especie') ? old('especie') : $especie->especie }}">
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('especie') }}</p>
    </div>

    <div class="w-1/3">
      <label for="nombre_comun" class="block text-sm/6 font-medium text-gray-900">Nombre común</label>
      <div class="mt-2">
        <input id="nombre_comun" name="nombre_comun" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" placeholder="Matamoscas" value="{{ old('nombre_comun') ? old('nombre_comun') : $especie->nombre_comun }}">
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('nombre_comun') }}</p>
    </div>
  </div>
  <div class="flex gap-3 justify-between w-full">
    <div class="w-1/2">
      <label for="toxicidad" class="block text-sm/6 font-medium text-gray-900">Toxicidad</label>
      <div class="mt-2">
        <select name="toxicidad" id="toxicidad" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
            <option value=""> </option> <!--TODO por aquí-->
            <option value="no tóxica" @if(old('toxicidad') == 'no tóxica') selected @endif>No tóxica</option>
            <option value="tóxica" @if(old('toxicidad') == 'tóxica') selected @endif>Tóxica</option>
            <option value="mortal" @if(old('toxicidad') == 'mortal') selected @endif>Mortal</option>
        </select>
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('toxicidad') }}</p>
    </div>
    
    <div class="w-1/2">
      <label for="comestibilidad" class="block text-sm/6 font-medium text-gray-900">Comestibilidad</label>
      <div class="mt-2">
        <select name="comestibilidad" id="comestibilidad" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
            <option value=""> </option>
            <option value="excelente comestible" @if(old('comestibilidad') == 'excelente comestible') selected @endif>Excelente comestible</option>
            <option value="excelente comestible con precaución" @if(old('comestibilidad') == 'excelente comestible con precaución') selected @endif>Excelente comestible con precaución</option>
            <option value="comestible" @if(old('comestibilidad') == 'comestible') selected @endif>Comestible</option>
            <option value="comestible con precaución" @if(old('comestibilidad') == 'comestible con precaución') selected @endif>Comestible con precaución</option>
            <option value="sin valor culinario" @if(old('comestibilidad') == 'sin valor culinario') selected @endif>Sin valor culinario</option>
            <option value="no comestible" @if(old('comestibilidad') == 'no comestible') selected @endif>No comestible</option>
        </select>
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('comestibilidad') }}</p>
    </div>
  </div>
  <div class="mt-5 flex justify-end">
    <x-submit-button>Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('especies.index')}}">Descartar</x-secondary-link-button>
  </div>  
</form>
</main>
</x-layout>
