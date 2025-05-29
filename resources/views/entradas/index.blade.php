<x-layout title="Mi diario">
<main class="h-full">
<section class="flex flex-col items-center h-full">
    <div class="pt-8 pb-6 px-4 mx-auto max-w-screen-md text-center lg:pt-16 lg:px-12">
        <x-titulo>Mi diario</x-titulo>
        <x-subtitulo>Estas son todas las excursiones que has registrado en tu diario.</x-subtitulo>
    </div>
    <div class="w-full h-full flex flex-col items-center bg-brown-100 py-5">
        <div class="mt-3 w-4/5 relative overflow-x-auto sm:rounded-lg shadow-md">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-beige-100 bg-lightgreen text-darkgreen">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-calendar-days"></i> Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-location-dot"></i> Lugar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-comment"></i> Comentarios
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-basket-shopping"></i> Especies
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entradas as $entrada)
                        <tr
                            class="cursor-pointer odd:bg-brown-100 even:bg-brown-200 hover:bg-brown-300">
                            <td>
                                <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full px-6 py-4">
                                    {{ $entrada->fecha }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full px-6 py-4">
                                    {{ $entrada->lugar ?? "-" }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full px-6 py-4">
                                    {{ isset($entrada->comentarios) ? Str::limit($entrada->comentarios, 100, preserveWords: true) : "-" }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full px-6 py-4">
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
    </div>
</section>
</main>
</x-layout>