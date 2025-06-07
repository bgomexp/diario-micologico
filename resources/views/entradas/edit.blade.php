<x-layout title="Editar entrada">
<main class="flex flex-col items-center mt-8 bg-brown-100">
  <div class="px-4 pt-3 mx-auto max-w-screen-md text-center lg:px-12">
    <x-titulomini>Editar entrada</x-titulomini>
  </div>
<form id="formEntrada" class="2xl:w-2/5 lg:w-1/2 md:w-3/5 w-4/5 py-5 mt-2" method="post" action="{{route('entradas.update', $entrada->id)}}">
  @csrf
  @method('PUT')
  <div class="flex gap-3 justify-between w-full">
    <div class="w-full">
      <label for="titulo" class="block text-sm/6 font-medium">Título</label>
      <div class="mt-2">
        <input id="titulo" name="titulo" type="text" class="block w-full h-10 rounded-lg bg-transparent border border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50" placeholder="Introduce un título" value="{{old('titulo') ? old('titulo') : $entrada->titulo}}">
      </div>
      <p id="tituloErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('titulo') }}</p>
    </div>
    <div class="w-full">
      <label for="fecha" class="block text-sm/6 font-medium">Fecha*</label>  
      <div class="relative mt-2">
        <input type="text" name="fecha" class="input h-10 bg-transparent text-brown-800 border border-brown-800 border-dashed text-sm rounded-lg focus:outline-0 focus:ring-0 focus:border-solid block w-full px-3 py-1.5 placeholder:text-brown-800 placeholder:opacity-50 focus:shadow-none" placeholder="Selecciona una fecha" id="flatpickr-date" value="{{ old('fecha') ? \Carbon\Carbon::parse(old('fecha'))->format('d-m-y') : \Carbon\Carbon::parse($entrada->fecha)->format('d-m-y') }}" />
      </div>
      <p id="fechaErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('fecha') }}</p>
    </div>
  </div>

  <div class="w-full mt-5">
    <label for="lat" class="block text-sm/6 font-medium">Lugar</label>
    <!-- Mapa de selección -->
    <div id="map" class="h-80 border-1 border-brown-800 border-dashed mt-2 rounded-lg"></div>
    <input type="hidden" id="lat" name="lat" value="{{$entrada->lugar? explode('|', $entrada->lugar)[0] : ''}}">
    <input type="hidden" id="lng" name="lng" value="{{$entrada->lugar? explode('|', $entrada->lugar)[1] : ''}}">
    <p class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('lat') }} {{ $errors->first('lng') }}</p>
    <div class="w-full py-2 flex gap-2 flex-wrap md:flex-nowrap">
      <button type="button" id="btnUbiActual" class="w-full xl:w-50 cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-sm text-sm py-1 px-2">Ubicación actual</button>
      <button type="button" id="btnResetUbi" class="w-full xl:w-50 cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-sm text-sm py-1 px-2">Borrar ubicación</button>
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
          <p class="text-amber-600 text-xs italic my-2"> Deben indicarse una especie y una cantidad en todos los registros</p>
        @endif
        <p id="especiesErrors" class="text-amber-600 text-xs italic my-2"></p>
        <div class="flex">
          <button type="button" id="btnAnadirEjemplar" class="cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-sm text-sm py-1 px-2">Añadir ejemplar</button>
        </div>  
      </div>
    </div>
  </div> 

  <div class="my-5">
    <label for="comentarios" class="block text-sm/6 font-medium">Comentarios</label>
    <div class="mt-2">
      <textarea name="comentarios" id="comentarios" rows="10" class="block w-full rounded-md bg-transparent border-brown-800 border-dashed px-3 py-1.5 text-sm focus:outline-1 focus:-outline-offset-1 focus:ring-0 focus:border-solid">{{old('comentarios') ? old('comentarios') : $entrada->comentarios}}</textarea>
    </div>
    <p id="comentariosErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('comentarios') }}</p>
  </div>
  <p class="text-xs font-medium text-right">
    *Campo obligatorio
  </p>
  <div class="mt-5 flex justify-end gap-2">
    <x-submit-button id="btnGuardar">Guardar</x-submit-button>
    <x-secondary-link-button id="" href="{{route('entradas.show', $entrada->id)}}">Cancelar</x-secondary-link-button>
  </div>  
</form>
</main>

@push('scripts')
  @vite('resources/js/entradas-form.js')
  @vite('resources/js/entradas-validation.js')
  @vite('resources/js/mapa-edit.js')
@endpush
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</x-layout>
<template id="fila-template">
  {!! str_replace('__INDEX__', '__REEMPLAZAR__', view('partials.fila-seta', compact('especies'))->render()) !!}
</template>