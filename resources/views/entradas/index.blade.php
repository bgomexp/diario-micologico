<x-layout title="Mi diario">
<main class="h-full">
<section class="flex flex-col items-center h-full">
    <div class="pt-8 pb-6 px-4 mx-auto max-w-screen-md text-center lg:pt-16 lg:px-12">
        <x-titulo>Mi diario</x-titulo>
        <x-subtitulo>{{ count($entradas)>0? "Estas son todas las excursiones que has registrado en tu diario." : "Aún no has registrado ninguna entrada en tu diario."}}</x-subtitulo>
    </div>
    <div class="w-full h-full flex flex-col items-center bg-brown-100 py-5 px-2">
        <div class="mt-3 w-full lg:max-w-4/5 xl:max-w-3/5 relative overflow-x-auto sm:rounded-lg shadow-md">
            @if (count($entradas)>0)
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-beige-100 bg-lightgreen text-darkgreen">
                    <tr>
                        <th scope="col" class="px-6 py-3 min-w-30">
                            <i class="fa-solid fa-calendar-days"></i> Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 min-w-30 lg:min-w-50">
                            <i class="fa-solid fa-pen-nib"></i> Título
                        </th>
                        <th scope="col" class="px-6 py-3 min-w-30">
                            <i class="fa-solid fa-location-dot"></i> Lugar
                        </th>
                        <th scope="col" class="px-6 py-3 min-w-40">
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
                                    {{ $entrada->titulo ?? "Sin título" }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('entradas.show', $entrada->id) }}" class="ubicacion block w-full h-full px-6 py-4">
                                    @if (isset($entrada->lugar))
                                        <span class="underline text-darkgreen hover:text-lime-600">Ver ubicación</span>
                                    @else
                                        Sin ubicación
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('entradas.show', $entrada->id) }}" class="block w-full h-full px-6 py-4">
                                    @if ($entrada->especies->isNotEmpty())
                                        <ul>
                                            @for ($i = 0; ($i < count($entrada->especies)) && ($i < 3); $i++)
                                                <li>{{ $entrada->especies[$i]->especie }} ({{ $entrada->especies[$i]->pivot->cantidad }})</li>
                                            @endfor
                                            @if (count($entrada->especies) > 3)
                                                <p class="underline text-darkgreen hover:text-lime-600">Ver más</p>
                                            @endif
                                        </ul>
                                    @else
                                        [Sin especies]
                                    @endif
                                </a>    
                            </td>
                        </tr>
                    @endforeach
                </tbody> 
            </table>
            @endif
        </div>
        <div class="w-full lg:max-w-4/5 xl:max-w-3/5 flex {{ count($entradas)>0? 'mt-6 justify-end': 'mt-0 justify-center'}}">
            <x-link-button id="" href="{{route('entradas.create')}}">Nueva entrada</x-link-button>
        </div>
    </div>
</section>
</main>
</x-layout>