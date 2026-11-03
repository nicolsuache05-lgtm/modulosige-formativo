<!-- ============================================== -->
<!-- 2. FILTROS Y TABLA DE EVENTOS (2/3 DEL GRID) -->
<!-- ============================================== -->
<div class="lg:col-span-2 space-y-4">
    
    <!-- Card de Filtros Interactivos (Identidad SENA ERP) -->
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
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Buscar Evento</label>
                <div class="relative">
                    <input type="text" 
                           id="eventSearchInput" 
                           onkeyup="filterEventsTable()" 
                           placeholder="Buscar por ID, nombre o lugar..." 
                           class="w-full pl-8 pr-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Tipo de Evento</label>
                <select id="eventTypeFilter" 
                        onchange="filterEventsTable()" 
                        class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none transition cursor-pointer">
                    <option value="">Todos los tipos</option>
                    <option value="Feria">Feria laboral</option>
                    <option value="Taller">Taller práctico</option>
                    <option value="Encuentro">Encuentro institucional</option>
                    <option value="Hackathon">Concurso / Hackathon</option>
                    <option value="Conferencia">Conferencia / Charla</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Estado</label>
                <select id="eventStatusFilter" 
                        onchange="filterEventsTable()" 
                        class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none transition cursor-pointer">
                    <option value="">Todos los estados</option>
                    <option value="PROGRAMADO">Programados</option>
                    <option value="REALIZADO">Realizados</option>
                    <option value="EN CURSO">En Curso</option>
                    <option value="CANCELADO">Cancelados</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tabla Principal de Eventos -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
        
        <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between bg-white">
            <div>
                <h3 class="text-xs sm:text-sm font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-calendar-check text-[#39A900]"></i>
                    Listado de Eventos Disponibles
                </h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Haz clic en una fila para ver su desglose, gestionar asistentes o enviar invitaciones.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm border-collapse" id="eventosTable">
                <thead>
                    <tr class="bg-[#FAFCF9] border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4">ID</th>
                        <th class="py-3.5 px-4">Evento</th>
                        <th class="py-3.5 px-4">Tipo</th>
                        <th class="py-3.5 px-4">Fecha</th>
                        <th class="py-3.5 px-4">Estado</th>
                        <th class="py-3.5 px-4">Registro / Cupo</th>
                        <th class="py-3.5 px-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($eventos as $index => $item)
                        @php
                            $jsonData = json_encode($item);
                            $statusUpper = strtoupper($item['status'] ?? '');
                            $statusClass = match($statusUpper) {
                                'REALIZADO' => 'bg-[#001A29] text-[#62E31D] border-[#001A29]',
                                'PROGRAMADO' => 'bg-[#EAF7EE] text-[#166534] border-[#BBF7D0]',
                                'EN CURSO' => 'bg-emerald-100/70 text-emerald-900 border-emerald-300',
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
                            
                            <td class="py-3.5 px-4 font-bold text-[#00131E] whitespace-nowrap">
                                {{ $item['id'] }}
                            </td>

                            <td class="py-3.5 px-4">
                                <div class="font-bold text-gray-900">{{ $item['title'] }}</div>
                                <div class="text-[11.5px] text-gray-500 flex items-center gap-1 mt-0.5">
                                    <i class="fa-solid fa-location-dot text-[10px] text-[#39A900]"></i>
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
                                <span class="inline-block px-2.5 py-1 rounded-full text-[10.5px] font-extrabold border {{ $statusClass }}">
                                    {{ $item['status'] }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4 min-w-[120px]">
                                <div class="space-y-1">
                                    <div class="text-[11px] font-bold text-gray-700 flex justify-between">
                                        <span>{{ $item['registrados'] }} / {{ $item['cupo'] }}</span>
                                        <span class="text-[#166534] font-extrabold">{{ $item['rate'] }}</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-1.5 rounded-full" style="width: {{ $item['rate_num'] }}%;"></div>
                                    </div>
                                </div>
                            </td>

                            <td class="py-3.5 px-4 text-center whitespace-nowrap" onclick="event.stopPropagation();">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" 
                                            onclick="selectEvento({{ $jsonData }}, 'evt-row-{{ $item['id'] }}'); abrirModalDetalleEvento({{ $jsonData }});" 
                                            class="w-7 h-7 rounded-lg bg-[#EAF7EE] hover:bg-[#d8f3de] text-[#166534] border border-[#BBF7D0] inline-flex items-center justify-center transition cursor-pointer text-xs"
                                            title="Ver detalle completo (SENA ERP)">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button type="button" 
                                            onclick="selectEvento({{ $jsonData }}, 'evt-row-{{ $item['id'] }}'); abrirModalEditarEvento({{ $jsonData }});" 
                                            class="w-7 h-7 rounded-lg border border-gray-200 text-gray-500 hover:text-[#166534] hover:bg-[#EAF7EE] hover:border-[#BBF7D0] inline-flex items-center justify-center transition cursor-pointer text-xs"
                                            title="Editar evento">
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

</div>
