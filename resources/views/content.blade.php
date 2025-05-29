<x-layout title="Página personal">
<main class="h-full">
<section class="px-3">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <x-titulo>¡Hola, @auth{{Auth::user()->name}}@endauth!</x-titulo>
        <x-subtitulo>Nos alegramos de verte. ¿Qué quieres hacer hoy?</x-subtitulo>
    </div>
    <div class="bg-brown-300 h-full">
        <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">[OPCIONES]</div>
    <div>
</section>
</main>
</x-layout>