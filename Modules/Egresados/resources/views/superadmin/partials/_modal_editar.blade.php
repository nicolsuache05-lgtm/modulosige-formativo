<!-- Modules/Egresados/Resources/views/superadmin/partials/_modal_editar.blade.php -->
<!-- VENTANA FLOTANTE MODAL: EDITAR DATOS DEL EGRESADO -->

<div x-show="openModalEditar" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModalEditar = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalEditar = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 sm:px-8 py-5 bg-gradient-to-r from-[#001A29] to-[#00131E] text-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center font-bold text-lg shadow-inner">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-amber-300 uppercase tracking-wider">EDICIÓN DE EXPEDIENTE · SIGE</div>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">Editar Datos del Egresado</h3>
                    <p class="text-xs text-white/70 mt-0.5">Modificando información de: <strong id="edit_egresado_name_label" class="text-emerald-300 font-bold">Egresado</strong></p>
                </div>
            </div>
            <button @click="openModalEditar = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Cuerpo del Formulario con Scroll -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6">
            <form id="form-editar-perfil" action="/egresados/1/update" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                
                <!-- Sección 1: Información Personal & Identificación -->
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-1.5">
                        <i class="fa-regular fa-id-card text-emerald-600"></i>
                        <span>Información Personal e Identificación</span>
                    </h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-1">
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Tipo Documento</label>
                            <select name="tipo_documento" id="edit_tipo_documento" required class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600">
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                                <option value="PEP">Permiso de Protección Temporal</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Número de Documento <span class="text-red-500">*</span></label>
                            <input type="text" name="documento" id="edit_documento" required pattern="[0-9]{5,15}" inputmode="numeric" title="Ingrese entre 5 y 15 dígitos numéricos sin puntos ni espacios" placeholder="Ej. 107584578" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 font-semibold text-gray-800">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Nombre Completo (Nombres y Apellidos) <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" id="edit_nombre" required placeholder="Nombres y Apellidos" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 font-semibold text-gray-800">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="correo" id="edit_correo" required placeholder="correo@sena.edu.co" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 text-gray-800">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Teléfono / Celular</label>
                            <input type="tel" name="telefono" id="edit_telefono" pattern="[0-9]{7,15}" inputmode="numeric" title="Ingrese entre 7 y 15 dígitos numéricos sin caracteres especiales" placeholder="Ej. 3201234567" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 text-gray-800">
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-400 mt-2">Los datos de contacto (correo y teléfono) deben ser únicos y no pertenecer a otro registro.</p>
                </div>

                <!-- Sección 2: Información Académica y Estado -->
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-1.5">
                        <i class="fa-solid fa-graduation-cap text-emerald-600"></i>
                        <span>Formación Académica y Estado Ocupacional</span>
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Programa de Formación</label>
                            <input type="text" name="programa" id="edit_programa" list="lista_programas_formacion_edit" placeholder="Escribe el programa de formación" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 font-semibold text-gray-800">
                            <datalist id="lista_programas_formacion_edit">
                                <option value="Análisis y Desarrollo de Software (ADSO)">
                                <option value="Gestión de Empresas Agropecuarias">
                                <option value="Procesamiento de Alimentos">
                                <option value="Producción Ganadera">
                                <option value="Gestión Administrativa">
                                <option value="Gestión del Talento Humano">
                                <option value="Contabilización de Operaciones Comerciales y Financieras">
                                <option value="Producción Agropecuaria Ecológica">
                                <option value="Sistemas">
                            </datalist>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Código de Ficha SENA</label>
                            <input type="text" name="ficha" id="edit_ficha" placeholder="Ej. 3230026" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 font-semibold text-gray-800">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Estado Ocupacional</label>
                        <select name="estado" id="edit_estado" class="w-full px-3.5 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 font-semibold text-gray-800">
                            <option value="CERTIFICADO">CERTIFICADO</option>
                            <option value="EN FORMACIÓN">EN FORMACIÓN</option>
                            <option value="CONDICIONADO">CONDICIONADO</option>
                            <option value="INDUCCIÓN">INDUCCIÓN</option>
                            <option value="APLAZADO">APLAZADO</option>
                            <option value="CANCELADO">CANCELADO</option>
                            <option value="RETIRO VOLUNTARIO">RETIRO VOLUNTARIO</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal (Botones) -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end gap-3 bg-gray-50/50">
            <button type="button" @click="openModalEditar = false" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">
                Cancelar
            </button>
            <button type="submit" form="form-editar-perfil" class="px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Guardar Cambios</span>
            </button>
        </div>

    </div>
</div>

<script>
    /**
     * Rellena dinámicamente el formulario modal de edición con los datos del egresado
     */
    function populateModalEditar(data) {
        if (!data) return;

        // Actualizar URL de acción del formulario
        const form = document.getElementById('form-editar-perfil');
        if (form && data.id) {
            form.action = '/egresados/' + data.id + '/update';
        }

        const editNameLabel = document.getElementById('edit_egresado_name_label');
        if (editNameLabel && data.name) {
            editNameLabel.innerText = data.name;
        }

        const docInput = document.getElementById('edit_documento');
        if (docInput) docInput.value = data.document || '';

        const nameInput = document.getElementById('edit_nombre');
        if (nameInput) nameInput.value = data.name || '';

        const emailInput = document.getElementById('edit_correo');
        if (emailInput) {
            emailInput.value = (data.email && data.email !== 'No registra correo' && data.email !== 'Sin correo') ? data.email : '';
        }

        const phoneInput = document.getElementById('edit_telefono');
        if (phoneInput) {
            phoneInput.value = (data.phone && data.phone !== 'No registra teléfono' && data.phone !== 'Sin teléfono') ? data.phone : '';
        }

        const fichaInput = document.getElementById('edit_ficha');
        if (fichaInput) fichaInput.value = data.code || '';

        const progInput = document.getElementById('edit_programa');
        if (progInput) progInput.value = data.program || '';

        const docTypeSelect = document.getElementById('edit_tipo_documento');
        if (docTypeSelect && data.document_type) {
            const val = String(data.document_type).toUpperCase();
            if (val.includes('CÉDULA') || val.includes('CEDULA') || val === 'CC') docTypeSelect.value = 'CC';
            else if (val.includes('TARJETA') || val === 'TI') docTypeSelect.value = 'TI';
            else if (val.includes('EXTRANJERÍA') || val.includes('EXTRANJERIA') || val === 'CE') docTypeSelect.value = 'CE';
            else if (val.includes('PEP') || val.includes('PROTECCIÓN') || val.includes('PPT')) docTypeSelect.value = 'PEP';
        }

        const estadoSelect = document.getElementById('edit_estado');
        if (estadoSelect && data.status) {
            estadoSelect.value = data.status;
        }
    }
</script>
