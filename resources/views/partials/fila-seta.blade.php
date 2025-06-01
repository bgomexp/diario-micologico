@php
    $index = $index ?? '__INDEX__';
@endphp
<div class="fila flex flex-wrap sm:flex-nowrap justify-between gap-2 my-2 border-b border-brown-800/10 pb-2">
    <div class="w-full">
        <label for="setas[{{ $index }}][especie]" class="block text-sm/6 font-medium">Especie</label>
        <select name = "setas[{{ $index }}][especie]" id="setas[{{ $index }}][especie]"
        data-select='{
            "placeholder": "<span class=\"text-brown-800 opacity-50 text-sm\">Selecciona una especie</span>",
            "searchPlaceholder": "Buscar...",
            "searchNoResultText": "No hay resultados",
            "searchNoResultClasses": "text-brown-800 text-sm mx-2.5",
            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
            "toggleClasses": "h-9 advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40 rounded-lg bg-brown-100 border-brown-800 border-dashed px-3 py-1.5 text-sm text-brown-800 focus:ring-0 focus:border-brown-800 focus:shadow-none",
            "hasSearch": true,
            "searchClasses": "w-full mt-1 rounded-lg bg-transparent border-brown-800 px-3 py-1.5 text-sm text-brown-800 focus:ring-0 focus:border-brown-800",
            "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto bg-brown-100",
            "optionClasses": "text-sm text-brown-800 advance-select-option selected:select-active hover:bg-lightgreen selected:bg-mediumgreen selected:text-lime-900 selected:font-semibold",
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

    <div class="w-full sm:w-auto flex">
        <div class="w-full">
            <label for="setas[{{ $index }}][cantidad]" class="block text-sm/6 font-medium">Cantidad</label>
            <input type="number" name="setas[{{ $index }}][cantidad]" id="setas[{{ $index }}][cantidad]" value="{{ $data['cantidad'] ?? 1 }}" min="1" class="w-full h-9 bg-transparent rounded-lg border-brown-800 border-dashed px-3 py-1.5 text-sm focus:ring-0 focus:border-solid placeholder:text-brown-800 placeholder:opacity-50">
        </div>
        <div class="flex flex-col-reverse items-center px-3 mb-2.5 w-auto">
            <button type="button" class="cursor-pointer text-sm font-medium text-amber-700 hover:underline">Eliminar</button>
        </div>
    </div>
</div>