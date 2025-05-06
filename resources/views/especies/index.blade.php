<x-layout title="Especies">
<main>
<section class="bg-white dark:bg-gray-900 flex flex-col items-center">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h1 class="mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-4xl dark:text-white">Especies</h1>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">Estas son las especies que puedes añadir a las entradas de tu diario</p>
    </div>
    <div class="mt-5 w-4/5 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Género
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Especie
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre común
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Toxicidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Comestibilidad
                    </th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($especies as $especie)
                    <tr
                        class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $especie->genero }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $especie->especie }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $especie->nombre_comun }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $especie->toxicidad }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $especie->comestibilidad }}
                        </td>
                    </tr>
                @endforeach
            </tbody> 

            </tbody>
        </table>
    </div>
    {{ $especies->links() }}
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">¿No encuentras la que buscas? Puedes solicitar la inclusión de una especie <a class="font-normal cursor-pointer text-lime-600 hover:text-lime-500">aquí</a>.</p>
    </div>
</section>
</main>
</x-layout>