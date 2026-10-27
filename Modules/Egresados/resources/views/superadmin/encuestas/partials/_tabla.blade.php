<!-- ============================================== -->
<!-- 2. TABLA DE ENCUESTAS (COLUMNA IZQUIERDA 2/3) -->
<!-- ============================================== -->
<div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
    
    <!-- Toolbar de Búsqueda y Filtros -->
    <div class="p-4 sm:p-5 border-b border-gray-100 bg-[#FAFCF9] flex flex-wrap items-center justify-between gap-3">
        
        <!-- Buscador -->
        <div class="relative flex-1 min-w-[220px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
            <input type="text" 
                   id="surveySearchInput" 
                   onkeyup="filterSurveysTable()" 
                   placeholder="Buscar encuesta por ID, título o público..." 
                   class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none transition">
        </div>

        <!-- Filtro por Estado -->
        <select id="surveyStatusFilter" 
                onchange="filterSurveysTable()" 
                class="px-3.5 py-2 text-xs sm:text-sm font-semibold bg-white border border-gray-200 rounded-xl text-gray-700 outline-none focus:border-emerald-600 cursor-pointer">
            <option value="">-- Todos los Estados --</option>
            <option value="ACTIVA">Activas</option>
            <option value="CERRADA">Cerradas</option>
            <option value="BORRADOR">Borrador</option>
        </select>

    </div>

    <!-- Contenedor con Scroll Horizontal -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs sm:text-sm border-collapse" id="encuestasTable">
            <thead>
                <tr class="bg-[#F8FCF9] text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3.5 px-4 sm:px-5">ID</th>
                    <th class="py-3.5 px-4 sm:px-5">Nombre Encuesta</th>
                    <th class="py-3.5 px-4 sm:px-5">Estado</th>
                    <th class="py-3.5 px-4 sm:px-5">Dirigido a</th>
                    <th class="py-3.5 px-4 sm:px-5">Progreso</th>
                    <th class="py-3.5 px-4 sm:px-5 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($encuestas as $index => $item)
                    @php
                        $jsonData = json_encode($item);
                        $isFirst = ($index === 0);
                    @endphp
                    <tr class="encuesta-row hover:bg-emerald-50/40 transition cursor-pointer {{ $isFirst ? 'selected-row bg-emerald-50/60 border-l-4 border-emerald-600' : '' }}"
                        id="survey-row-{{ $item['id'] }}"
                        data-id="{{ $item['id'] }}"
                        data-title="{{ $item['title'] }}"
                        data-status="{{ $item['status'] }}"
                        onclick="selectEncuesta({{ $jsonData }}, 'survey-row-{{ $item['id'] }}')">
                        
                        <!-- ID -->
                        <td class="py-3.5 px-4 sm:px-5 font-bold text-[#00131E] whitespace-nowrap">
                            {{ $item['id'] }}
                        </td>

                        <!-- Título y Autor -->
                        <td class="py-3.5 px-4 sm:px-5">
                            <div class="font-bold text-gray-900 leading-snug">{{ $item['title'] }}</div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <p class="text-[11px] text-gray-500">
                                    Creado por: <span class="font-semibold text-blue-600">{{ $item['creado_por'] ?? 'Coordinación Académica' }}</span>
                                </p>
                            </div>
                            <div class="text-[10.5px] text-gray-400 mt-0.5">Creada: {{ $item['date'] }}</div>
                        </td>

                        <!-- Estado -->
                        <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap">
                            @if($item['status'] === 'ACTIVA')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    ACTIVA
                                </span>
                            @elseif($item['status'] === 'CERRADA')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    CERRADA
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    {{ $item['status'] }}
                                </span>
                            @endif
                        </td>

                        <!-- Dirigido a -->
                        <td class="py-3.5 px-4 sm:px-5 text-gray-600 font-medium whitespace-nowrap">
                            {{ $item['target'] }}
                        </td>

                        <!-- Barra de Progreso -->
                        <td class="py-3.5 px-4 sm:px-5 whitespace-nowrap min-w-[130px]">
                            <div class="space-y-1">
                                <div class="flex justify-between text-[11px] font-bold text-gray-700">
                                    <span>{{ $item['respondidas'] }}/{{ $item['enviadas'] }}</span>
                                    <span class="text-emerald-700 font-extrabold">{{ $item['rate'] }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-400 h-1.5 rounded-full transition-all duration-500" 
                                         style="width: {{ $item['rate_num'] }}%;"></div>
                                </div>
                            </div>
                        </td>

                        <!-- Acciones -->
                        <td class="py-3.5 px-4 sm:px-5 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5" onclick="event.stopPropagation();">
                                <button type="button" 
                                        onclick="selectEncuesta({{ $jsonData }}, 'survey-row-{{ $item['id'] }}')" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-emerald-700 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-300 transition shadow-2xs" 
                                        title="Ver detalles en panel lateral">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </button>
                                @if(!empty($item['url']))
                                    <a href="{{ $item['url'] }}" 
                                       target="_blank" 
                                       class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-blue-700 hover:bg-blue-50 border border-gray-200 hover:border-blue-300 transition shadow-2xs" 
                                       title="Abrir formulario externo">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 px-4 text-gray-500">
                            <i class="fa-regular fa-folder-open text-3xl text-gray-300 mb-2 block"></i>
                            <span class="font-bold text-gray-700 block">No se encontraron encuestas registradas</span>
                            <span class="text-xs text-gray-400">Haga clic en "+ Crear Encuesta" para registrar una nueva.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
