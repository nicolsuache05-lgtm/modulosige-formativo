<!-- Modules/Egresados/resources/views/superadmin/partials/_modal_perfil_egresado.blade.php -->
<!-- VENTANA FLOTANTE: PERFIL COMPLETO DEL EGRESADO (Estilo idéntico al expediente de Instructores) -->

<div x-show="openModalPerfilEgresado" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.window.escape="openModalPerfilEgresado = false"
     class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" x-cloak>
    
    <div @click.away="openModalPerfilEgresado = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 flex flex-col max-h-[92vh] overflow-hidden">
        
        <!-- Encabezado de la Ventana Flotante -->
        <div class="flex items-center justify-between border-b border-gray-100 px-6 sm:px-8 py-5 bg-gradient-to-r from-[#001A29] to-[#00131E] text-white">
            <div class="flex items-center gap-4">
                <div id="modalEgresadoInitials" class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg shadow-inner">
                    EG
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-[10.5px] font-extrabold text-emerald-300 uppercase tracking-wider">EXPEDIENTE DEL EGRESADO · SIGE</span>
                        <span id="modalEgresadoStatusPill" class="px-2 py-0.5 text-[10px] font-extrabold rounded-full bg-emerald-50 text-emerald-700 uppercase">
                            CERTIFICADO
                        </span>
                    </div>
                    <h3 id="modalEgresadoName" class="text-xl font-bold text-white tracking-tight">Cargando egresado...</h3>
                    <p class="text-xs text-green-100/70 mt-0.5">Centro de Formación Agroindustrial La Angostura — CEFA</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" 
                        @click="openModalPerfilEgresado = false; populateModalEditar(window.currentSelectedEgresado); openModalEditar = true;" 
                        class="px-3.5 py-1.5 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-semibold flex items-center gap-1.5 transition border border-white/20 cursor-pointer">
                    <i class="fa-solid fa-pen-to-square text-amber-300"></i>
                    <span>Editar Datos</span>
                </button>
                <button @click="openModalPerfilEgresado = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Cuerpo de la Ventana Flotante con Scroll -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto space-y-6">
            
            <!-- 1. Información de Contacto y Personal -->
            <div>
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100">Información Personal y de Contacto</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block">Documento de Identidad</span>
                        <p id="modalEgresadoDoc" class="text-sm font-bold text-gray-800 mt-0.5">Cédula: N/A</p>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block">Correo Electrónico</span>
                        <p id="modalEgresadoEmail" class="text-sm font-bold text-gray-800 mt-0.5 break-all">correo@sena.edu.co</p>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block">Teléfono / Celular</span>
                        <p id="modalEgresadoPhone" class="text-sm font-bold text-gray-800 mt-0.5">No registra</p>
                    </div>
                    <div class="bg-gray-50 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block">Protección de Datos (Habeas Data)</span>
                        <p class="text-sm font-bold text-emerald-700 mt-0.5 flex items-center gap-1">
                            <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                            Autorizado y Verificado
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. Formación Académica SENA -->
            <div>
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100">Formación Académica SENA</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50/60 border border-emerald-100 p-3.5 rounded-2xl sm:col-span-2">
                        <span class="text-[10px] text-emerald-700 font-bold uppercase block">Programa Principal de Formación</span>
                        <p id="modalEgresadoProgram" class="text-sm font-bold text-emerald-900 mt-0.5">Análisis y Desarrollo de Software (ADSO)</p>
                    </div>
                    <div class="bg-emerald-50/60 border border-emerald-100 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-emerald-700 font-bold uppercase block">Código de Ficha</span>
                        <p id="modalEgresadoCode" class="text-sm font-bold text-emerald-900 mt-0.5">N/A</p>
                    </div>
                    <div class="bg-emerald-50/60 border border-emerald-100 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-emerald-700 font-bold uppercase block">Centro de Formación</span>
                        <p class="text-sm font-bold text-emerald-900 mt-0.5">CEFA La Angostura (Campoalegre)</p>
                    </div>
                </div>
            </div>

            <!-- 3. Situación Laboral y Ocupacional -->
            <div>
                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 pb-1 border-b border-gray-100">Situación Laboral y Ocupacional</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-blue-50/50 border border-blue-100 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-blue-700 font-bold uppercase block">Estado Actual</span>
                        <p id="modalEgresadoStatusText" class="text-sm font-bold text-blue-900 mt-0.5">CERTIFICADO</p>
                    </div>
                    <div class="bg-blue-50/50 border border-blue-100 p-3.5 rounded-2xl">
                        <span class="text-[10px] text-blue-700 font-bold uppercase block">Empresa Actual / Vinculación</span>
                        <p class="text-sm font-bold text-blue-900 mt-0.5">Agroindustrias del Huila S.A.S</p>
                    </div>
                </div>
            </div>

            <!-- 4. Trazabilidad de Seguimiento -->
            <div>
                <div class="flex items-center justify-between mb-3 pb-1 border-b border-gray-100">
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Trazabilidad de Seguimiento Institucional</h4>
                    <span class="text-[10px] text-emerald-700 font-bold">Bitácora Oficial</span>
                </div>
                
                <div class="relative border-l-2 border-gray-100 ml-3 space-y-6 pb-2">
                    <!-- Hito 1 -->
                    <div class="relative pl-6">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-white border-2 border-emerald-500 rounded-full"></div>
                        <div>
                            <span class="text-xs font-bold text-emerald-600">12 Agosto 2026</span>
                            <h5 class="font-bold text-gray-800 mt-0.5 text-sm">Contacto Telefónico</h5>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                El egresado confirma que sigue laborando en su sector formativo y solicita información sobre especializaciones tecnológicas del centro.
                            </p>
                            <span class="text-[10px] text-gray-400 mt-1.5 block">Registrado por: Super Admin CEFA</span>
                        </div>
                    </div>

                    <!-- Hito 2 -->
                    <div class="relative pl-6">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-white border-2 border-blue-500 rounded-full"></div>
                        <div>
                            <span class="text-xs font-bold text-blue-600">15 Mayo 2026</span>
                            <h5 class="font-bold text-gray-800 mt-0.5 text-sm">Encuesta de Graduación</h5>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                Diligenció encuesta de satisfacción de egresados, calificando con 5/5 la calidad de formación recibida en el CEFA.
                            </p>
                            <span class="text-[10px] text-gray-400 mt-1.5 block">Registrado por: Sistema Automático SIGE</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pie de la Ventana Flotante -->
        <div class="border-t border-gray-100 px-6 sm:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-gray-50/50">
            <button type="button" 
                    @click="openModalPerfilEgresado = false" 
                    class="w-full sm:w-auto px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-sm text-center">
                Cerrar Expediente
            </button>

            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                <button type="button" 
                        @click="openModalPerfilEgresado = false; populateModalEditar(window.currentSelectedEgresado); openModalEditar = true;" 
                        class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded-xl transition cursor-pointer shadow-sm flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Editar Datos</span>
                </button>

                <button type="button" 
                        @click="openModalPerfilEgresado = false; openModalSeguimiento = true;" 
                        class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition cursor-pointer shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Registrar Seguimiento</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Rellena todos los campos de la ventana flotante de perfil de egresado
     */
    function populateModalPerfilEgresado(data) {
        if (!data) return;

        const mpInit = document.getElementById('modalEgresadoInitials');
        if (mpInit) mpInit.innerText = data.initials || 'EG';

        const mpName = document.getElementById('modalEgresadoName');
        if (mpName) mpName.innerText = data.name || 'Egresado';

        const mpDoc = document.getElementById('modalEgresadoDoc');
        if (mpDoc) mpDoc.innerText = (data.document_type || 'CC') + ': ' + (data.document || 'N/A');

        const mpEmail = document.getElementById('modalEgresadoEmail');
        if (mpEmail) mpEmail.innerText = data.email || 'Sin correo';

        const mpPhone = document.getElementById('modalEgresadoPhone');
        if (mpPhone) mpPhone.innerText = data.phone || 'No registra';

        const mpProg = document.getElementById('modalEgresadoProgram');
        if (mpProg) mpProg.innerText = data.program || 'Programa de Formación CEFA';

        const mpCode = document.getElementById('modalEgresadoCode');
        if (mpCode) mpCode.innerText = data.code || 'N/A';

        const statusText = data.status || 'CERTIFICADO';
        const mpStatusPill = document.getElementById('modalEgresadoStatusPill');
        if (mpStatusPill) {
            mpStatusPill.innerText = statusText;
            mpStatusPill.className = 'px-2 py-0.5 text-[10px] font-extrabold rounded-full uppercase ' +
                (data.pill_class === 'status-blue' ? 'bg-blue-50 text-blue-700' :
                (data.pill_class === 'status-red' ? 'bg-red-50 text-red-700' :
                (data.pill_class === 'status-amber' ? 'bg-amber-50 text-amber-700' :
                'bg-emerald-50 text-emerald-700')));
        }

        const mpStatusText = document.getElementById('modalEgresadoStatusText');
        if (mpStatusText) mpStatusText.innerText = statusText;

        // Sincronizar datos en el modal de seguimiento
        const segInput = document.getElementById('seguimiento_egresado_id');
        if (segInput && data.id) segInput.value = data.id;
        const segLabel = document.getElementById('seguimiento_egresado_name_label');
        if (segLabel && data.name) segLabel.innerText = data.name;
    }
</script>
