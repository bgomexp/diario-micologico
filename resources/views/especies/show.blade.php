<x-layout title="Especie">
  <main>
    <section class="bg-white flex flex-col items-center">
      <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-2 text-3xl font-bold tracking-tight leading-none text-gray-800 lg:mb-2 md:text-4xl xl:text-3xl">{{ $especie->genero.substr($especie->especie, 2) }}</h2>
      </div>
      <div class="mt-3 w-2/5 relative  sm:rounded-lg">
        <div class="flow-root">
          <dl class="-my-3 divide-y divide-gray-200 text-sm">
            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Género</dt>
              <dd class="text-gray-700 sm:col-span-2">{{ $especie->genero }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Especie</dt>
              <dd class="text-gray-700 sm:col-span-2">{{ $especie->especie }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Nombre común</dt>
              <dd class="text-gray-700 sm:col-span-2">{{ isset($especie->nombre_comun) ? $especie->nombre_comun : 'No registrado' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Toxicidad</dt>
              <dd class="text-gray-700 sm:col-span-2">{{ isset($especie->toxicidad) ? strtoupper($especie->toxicidad[0]) . substr($especie->toxicidad, 1) : 'No registrada' }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-gray-900">Comestibilidad</dt>
              <dd class="text-gray-700 sm:col-span-2">{{ isset($especie->comestibilidad) ? strtoupper($especie->comestibilidad[0]) . substr($especie->comestibilidad, 1) : 'No registrada' }}</dd>
            </div>
            
          </dl>
        </div>
        @if (Auth::user()->role=='admin')
        <div class="mt-6 w-full flex justify-end">
            <x-link-button id="" href="{{route('especies.edit', $especie->id)}}">Modificar</x-link-button>
            <x-secondary-button id="btnEliminar">Eliminar</x-secondary-button>
        </div>
        @endif
      </div>
    </section>
    <dialog id="confirmDialog">
      <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-lime-100 sm:mx-0 sm:size-10">
                    <svg class="size-6 text-lime-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-base font-semibold text-gray-900" id="modal-title">Eliminar especie</h3>
                    <div class="mt-2">
                      <p class="text-sm text-gray-500">¿Seguro que quieres eliminar esta especie de la base de datos? Todos los datos se perderán para siempre.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <form action="{{ route('especies.destroy', $especie->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cursor-pointer focus:outline-none text-gray-700 inline-flex w-full justify-center bg-gray-50 shadow-xs sm:ml-3 sm:w-auto border-1 border-gray-300 hover:bg-white font-medium rounded-lg text-sm px-5 py-2">Eliminar especie</button>
                </form>
                <button type="button" id="btnCancelarEliminar" class="cursor-pointer mt-3 inline-flex w-full justify-center shadow-xs ring-1 ring-gray-300 sm:mt-0 sm:w-auto focus:outline-none text-white bg-lime-700 hover:bg-lime-800 font-medium rounded-lg text-sm px-5 py-2">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </dialog>   
  </main>
    @push('scripts')
        @vite('resources/js/show-entrada.js')
    @endpush
</x-layout>
