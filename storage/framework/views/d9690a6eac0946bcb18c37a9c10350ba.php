<!-- Modules/Egresados/Resources/views/superadmin/partials/_modal_seguimiento.blade.php -->

<div x-show="openModalSeguimiento" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
    
    <div @click.away="openModalSeguimiento = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-3 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 sm:scale-95"
         class="bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-gray-100 flex flex-col overflow-hidden">
        
        <!-- Encabezado SENA ERP -->
        <div class="flex items-center justify-between border-b-4 border-[#39A900] px-6 py-4 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-[#62E31D] border border-white/10 text-base">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-white tracking-wide">Registrar Seguimiento</h3>
                    <p class="text-xs text-white/70">Contacto y trazabilidad básica del egresado</p>
                </div>
            </div>
            <button @click="openModalSeguimiento = false" type="button" class="text-white/60 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Banner del Egresado -->
        <div class="px-6 py-3 bg-[#EAF7EE] border-b border-[#BBF7D0] flex items-center justify-between flex-wrap gap-2">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-[#39A900] text-white font-bold flex items-center justify-center text-xs">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-[#166534] uppercase tracking-wider">Egresado</div>
                    <div id="seguimiento_egresado_name_label" class="text-sm font-bold text-[#00131E]"><?php echo e($nombreCompleto ?? 'JUAN DAVID LIZCANO'); ?></div>
                </div>
            </div>
            <span id="seguimiento_egresado_doc_label" class="text-xs font-semibold px-2.5 py-1 bg-white rounded-lg border border-[#BBF7D0] text-[#166534]">
                <i class="fa-regular fa-id-card mr-1 text-[#39A900]"></i> <?php echo e($docCompleto ?? 'Documento'); ?>

            </span>
        </div>

        <!-- Formulario Básico -->
        <div class="p-6">
            <form id="form-seguimiento-simple" action="<?php echo e((request()->is('*instructor*') || (Auth::check() && Auth::user()->hasRole('instructor'))) ? route('egresados.instructor.seguimiento.store') : route('egresados.superadmin.seguimiento.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="egresado_id" id="seguimiento_egresado_id" value="<?php echo e($apprentice->id ?? 1); ?>">

                <!-- Fila 1: Canal y Fecha -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Canal de Contacto *</label>
                        <select name="tipo_contacto" required class="w-full px-3 py-2 text-xs font-medium bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none transition">
                            <option value="TELEFONICO">📞 Llamada Telefónica</option>
                            <option value="WHATSAPP">💬 Mensaje WhatsApp</option>
                            <option value="CORREO">✉️ Correo Electrónico</option>
                            <option value="PRESENCIAL">👥 Visita Presencial</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Fecha del Contacto *</label>
                        <input type="date" name="fecha" required value="<?php echo e(date('Y-m-d')); ?>" class="w-full px-3 py-2 text-xs font-medium bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none transition">
                    </div>
                </div>

                <!-- Fila 2: Estado Laboral y Empresa -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Estado Laboral Actual *</label>
                        <select name="nuevo_estado_laboral" required class="w-full px-3 py-2 text-xs font-medium bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none transition">
                            <option value="EMPLEADO">💼 Vinculado / Empleado</option>
                            <option value="INDEPENDIENTE">🚀 Emprendedor / Propio</option>
                            <option value="EN FORMACION">⏳ En Etapa Productiva</option>
                            <option value="DESEMPLEADO">🔍 En Búsqueda de Empleo</option>
                            <option value="ESTUDIANDO">🎓 Continuando Estudios</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Empresa / Ocupación</label>
                        <input type="text" name="empresa_actual" placeholder="Ej: Agropecuaria / Freelance" class="w-full px-3 py-2 text-xs font-medium bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none transition">
                    </div>
                </div>

                <!-- Fila 3: Observaciones -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Observaciones / Resultado del Contacto *</label>
                    <textarea name="observaciones" rows="3" required placeholder="Escriba brevemente el resultado del contacto, acuerdos o novedades del egresado..." class="w-full px-3 py-2 text-xs font-medium bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#39A900]/30 focus:border-[#39A900] outline-none transition resize-none"></textarea>
                </div>
            </form>
        </div>

        <!-- Pie con Botones -->
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50">
            <button type="button" @click="openModalSeguimiento = false" class="px-4 py-2 bg-white hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl border border-gray-300 transition cursor-pointer">
                Cancelar
            </button>
            <button type="submit" form="form-seguimiento-simple" class="px-5 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2d8500] hover:from-[#2d8500] hover:to-[#226300] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/30 hover:shadow-lg flex items-center gap-2 cursor-pointer border-0">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Guardar Seguimiento</span>
            </button>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules/Egresados\resources/views/superadmin/partials/_modal_seguimiento.blade.php ENDPATH**/ ?>