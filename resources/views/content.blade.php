<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
    @vite('resources/css/app.css')
</head>
<body>
<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="#" class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/5635/5635613.png" class="mr-3 h-6 sm:h-9" alt="logo" /> <!--Placeholder logo-->
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Diario Micológico</span>
            </a>
            <div class="flex items-center lg:order-2">
                <a href="{{route('logout')}}" class="text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:ring-lime-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-lime-600 dark:hover:bg-lime-700 focus:outline-none dark:focus:ring-lime-800">Cerrar sesión</a>
            </div>
        </div>
    </nav>
</header>
<main>
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-6xl dark:text-white">Página personal @auth de {{Auth::user()->name}} @endauth</h1>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">Aquí va la información para usuarios que han iniciado sesión.</p>
    </div>
</section>
</main>
</body>
</html>