<x-layout title="Entrada">
  <main>
    <section class="bg-white flex flex-col items-center">
      <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-2 text-3xl font-bold tracking-tight leading-none text-gray-800 lg:mb-2 md:text-4xl xl:text-3xl">Entrada</h2>
      </div>
      <div class="mt-3 w-2/5 relative  sm:rounded-lg">
        <div class="flow-root">
          <dl class="-my-3 divide-y divide-gray-200 text-sm">
            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Fecha</dt>

              <dd class="text-gray-700 sm:col-span-2">{{ writtenDate($entrada->fecha) }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Lugar</dt>

              <dd class="text-gray-700 sm:col-span-2">{{ $entrada->lugar ?? "No especificado" }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Especies encontradas</dt>

              <dd class="text-gray-700 sm:col-span-2">
                @if ($entrada->especies->isNotEmpty())
                  <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs bg-white uppercase">
                            <tr>
                                <th scope="col" class="pt-0.5 pb-2">
                                    Especie
                                </th>
                                <th scope="col" class="pt-0.5 pb-2">
                                    Cantidad
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($entrada->especies as $especie)
                            <tr class="bg-white border-t border-gray-200">
                                <td class="py-3">
                                    {{ $especie->genero.substr($especie->especie, 2) }}
                                </td>
                                <td class="py-3">
                                    {{ $especie->pivot->cantidad }}
                                </td>
                            </tr>
                          @endforeach  
                        </tbody>
                    </table>
                </div>
                @else
                  -
                @endif
              </dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Comentarios</dt>

              <dd class="text-gray-700 sm:col-span-2 text-justify">
                {{ $entrada->comentarios ?? "No hay comentarios" }}
              </dd>
            </div>
          </dl>
        </div>
        <div class="mt-6 w-full flex justify-end">
            <x-link-button id="" href="{{route('entradas.edit', $entrada->id)}}">Modificar</x-link-button>
            <x-secondary-link-button id="" href="">Eliminar</x-link-button>
        </div>
      </div>
    </section>
  </main>
</x-layout>
