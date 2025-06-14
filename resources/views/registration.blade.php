<x-form-layout title="Registro">
<section class="bg-beige-100 py-12">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
      <div class="flex items-center mb-6 text-2xl font-medium font-youngserif">
          <img class="w-12 h-12 mr-2" src="{{ asset('images/logo.png') }}" alt="logo">
          Diario Micológico    
      </div>
      <div class="w-full bg-beige-50 rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-brown-100">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-medium leading-tight tracking-tight font-youngserif">
                  Crear una cuenta
              </h1>
              <form id="formRegistro" method="POST" action="{{route('validar-registro')}}" class="space-y-4 md:space-y-6">
                @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium">Nombre*</label>
                        <input type="text" name="name" id="name" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" placeholder="Tu nombre" value="{{old('name')}}">
                        <p id="nameErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('name') }}</p>
                    </div>
                    <div>
                        <label for="surname" class="block mb-2 text-sm font-medium">Apellidos</label>
                        <input type="text" name="surname" id="surname" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" placeholder="Tu nombre" value="{{old('surname')}}">
                        <p id="surnameErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('surname') }}</p>
                    </div>
                    <div>
                      <label for="email" class="block mb-2 text-sm font-medium">Correo electrónico*</label>
                      <input type="email" name="email" id="email" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" placeholder="correo@electronico.com" value="{{old('email')}}">
                      <p id="emailErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('email') }}</p>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium">Contraseña*</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" >
                      <p id="passwordErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('password') }}</p>
                  </div>
                  <div>
                      <label for="password_confirmation" class="block mb-2 text-sm font-medium">Confirmar contraseña*</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" >
                      <p id="confirmPasswordErrors" class="text-amber-600 text-xs italic mt-2"></p>
                  </div>
                  <button id="btnCrearCuenta" type="submit" class="w-full cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Crear cuenta</button>
                  <p class="text-sm font-light">
                      ¿Ya tienes cuenta? <a href="{{route('login')}}" class="font-medium text-darkgreen hover:underline">Inicia sesión aquí</a>
                  </p>
                  <p class="text-xs font-medium">
                      *Campo obligatorio
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
@if (app()->environment() !== 'testing')
    @push('scripts')
        @vite('resources/js/registration-validation.js')
    @endpush
@endif

</x-form-layout>