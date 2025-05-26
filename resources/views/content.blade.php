<x-layout title="Página personal">
<main>
<section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <h2 class="mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl xl:text-5xl">¡Hola, @auth{{Auth::user()->name}}@endauth!</h2>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl ">Aquí va la información para usuarios que han iniciado sesión.</p>
    </div>
    <div class="flex justify-center gap-5">
        <x-cardimglink/>
        <x-cardimglink/>
    </div>
    
</section>
</main>
</x-layout>