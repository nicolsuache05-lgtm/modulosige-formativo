<!-- Modules/Egresados/Resources/views/superadmin/encuestas/partials/_modal_crear.blade.php -->
<!-- MODAL DE CREACIÓN / CONSTRUCTOR DE ENCUESTAS INSTITUCIONALES SENA ERP -->
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

    $fichasOptions = [];
    $fichasOptions[] = [
        'code' => 'TODOS',
        'program' => 'General CEFA',
        'label' => 'Todos los Egresados (General CEFA)',
        'value' => 'Todos los Egresados (General CEFA)',
        'search' => 'todos los egresados general cefa',
        'count' => 0
    ];
    if (isset($courses)) {
        foreach($courses as $c) {
            $fCode = (string)$c->code;
            $pName = $c->program ? $c->program->name : 'Programa General';
            $apprCount = method_exists($c, 'apprentices') ? $c->apprentices->count() : 0;
            $fichasOptions[] = [
                'code' => $fCode,
                'program' => $pName,
                'label' => "Ficha {$fCode} — {$pName}",
                'value' => "Ficha {$fCode} - {$pName}",
                'search' => strtolower("{$fCode} {$pName} ficha"),
                'count' => $apprCount
            ];
        }
    }
@endphp

<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModal = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center p-3 sm:p-4 pt-3 sm:pt-5" x-cloak>
    
    <!-- Modal Card Premium Institucional (max-w-4xl) -->
    <div @click.away="openModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-3xl max-w-4xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[96vh] overflow-hidden"
         
         {{-- LÓGICA ALPINE.JS DEL CONSTRUCTOR DE ENCUESTAS --}}
         x-data="{
            preguntas: [
                { id: Date.now(), texto: '', tipo: 'opcion_multiple', opciones: ['Totalmente de acuerdo', 'De acuerdo', 'En desacuerdo'], obligatoria: true }
            ],
            fichasLista: {{ json_encode($fichasOptions) }},
            dropdownOpen: false,
            publicoObjetivo: 'Todos los Egresados (General CEFA)',
            publicoError: '',

            get fichasFiltradas() {
                const q = (this.publicoObjetivo || '').trim().toLowerCase();
                if (!q) {
                    return this.fichasLista;
                }
                return this.fichasLista.filter(item => {
                    return item.search.includes(q) || item.label.toLowerCase().includes(q) || (item.value && item.value.toLowerCase().includes(q));
                });
            },

            seleccionarOpcion(item) {
                this.publicoObjetivo = item.value || item.label;
                this.dropdownOpen = false;
                this.publicoError = '';
            },

            toggleDropdown() {
                this.dropdownOpen = !this.dropdownOpen;
            },
            
            validarPublico() {
                const v = (this.publicoObjetivo || '').trim();
                if (!v) {
                    this.publicoError = 'Digite un dato correcto. Debe indicar el público objetivo.';
                    return false;
                }
                const lower = v.toLowerCase();
                // Cobertura general para todos los egresados
                if (lower.includes('todos') || lower.includes('general')) {
                    this.publicoError = '';
                    return true;
                }
                // Si escribió el código exacto de la ficha (Ej: 3312595) o contiene la ficha
                const matchDigit = v.match(/\b\d{4,8}\b/);
                if (matchDigit) {
                    const found = this.fichasLista.find(f => f.code === matchDigit[0]);
                    if (found) {
                        this.publicoError = '';
                        return true;
                    }
                }
                // Si coincide con alguna de las opciones
                const foundAny = this.fichasLista.find(f => f.label.toLowerCase().includes(lower) || (f.value && f.value.toLowerCase().includes(lower)) || f.search.includes(lower));
                if (foundAny) {
                    this.publicoError = '';
                    return true;
                }

                this.publicoError = 'Digite un dato correcto. Debe seleccionar \'Todos los Egresados\' o una ficha válida registrada en el sistema.';
                return false;
            },

            validarFormulario(e) {
                if (!this.validarPublico()) {
                    e.preventDefault();
                    const inputEl = document.getElementById('input_publico_objetivo');
                    if (inputEl) {
                        inputEl.focus();
                        inputEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return false;
                }
                return true;
            },
            agregarPregunta() {
                this.preguntas.push({ 
                    id: Date.now() + Math.random(), 
                    texto: '', 
                    tipo: 'opcion_multiple', 
                    opciones: ['Opción 1', 'Opción 2'], 
                    obligatoria: true 
                });
            },
            eliminarPregunta(index) {
                if(this.preguntas.length > 1) {
                    this.preguntas.splice(index, 1);
                }
            },
            agregarOpcion(preguntaIndex) {
                const count = this.preguntas[preguntaIndex].opciones.length + 1;
                this.preguntas[preguntaIndex].opciones.push('Opción ' + count);
            },
            eliminarOpcion(preguntaIndex, opcionIndex) {
                if(this.preguntas[preguntaIndex].opciones.length > 1) {
                    this.preguntas[preguntaIndex].opciones.splice(opcionIndex, 1);
                }
            }
         }">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                    <i class="fa-solid fa-clipboard-question"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-[#62E31D] uppercase tracking-wider">MÓDULO DE ENCUESTAS · SIGE ERP</div>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">Constructor de Encuestas a Egresados</h3>
                    <p class="text-xs text-white/70 mt-0.5">Diseñe cuestionarios interactivos de seguimiento, caracterización y pertinencia institucional.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll Suave -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6 bg-[#f8fafc]/80">
            <form id="form-crear-encuesta" 
                  action="{{ request()->routeIs('egresados.instructor.*') ? route('egresados.instructor.encuestas.store') : route('egresados.superadmin.encuestas.store') }}" 
                  method="POST" 
                  @submit="validarFormulario($event)"
                  class="space-y-6">
                @csrf
                
                <!-- Input serializado con las preguntas para el backend -->
                <input type="hidden" name="estructura_preguntas" :value="JSON.stringify(preguntas)">
                
                <!-- SECCIÓN 1: CONFIGURACIÓN GENERAL -->
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200/80 shadow-sm space-y-4 border-l-4 border-l-[#39A900]">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-[#39A900] flex items-center justify-center text-xs font-bold border border-emerald-200">1</span>
                            <h4 class="text-xs font-bold text-[#00131E] uppercase tracking-wider">Información y Parámetros de la Encuesta</h4>
                        </div>
                        <span class="text-[11px] font-semibold text-gray-400">Campos obligatorios marcados con *</span>
                    </div>
                    
                    <!-- Título de la Encuesta -->
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-heading text-[#39A900]"></i>
                            <span>Título de la Encuesta</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="titulo" 
                               required 
                               placeholder="Ej. Encuesta de Seguimiento a la Trayectoria y Pertinencia de Egresados 2026" 
                               class="w-full px-4 py-2.5 text-sm sm:text-base font-semibold text-gray-800 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition">
                    </div>
                    
                    <!-- Descripción u Objetivo -->
                    <div>
                        <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-align-left text-[#39A900]"></i>
                            <span>Descripción / Objetivo Institucional</span>
                        </label>
                        <textarea name="descripcion" 
                                  rows="2" 
                                  placeholder="Detalle el propósito de la consulta a los egresados o las instrucciones para responder el instrumento..." 
                                  class="w-full px-4 py-2.5 text-sm text-gray-700 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none transition resize-none"></textarea>
                    </div>

                    <!-- Parámetros en 2 columnas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-1">
                        <!-- PÚBLICO OBJETIVO: TODOS LOS EGRESADOS O FICHA DE APRENDICES -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1 flex items-center justify-between">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-users text-[#39A900]"></i>
                                    <span>PÚBLICO OBJETIVO (EGRESADOS)</span>
                                    <span class="text-red-500">*</span>
                                </span>
                                <span class="text-[10px] text-gray-400 font-normal">Escribe la ficha o escoge del listado</span>
                            </label>

                            <!-- Campo interactivo: permite escribir para filtrar y desplegar la lista con clic -->
                            <div class="relative" @click.away="dropdownOpen = false">
                                <div class="relative flex items-center">
                                    <input type="text"
                                           name="publico_objetivo"
                                           id="input_publico_objetivo"
                                           x-model="publicoObjetivo"
                                           @focus="dropdownOpen = true"
                                           @click="dropdownOpen = true"
                                           @input="dropdownOpen = true; publicoError = ''"
                                           @blur="setTimeout(() => validarPublico(), 250)"
                                           required
                                           autocomplete="off"
                                           placeholder="Escribe la ficha (Ej. 694778) o selecciona del desplegable..."
                                           class="w-full pl-3.5 pr-10 py-2.5 text-xs sm:text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition"
                                           :class="publicoError ? 'border-red-400 focus:border-red-500 focus:ring-red-100' : ''">

                                    <!-- Botón interactivo para desplegar/ocultar con un clic -->
                                    <button type="button" 
                                            @click.prevent="toggleDropdown()"
                                            class="absolute right-0 top-0 bottom-0 px-3 flex items-center justify-center text-gray-400 hover:text-[#39A900] transition cursor-pointer"
                                            title="Desplegar listado de fichas">
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="dropdownOpen ? 'rotate-180 text-[#39A900]' : ''"></i>
                                    </button>
                                </div>

                                <!-- Menú Desplegable Flotante Elegante -->
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
                                            <span>Fichas y Públicos Disponibles</span>
                                        </span>
                                        <span class="text-[10px] text-gray-400" x-text="fichasFiltradas.length + ' opciones'"></span>
                                    </div>

                                    <div class="overflow-y-auto divide-y divide-gray-50 max-h-48">
                                        <template x-for="item in fichasFiltradas" :key="item.code">
                                            <button type="button" 
                                                    @click="seleccionarOpcion(item)"
                                                    class="w-full text-left px-3.5 py-2.5 hover:bg-emerald-50/60 transition flex items-center justify-between gap-2 group cursor-pointer"
                                                    :class="(publicoObjetivo === (item.value || item.label)) ? 'bg-emerald-50 font-bold text-[#166534]' : 'text-gray-700'">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <i class="fa-solid text-xs" :class="item.code === 'TODOS' ? 'fa-users text-[#39A900]' : 'fa-id-card text-gray-400 group-hover:text-[#39A900]'"></i>
                                                    <span class="text-xs truncate" x-text="item.label"></span>
                                                </div>
                                                <span x-show="item.count > 0" class="shrink-0 text-[10px] px-1.5 py-0.5 rounded bg-gray-100 text-gray-500 font-medium group-hover:bg-[#39A900] group-hover:text-white transition" x-text="item.count + ' aprendices'"></span>
                                            </button>
                                        </template>

                                        <div x-show="fichasFiltradas.length === 0" class="p-4 text-center text-xs text-gray-400">
                                            <i class="fa-solid fa-magnifying-glass text-gray-300 text-base mb-1 block"></i>
                                            <span>No se encontró ninguna ficha con ese criterio. Puedes seguir digitando o seleccionar 'Todos los Egresados'.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-[10.5px] text-gray-400 mt-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-info text-[#39A900]"></i>
                                <span>Puedes hacer clic en la flecha para ver el listado o escribir directamente el número de ficha o programa para filtrar.</span>
                            </div>

                            <!-- Mensaje de Validación de Error si ingresa un dato que no es correcto -->
                            <div x-show="publicoError" style="display:none;" class="p-2.5 bg-red-50 border border-red-300 rounded-xl text-red-700 text-xs font-bold mt-2 flex items-center gap-2">
                                <i class="fa-solid fa-triangle-exclamation text-red-500 text-sm flex-shrink-0"></i>
                                <span x-text="publicoError"></span>
                            </div>

                            @error('publico_objetivo')
                                <div class="p-2.5 bg-red-50 border border-red-300 rounded-xl text-red-700 text-xs font-bold mt-2 flex items-center gap-2">
                                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-sm flex-shrink-0"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- FECHA LÍMITE DE RESPUESTA -->
                        <div>
                            <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1 flex items-center gap-1.5">
                                <i class="fa-regular fa-calendar-check text-[#39A900]"></i>
                                <span>Fecha Límite de Respuesta</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="fecha_cierre" 
                                   required 
                                   min="{{ date('Y-m-d') }}"
                                   value="{{ date('Y-m-d', strtotime('+15 days')) }}"
                                   class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                            <span class="text-[11px] text-gray-400 mt-1 block">La encuesta se cerrará automáticamente al vencer esta fecha.</span>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 2: CONSTRUCTOR DE PREGUNTAS -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between px-1">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-[#39A900] flex items-center justify-center text-xs font-bold border border-emerald-200">2</span>
                            <h4 class="text-xs font-bold text-[#00131E] uppercase tracking-wider">Preguntas del Cuestionario</h4>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-gray-200 text-xs font-bold text-[#00131E] shadow-2xs">
                            <i class="fa-solid fa-list-check text-[#39A900]"></i>
                            <span x-text="preguntas.length + (preguntas.length === 1 ? ' Pregunta' : ' Preguntas')"></span>
                        </span>
                    </div>

                    <!-- Iterador Alpine para cada pregunta -->
                    <template x-for="(pregunta, index) in preguntas" :key="pregunta.id">
                        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200 shadow-sm relative group border-l-4 border-l-[#39A900] hover:shadow-md transition-all space-y-4">
                            
                            <!-- Barra Superior de la Pregunta: Número, Enunciado, Tipo y Eliminar -->
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3">
                                
                                <!-- Número de pregunta -->
                                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#001A29] to-[#002336] text-[#62E31D] flex items-center justify-center text-xs font-black shadow-xs flex-shrink-0">
                                    <span x-text="index + 1"></span>
                                </div>

                                <!-- Input Enunciado -->
                                <div class="flex-1 w-full">
                                    <input type="text" 
                                           x-model="pregunta.texto" 
                                           required 
                                           placeholder="Escriba aquí la pregunta para el egresado..." 
                                           class="w-full px-4 py-2.5 text-sm font-semibold bg-gray-50/60 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] transition text-gray-800">
                                </div>
                                
                                <!-- Selector de Tipo de Pregunta -->
                                <div class="w-full md:w-56 flex-shrink-0">
                                    <select x-model="pregunta.tipo" class="w-full px-3.5 py-2.5 text-xs font-bold bg-gray-50/60 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] text-gray-700">
                                        <option value="opcion_multiple">🔘 Opción Múltiple (Radio)</option>
                                        <option value="casillas">☑️ Casillas de Verificación</option>
                                        <option value="texto_corto">📝 Texto Corto (Línea)</option>
                                        <option value="parrafo">📄 Párrafo (Texto Largo)</option>
                                    </select>
                                </div>

                                <!-- Botón Eliminar Pregunta -->
                                <button type="button" 
                                        @click="eliminarPregunta(index)" 
                                        class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition cursor-pointer flex-shrink-0" 
                                        title="Eliminar pregunta" 
                                        x-show="preguntas.length > 1">
                                    <i class="fa-regular fa-trash-can text-sm"></i>
                                </button>
                            </div>

                            <!-- Opciones Dinámicas (Para opción múltiple o casillas) -->
                            <div x-show="pregunta.tipo === 'opcion_multiple' || pregunta.tipo === 'casillas'" class="pl-2 sm:pl-11 space-y-2.5 pt-1">
                                <template x-for="(opcion, opIndex) in pregunta.opciones" :key="opIndex">
                                    <div class="flex items-center gap-2.5">
                                        <!-- Viñeta institucional -->
                                        <div class="text-[#39A900] flex-shrink-0">
                                            <i x-show="pregunta.tipo === 'opcion_multiple'" class="fa-regular fa-circle text-xs"></i>
                                            <i x-show="pregunta.tipo === 'casillas'" class="fa-regular fa-square text-xs"></i>
                                        </div>
                                        
                                        <!-- Input opción -->
                                        <input type="text" 
                                               x-model="pregunta.opciones[opIndex]" 
                                               required 
                                               class="flex-1 px-3 py-1.5 text-sm bg-gray-50/50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] text-gray-800 transition" 
                                               placeholder="Escribe el texto de la opción...">
                                        
                                        <!-- Eliminar opción -->
                                        <button type="button" 
                                                @click="eliminarOpcion(index, opIndex)" 
                                                class="text-gray-400 hover:text-red-500 p-1.5 rounded-lg hover:bg-red-50 transition cursor-pointer" 
                                                title="Quitar opción" 
                                                x-show="pregunta.opciones.length > 1">
                                            <i class="fa-solid fa-xmark text-xs"></i>
                                        </button>
                                    </div>
                                </template>
                                
                                <!-- Botón Agregar Opción -->
                                <div class="pt-1">
                                    <button type="button" 
                                            @click="agregarOpcion(index)" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-[#39A900] hover:text-[#2d8500] hover:bg-emerald-50 transition cursor-pointer">
                                        <i class="fa-solid fa-plus text-[10px]"></i>
                                        <span>Añadir otra opción</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Vista Previa para Texto Corto o Párrafo -->
                            <div x-show="pregunta.tipo === 'texto_corto' || pregunta.tipo === 'parrafo'" class="pl-2 sm:pl-11 pt-1">
                                <div class="p-3 bg-gray-50/80 border border-dashed border-gray-300 rounded-xl text-xs text-gray-500 flex items-center gap-2">
                                    <i class="fa-regular fa-pen-to-square text-[#39A900]"></i>
                                    <span x-text="pregunta.tipo === 'texto_corto' ? 'Espacio habilitado para respuesta breve en una sola línea del egresado.' : 'Espacio habilitado para respuesta descriptiva en múltiples renglones del egresado.'"></span>
                                </div>
                            </div>

                            <!-- Configuración Inferior de la Pregunta: Obligatoria -->
                            <div class="pt-3 border-t border-gray-100 flex justify-between items-center text-xs">
                                <span class="text-gray-400 font-medium">Configuración de respuesta</span>
                                
                                <label class="flex items-center gap-2 cursor-pointer select-none">
                                    <span class="font-bold text-gray-700">Respuesta obligatoria</span>
                                    <input type="checkbox" x-model="pregunta.obligatoria" class="sr-only peer">
                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#39A900] relative"></div>
                                </label>
                            </div>

                        </div>
                    </template>
                </div>

                <!-- Botón de Añadir Nueva Pregunta -->
                <div class="flex justify-center pt-2">
                    <button type="button" 
                            @click="agregarPregunta()" 
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-dashed border-[#39A900] text-[#39A900] hover:bg-emerald-50 hover:border-[#2d8500] font-bold text-xs uppercase tracking-wider rounded-2xl shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer">
                        <i class="fa-solid fa-plus text-sm"></i>
                        <span>Añadir Nueva Pregunta</span>
                    </button>
                </div>

            </form>
        </div>

        <!-- Pie del Modal con Acciones Institucionales ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-between bg-gray-50/70 rounded-b-3xl">
            <div class="flex items-center gap-2 text-xs text-gray-500 font-medium">
                <i class="fa-solid fa-layer-group text-[#39A900]"></i>
                <span>Total de preguntas: <strong class="text-gray-900" x-text="preguntas.length"></strong></span>
            </div>
            
            <div class="flex items-center gap-3">
                <button type="button" 
                        @click="openModal = false" 
                        class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                    Cancelar
                </button>
                <button type="submit" 
                        form="form-crear-encuesta" 
                        class="px-6 py-2.5 bg-gradient-to-r from-[#001A29] to-[#39A900] hover:from-[#00131E] hover:to-[#2e8b00] text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-950/20 transition cursor-pointer flex items-center gap-2 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    <span>Publicar Encuesta</span>
                </button>
            </div>
        </div>

    </div>
</div>
