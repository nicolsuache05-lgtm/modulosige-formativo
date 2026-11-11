<!-- ============================================== -->
<!-- 2. FILTROS Y TABLA DE ENCUESTAS (2/3 DEL GRID) -->
<!-- ============================================== -->
<div class="lg:col-span-2 space-y-4">

    <!-- Card de Filtros Interactivos (Paleta SENA ERP) -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs space-y-3.5">
        <div class="flex items-center justify-between pb-2 border-b border-gray-50">
            <span class="text-xs font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-sliders text-[#39A900]"></i>
                Filtros de Búsqueda Rápida
            </span>
            <span class="text-[11px] text-gray-400">Filtrado en tiempo real</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Estado</label>
                <select id="surveyStatusFilter" onchange="filterSurveysTable()" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none transition">
                    <option value="">Todos los estados</option>
                    <option value="ACTIVA">Activas</option>
                    <option value="CERRADA">Cerradas</option>
                    <option value="BORRADOR">Borrador</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Público Objetivo</label>
                <select id="surveyTargetFilter" onchange="filterSurveysTable()" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none transition">
                    <option value="">Todos los públicos</option>
                    <option value="ADSO">Egresados ADSO</option>
                    <option value="Tecnólogos">Egresados Tecnólogos</option>
                    <option value="Todas">Todas las Especialidades</option>
                    <option value="Emprendedores">Egresados Emprendedores</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Buscar por Nombre o ID</label>
                <div class="relative">
                    <input type="text" id="surveySearchInput" onkeyup="filterSurveysTable()" placeholder="Buscar encuesta..." 
                           class="w-full pl-8 pr-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] outline-none transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Principal de Encuestas (Paleta SENA ERP) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="p-4 border-b border-gray-50 flex items-center justify-between">
            <div>
                <h2 class="font-editorial text-base font-bold text-[#00131E] flex items-center gap-2">
                    <i class="fa-solid fa-table-list text-[#39A900] text-sm"></i>
                    Listado de Encuestas Disponibles
                </h2>
                <span class="text-[11px] text-gray-400 mt-0.5 block">Haz clic en una fila para ver su desglose o gestionarla</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs" id="encuestasTable">
                <thead class="bg-gray-50/80 text-gray-500 font-bold uppercase tracking-wider text-[10px] border-b border-gray-100">
                    <tr>
                        <th class="py-3.5 px-4">ID</th>
                        <th class="py-3.5 px-4">Encuesta / Título</th>
                        <th class="py-3.5 px-4">Fecha</th>
                        <th class="py-3.5 px-4">Generado por</th>
                        <th class="py-3.5 px-4">Población</th>
                        <th class="py-3.5 px-4">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($encuestas as $index => $item)
                        @php
                            $jsonData = json_encode($item);
                            $isFirst = ($index === 0);
                        @endphp
                        <tr class="encuesta-row hover:bg-emerald-50/40 cursor-pointer transition {{ $isFirst ? 'bg-emerald-50/60 font-semibold border-l-4 border-[#39A900]' : '' }}" 
                            id="survey-row-{{ $item['id'] }}"
                            data-id="{{ $item['id'] }}"
                            data-title="{{ $item['title'] }}"
                            data-target="{{ $item['target'] }}"
                            data-status="{{ $item['status'] }}"
                            onclick="selectEncuesta({{ $jsonData }}, 'survey-row-{{ $item['id'] }}')">
                            
                            <!-- ID con color institucional -->
                            <td class="py-3.5 px-4 font-bold text-emerald-800 whitespace-nowrap">
                                {{ $item['id'] }}
                            </td>

                            <!-- Título y objetivo -->
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-gray-900 leading-snug">{{ $item['title'] }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">
                                    <i class="fa-solid fa-clipboard-question text-[9px] mr-1"></i>{{ Str::limit($item['description'] ?? '', 45) }}
                                </div>
                            </td>

                            <!-- Fecha -->
                            <td class="py-3.5 px-4 text-gray-500 font-medium whitespace-nowrap">
                                {{ $item['date'] }}
                            </td>

                            <!-- Generado por -->
                            <td class="py-3.5 px-4 font-medium text-gray-600 whitespace-nowrap">
                                {{ $item['creado_por'] ?? 'Coordinación Académica' }}
                            </td>

                            <!-- Dirigido a -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                                    <i class="fa-solid fa-users text-[9px]"></i> {{ $item['target'] }}
                                </span>
                            </td>

                            <!-- Estado -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($item['status'] === 'ACTIVA')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        ACTIVA
                                    </span>
                                @elseif($item['status'] === 'CERRADA')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-gray-100 text-gray-600 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        CERRADA
                                    </span>
                                    @if($item['auto_cerrada'] ?? false)
                                        <span class="block text-[9.5px] text-gray-400 font-medium mt-0.5" title="Cerrada automáticamente al cumplirse la fecha límite">
                                            <i class="fa-solid fa-calendar-xmark text-[8.5px]"></i> Por fecha límite
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ $item['status'] }}
                                    </span>
                                @endif
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

</div>
