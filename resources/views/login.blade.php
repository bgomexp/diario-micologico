<x-form-layout title="Iniciar sesión">
    <section class="bg-gray-50">
        @if(session('warning'))
        <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
            <span class="font-medium">Error!</span> {{ session('warning') }}
        </div>    
        @endif
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            <img class="w-12 h-12 mr-2" src="https://cdn-icons-png.flaticon.com/512/5635/5635613.png" alt="logo"> <!--Placeholder logo-->
            Diario Micológico    
        </a>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                    Iniciar sesión
                </h1>
                <form method="POST" action="{{route('iniciar-sesion')}}" class="space-y-4 md:space-y-6">
                    @csrf
                        <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-600 focus:border-lime-600 block w-full p-2.5" placeholder="correo@electronico.com" value="{{old('email')}}" required="">
                        <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('email') }}</p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-600 focus:border-lime-600 block w-full p-2.5" required="">
                        <p class="text-red-500 text-xs italic mt-2"> {{ $errors->first('password') }}</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-lime-300">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-light text-gray-500">Recuérdame</label>
                        </div>
                    </div>

                    <button type="submit" class="w-full cursor-pointer text-white bg-lime-600 hover:bg-lime-700 focus:ring-1 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Iniciar sesión</button>
                    <p class="text-sm font-light text-gray-500">
                        ¿No tienes cuenta? <a href="{{route('registro')}}" class="font-medium text-lime-700 hover:underline">Regístrate aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </section>
</x-form-layout>