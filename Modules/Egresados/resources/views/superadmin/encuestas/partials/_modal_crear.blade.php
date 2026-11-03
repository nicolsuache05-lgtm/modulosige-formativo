<!-- Modules/Egresados/Resources/views/superadmin/encuestas/partials/_modal_crear.blade.php -->
<!-- MODAL DE CREACIÓN / CONSTRUCTOR DE ENCUESTAS INSTITUCIONALES SENA ERP -->

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
            <form id="form-crear-encuesta" action="{{ route('egresados.superadmin.encuestas.store') }}" method="POST" class="space-y-6">
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div>
                            <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-users text-[#39A900]"></i>
                                <span>Público Objetivo (Egresados)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="publico_objetivo" required class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
                                <option value="TODOS">Todos los Egresados (General CEFA)</option>
                                <option value="ADSO">Egresados ADSO (Software)</option>
                                <option value="GAE">Egresados Gestión Agroempresarial</option>
                                <option value="EMPRENDEDORES">Egresados con Unidades Productivas</option>
                                <option value="INSTRUCTORES">Docentes / Coordinadores de Seguimiento</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-regular fa-calendar-check text-[#39A900]"></i>
                                <span>Fecha Límite de Respuesta</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="fecha_cierre" 
                                   required 
                                   class="w-full px-3.5 py-2.5 text-sm bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800 transition">
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
