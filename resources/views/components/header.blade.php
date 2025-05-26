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
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="cursor-pointer flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-lime-700 md:me-0 focus:ring-2 focus:ring-lime-100" type="button">
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
                    <div><span class="font-medium">@auth {{Auth::user()->name}} @endauth</span> @if(Auth::user()->role=='admin') (admin.) @endif</div>
                    <div class="truncate">@auth {{Auth::user()->email}} @endauth</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                    <li>
                        <a href="{{ route('users.edit', Auth::user()->id) }}" class="block px-4 py-2 hover:bg-gray-100">Mi cuenta</a>
                    </li>
                    </ul>
                    <div class="py-2">
                    <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<nav class="bg-white border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://cdn-icons-png.flaticon.com/512/5635/5635613.png" class="mr-3 h-6 sm:h-9" alt="logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap">Diario Micológico</span>
  </a>
  <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button type="button" class="flex text-sm bg-white rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Abrir menú de usuario</span>
        <img class="w-8 h-8 rounded-full" src="https://cdn-icons-png.flaticon.com/512/4122/4122823.png" alt="user photo">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm" id="user-dropdown">
        <div class="px-4 py-3 text-gray-900">
          <div class="truncate text-sm"><span class="font-medium">@auth {{Auth::user()->name}} @endauth</span> @if(Auth::user()->role=='admin') (admin.) @endif</div>
          <div class="truncate text-sm">@auth {{Auth::user()->email}} @endauth</div>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="{{ route('users.edit', Auth::user()->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi cuenta</a>
          </li>
          <li>
            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
      <li>
        <a href="#" class="block py-2 px-3 text-white bg-lime-700 rounded-sm md:bg-transparent md:text-lime-700 md:p-0" aria-current="page">Inicio</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-3 text-gray-700 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-700 md:p-0">Mi diario</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-3 text-gray-700 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-700 md:p-0">Mi perfil</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-3 text-gray-700 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-700 md:p-0">Especies</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
</header>