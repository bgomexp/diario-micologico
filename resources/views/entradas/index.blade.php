<x-layout title="Mi diario">
<main>
<section class="bg-white flex flex-col items-center">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-2 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-2 md:text-5xl xl:text-4xl">Mi diario</h2>
    </div>
    <div class="w-4/5 flex justify-end">
            <x-link-button id="" href="{{route('entradas.create')}}">Nueva entrada</x-link-button>
        </div>
    <div class="mt-3 w-4/5 relative overflow-x-auto sm:rounded-lg shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lugar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Comentarios
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Especies
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entradas as $entrada)
                    <tr
                        class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $entrada->fecha }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $entrada->lugar }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $entrada->comentarios }}
                        </td>
                        <td class="px-6 py-4">
                            Especies
                        </td>
                    </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
</section>
</main>
</x-layout>