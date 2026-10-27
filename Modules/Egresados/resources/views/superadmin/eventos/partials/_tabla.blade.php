{{-- Tabla Principal de Eventos Institucionales --}}
<div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
    
    <!-- Toolbar de Búsqueda y Filtros -->
    <div class="p-4 sm:p-5 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3 bg-[#FAFCF9]">
        <div class="relative flex-1 min-w-[220px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
            <input type="text" 
                   id="eventSearchInput" 
                   onkeyup="filterEventsTable()" 
                   placeholder="Buscar evento por ID, nombre o tipo..." 
                   class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
        </div>

        <div>
            <select id="eventStatusFilter" 
                    onchange="filterEventsTable()" 
                    class="px-3 py-2 text-xs sm:text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 font-medium text-gray-700 outline-hidden cursor-pointer">
                <option value="">-- Todos los Estados --</option>
                <option value="PROGRAMADO">Programados</option>
                <option value="REALIZADO">Realizados</option>
                <option value="EN CURSO">En Curso</option>
                <option value="CANCELADO">Cancelados</option>
            </select>
        </div>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs sm:text-sm border-collapse" id="eventosTable">
            <thead>
                <tr class="bg-[#FAFCF9] border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                    <th class="py-3.5 px-4">ID</th>
                    <th class="py-3.5 px-4">Evento</th>
                    <th class="py-3.5 px-4">Tipo</th>
                    <th class="py-3.5 px-4">Fecha</th>
                    <th class="py-3.5 px-4">Estado</th>
                    <th class="py-3.5 px-4">Registro</th>
                    <th class="py-3.5 px-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($eventos as $index => $item)
                    @php
                        $jsonData = json_encode($item);
                        $statusClass = match(strtoupper($item['status'] ?? '')) {
                            'REALIZADO' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'PROGRAMADO' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'EN CURSO' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'CANCELADO' => 'bg-red-50 text-red-700 border-red-200',
                            default => 'bg-gray-50 text-gray-700 border-gray-200',
                        };
                    @endphp
                    <tr class="event-row transition cursor-pointer hover:bg-[#F4FAF5] {{ $index === 0 ? 'bg-emerald-50/50 font-medium' : '' }}" 
                        id="evt-row-{{ $item['id'] }}"
                        data-id="{{ $item['id'] }}"
                        data-title="{{ $item['title'] }}"
                        data-type="{{ $item['type'] }}"
                        data-status="{{ $item['status'] }}"
                        onclick="selectEvento({{ $jsonData }}, 'evt-row-{{ $item['id'] }}')">
                        
                        <td class="py-3.5 px-4 font-bold text-[#00131E]">
                            {{ $item['id'] }}
                        </td>

                        <td class="py-3.5 px-4">
                            <div class="font-bold text-gray-900">{{ $item['title'] }}</div>
                            <div class="text-[11.5px] text-gray-500 flex items-center gap-1 mt-0.5">
                                <i class="fa-solid fa-location-dot text-[10px] text-gray-400"></i>
                                <span>{{ $item['location'] }}</span>
                            </div>
                        </td>

                        <td class="py-3.5 px-4 text-xs text-gray-600 font-medium whitespace-nowrap">
                            {{ $item['type'] }}
                        </td>

                        <td class="py-3.5 px-4 text-xs text-gray-600 whitespace-nowrap">
                            {{ $item['date'] }}
                        </td>

                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusClass }}">
                                {{ $item['status'] }}
                            </span>
                        </td>

                        <td class="py-3.5 px-4 min-w-[120px]">
                            <div class="space-y-1">
                                <div class="text-[11px] font-bold text-gray-700 flex justify-between">
                                    <span>{{ $item['registrados'] }} / {{ $item['cupo'] }}</span>
                                    <span>{{ $item['rate'] }}</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-1.5 rounded-full" style="width: {{ $item['rate_num'] }}%;"></div>
                                </div>
                            </div>
                        </td>

                        <td class="py-3.5 px-4 text-center whitespace-nowrap" onclick="event.stopPropagation();">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" 
                                        onclick="selectEvento({{ $jsonData }}, 'evt-row-{{ $item['id'] }}')" 
                                        class="w-7 h-7 rounded-lg border border-gray-200 text-gray-500 hover:text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300 inline-flex items-center justify-center transition cursor-pointer text-xs"
                                        title="Ver detalles">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button type="button" 
                                        onclick="alert('Edición rápida del evento: {{ $item['title'] }}')" 
                                        class="w-7 h-7 rounded-lg border border-gray-200 text-gray-500 hover:text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300 inline-flex items-center justify-center transition cursor-pointer text-xs"
                                        title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-400 text-xs sm:text-sm">
                            No hay eventos programados en este momento.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
