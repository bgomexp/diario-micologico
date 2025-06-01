<x-form-layout title="Iniciar sesión">
    <section>
        @if(session('fail'))
        <x-alerts.fail>{{ session('fail') }}</x-alerts.fail>   
        @endif
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="flex items-center mb-6 text-2xl font-medium text-brown-800 font-youngserif">
            <img class="w-12 h-12 mr-2" src="{{ asset('images/logo.png') }}" alt="logo">
            Diario Micológico    
        </div>
        <div class="w-full rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-brown-100">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-medium leading-tight tracking-tight text-brown-800 font-youngserif">
                    Iniciar sesión
                </h1>
                <form id="formLogin" method="POST" action="{{route('iniciar-sesion')}}" class="space-y-4 md:space-y-6">
                    @csrf
                        <div>
                        <label for="email" class="block mb-2 text-sm font-medium">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" placeholder="correo@electronico.com" value="{{old('email')}}" required="">
                        <p id="emailErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('email') }}</p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-brown-100 border-dashed border-brown-800 text-sm rounded-lg focus:ring-0 focus:border-solid block w-full p-2.5 placeholder:text-brown-800 placeholder:opacity-50" required="">
                        <p  id="passwordErrors" class="text-amber-600 text-xs italic mt-2"> {{ $errors->first('password') }}</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 text-darkgreen bg-transparent border-mediumgreen rounded-sm focus:ring-darkgreen focus:ring-1">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-light">Recuérdame</label>
                        </div>
                    </div>

                    <button id="btnIniciarSesion" type="submit" class="w-full cursor-pointer text-darkgreen bg-lightgreen hover:bg-transparent border-1 border-lightgreen hover:border-brown-800 hover:text-brown-800 focus:ring-0 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Iniciar sesión</button>
                    <p class="text-sm font-light">
                        ¿No tienes cuenta? <a href="{{route('registro')}}" class="font-medium text-darkgreen hover:underline">Regístrate aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </section>
@push('scripts')
  @vite('resources/js/login-validation.js')
@endpush
</x-form-layout>