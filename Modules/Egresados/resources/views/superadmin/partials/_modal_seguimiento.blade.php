<!-- Modules/Egresados/Resources/views/superadmin/partials/_modal_seguimiento.blade.php -->

<div x-show="openModalSeguimiento" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalSeguimiento = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-gray-100 flex flex-col">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Registrar Seguimiento</h3>
                <p class="text-xs text-gray-500 mt-1">Agregue un nuevo hito a la trazabilidad para <span id="seguimiento_egresado_name_label" class="font-bold text-emerald-700">{{ $nombreCompleto ?? 'el egresado' }}</span>.</p>
            </div>
            <button @click="openModalSeguimiento = false" type="button" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Formulario de Seguimiento -->
        <div class="px-6 py-4">
            <form id="form-seguimiento" action="{{ route('egresados.superadmin.seguimiento.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Input oculto con el ID del egresado -->
                <input type="hidden" name="egresado_id" id="seguimiento_egresado_id" value="{{ $apprentice->id ?? 1 }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Tipo de Contacto</label>
                        <select name="tipo_contacto" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                            <option value="TELEFONICO">Llamada Telefónica</option>
                            <option value="CORREO">Correo Electrónico</option>
                            <option value="PRESENCIAL">Visita Presencial</option>
                            <option value="ENCUESTA">Respuesta Encuesta</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Fecha del Seguimiento</label>
                        <!-- Fecha actual por defecto -->
                        <input type="date" name="fecha" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">¿Cambió su estado laboral?</label>
                    <select name="nuevo_estado_laboral" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                        <option value="">No, mantener estado actual</option>
                        <option value="EMPLEADO">Cambiar a: Empleado</option>
                        <option value="DESEMPLEADO">Cambiar a: Desempleado</option>
                        <option value="INDEPENDIENTE">Cambiar a: Independiente / Emprendedor</option>
                        <option value="ESTUDIANDO">Cambiar a: Estudiando</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Observaciones / Detalles del Contacto</label>
                    <textarea name="observaciones" rows="4" required placeholder="Detalle aquí los resultados de la llamada, acuerdos o comentarios del egresado..." class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 resize-none"></textarea>
                </div>
            </form>
        </div>

        <!-- Pie del Modal -->
        <div class="border-t border-gray-100 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50/50 rounded-b-2xl">
            <button type="button" @click="openModalSeguimiento = false" class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-seguimiento" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Guardar Seguimiento
            </button>
        </div>
    </div>
</div>
