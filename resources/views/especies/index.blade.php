<x-layout title="Especies">
<main>
<section class="flex flex-col items-center">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-4xl">Especies</h2>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl">Estas son las especies que puedes añadir a las entradas de tu diario.</p>
    </div>
    <div class="mt-5 w-4/5 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                        class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
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
    {{ $especies->links() }}
    @if (Auth::user()->role=='admin')
    <div class="mt-6 w-4/5 flex justify-end">
        <x-link-button id="" href="{{route('especies.create')}}">Nueva especie</x-link-button>
    </div>
    @else
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <p class="font-light text-gray-500 md:text-lg xl:text-xl">¿No encuentras la que buscas? Puedes solicitar la inclusión de una especie <a class="font-normal cursor-pointer text-lime-600 hover:text-lime-500">aquí</a>.</p>
    </div>
    @endif
</section>
</main>
</x-layout>