<!-- ============================================== -->
<!-- 2. FILTROS Y TABLA DE REPORTES (2/3 DEL GRID) -->
<!-- ============================================== -->
<div class="lg:col-span-2 space-y-4">

    <!-- Card de Filtros Interactivos -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-xs space-y-3.5">
        <div class="flex items-center justify-between pb-2 border-b border-gray-50">
            <span class="text-xs font-bold text-gray-700 uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-sliders text-emerald-600"></i>
                Filtros de Búsqueda Rápida
            </span>
            <span class="text-[11px] text-gray-400">Filtrado en tiempo real</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Programa</label>
                <select id="filterPrograma" onchange="applyFilters()" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-emerald-600 outline-none transition">
                    <option value="">Todos los programas</option>
                    <option value="ADSO">ADSO (Software)</option>
                    <option value="Gestión Agroempresarial">Gestión Agroempresarial</option>
                    <option value="Producción Agrícola">Producción Agrícola</option>
                    <option value="Contabilización">Contabilización</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Tipo de Reporte</label>
                <select id="filterTipo" onchange="applyFilters()" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-emerald-600 outline-none transition">
                    <option value="">Todos los tipos</option>
                    <option value="EMPLEABILIDAD">Empleabilidad</option>
                    <option value="SEGUIMIENTO">Seguimiento</option>
                    <option value="ENCUESTAS">Encuestas</option>
                    <option value="DIRECTORIO">Directorio</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Formato</label>
                <select id="filterFormato" onchange="applyFilters()" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-emerald-600 outline-none transition">
                    <option value="">Todos</option>
                    <option value="EXCEL">Excel (.csv/.xlsx)</option>
                    <option value="PDF">PDF Institucional</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Buscar por Nombre</label>
                <div class="relative">
                    <input type="text" id="filterText" onkeyup="applyFilters()" placeholder="Buscar reporte..." 
                           class="w-full pl-8 pr-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-emerald-600 outline-none transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Principal de Reportes -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="p-4 border-b border-gray-50 flex items-center justify-between">
            <h2 class="font-editorial text-base font-bold text-[#00131E] flex items-center gap-2">
                <i class="fa-solid fa-table-list text-emerald-600 text-sm"></i>
                Listado de Reportes Disponibles
            </h2>
            <span class="text-xs font-semibold text-gray-400">Haz clic en una fila para ver su desglose lateral</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs" id="reportesTable">
                <thead class="bg-gray-50/80 text-gray-500 font-bold uppercase tracking-wider text-[10px] border-b border-gray-100">
                    <tr>
                        <th class="py-3.5 px-4">ID</th>
                        <th class="py-3.5 px-4">Reporte</th>
                        <th class="py-3.5 px-4">Fecha</th>
                        <th class="py-3.5 px-4">Generado por</th>
                        <th class="py-3.5 px-4">Formato</th>
                        <th class="py-3.5 px-4">Estado</th>
                        <th class="py-3.5 px-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($reportes as $index => $item)
                        @php
                            $jsonData = json_encode($item);
                        @endphp
                        <tr class="report-row hover:bg-emerald-50/40 cursor-pointer transition {{ $index === 0 ? 'bg-emerald-50/60 font-semibold' : '' }}" 
                            id="rep-row-{{ $item['id'] }}"
                            data-id="{{ $item['id'] }}"
                            data-program="{{ $item['program'] ?? '' }}"
                            data-title="{{ $item['title'] ?? '' }}"
                            data-type="{{ $item['type'] ?? '' }}"
                            data-format="{{ $item['format'] ?? '' }}"
                            onclick="selectReporte({{ $jsonData }}, 'rep-row-{{ $item['id'] }}')">
                            
                            <td class="py-3.5 px-4 font-bold text-emerald-800">
                                {{ $item['id'] }}
                            </td>

                            <td class="py-3.5 px-4">
                                <div class="font-bold text-gray-900">{{ $item['title'] }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">
                                    <i class="fa-solid fa-graduation-cap text-[9px] mr-1"></i>{{ $item['program'] ?? 'General' }}
                                </div>
                            </td>

                            <td class="py-3.5 px-4 text-gray-500 font-medium">
                                {{ $item['date'] }}
                            </td>

                            <td class="py-3.5 px-4 font-medium text-gray-600">
                                {{ $item['generated_by'] }}
                            </td>

                            <td class="py-3.5 px-4">
                                @if(($item['format'] ?? '') === 'PDF')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-red-50 text-red-700 border border-red-200">
                                        <i class="fa-solid fa-file-pdf"></i> PDF
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-file-excel"></i> Excel
                                    </span>
                                @endif
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $item['status'] ?? 'GENERADO' }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4 text-center" onclick="event.stopPropagation();">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" 
                                            onclick="selectReporte({{ $jsonData }}, 'rep-row-{{ $item['id'] }}')" 
                                            class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 flex items-center justify-center transition cursor-pointer" 
                                            title="Ver Detalle">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </button>
                                    <a href="{{ route('egresados.superadmin.reportes.export', ['title' => $item['title'], 'format' => $item['format'] ?? 'EXCEL']) }}" 
                                       class="w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 flex items-center justify-center transition cursor-pointer" 
                                       title="Descargar">
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <div>No se han generado reportes institucionales todavía.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
