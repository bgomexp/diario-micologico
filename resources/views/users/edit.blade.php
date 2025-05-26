<x-layout title="Mi cuenta">
<main class="flex flex-col items-center">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-1 text-3xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl xl:text-3xl">Mi cuenta</h2>
    </div>
    <form class="2xl:w-1/3 xl:w-1/3 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/4" method="post" action="{{ route('users.updatedata') }}">
    @csrf
    @method('PUT')
        <h3 class="mb-1 text-xl font-medium tracking-tight leading-none text-gray-900 lg:mb-6 md:text-2xl xl:text-xl">Información personal</h3>
        <div class="flex gap-3 justify-between w-full">
            <div class="w-1/2">
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Nombre</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" value="{{ old('name', $user->name) }}">
                </div>
                <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('name') }}</p>
            </div>
            
            <div class="w-1/2">
                <label for="surname" class="block text-sm/6 font-medium text-gray-900">Apellidos</label>
                <div class="mt-2">
                    <input id="surname" name="surname" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" value="{{ old('surname', $user->surname) }}">
                </div>
                <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('surname') }}</p>
            </div>
        </div>
        
        <div class="flex gap-3 justify-between w-full">
            <div class="w-full">
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo electrónico</label>
                <div class="mt-2">
                    <input id="email" name="email" type="text" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6" value="{{ old('email', $user->email) }}">
                </div>
                <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('email') }}</p>
            </div>
        </div>

        <div class="mt-5 flex justify-end">
            <x-submit-button>Guardar</x-submit-button>
        </div>
        <hr class="h-px my-1 bg-gray-200 border-0">
    </form>
    <form class="2xl:w-1/3 xl:w-1/3 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/4 mt-3" method="post" action="{{ route('users.updatepassword') }}">
    @csrf
    @method('PUT')
        <h3 class="mb-1 text-xl font-medium tracking-tight leading-none text-gray-900 lg:mb-6 md:text-2xl xl:text-xl">Cambiar contraseña</h3>
        <div class="w-full">
            <label for="old_password" class="block text-sm/6 font-medium text-gray-900">Constraseña actual</label>
            <div class="mt-2">
                <input id="old_password" name="old_password" type="password" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
            </div>
            <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('old_password') }}</p>
        </div>
        <div class="w-full">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Nueva constraseña</label>
            <div class="mt-2">
                <input id="password" name="password" type="password" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
            </div>
            <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('password') }}</p>
        </div>
        <div class="w-full">
            <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirmar constraseña</label>
            <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full h-10 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-0 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
            </div>
        </div>

        <div class="mt-5 flex justify-end">
            <x-submit-button>Guardar</x-submit-button>
        </div>
        <hr class="h-px my-1 bg-gray-200 border-0">
    </form>
    <div class="2xl:w-1/3 xl:w-1/3 lg:w-3/5 md:w-3/5 sm:w-3/5 w-4/4 pt-3 pb-10">
        <x-tertiary-button id="btnEliminar">Eliminar cuenta</x-tertiary-button>
    </div>

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
                    <h3 class="text-base font-semibold text-gray-900" id="modal-title">Eliminar cuenta</h3>
                    <div class="mt-2">
                      <p class="text-sm text-gray-500">¿Seguro que quieres eliminar tu cuenta de usuario? Todos los datos se perderán para siempre.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <form action="{{ route('users.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cursor-pointer focus:outline-none text-gray-700 inline-flex w-full justify-center bg-gray-50 shadow-xs sm:ml-3 sm:w-auto border-1 border-gray-300 hover:bg-white font-medium rounded-lg text-sm px-5 py-2">Eliminar cuenta</button>
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
