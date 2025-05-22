<x-layout title="Mi diario">
<main>
<section class="bg-white flex flex-col items-center">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-8 lg:px-12">
        <h2 class="mb-2 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-2 md:text-5xl xl:text-4xl">Mi diario</h2>
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
                        class="cursor-pointer odd:bg-white even:bg-gray-50 hover:bg-gray-100 border-b border-gray-200">
                        <td class="px-6 py-4">
                            <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full">
                                {{ $entrada->fecha }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full">
                                {{ $entrada->lugar ?? "-" }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full">
                                {{ isset($entrada->comentarios) ? Str::limit($entrada->comentarios, 100, preserveWords: true) : "-" }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full">
                                @if ($entrada->especies->isNotEmpty())
                                    <ul>
                                        @foreach ($entrada->especies as $especie)
                                            <li>{{ $especie->especie }} ({{ $especie->pivot->cantidad }})</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </a>    
                        </td>
                    </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
    <div class="mt-6 w-4/5 flex justify-end">
            <x-link-button id="" href="{{route('entradas.create')}}">Nueva entrada</x-link-button>
        </div>
</section>
</main>
</x-layout>