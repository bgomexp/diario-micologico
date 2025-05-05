<x-layout title="Página personal">
<x-header/>
<main>
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-6xl dark:text-white">Página personal @auth de {{Auth::user()->name}} @endauth</h1>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">Aquí va la información para usuarios que han iniciado sesión.</p>
    </div>
</section>
</main>
</x-layout>