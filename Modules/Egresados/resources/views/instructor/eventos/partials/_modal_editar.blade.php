{{-- Modal para Editar Evento Institucional (Identidad SENA ERP) --}}
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
            <form id="form-editar-evento" action="#" method="POST" class="space-y-5">
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
                            <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                                <span>Programas Dirigidos</span>
                            </label>
                            <input type="text" name="program" id="edit_program" list="edit_programas_sugeridos"
                                   class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] focus:ring-2 focus:ring-[#39A900]/20 outline-none transition" 
                                   placeholder="Escriba el programa o seleccionelo de la lista...">
                            <datalist id="edit_programas_sugeridos">
                                <option value="Todos los Programas">
                                <option value="Análisis y Desarrollo de Software (ADSO)">
                                <option value="Gestión Agroempresarial">
                                <option value="Producción Ganadera">
                                <option value="Producción Agrícola">
                                <option value="Contabilización de Operaciones Comerciales y Financieras">
                                <option value="Mantenimiento de Equipos de Cómputo">
                            </datalist>
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

