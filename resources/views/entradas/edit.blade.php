<x-layout title="Editar entrada">
<main class="flex flex-col items-center">
<div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-1 text-3xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl xl:text-3xl">Nueva entrada</h2>
    </div>
<form class="2xl:w-1/2 xl:w-1/2 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/5" method="post" action="{{route('entradas.update')}}">
  @csrf
  @method('put')
  <div class="flex gap-3 justify-between w-full">
    <div class="w-1/2">
      <label for="fecha" class="block text-sm/6 font-medium text-gray-900">Fecha</label>  
      <div class="relative mt-2">
        <input type="text" name="fecha" class="input h-10 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-0 focus:ring-0 focus:border-lime-500 block w-full px-3 py-1.5 placeholder:text-gray-500" placeholder="Selecciona una fecha" id="flatpickr-date" value="{{ old('fecha') ? \Carbon\Carbon::parse(old('fecha'))->format('d-m-y') : \Carbon\Carbon::parse($entrada->fecha)->format('d-m-y') }}" />
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('fecha') }}</p>
    </div>
    
    <div class="w-1/2">
      <label for="lugar" class="block text-sm/6 font-medium text-gray-900">Lugar</label>
      <div class="mt-2">
        <input id="lugar" name="lugar" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" placeholder="Introduce un lugar" value="{{ old('lugar') ? old('lugar') : $entrada->lugar }}">
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
            @foreach ($entrada->especies as $i => $especie)
              @include('partials.fila-seta', ['index' => $i, 'data' => ["especie" => $especie->id, "cantidad" => $especie->pivot->cantidad]])
            @endforeach
          @else
            @foreach (old('setas') as $i => $seta)
              @include('partials.fila-seta', ['index' => $i, 'data' => $seta])
            @endforeach
          @endif
        </div>
        @if ($errors->has('setas.*.especie'))
          <p class="text-red-500 text-xs italic my-2"> Deben indicarse una especie y una cantidad en todos los registros</p>
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
      <textarea name="comentarios" id="comentarios" rows="10" class="block w-full rounded-md bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400  focus:outline-1 focus:-outline-offset-1 focus:ring-0 focus:outline-lime-500 sm:text-sm/6">{{old('comentarios') ? old('comentarios') : $entrada->comentarios}}</textarea>
    </div>
  </div>
  <div class="mt-5 flex justify-end">
    <x-submit-button>Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('entradas.show', $entrada->id)}}">Cancelar</x-secondary-link-button>
  </div>  
</form>
</main>

@yield('content')

@push('scripts')
  @vite('resources/js/create-entrada.js')
@endpush
</x-layout>
<template id="fila-template">
  {!! str_replace('__INDEX__', '__REEMPLAZAR__', view('partials.fila-seta', compact('especies'))->render()) !!}
</template>