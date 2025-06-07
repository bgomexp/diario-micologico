<x-layout title="Especies">
<main>
<section class="flex flex-col items-center h-full">
    <div class="pt-8 pb-6 px-4 mx-auto max-w-screen-md text-center lg:pt-16 lg:px-12">
        <x-titulo>Especies</x-titulo>
        <x-subtitulo>Estas son las especies que puedes añadir a las entradas de tu diario.</x-subtitulo>
    </div>
    <div class="w-full h-full flex flex-col items-center bg-brown-100 py-5 px-2">
        <div class="mt-3 w-full lg:max-w-4/5 relative overflow-x-auto sm:rounded-lg shadow-md">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-beige-100 bg-lightgreen text-darkgreen">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-book"></i></i> Género
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-book-open"></i></i> Especie
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-comments"></i> Nombre común
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-skull"></i> Toxicidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-utensils"></i> Comestibilidad
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($especies as $especie)
                        <tr
                            class="cursor-pointer odd:bg-brown-100 even:bg-brown-200 hover:bg-brown-300">
                            <td class="px-6 py-4">
                                <a href="{{ route('especies.show', $especie->id) }}" class="block w-full h-full">
                                    {{ $especie->genero }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('especies.show', $especie->id) }}" class="block w-full h-full">
                                    {{ $especie->especie }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('especies.show', $especie->id) }}" class="block w-full h-full">
                                    {{ isset($especie->nombre_comun) ? $especie->nombre_comun : "-" }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('especies.show', $especie->id) }}" class="block w-full h-full">
                                    {{ isset($especie->toxicidad) ? strtoupper($especie->toxicidad[0]) . substr($especie->toxicidad, 1) : "-" }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('especies.show', $especie->id) }}" class="block w-full h-full">
                                    {{ isset($especie->comestibilidad) ? strtoupper($especie->comestibilidad[0]) . substr($especie->comestibilidad, 1) : "-" }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody> 
            </table>
        </div>
        {{ $especies->links('vendor.pagination.tailwind') }}
        @if (Auth::user()->role=='admin')
        <div class="mt-6 w-full lg:max-w-4/5 flex justify-end">
            <x-link-button id="" href="{{route('especies.create')}}">Nueva especie</x-link-button>
        </div>
        @else
        <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
            <x-subtitulo>¿No encuentras la que buscas? Puedes solicitar la inclusión de una especie <a href="{{ route('especies.suggest') }}" class="font-normal cursor-pointer text-darkgreen hover:underline">aquí</a>.</x-subtitulo>
        </div>
        @endif
    </div>
</section>
</main>
</x-layout>