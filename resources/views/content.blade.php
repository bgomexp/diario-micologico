<x-layout title="Página personal">
<main class="h-auto">
<section class>
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-14 lg:px-12">
        <x-titulo>¡Hola, @auth{{Auth::user()->name}}@endauth!</x-titulo>
        <x-subtitulo>Nos alegramos de verte. ¿Qué quieres hacer hoy?</x-subtitulo>
    </div>
    <div class="bg-brown-300 py-8 h-auto">
        <div class="p-1 flex flex-wrap items-center justify-center">

    <a href="{{ route('entradas.create') }}">
        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-mediumgreen rounded-lg max-w-xs shadow-lg group cursor-pointer">
            <svg class="absolute bottom-0 left-0 mb-8 scale-150 group-hover:scale-[1.65] transition-transform"
                viewBox="0 0 375 283" fill="none" style="opacity: 0.1;">
                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
            </svg>
            <div class="relative pt-6 px-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                </div>
                <img class="relative w-40" src="{{ asset('images/basket.png') }}" alt="">
            </div>
            <div class="relative text-white px-4 pb-4 mt-6">
                <div class="flex justify-between">
                    <span class="block font-medium text-xl font-youngserif">Registrar entrada</span>
                </div>
            </div>
        </div>
    </a>

    <a href="{{ route('entradas.index') }}">
        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-darkgreen rounded-lg max-w-xs shadow-lg group cursor-pointer">
            <svg class="absolute bottom-0 left-0 mb-8 scale-150 group-hover:scale-[1.65] transition-transform" viewBox="0 0 375 283" fill="none"
                style="opacity: 0.1;">
                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
            </svg>
            <div class="relative pt-6 px-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                </div>
                <img class="relative w-40" src="{{ asset('images/book.png') }}" alt="">
            </div>
            <div class="relative text-white px-4 pb-4 mt-6">
                <div class="flex justify-between">
                    <span class="block font-medium font-youngserif text-xl">Consultar diario</span>
                </div>
            </div>
        </div>
    </a>

    <a href="{{ route('estadisticas') }}">
        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-mediumgreen rounded-lg max-w-xs shadow-lg group cursor-pointer">
            <svg class="absolute bottom-0 left-0 mb-8 scale-150 group-hover:scale-[1.65] transition-transform" viewBox="0 0 375 283" fill="none"
                style="opacity: 0.1;">
                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
            </svg>
            <div class="relative pt-6 px-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                </div>
                <img class="relative w-40" src="{{ asset('images/analytics.png') }}" alt="">
            </div>
            <div class="relative text-white px-4 pb-4 mt-6">
                <div class="flex justify-between">
                    <span class="block font-medium font-youngserif text-xl">Ver estadísticas</span>
                </div>
            </div>
        </div>
    </a>

    <a href="{{ route('especies.index') }}">
        <div class="flex-shrink-0 m-6 relative overflow-hidden bg-darkgreen rounded-lg max-w-xs shadow-lg group cursor-pointer">
            <svg class="absolute bottom-0 left-0 mb-8 scale-150 group-hover:scale-[1.65] transition-transform" viewBox="0 0 375 283" fill="none"
                style="opacity: 0.1;">
                <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
            </svg>
            <div class="relative pt-6 px-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                    style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                </div>
                <img class="relative w-40" src="{{ asset('images/mushroom.png') }}" alt="">
            </div>
            <div class="relative text-white px-4 pb-4 mt-6">
                <div class="flex justify-between">
                    <span class="block font-medium font-youngserif text-xl">Consultar especies</span>
                </div>
            </div>
        </div>
    </a>
    <div>
</section>
</main>
</x-layout>