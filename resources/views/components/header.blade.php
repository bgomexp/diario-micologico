<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-4">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="/" class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/5635/5635613.png" class="mr-3 h-6 sm:h-9" alt="logo" /> <!--Placeholder logo-->
                <h1 class="self-center text-2xl font-semibold whitespace-nowrap">Diario Micológico</h1>
            </a>

            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Inicio</a>
                    </li>
                    <li>
                        <a href="{{route('entradas.index')}}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Mi diario</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Mi perfil</a>
                    </li>
                    <li>
                        <a href="{{route('especies.index')}}" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Especies</a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center lg:order-2">            
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-lime-700 md:me-0 focus:ring-2 focus:ring-lime-100" type="button">
                <span class="sr-only">Abrir menú de usuario</span>
                <img class="w-8 h-8 me-2 rounded-full" src="https://cdn-icons-png.flaticon.com/512/4122/4122823.png" alt="user photo">
                @auth {{Auth::user()->name}} @endauth
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownAvatarName" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                    <div class="px-4 py-3 text-sm text-gray-900">
                    <div class="font-medium ">@auth {{Auth::user()->name}} @endauth</div>
                    <div class="truncate">@auth {{Auth::user()->email}} @endauth</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Mi cuenta</a>
                    </li>
                    </ul>
                    <div class="py-2">
                    <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>