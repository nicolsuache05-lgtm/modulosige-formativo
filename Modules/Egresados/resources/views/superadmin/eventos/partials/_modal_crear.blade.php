{{-- Modal para Crear / Programar Nuevo Evento --}}
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
         class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[90vh]">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Programar Nuevo Evento</h3>
                <p class="text-xs text-gray-500 mt-1">Configure los detalles, fecha y cupos del evento institucional.</p>
            </div>
            <button @click="openModal = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario -->
        <div class="px-6 py-4 overflow-y-auto">
            <form id="form-crear-evento" action="{{ route('egresados.superadmin.eventos.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Sección 1: Datos Principales -->
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">Información del Evento</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Nombre del Evento</label>
                            <input type="text" name="nombre_evento" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition" placeholder="Ej. Feria Laboral Agroindustrial 2026">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Tipo de Evento</label>
                            <select name="tipo_evento" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                                <option value="FERIA">Feria Laboral</option>
                                <option value="TALLER">Taller Práctico</option>
                                <option value="ENCUENTRO">Encuentro Institucional</option>
                                <option value="HACKATHON">Concurso / Hackathon</option>
                                <option value="CONFERENCIA">Conferencia / Charla</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Lugar / Ubicación</label>
                            <input type="text" name="lugar" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition" placeholder="Ej. Auditorio Principal CEFA">
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Fechas y Logística -->
                <div class="pt-2">
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-50">Logística y Participantes</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" name="fecha_inicio" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Cupo Máximo (Total)</label>
                            <input type="number" name="cupo_total" min="1" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition" placeholder="Ej. 200">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Programas Dirigidos</label>
                            <select name="programas_dirigidos[]" multiple class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition h-20">
                                <option value="TODOS" selected>Todos los Programas</option>
                                <option value="ADSO">ADSO</option>
                                <option value="GAE">Gestión Agroempresarial</option>
                                <option value="PG">Producción Agrícola</option>
                            </select>
                            <p class="text-[10px] text-gray-400 mt-1">Presione CTRL para seleccionar varios.</p>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Descripción del Evento</label>
                            <textarea name="descripcion" rows="3" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-hidden transition resize-none" placeholder="Objetivo de este evento y detalles para los asistentes..."></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-2xl">
            <button type="button" @click="openModal = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-xs">
                Cancelar
            </button>
            <button type="submit" form="form-crear-evento" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Agendar Evento
            </button>
        </div>

    </div>
</div>
