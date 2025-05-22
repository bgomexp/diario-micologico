@php
    $index = $index ?? '__INDEX__';
@endphp
<div class="fila flex justify-between gap-2 my-2 border-b border-gray-900/10 pb-2"> <!--Esto es lo que se añade y quita-->
    <div class="w-full">
        <select name = "setas[{{ $index }}][especie]"
        data-select='{
            "placeholder": "<span class=\"text-gray-500 text-sm\">Selecciona una especie</span>",
            "searchPlaceholder": "Buscar...",
            "searchNoResultText": "No hay resultados",
            "searchNoResultClasses": "text-gray-500 text-sm mx-2.5",
            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
            "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-lime-500 focus:border-lime-500 sm:text-sm/6",
            "hasSearch": true,
            "searchClasses": "w-full mt-1 rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-lime-500 focus:border-lime-500 sm:text-sm/6",
            "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
            "optionClasses": "text-sm advance-select-option selected:select-active hover:bg-gray-50 selected:bg-lime-100 selected:text-lime-700",
            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
            "extraMarkup": "<span class=\"icon-[tabler--caret-up-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
            }'
            class="hidden">
            <option value="">Choose</option>
            @foreach ($especies as $especie)
                <option value="{{ $especie->id }}" {{ (isset($data['especie']) && $data['especie'] == $especie->id) ? 'selected' : '' }}> {{ $especie->genero.substr($especie->especie, 2) }} {{ isset($especie->nombre_comun)? "(".$especie->nombre_comun.")" : "" }} </option>
            @endforeach
        </select>
    </div>

    <div class="w-1/5">
        <input type="number" name="setas[{{ $index }}][cantidad]" value="{{ $data['cantidad'] ?? 1 }}" min="1" class="w-full rounded-lg bg-white border-gray-300 px-3 py-1.5 text-base text-gray-900 focus:ring-lime-500 focus:border-lime-500 placeholder:text-gray-500  sm:text-sm/6">
    </div>
    <div class="flex px-1">
        <button type="button" class="cursor-pointer text-sm font-medium text-red-600 hover:underline">Eliminar</button>
    </div>
</div>