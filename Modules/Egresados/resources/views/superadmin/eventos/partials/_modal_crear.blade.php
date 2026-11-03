{{-- Modal para Crear / Programar Nuevo Evento (Identidad SENA ERP) --}}
<div x-show="openModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModal = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-8 sm:pt-12 p-3 sm:p-4" x-cloak>
    
    <div @click.away="openModal = false" 
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
                    <i class="fa-solid fa-calendar-plus"></i>
                </div>
                <div>
                    <div class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE EVENTOS · SIGE ERP</div>
                    <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">Programar Nuevo Evento</h3>
                    <p class="text-xs text-white/75 mt-0.5">Configure los detalles, fecha y cupos del evento institucional.</p>
                </div>
            </div>
            <button @click="openModal = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll Suave -->
        <div class="px-6 sm:px-8 py-5 overflow-y-auto space-y-6 bg-[#f8fafc]/80">
            <form id="form-crear-evento" action="{{ route('egresados.superadmin.eventos.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Sección 1: Información Base del Evento -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#39A900] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-[#39A900]"></i>
                            Información del Evento
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
                            <input type="text" name="nombre_evento" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. Feria Laboral Agroindustrial 2026">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-tag text-[#39A900]"></i>
                                <span>Tipo de Evento</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="tipo_evento" required 
                                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition">
                                <option value="FERIA">Feria Laboral</option>
                                <option value="TALLER">Taller Práctico</option>
                                <option value="ENCUENTRO">Encuentro Institucional</option>
                                <option value="HACKATHON">Concurso / Hackathon</option>
                                <option value="CONFERENCIA">Conferencia / Charla</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-[#39A900]"></i>
                                <span>Lugar / Ubicación</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="lugar" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. Auditorio Principal CEFA">
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Logística y Participantes -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200/80 shadow-xs border-l-4 border-l-[#001A29] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <h4 class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-users-gear text-[#001A29]"></i>
                            Logística y Participantes
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-clock text-[#39A900]"></i>
                                <span>Fecha y Hora de Inicio</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="fecha_inicio" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-users text-[#39A900]"></i>
                                <span>Cupo Máximo (Total)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="cupo_total" min="1" required 
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Ej. 200">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                                <span>Programas Dirigidos</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="programas_dirigidos" 
                                       id="programas_dirigidos"
                                       list="programas_sugeridos"
                                       class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                       placeholder="Escriba el programa (ej. ADSO, Gestión Agroempresarial, Todos...)"
                                       value="Todos los Programas">
                                <datalist id="programas_sugeridos">
                                    <option value="Todos los Programas">
                                    <option value="Análisis y Desarrollo de Software (ADSO)">
                                    <option value="Gestión Agroempresarial">
                                    <option value="Producción Ganadera">
                                    <option value="Producción Agrícola">
                                    <option value="Contabilización de Operaciones Comerciales y Financieras">
                                    <option value="Mantenimiento de Equipos de Cómputo">
                                </datalist>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-pen text-[9px] text-[#39A900]"></i>
                                Puede escribir libremente el nombre del programa o seleccionarlo de las sugerencias.
                            </p>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-align-left text-[#39A900]"></i>
                                <span>Descripción del Evento</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea name="descripcion" rows="3" required 
                                      class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition resize-none h-24" 
                                      placeholder="Objetivo de este evento y detalles para los asistentes..."></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal con Identidad SENA ERP -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-between bg-white">
            <span class="text-[11px] text-gray-400 hidden sm:inline flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-[#39A900]"></i>
                Módulo Institucional SIGE · CEFA
            </span>
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <button type="button" @click="openModal = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    Cancelar
                </button>
                <button type="submit" form="form-crear-evento" class="px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-xs"></i>
                    <span>Agendar Evento</span>
                </button>
            </div>
        </div>

    </div>
</div>
