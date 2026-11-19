{{-- Modal para Editar Evento Institucional (Identidad SENA ERP) --}}
@php
    if (!isset($courses) || empty($courses) || (is_object($courses) && $courses->isEmpty())) {
        try {
            $courses = \Modules\SICA\Entities\Course::with('program')
                ->whereHas('apprentices')
                ->orderBy('code')
                ->get();
            if ($courses->isEmpty()) {
                $courses = \Modules\SICA\Entities\Course::with('program')->orderBy('code')->get();
            }
        } catch (\Throwable $e) {
            $courses = collect([]);
        }
    }

    $fichasEventos = [];
    $fichasEventos[] = [
        'code' => 'TODOS',
        'program' => 'General CEFA',
        'label' => 'Todos los Programas / Egresados (General CEFA)',
        'value' => 'Todos los Programas'
    ];
    $fichasEventos[] = [
        'code' => 'TODOS_EGRESADOS',
        'program' => 'General CEFA',
        'label' => 'Todos los Egresados (General CEFA)',
        'value' => 'Todos los Egresados'
    ];

    $knownCodes = [];
    if (isset($courses) && count($courses) > 0) {
        foreach($courses as $c) {
            $fCode = (string)$c->code;
            if (empty($fCode)) continue;
            $knownCodes[] = $fCode;
            $pName = $c->program ? $c->program->name : 'Programa General';
            $fichasEventos[] = [
                'code' => $fCode,
                'program' => $pName,
                'label' => "Ficha {$fCode} — {$pName}",
                'value' => "Ficha {$fCode} - {$pName}"
            ];
        }
    }

    $fichasFrecuentes = [
        ['code' => '3230026', 'program' => 'ADSO (Análisis y Desarrollo de Software)'],
        ['code' => '2692924', 'program' => 'Análisis y Desarrollo de Software (ADSO)'],
        ['code' => '3312595', 'program' => 'ADSO - Sistemas'],
        ['code' => '2847291', 'program' => 'Gestión Agroempresarial'],
        ['code' => '2918374', 'program' => 'Producción Ganadera'],
        ['code' => '694778',  'program' => 'Producción Agropecuaria'],
        ['code' => '735783',  'program' => 'Sistemas Agropecuarios EC'],
    ];
    foreach ($fichasFrecuentes as $ff) {
        if (!in_array($ff['code'], $knownCodes)) {
            $fichasEventos[] = [
                'code' => $ff['code'],
                'program' => $ff['program'],
                'label' => "Ficha {$ff['code']} — {$ff['program']}",
                'value' => "Ficha {$ff['code']} - {$ff['program']}"
            ];
            $knownCodes[] = $ff['code'];
        }
    }
@endphp
<div x-show="openEditModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openEditModal = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-8 sm:pt-12 p-3 sm:p-4" x-cloak>
    
    <div @click.away="openEditModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden transform">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE EVENTOS · SIGE ERP</span>
                        <span id="modalEditCodigo" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#39A900] text-white">EVT-012</span>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-white tracking-tight mt-0.5">Editar Evento Institucional</h3>
                    <p class="text-xs text-white/75 mt-0.5">Modifique los datos, logística y capacidad del evento.</p>
                </div>
            </div>
            <button @click="openEditModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll Suave -->
        <div class="px-6 sm:px-8 py-5 overflow-y-auto space-y-6 bg-[#f8fafc]/80">
            <form id="form-editar-evento" action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')
                
                <!-- Sección 1: Información Base del Evento -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-[#39A900]"></i>
                            Información Principal
                        </h4>
                        <span class="text-[10.5px] text-gray-400 font-medium">* Campos obligatorios</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-heading text-[#39A900]"></i>
                                <span>Nombre del Evento</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="edit_title" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Nombre del evento">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-tag text-[#39A900]"></i>
                                <span>Tipo de Evento</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="type" id="edit_type" required list="edit_tipos_sugeridos"
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. Feria laboral, Taller práctico">
                            <datalist id="edit_tipos_sugeridos">
                                <option value="Feria laboral">
                                <option value="Taller práctico">
                                <option value="Encuentro institucional">
                                <option value="Concurso / Hackathon">
                                <option value="Conferencia / Charla">
                            </datalist>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-flag text-[#39A900]"></i>
                                <span>Estado del Evento</span>
                            </label>
                            <select name="status" id="edit_status" 
                                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition">
                                <option value="PROGRAMADO">PROGRAMADO</option>
                                <option value="REALIZADO">REALIZADO</option>
                                <option value="EN CURSO">EN CURSO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Logística y Capacidad -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#001A29] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-users-gear text-[#001A29]"></i>
                            Logística y Capacidad
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-calendar text-[#39A900]"></i>
                                <span>Fecha</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="date" id="edit_date" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="DD/MM/AAAA">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-clock text-[#39A900]"></i>
                                <span>Horario</span>
                            </label>
                            <input type="text" name="time" id="edit_time" 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. 08:00 AM - 04:00 PM">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-[#39A900]"></i>
                                <span>Lugar / Ubicación</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="location" id="edit_location" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. Auditorio Principal CEFA">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-users text-[#39A900]"></i>
                                <span>Cupo Máximo (Total)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="cupo" id="edit_cupo" min="1" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. 200">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center justify-between">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                                    <span>Programas Dirigidos</span>
                                </span>
                                <span class="text-[10px] text-gray-400 font-semibold lowercase">Escribe la ficha o selecciona</span>
                            </label>

                            <div class="relative" 
                                 x-data="{
                                    dropdownOpen: false,
                                    fichasLista: {{ json_encode($fichasEventos) }},
                                    programaSeleccionado: '',
                                    init() {
                                        this.actualizarDesdeInput();
                                    },
                                    actualizarDesdeInput() {
                                        this.$nextTick(() => {
                                            const el = document.getElementById('edit_program');
                                            if (el) this.programaSeleccionado = el.value || 'Todos los Programas';
                                        });
                                    },
                                    get fichasFiltradas() {
                                        const q = (this.programaSeleccionado || '').trim().toLowerCase();
                                        if (!q || q === 'todos los programas') {
                                            return this.fichasLista;
                                        }
                                        return this.fichasLista.filter(item => {
                                            const s = item.search || (item.code + ' ' + item.label).toLowerCase();
                                            return s.includes(q) || item.label.toLowerCase().includes(q) || (item.value && item.value.toLowerCase().includes(q));
                                        });
                                    },
                                    seleccionarOpcion(item) {
                                        this.programaSeleccionado = item.value || item.label;
                                        const el = document.getElementById('edit_program');
                                        if (el) el.value = this.programaSeleccionado;
                                        this.dropdownOpen = false;
                                    },
                                    toggleDropdown() {
                                        this.dropdownOpen = !this.dropdownOpen;
                                    }
                                 }"
                                 @abrir-modal-editar-evento.window="actualizarDesdeInput()"
                                 @click.away="dropdownOpen = false">

                                <div class="relative flex items-center">
                                    <input type="text" 
                                           name="program" 
                                           id="edit_program" 
                                           x-model="programaSeleccionado"
                                           @focus="dropdownOpen = true"
                                           @click="dropdownOpen = true"
                                           @input="dropdownOpen = true"
                                           list="edit_programas_sugeridos"
                                           autocomplete="off"
                                           class="w-full pl-3.5 pr-10 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                           placeholder="Escriba el programa o ficha (ej. 3230026, ADSO, Todos...)">

                                    <button type="button" 
                                            @click.prevent="toggleDropdown()"
                                            class="absolute right-0 top-0 bottom-0 px-3 flex items-center justify-center text-gray-400 hover:text-[#39A900] transition cursor-pointer"
                                            title="Desplegar listado de fichas y programas">
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="dropdownOpen ? 'rotate-180 text-[#39A900]' : ''"></i>
                                    </button>
                                </div>

                                <!-- Menú Desplegable Flotante con Todas las Fichas del SENA -->
                                <div x-show="dropdownOpen"
                                     style="display: none;"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 -translate-y-1 scale-98"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 -translate-y-1 scale-98"
                                     class="absolute left-0 right-0 mt-1.5 bg-white border border-gray-200 rounded-2xl shadow-xl z-50 overflow-hidden max-h-60 flex flex-col">
                                    
                                    <div class="px-3 py-2 bg-gray-50 border-b border-gray-100 flex items-center justify-between text-[11px] text-gray-500 font-semibold">
                                        <span class="flex items-center gap-1.5">
                                            <i class="fa-solid fa-list-check text-[#39A900]"></i>
                                            <span>Fichas y Programas Disponibles</span>
                                        </span>
                                        <span class="text-[10px] text-gray-400" x-text="fichasFiltradas.length + ' opciones'"></span>
                                    </div>

                                    <div class="overflow-y-auto divide-y divide-gray-50 max-h-48">
                                        <template x-for="item in fichasFiltradas" :key="item.code">
                                            <button type="button" 
                                                    @click="seleccionarOpcion(item)"
                                                    class="w-full text-left px-3.5 py-2.5 hover:bg-emerald-50/60 transition flex items-center justify-between gap-2 group cursor-pointer"
                                                    :class="(programaSeleccionado === (item.value || item.label)) ? 'bg-emerald-50 font-bold text-[#166534]' : 'text-gray-700'">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <i class="fa-solid text-xs" :class="item.code === 'TODOS' || item.code === 'TODOS_EGRESADOS' ? 'fa-users text-[#39A900]' : 'fa-id-card text-gray-400 group-hover:text-[#39A900]'"></i>
                                                    <span class="text-xs truncate" x-text="item.label"></span>
                                                </div>
                                            </button>
                                        </template>

                                        <div x-show="fichasFiltradas.length === 0" class="p-4 text-center text-xs text-gray-400">
                                            <i class="fa-solid fa-magnifying-glass text-gray-300 text-base mb-1 block"></i>
                                            <span>No se encontró ninguna ficha con ese criterio. Puedes seguir digitando o seleccionar 'Todos los Programas'.</span>
                                        </div>
                                    </div>
                                </div>

                                <datalist id="edit_programas_sugeridos">
                                    <option value="Todos los Programas">Todos los Programas (General CEFA)</option>
                                    <option value="Todos los Egresados">Todos los Egresados (General CEFA)</option>
                                    @foreach($fichasEventos as $item)
                                        @if($item['code'] !== 'TODOS' && $item['code'] !== 'TODOS_EGRESADOS')
                                            <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
                                            <option value="{{ $item['code'] }}">{{ $item['label'] }}</option>
                                        @endif
                                    @endforeach
                                    <option value="Análisis y Desarrollo de Software (ADSO)">Análisis y Desarrollo de Software (ADSO)</option>
                                    <option value="Gestión Agroempresarial">Gestión Agroempresarial</option>
                                    <option value="Producción Ganadera">Producción Ganadera</option>
                                    <option value="Producción Agrícola">Producción Agrícola</option>
                                    <option value="Contabilización de Operaciones Comerciales y Financieras">Contabilización de Operaciones Comerciales y Financieras</option>
                                    <option value="Mantenimiento de Equipos de Cómputo">Mantenimiento de Equipos de Cómputo</option>
                                </datalist>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-pen text-[9px] text-[#39A900]"></i>
                                Puedes hacer clic en la flecha para ver el listado o escribir directamente el número de ficha o programa para filtrar.
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-align-left text-[#39A900]"></i>
                                <span>Descripción del Evento</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" id="edit_description" rows="3" required 
                                      class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition resize-none h-24" 
                                      placeholder="Descripción del evento y detalles logísticos..."></textarea>
                        </div>
                    </div>
                </div>

                @include('egresados::partials._evento_image_field', ['idPrefix' => 'edit_evt_img', 'fieldLabel' => 'Foto / Portada del Evento'])
            </form>
        </div>

        <!-- Pie del Modal con Identidad SENA ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-between bg-white">
            <span class="text-[11px] text-gray-400 hidden sm:inline flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-[#39A900]"></i>
                Módulo Institucional SIGE · CEFA
            </span>
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <button type="button" @click="openEditModal = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Cancelar
                </button>
                <button type="submit" form="form-editar-evento" class="px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Guardar Cambios</span>
                </button>
            </div>
        </div>

    </div>
</div>

