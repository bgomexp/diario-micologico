<x-layout title="Página personal">
<main class="bg-brown-100">
<section class>
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-14 lg:px-12">
        <x-titulo>Mis estadísticas</x-titulo>
        <x-subtitulo>Aquí puedes consultar algunas estadísticas asociadas a tu diario.</x-subtitulo>
    </div>
    <div class="border-t-3 border-b-3 border-mediumgreen bg-lightgreen flex items-center justify-center py-3">
        <label for="year" class=" font-normal md:text-lg xl:text-xl ">Estadísticas del año:</label>
        <div class="flex justify-center p-2 gap-2">
            <div class="min-w-25">
                <select name="year" id="year"
                data-select='{
                    "placeholder": "<span class=\"text-brown-800 opacity-50 text-base\">Año</span>",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-transparent border-brown-800 border-dashed px-3 py-1 text-base text-brown-800 focus:ring-0 focus:border-brown-800 focus:shadow-none",
                    "hasSearch": false,
                    "dropdownClasses": "advance-select-menu max-h-52 pt-1 overflow-y-auto bg-brown-100",
                    "optionClasses": "text-base text-brown-800 advance-select-option selected:select-active hover:bg-lightgreen selected:bg-mediumgreen selected:text-lime-900 selected:font-semibold",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                    "extraMarkup": "<span class=\"absolute end-3 top-1/2 -translate-y-1/2 pointer-events-none flex items-center justify-center\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-4 h-4 text-brown-800\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 9l-7 7-7-7\" /></svg></span>"
                    }'
                    class="hidden">
                    @foreach ($years as $year)
                        <option value="{{$year}}" @if ($year==$selectedYear) selected @endif>{{$year}} </option>
                    @endforeach
                </select>
            </div>            
        </div>
    </div>
    <div class="bg-brown-200 flex flex-col items-center pb-4 pt-8">
        <h3 class="mb-4 text-xl font-medium font-youngserif tracking-tight leading-none lg:mb-6 sm:text-2xl xl:text-3xl">Entradas registradas</h3>
        <x-subtitulo>
            Has registrado un total de
            @if($entradas == null)
                <span class="font-semibold">0</span> excursiones
            @elseif($entradas->count() == 1)
                <span class="font-semibold">1</span> excursión
            @else
                <span class="font-semibold">{{ $entradas->count() }}</span> excursiones
            @endif
        </x-subtitulo>
        <canvas id="graficoEntradas" class="w-full mt-3 lg:my-5 lg:max-w-250 md:max-h-100"></canvas>
    </div>
    <div class="bg-brown-300 flex flex-col items-center pb-4 pt-8">
        <h3 class="mb-4 text-xl font-medium font-youngserif tracking-tight leading-none lg:mb-6 sm:text-2xl xl:text-3xl">Ejemplares encontrados</h3>
        <x-subtitulo>
            Has encontrado un total de
            @if($numEjemplares == 1)
                <span class="font-semibold">1</span> ejemplar
            @else
                <span class="font-semibold">{{ $numEjemplares }}</span> ejemplares
            @endif
        </x-subtitulo>
        <canvas id="graficoUnidades" class="w-full mt-3 lg:my-5 lg:max-w-250 md:max-h-100"></canvas>
    </div>
    <div class="bg-brown-200 flex flex-col items-center pb-4 pt-8">
        <h3 class="mb-4 text-xl font-medium font-youngserif tracking-tight leading-none lg:mb-6 sm:text-2xl xl:text-3xl">Especies más comunes</h3>
        <x-subtitulo>
            @if($labelsTop->count()==1)
                Esta es la especie que más veces has registrado
            @elseif($labelsTop->count()==0)
                No has registrado ninguna especie
            @else
                Estas son las {{$labelsTop->count()}} especies que más veces has registrado
            @endif
        </x-subtitulo>
        @if($labelsTop->count()!=0)
            <canvas id="graficoTopEspecies" class="w-full mt-3 lg:my-5 lg:max-w-250 max-h-55 md:max-h-100"></canvas>
        @else
            <div class="h-10"></div>
        @endif
    </div>
</section>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if (app()->environment() !== 'testing')
    @push('scripts')
        @vite('resources/js/stats.js')
    @endpush
@endif
<script>
    window.onload = function() {
        //Gráfico entradas
        const valoresEntradas = {!! json_encode($entradasPorMes) !!};
        renderGraficoEntradas(valoresEntradas);
        //Gráfico ejemplares
        const valoresEj = {!! json_encode($ejemplaresPorMes) !!};
        renderGraficoUnidades(valoresEj);
        //Gráfico de top de especies
        const labelsTop = {!! json_encode($labelsTop) !!};
        const valoresTop = {!! json_encode($valoresTop) !!};
        renderGraficoTopEspecies(labelsTop, valoresTop);
    };
</script>
</x-layout>