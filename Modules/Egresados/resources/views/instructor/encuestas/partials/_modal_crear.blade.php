<!-- Modal Constructor de Encuestas para el Instructor -->
<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-xs flex items-center justify-center p-4 sm:p-6" x-cloak>
    
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
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4 bg-[#001A29] rounded-t-2xl text-white">
            <div>
                <h3 class="text-lg font-bold font-editorial">Constructor de Encuestas del Instructor</h3>
                <p class="text-xs text-emerald-200 mt-0.5">Diseñe el formulario para los egresados de sus fichas.</p>
            </div>
            <button @click="openModal = false" type="button" class="text-emerald-100 hover:text-white p-2 rounded-xl hover:bg-emerald-800 transition cursor-pointer">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll -->
        <div class="px-6 py-4 overflow-y-auto bg-gray-50/50">
            <form id="form-crear-encuesta-instructor" action="{{ route('egresados.instructor.encuestas.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Input oculto para enviar preguntas JSON -->
                <input type="hidden" name="estructura_preguntas" :value="JSON.stringify(preguntas)">
                
                <!-- Sección 1: Configuración General -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-xs space-y-4 border-l-4 border-l-emerald-600">
                    <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider border-b border-gray-100 pb-2">Configuración General</h4>
                    
                    <div>
                        <input type="text" name="titulo" required class="w-full px-2 py-3 text-2xl font-bold font-editorial text-gray-900 bg-transparent border-b-2 border-gray-200 focus:outline-hidden focus:border-emerald-600 transition" placeholder="Título de la Encuesta">
                    </div>
                    
                    <div>
                        <textarea name="descripcion" rows="2" class="w-full px-2 py-2 text-sm text-gray-600 bg-transparent border-b border-gray-200 focus:outline-hidden focus:border-emerald-600 resize-none transition" placeholder="Descripción del objetivo de la encuesta para sus egresados..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Dirigido a (Público Objetivo)</label>
                            <select name="publico_objetivo" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden">
                                <option value="TODOS">Todos los Egresados</option>
                                <option value="ADSO">Egresados ADSO</option>
                                <option value="GAE">Egresados Gestión Agroempresarial</option>
                                <option value="EMPRENDEDORES">Egresados Emprendedores</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Fecha Límite de Respuesta</label>
                            <input type="date" name="fecha_cierre" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden">
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Constructor de Preguntas -->
                <div class="space-y-4">
                    <template x-for="(pregunta, index) in preguntas" :key="pregunta.id">
                        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-xs relative group border-l-4 border-l-blue-500 transition-all hover:shadow-md">
                            
                            <!-- Botón Eliminar Pregunta -->
                            <button type="button" @click="eliminarPregunta(index)" class="absolute top-4 right-4 text-gray-300 hover:text-red-500 transition p-1 cursor-pointer" title="Eliminar pregunta" x-show="preguntas.length > 1">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="md:col-span-2">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1" x-text="'Pregunta #' + (index + 1)"></label>
                                    <input type="text" x-model="pregunta.texto" required placeholder="Escriba la pregunta aquí..." class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden font-medium">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Tipo de Respuesta</label>
                                    <select x-model="pregunta.tipo" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden font-medium cursor-pointer">
                                        <option value="texto_corto">Texto Corto (Respuesta abierta)</option>
                                        <option value="texto_largo">Párrafo (Respuesta larga)</option>
                                        <option value="opcion_multiple">Opción Múltiple (Radio)</option>
                                        <option value="casillas">Casillas de Verificación (Múltiples)</option>
                                        <option value="escala">Escala de Calificación (1 a 5)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Opciones para preguntas tipo Opción Múltiple o Casillas -->
                            <div x-show="pregunta.tipo === 'opcion_multiple' || pregunta.tipo === 'casillas'" class="space-y-2 mt-3 pl-2 border-l-2 border-gray-100">
                                <span class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider block mb-2">Opciones de respuesta:</span>
                                
                                <template x-for="(opcion, optIndex) in pregunta.opciones" :key="optIndex">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                        <input type="text" x-model="pregunta.opciones[optIndex]" class="flex-1 px-3 py-1.5 text-xs bg-gray-50 border border-gray-200 rounded-lg focus:border-emerald-600 outline-hidden">
                                        
                                        <button type="button" @click="eliminarOpcion(index, optIndex)" x-show="pregunta.opciones.length > 1" class="text-gray-300 hover:text-red-500 p-1 cursor-pointer">
                                            <i class="fa-solid fa-xmark text-xs"></i>
                                        </button>
                                    </div>
                                </template>

                                <button type="button" @click="agregarOpcion(index)" class="text-xs text-emerald-700 hover:text-emerald-800 font-bold flex items-center gap-1.5 mt-2 cursor-pointer">
                                    <i class="fa-solid fa-circle-plus text-xs"></i>
                                    <span>Añadir otra opción</span>
                                </button>
                            </div>

                            <!-- Toggle Pregunta Obligatoria -->
                            <div class="mt-4 pt-3 border-t border-gray-50 flex items-center justify-between">
                                <span class="text-xs text-gray-400">Pregunta requerida en el formulario</span>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" x-model="pregunta.obligatoria" class="rounded text-emerald-600 focus:ring-emerald-500">
                                    <span class="text-xs font-semibold text-gray-700">Obligatoria</span>
                                </label>
                            </div>

                        </div>
                    </template>
                </div>

                <!-- Botón Flotante para Agregar más preguntas -->
                <div class="text-center pt-2">
                    <button type="button" @click="agregarPregunta()" class="px-5 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold rounded-xl transition border border-emerald-200 inline-flex items-center gap-2 cursor-pointer shadow-2xs">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Añadir Nueva Pregunta</span>
                    </button>
                </div>

            </form>
        </div>

        <!-- Pie del Modal -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-2xl">
            <button type="button" @click="openModal = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-xs">
                Cancelar
            </button>
            <button type="submit" form="form-crear-encuesta-instructor" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Publicar Encuesta</span>
            </button>
        </div>

    </div>
</div>
