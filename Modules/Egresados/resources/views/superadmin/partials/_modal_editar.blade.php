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
     x-effect="if (openModalEditar) openEditarModal()"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalEditar = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado del Modal con Identidad SENA ERP -->
        <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 sm:px-8 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center font-bold text-lg shadow-md shadow-black/20">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <div class="text-[10px] font-extrabold text-[#62E31D] uppercase tracking-wider">EDICIÓN DE EXPEDIENTE · SIGE</div>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">Editar Datos del Egresado</h3>
                    <p class="text-xs text-white/70 mt-0.5">Modificando información de: <strong id="edit_egresado_name_label" class="text-[#62E31D] font-bold">Egresado</strong></p>
                </div>
            </div>
            <button @click="openModalEditar = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
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
                    <h4 class="text-xs font-bold text-[#00131E] uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-2">
                        <i class="fa-solid fa-id-card text-[#39A900]"></i>
                        <span>Información Personal e Identificación</span>
                    </h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-1">
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tipo Documento</label>
                            <select name="tipo_documento" id="edit_tipo_documento" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium">
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                                <option value="PEP">Permiso de Protección Temporal</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">Número de Documento <span class="text-red-500">*</span></label>
                            <input type="text" name="documento" id="edit_documento" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ej. 107584578" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nombre Completo (Nombres y Apellidos) <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" id="edit_nombre" required placeholder="Nombres y Apellidos" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="correo" id="edit_correo" required placeholder="correo@sena.edu.co" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Teléfono / Celular</label>
                            <input type="tel" name="telefono" id="edit_telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ej. 3201234567" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-400 mt-2">Los datos de contacto (correo y teléfono) deben ser únicos y no pertenecer a otro registro.</p>
                </div>

                <!-- Sección 2: Información Académica y Estado -->
                <div>
                    <h4 class="text-xs font-bold text-[#00131E] uppercase tracking-wider mb-3 pb-1 border-b border-gray-100 flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                        <span>Formación Académica y Estado Ocupacional</span>
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Programa de Formación</label>
                            <input type="text" name="programa" id="edit_programa" list="lista_programas_formacion_edit" placeholder="Escribe el programa de formación" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
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
                            <label class="block text-xs font-bold text-gray-700 mb-1">Código de Ficha SENA</label>
                            <input type="text" name="ficha" id="edit_ficha" placeholder="Ej. 3230026" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-power-off text-[#39A900]"></i>
                                <span>Estado en SIGE (Acceso al Sistema) <span class="text-red-500">*</span></span>
                            </label>
                            <select name="is_active" id="edit_is_active" required class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                                <option value="1">🟢 Activo (Habilitado)</option>
                                <option value="0">🔴 Inactivo (Desactivado)</option>
                            </select>
                            <p class="text-[11px] text-gray-400 mt-1">Permite activar o desactivar al egresado en el sistema.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                                <span>Estado Ocupacional / Formativo</span>
                            </label>
                            <select name="estado" id="edit_estado" class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#39A900]/20 focus:border-[#39A900] outline-none font-medium text-gray-800">
                                <option value="CERTIFICADO">CERTIFICADO</option>
                                <option value="EN FORMACIÓN">EN FORMACIÓN</option>
                                <option value="CONDICIONADO">CONDICIONADO</option>
                                <option value="INDUCCIÓN">INDUCCIÓN</option>
                                <option value="APLAZADO">APLAZADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                                <option value="RETIRO VOLUNTARIO">RETIRO VOLUNTARIO</option>
                            </select>
                            <p class="text-[11px] text-gray-400 mt-1">Situación formativa en el centro CEFA.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Pie del Modal (Botones) -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex items-center justify-end gap-3 bg-[#f8faf9]">
            <button type="button" @click="openModalEditar = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                Cancelar
            </button>
            <button type="submit" form="form-editar-perfil" class="px-6 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 hover:shadow-lg cursor-pointer flex items-center gap-2 border-0">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Guardar Cambios</span>
            </button>
        </div>

    </div>
</div>

<script>
    if (typeof parseJsonSafe !== 'function') {
        window.parseJsonSafe = function(raw) {
            if (!raw) return null;
            try {
                return JSON.parse(raw);
            } catch(e1) {
                try {
                    const doc = new DOMParser().parseFromString(raw, 'text/html');
                    const decoded = doc.body.textContent;
                    return JSON.parse(decoded);
                } catch(e2) {
                    console.error('Error parseando json de egresado:', e2, raw);
                    return null;
                }
            }
        };
    }

    /**
     * Función global para abrir y sincronizar el modal de edición
     */
    function openEditarModal(data) {
        if (!data) {
            data = window.currentSelectedEgresado;
        }
        if (!data) {
            const selRow = document.querySelector('.egresado-row.selected-row') || document.querySelector('.egresado-row');
            if (selRow) {
                const raw = selRow.getAttribute('data-json');
                data = window.parseJsonSafe(raw);
            }
        }
        if (data) {
            populateModalEditar(data);
        }
    }

    /**
     * Rellena dinámicamente el formulario modal de edición con los datos del egresado
     */
    function populateModalEditar(data) {
        if (!data) {
            data = window.currentSelectedEgresado;
        }
        if (!data) {
            const selRow = document.querySelector('.egresado-row.selected-row') || document.querySelector('.egresado-row');
            if (selRow) {
                const raw = selRow.getAttribute('data-json');
                data = window.parseJsonSafe(raw);
            }
        }
        if (!data) return;

        // Mantener referencia global sincronizada
        window.currentSelectedEgresado = data;

        // Actualizar URL canónica de acción del formulario
        const form = document.getElementById('form-editar-perfil');
        if (form && data.id) {
            const isInstructor = window.location.pathname.includes('/instructor');
            form.action = (isInstructor ? '{{ url("egresados/instructor") }}' : '{{ url("egresados") }}') + '/' + data.id + '/update';
        }

        const editNameLabel = document.getElementById('edit_egresado_name_label');
        if (editNameLabel) {
            editNameLabel.innerText = data.name || data.fullName || 'Egresado';
        }

        // 1. Tipo de documento
        const docTypeSelect = document.getElementById('edit_tipo_documento');
        if (docTypeSelect && (data.document_type || data.doc_type || data.tipo_documento)) {
            const val = String(data.document_type || data.doc_type || data.tipo_documento).toUpperCase();
            if (val.includes('TARJETA') || val === 'TI') docTypeSelect.value = 'TI';
            else if (val.includes('EXTRANJER') || val === 'CE') docTypeSelect.value = 'CE';
            else if (val.includes('PEP') || val.includes('PROTECCI') || val.includes('PPT') || val.includes('PERMISO')) docTypeSelect.value = 'PEP';
            else docTypeSelect.value = 'CC';
        }

        // 2. Número de documento
        const docInput = document.getElementById('edit_documento');
        if (docInput) {
            const rawDoc = String(data.document_raw || data.document_number || data.document || data.doc || '').replace(/\D/g, '');
            docInput.value = rawDoc;
        }

        // 3. Nombre completo
        const nameInput = document.getElementById('edit_nombre');
        if (nameInput) {
            nameInput.value = data.name || data.fullName || data.nombre || '';
        }

        // 4. Correo electrónico
        const emailInput = document.getElementById('edit_correo');
        if (emailInput) {
            const rawEmail = String(data.email_raw || data.email || data.correo || data.personal_email || data.misena_email || '').trim();
            emailInput.value = (!rawEmail.includes('No registra') && !rawEmail.includes('Sin correo')) ? rawEmail : '';
        }

        // 5. Teléfono
        const phoneInput = document.getElementById('edit_telefono');
        if (phoneInput) {
            const rawPhone = String(data.phone_raw || data.phone || data.telefono || data.telephone1 || '').replace(/\D/g, '');
            phoneInput.value = rawPhone;
        }

        // 6. Código de Ficha
        const fichaInput = document.getElementById('edit_ficha');
        if (fichaInput) {
            const rawCode = String(data.code_raw || data.code || data.ficha || '').trim();
            fichaInput.value = (rawCode && rawCode !== 'N/A' && rawCode !== 'Sin ficha') ? rawCode : '';
        }

        // 7. Programa de Formación
        const progInput = document.getElementById('edit_programa');
        if (progInput) {
            let rawProg = String(data.program_raw || data.program || data.programa || '').trim();
            if (rawProg === 'Sin programa') rawProg = '';
            progInput.value = rawProg;
        }

        // 8. Estado en SIGE (is_active)
        const activeSelect = document.getElementById('edit_is_active');
        if (activeSelect) {
            const isAct = (data.is_active === true || data.is_active === 1 || data.is_active === '1' || data.is_active === 'true');
            activeSelect.value = isAct ? '1' : '0';
        }

        // 9. Estado Ocupacional / Formativo
        const estadoSelect = document.getElementById('edit_estado');
        if (estadoSelect && (data.status || data.estado)) {
            const cleanSt = String(data.status || data.estado).toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim();
            for (let i = 0; i < estadoSelect.options.length; i++) {
                const opt = estadoSelect.options[i];
                const optClean = opt.value.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim();
                if (optClean === cleanSt || opt.value === (data.status || data.estado)) {
                    estadoSelect.value = opt.value;
                    break;
                }
            }
        }
    }
</script>
