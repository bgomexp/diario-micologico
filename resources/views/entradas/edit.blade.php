<x-layout title="Editar entrada">
<main class="flex flex-col items-center mt-8 bg-brown-100">
  <div class="px-4 pt-3 mx-auto max-w-screen-md text-center lg:px-12">
    <x-titulomini>Editar entrada</x-titulomini>
  </div>
<form class="2xl:w-1/2 xl:w-1/2 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/5 p-5 mt-2" method="post" action="{{route('entradas.update', $entrada->id)}}">
  @csrf
  @method('PUT')
  <div class="flex gap-3 justify-between w-full">
    <div class="w-1/2">
      <label for="fecha" class="block text-sm/6 font-medium">Fecha</label>  
      <div class="relative mt-2">
        <input type="text" name="fecha" class="input h-10 bg-transparent text-brown-800 border border-brown-800 border-dashed text-sm rounded-lg focus:outline-0 focus:ring-0 focus:border-solid block w-full px-3 py-1.5 placeholder:text-brown-800 placeholder:opacity-50 focus:shadow-none" placeholder="Selecciona una fecha" id="flatpickr-date" value="{{ old('fecha') ? \Carbon\Carbon::parse(old('fecha'))->format('d-m-y') : \Carbon\Carbon::parse($entrada->fecha)->format('d-m-y') }}" />
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('fecha') }}</p>
    </div>
    
    <div class="w-1/2">
      <label for="lugar" class="block text-sm/6 font-medium">Lugar</label>
      <div class="mt-2">
        <input id="lugar" name="lugar" type="text" class="block w-full h-10 rounded-lg bg-transparent border border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50" placeholder="Introduce un lugar" value="{{ old('lugar') ? old('lugar') : $entrada->lugar }}">
      </div>
      <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('lugar') }}</p>
    </div>
  </div>

  <div class="mt-5">
    <label for="encontrados" class="block text-sm/6 font-medium">Ejemplares encontrados</label>
    <div id="encontrados" class="mt-2">
      <div class="block w-full rounded-lg px-3 py-1.5 text-base border-1 border-brown-400">
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
          <button type="button" id="btnAnadirEjemplar" class="cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-sm text-sm py-1 px-2">Añadir ejemplar</button>
        </div>  
      </div>
    </div>
  </div> 

  <div class="mt-5">
    <label for="comentarios" class="block text-sm/6 font-medium">Comentarios</label>
    <div class="mt-2">
      <textarea name="comentarios" id="comentarios" rows="10" class="block w-full rounded-md bg-transparent border-brown-800 border-dashed px-3 py-1.5 text-sm focus:outline-1 focus:-outline-offset-1 focus:ring-0 focus:border-solid">{{old('comentarios') ? old('comentarios') : $entrada->comentarios}}</textarea>
    </div>
  </div>
  <div class="mt-5 flex justify-end gap-2">
    <x-submit-button>Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('entradas.show', $entrada->id)}}">Cancelar</x-secondary-link-button>
  </div>  
</form>
</main>

@push('scripts')
  @vite('resources/js/create-entrada.js')
@endpush
</x-layout>
<template id="fila-template">
  {!! str_replace('__INDEX__', '__REEMPLAZAR__', view('partials.fila-seta', compact('especies'))->render()) !!}
</template>