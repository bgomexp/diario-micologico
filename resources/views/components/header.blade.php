<header>
  <nav class="bg-beige-50 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 px-3">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('images/logo.png') }}" class="mr-3 mb-1 h-9" alt="logo" />
        <span class="self-center text-2xl lg:text-3xl font-medium font-youngserif whitespace-nowrap">Diario Micológico</span>
    </a>
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <button type="button" class="flex items-center rounded-full md:me-0 text-sm pe-1 font-medium hover:text-lime-700 cursor-pointer" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Abrir menú de usuario</span>
          <img class="w-8 h-8 rounded-full" src="{{ asset('images/user_icon.png') }}" alt="user photo">
          <span class="ml-2">@auth {{Auth::user()->name}} @endauth</span>
          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-brown-100 divide-y divide-brown-400 divide-dashed rounded-lg shadow-sm w-44" id="user-dropdown">
          <div class="px-4 py-3 bg-brown-200">
            <div class="truncate text-sm"><span class="font-medium">@auth {{Auth::user()->name}} @endauth</span> @if(Auth::user()->role=='admin') (admin.) @endif</div>
            <div class="truncate text-sm">@auth {{Auth::user()->email}} @endauth</div>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="{{ route('users.edit', Auth::user()->id) }}" class="block px-4 py-2 text-sm hover:bg-brown-200">Mi cuenta</a>
            </li>
            <li>
              <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm hover:bg-brown-200">Cerrar sesión</a>
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
      <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
        <li>
          <a href="/" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('/') ? 'text-green-950 bg-mediumgreen md:bg-transparent md:text-lime-700' : 'text-brown-800 hover:bg-lightgreen md:hover:bg-transparent md:hover:text-lime-700' }}">Inicio</a>
        </li>
        <li>
          <a href="{{route('entradas.index')}}" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('entradas*') ? 'text-green-950 bg-mediumgreen md:bg-transparent md:text-lime-700' : 'text-brown-800 hover:bg-lightgreen md:hover:bg-transparent md:hover:text-lime-700' }}">Mi diario</a>
        </li>
        <li>
          <a href="" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('perfil*') ? 'text-green-950 bg-mediumgreen md:bg-transparent md:text-lime-700' : 'text-brown-800 hover:bg-lightgreen md:hover:bg-transparent md:hover:text-lime-700' }}">Mi perfil</a>
        </li>
        <li>
          <a href="{{route('especies.index')}}" class="block py-2 px-3 rounded-sm md:p-0 {{ Request::is('especies*') ? 'text-green-950 bg-mediumgreen md:bg-transparent md:text-lime-700' : 'text-brown-800 hover:bg-lightgreen md:hover:bg-transparent md:hover:text-lime-700' }}">Especies</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
</header>