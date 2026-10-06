<!-- Modules/Egresados/Resources/views/superadmin/encuestas/partials/_modal_crear.blade.php -->

<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <!-- Modal más ancho (max-w-4xl) para el constructor de encuestas -->
    <div @click.away="openModal = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-2xl max-w-4xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[90vh]"
         
         {{-- LÓGICA ALPINE.JS PARA EL CONSTRUCTOR TIPO GOOGLE FORMS --}}
         x-data="{
            preguntas: [
                { id: Date.now(), texto: '', tipo: 'opcion_multiple', opciones: ['Opción 1'], obligatoria: true }
            ],
            agregarPregunta() {
                this.preguntas.push({ id: Date.now(), texto: '', tipo: 'texto_corto', opciones: ['Opción 1'], obligatoria: false });
            },
            eliminarPregunta(index) {
                if(this.preguntas.length > 1) this.preguntas.splice(index, 1);
            },
            agregarOpcion(preguntaIndex) {
                this.preguntas[preguntaIndex].opciones.push('Nueva Opción');
            },
            eliminarOpcion(preguntaIndex, opcionIndex) {
                if(this.preguntas[preguntaIndex].opciones.length > 1) {
                    this.preguntas[preguntaIndex].opciones.splice(opcionIndex, 1);
                }
            }
         }">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4 bg-emerald-700 rounded-t-2xl text-white">
            <div>
                <h3 class="text-lg font-bold">Constructor de Encuestas</h3>
                <p class="text-xs text-emerald-100 mt-1">Diseñe el formulario nativo para los egresados.</p>
            </div>
            <button @click="openModal = false" type="button" class="text-emerald-100 hover:text-white p-2 rounded-xl hover:bg-emerald-600 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll -->
        <div class="px-6 py-4 overflow-y-auto bg-gray-50/50">
            <form id="form-crear-encuesta" action="{{ route('egresados.superadmin.encuestas.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Input oculto para enviar toda la estructura de preguntas al backend como JSON -->
                <input type="hidden" name="estructura_preguntas" :value="JSON.stringify(preguntas)">
                
                <!-- Sección 1: Configuración General (Tarjeta Blanca) -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm space-y-4 border-l-4 border-l-emerald-600">
                    <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Configuración General</h4>
                    
                    <div>
                        <input type="text" name="titulo" required class="w-full px-2 py-3 text-2xl font-bold text-gray-900 bg-transparent border-b-2 border-gray-200 focus:outline-none focus:border-emerald-600 transition" placeholder="Título de la Encuesta">
                    </div>
                    
                    <div>
                        <textarea name="descripcion" rows="2" class="w-full px-2 py-2 text-sm text-gray-600 bg-transparent border-b border-gray-200 focus:outline-none focus:border-emerald-600 resize-none transition" placeholder="Descripción de la encuesta..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Dirigido a</label>
                            <select name="publico_objetivo" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                                <option value="TODOS">Todos los Egresados (General)</option>
                                <option value="ADSO">Egresados ADSO</option>
                                <option value="GAE">Egresados Gestión Agroempresarial</option>
                                <option value="EMPRENDEDORES">Egresados Emprendedores</option>
                                <option value="INSTRUCTORES">Instructores / Seguimiento</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Fecha de Cierre</label>
                            <input type="date" name="fecha_cierre" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Constructor de Preguntas (Iterador Alpine) -->
                <div class="space-y-4">
                    <template x-for="(pregunta, index) in preguntas" :key="pregunta.id">
                        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm relative group border-l-4 border-l-blue-500 transition-all hover:shadow-md">
                            
                            <!-- Botón Eliminar Pregunta -->
                            <button type="button" @click="eliminarPregunta(index)" class="absolute top-4 right-4 text-gray-300 hover:text-red-500 transition p-1 cursor-pointer" title="Eliminar pregunta" x-show="preguntas.length > 1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <!-- Enunciado de la Pregunta -->
                                <div class="md:col-span-2">
                                    <input type="text" x-model="pregunta.texto" class="w-full px-3 py-2 text-base font-semibold bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Escribe tu pregunta aquí...">
                                </div>
                                
                                <!-- Tipo de Pregunta -->
                                <div>
                                    <select x-model="pregunta.tipo" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                        <option value="texto_corto">Texto Corto</option>
                                        <option value="parrafo">Párrafo (Texto Largo)</option>
                                        <option value="opcion_multiple">Opción Múltiple (Radio)</option>
                                        <option value="casillas">Casillas de Verificación</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Opciones (Solo visible si es Opción Múltiple o Casillas) -->
                            <div x-show="pregunta.tipo === 'opcion_multiple' || pregunta.tipo === 'casillas'" class="pl-2 space-y-2 mt-2">
                                <template x-for="(opcion, opIndex) in pregunta.opciones" :key="opIndex">
                                    <div class="flex items-center gap-2">
                                        <!-- Ícono decorativo según tipo -->
                                        <div class="text-gray-400">
                                            <svg x-show="pregunta.tipo === 'opcion_multiple'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/></svg>
                                            <svg x-show="pregunta.tipo === 'casillas'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke-width="2"/></svg>
                                        </div>
                                        
                                        <input type="text" x-model="pregunta.opciones[opIndex]" class="flex-1 px-0 py-1 text-sm bg-transparent border-b border-gray-200 focus:outline-none focus:border-blue-500 hover:border-gray-300 transition" placeholder="Escribe una opción">
                                        
                                        <button type="button" @click="eliminarOpcion(index, opIndex)" class="text-gray-400 hover:text-red-500 cursor-pointer" x-show="pregunta.opciones.length > 1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </template>
                                
                                <button type="button" @click="agregarOpcion(index)" class="mt-2 text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1 cursor-pointer">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Añadir opción
                                </button>
                            </div>

                            <!-- Vista Previa para Texto (Decorativo) -->
                            <div x-show="pregunta.tipo === 'texto_corto' || pregunta.tipo === 'parrafo'" class="pl-2 mt-3">
                                <div class="w-2/3 border-b border-dashed border-gray-300 pb-2 text-xs text-gray-400">
                                    <span x-text="pregunta.tipo === 'texto_corto' ? 'Texto de respuesta corta' : 'Texto de respuesta larga'"></span>
                                </div>
                            </div>

                            <!-- Configuración inferior de la pregunta (Obligatoria) -->
                            <div class="mt-4 pt-3 border-t border-gray-100 flex justify-end items-center gap-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <span class="text-xs text-gray-500 font-medium">Obligatoria</span>
                                    <!-- Toggle Switch Nativo -->
                                    <input type="checkbox" x-model="pregunta.obligatoria" class="sr-only peer">
                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500 relative"></div>
                                </label>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Botón Flotante para Agregar Nueva Pregunta -->
                <div class="flex justify-center mt-4">
                    <button type="button" @click="agregarPregunta()" class="flex items-center gap-2 px-6 py-2.5 bg-white border border-dashed border-emerald-500 text-emerald-600 font-bold text-sm rounded-full hover:bg-emerald-50 transition shadow-sm cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Añadir Pregunta
                    </button>
                </div>

            </form>
        </div>

        <!-- Pie del Modal -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-between bg-white rounded-b-2xl">
            <span class="text-xs text-gray-400" x-text="'Total preguntas: ' + preguntas.length"></span>
            
            <div class="flex gap-3">
                <button type="button" @click="openModal = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Cancelar
                </button>
                <button type="submit" form="form-crear-encuesta" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Publicar Encuesta
                </button>
            </div>
        </div>

    </div>
</div>
