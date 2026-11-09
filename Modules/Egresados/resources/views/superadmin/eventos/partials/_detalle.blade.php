<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4" x-data="{ confirmarEnvio: false, confirmarCancelacion: false }">
    
    <!-- Cabecera del Detalle (Identidad SENA ERP) -->
    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[#00131E] flex items-center gap-1.5">
            <i class="fa-solid fa-calendar-check text-[#39A900]"></i>
            Detalle del Evento
        </h3>
        <span id="detailStatusBadge" class="px-2.5 py-0.5 text-[10px] font-extrabold rounded-md bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">PROGRAMADO</span>
    </div>
    
    <div class="space-y-1">
        <h4 id="detailEventTitle" class="font-bold text-[#00131E] text-sm font-editorial">Feria laboral 2026</h4>
        <p id="detailEventMeta" class="text-xs text-gray-500">ID: <span class="font-bold text-[#39A900]">EVT-012</span> | Tipo: Feria laboral</p>
        <p class="text-xs text-gray-600 pt-1"><strong>Fecha:</strong> <span id="detailEventDateTime">20/06/2026 | 09:00 AM - 04:00 PM</span></p>
        <p class="text-xs text-gray-600"><strong>Lugar:</strong> <span id="detailEventLocation">Auditorio Principal</span></p>
        <p class="text-xs text-gray-600"><strong>Programa:</strong> <span id="detailEventProgram" class="font-semibold text-[#166534]">ADSO - GAE</span></p>
        <p class="text-xs text-gray-600"><strong>Responsable:</strong> <span id="detailEventResp">Coordinación Académica</span></p>
    </div>

    <!-- Descripción -->
    <div class="bg-gray-50/80 p-3.5 rounded-xl text-xs text-gray-600 space-y-1 border border-gray-100 border-l-4 border-l-[#001A29]">
        <span class="text-[10px] font-bold text-gray-400 block uppercase tracking-wider">Descripción del Evento</span>
        <p id="detailEventDesc" class="leading-relaxed text-gray-600">Feria laboral dirigida a Egresados para conectar con empresas aliadas y conocer oportunidades de empleo y prácticas profesionales.</p>
    </div>

    <!-- Estadísticas -->
    <div class="bg-gray-50/80 p-3.5 rounded-xl space-y-2 border border-gray-100 border-l-4 border-l-[#39A900]">
        <span class="text-[10px] font-bold text-gray-400 block uppercase tracking-wider">Estadísticas de Aforo</span>
        <div class="flex justify-between text-xs text-gray-600"><span>Cupo total:</span> <span id="detailCupo" class="font-bold text-[#00131E]">200</span></div>
        <div class="flex justify-between text-xs text-gray-600"><span>Registros Confirmados:</span> <span id="detailRegistrados" class="font-bold text-[#166534]">156</span></div>
        <div class="flex justify-between text-xs text-gray-600"><span>Pendientes confirmación:</span> <span id="detailPendientes" class="font-bold text-amber-600">12</span></div>
        <div class="flex justify-between text-xs text-gray-600"><span>Tasa de Ocupación:</span> <span id="detailRate" class="font-bold text-[#39A900]">78%</span></div>
        
        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden mt-1.5">
            <div id="detailProgressBar" class="bg-gradient-to-r from-[#001A29] to-[#39A900] h-full rounded-full transition-all duration-300" style="width: 78%"></div>
        </div>
    </div>

    <!-- =============== BOTONES FUNCIONALES =============== -->
    <div class="space-y-2 pt-2">
        
        <!-- 1. Ver Detalle Completo (Abre modal institucional con colores del ERP) -->
        <button type="button" 
                id="btnActionShow" 
                onclick="abrirModalDetalleEvento()" 
                class="w-full py-2.5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] hover:from-[#001A29] hover:to-[#00283d] text-white border border-white/10 text-xs font-bold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
            <i class="fa-solid fa-eye text-[#62E31D] text-xs"></i>
            <span>Ver Detalle Completo</span>
        </button>

        <!-- 2. Exportar Asistentes (Excel) -->
        <a id="btnActionExportar" 
           href="{{ route('egresados.superadmin.eventos.exportar', ['id' => 'EVT-012']) }}" 
           class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-xs flex items-center justify-center gap-2 cursor-pointer">
            <i class="fa-solid fa-file-excel text-[#39A900] text-xs"></i>
            <span>Exportar Asistentes (Excel)</span>
        </a>

        <!-- 3. Enviar Invitación (Abre Modal) -->
        <button @click="confirmarEnvio = true" type="button" class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Enviar Invitación
        </button>

        <!-- 3. Cancelar Evento (Abre Modal de Peligro) -->
        <button @click="confirmarCancelacion = true" type="button" class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 mt-2 cursor-pointer shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Cancelar Evento
        </button>
    </div>

    <!-- =============== MODALES FLOTANTES =============== -->
    
    <!-- Modal: Enviar Invitación con Selección de Destinatarios (Identidad SENA ERP) -->
    <div x-show="confirmarEnvio" 
         style="display: none;" 
         x-data="{
             tipoDestinatario: 'especifico',
             filtroPrograma: '',
             busquedaEgresado: '',
             selectedEgresados: [],
             egresadosDisponibles: {{ json_encode($egresadosList ?? []) }},
             toggleAll() {
                 if (this.selectedEgresados.length === this.filteredEgresados.length) {
                     this.selectedEgresados = [];
                 } else {
                     this.selectedEgresados = this.filteredEgresados.map(e => e.id);
                 }
             },
             get filteredEgresados() {
                 let list = this.egresadosDisponibles || [];
                 if (this.filtroPrograma) {
                     list = list.filter(e => (e.programa || '').toLowerCase().includes(this.filtroPrograma.toLowerCase()));
                 }
                 if (this.busquedaEgresado.trim()) {
                     const q = this.busquedaEgresado.toLowerCase();
                     list = list.filter(e => 
                         (e.nombre || '').toLowerCase().includes(q) || 
                         (e.documento || '').toLowerCase().includes(q) ||
                         (e.ficha || '').toLowerCase().includes(q)
                     );
                 }
                 return list;
             }
         }"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-8 sm:pt-14 p-3 sm:p-4" x-cloak>
        <div @click.away="confirmarEnvio = false" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
             class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-gray-100 overflow-hidden transform flex flex-col max-h-[92vh]">
            
            <!-- Encabezado del Modal con Identidad SENA ERP -->
            <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 py-4 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-base shadow-md shadow-black/20 flex-shrink-0">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                    <div>
                        <span class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider block">CONVOCATORIA Y DESTINATARIOS · SIGE ERP</span>
                        <h3 class="text-base sm:text-lg font-bold text-white tracking-tight">Enviar Invitación a Evento</h3>
                    </div>
                </div>
                <button @click="confirmarEnvio = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="p-5 sm:p-6 bg-[#f8fafc]/80 overflow-y-auto space-y-4 flex-1">
                
                <form id="formEnviarInvitacion" action="{{ route('egresados.superadmin.eventos.invitar', ['id' => 'EVT-012']) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Segmentación de Destinatarios -->
                    <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-2xs space-y-3">
                        <span class="text-[11px] font-bold text-[#00131E] uppercase tracking-wider block flex items-center gap-1.5">
                            <i class="fa-solid fa-users text-[#39A900]"></i>
                            ¿A quién deseas enviar la invitación?
                        </span>
                        
                        <!-- Opciones en tarjetas radiales -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                            <label class="relative flex flex-col p-3 rounded-xl border cursor-pointer transition text-xs"
                                   :class="tipoDestinatario === 'especifico' ? 'border-[#39A900] bg-[#EAF7EE]/50 ring-1 ring-[#39A900]' : 'border-gray-200 hover:bg-gray-50'">
                                <input type="radio" name="tipo_destinatario" value="especifico" x-model="tipoDestinatario" class="sr-only">
                                <span class="font-bold text-[#00131E] flex items-center gap-1.5 mb-1">
                                    <i class="fa-solid fa-user-check text-[#39A900]"></i>
                                    Específicos
                                </span>
                                <span class="text-[10.5px] text-gray-500">Elegir egresados uno a uno</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border cursor-pointer transition text-xs"
                                   :class="tipoDestinatario === 'programa' ? 'border-[#39A900] bg-[#EAF7EE]/50 ring-1 ring-[#39A900]' : 'border-gray-200 hover:bg-gray-50'">
                                <input type="radio" name="tipo_destinatario" value="programa" x-model="tipoDestinatario" class="sr-only">
                                <span class="font-bold text-[#00131E] flex items-center gap-1.5 mb-1">
                                    <i class="fa-solid fa-graduation-cap text-[#39A900]"></i>
                                    Por Programa
                                </span>
                                <span class="text-[10.5px] text-gray-500">Filtrar por especialidad</span>
                            </label>

                            <label class="relative flex flex-col p-3 rounded-xl border cursor-pointer transition text-xs"
                                   :class="tipoDestinatario === 'todos' ? 'border-[#39A900] bg-[#EAF7EE]/50 ring-1 ring-[#39A900]' : 'border-gray-200 hover:bg-gray-50'">
                                <input type="radio" name="tipo_destinatario" value="todos" x-model="tipoDestinatario" class="sr-only">
                                <span class="font-bold text-[#00131E] flex items-center gap-1.5 mb-1">
                                    <i class="fa-solid fa-bullhorn text-[#39A900]"></i>
                                    Todos
                                </span>
                                <span class="text-[10.5px] text-gray-500">Convocatoria masiva</span>
                            </label>
                        </div>
                    </div>

                    <!-- Panel si elige 'Por Programa' -->
                    <div x-show="tipoDestinatario === 'programa'" x-cloak class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-2xs space-y-2">
                        <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Seleccionar Programa de Formación</label>
                        <select name="filtro_programa" x-model="filtroPrograma" class="w-full px-3.5 py-2.5 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] outline-none">
                            <option value="">-- Selecciona un programa --</option>
                            @foreach($programsList ?? ['ADSO', 'Gestión Agroempresarial', 'Producción Ganadera', 'Producción Agrícola', 'Contabilización'] as $pName)
                                <option value="{{ $pName }}">{{ $pName }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10.5px] text-gray-500 mt-1">Se enviará exclusivamente a los egresados registrados pertenecientes a este programa.</p>
                    </div>

                    <!-- Panel si elige 'Todos' -->
                    <div x-show="tipoDestinatario === 'todos'" x-cloak class="bg-emerald-50/70 border border-emerald-200 p-4 rounded-2xl flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-[#39A900] text-base mt-0.5"></i>
                        <div class="text-xs text-gray-700 leading-relaxed">
                            <strong class="text-[#00131E] block mb-0.5">Convocatoria General CEFA</strong>
                            La invitación será despachada a la base completa de egresados vinculados al sistema institucional.
                        </div>
                    </div>

                    <!-- Panel si elige 'Específicos' (Lista con checkboxes y buscador) -->
                    <div x-show="tipoDestinatario === 'especifico'" x-cloak class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-2xs space-y-3">
                        
                        <!-- Filtros del buscador de egresados -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <div class="relative">
                                <input type="text" x-model="busquedaEgresado" placeholder="Buscar por nombre o cédula..." 
                                       class="w-full pl-8 pr-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-800 focus:bg-white focus:border-[#39A900] outline-none">
                                <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                            </div>
                            <div>
                                <select x-model="filtroPrograma" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl font-medium text-gray-700 focus:bg-white focus:border-[#39A900] outline-none">
                                    <option value="">Todos los programas</option>
                                    @foreach($programsList ?? ['ADSO', 'Gestión Agroempresarial', 'Producción Ganadera'] as $pName)
                                        <option value="{{ $pName }}">{{ $pName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Barra de control y conteo -->
                        <div class="flex items-center justify-between pt-1 border-b border-gray-100 pb-2 text-xs">
                            <button type="button" @click="toggleAll()" class="text-[#166534] hover:underline font-bold text-[11px] flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-check-double text-[#39A900]"></i>
                                <span x-text="selectedEgresados.length === filteredEgresados.length && filteredEgresados.length > 0 ? 'Deseleccionar todos' : 'Seleccionar todos (' + filteredEgresados.length + ')'"></span>
                            </button>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10.5px] font-extrabold bg-[#EAF7EE] text-[#166534] border border-[#BBF7D0]">
                                <span x-text="selectedEgresados.length"></span> seleccionados
                            </span>
                        </div>

                        <!-- Lista scrolleable de egresados -->
                        <div class="max-h-56 overflow-y-auto divide-y divide-gray-100 border border-gray-100 rounded-xl bg-gray-50/40">
                            <template x-for="egr in filteredEgresados" :key="egr.id">
                                <label class="flex items-center gap-3 p-2.5 hover:bg-emerald-50/60 cursor-pointer transition text-xs">
                                    <input type="checkbox" name="egresados_ids[]" :value="egr.id" x-model="selectedEgresados" 
                                           class="w-4 h-4 text-[#39A900] rounded focus:ring-[#39A900] border-gray-300">
                                    <div class="w-7 h-7 rounded-lg bg-[#EAF7EE] text-[#166534] font-extrabold flex items-center justify-center text-[10px] flex-shrink-0">
                                        <span x-text="(egr.nombre || 'E').substring(0, 2).toUpperCase()"></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-bold text-gray-900 truncate" x-text="egr.nombre"></div>
                                        <div class="text-[10px] text-gray-500 flex items-center gap-2 truncate">
                                            <span>CC: <strong x-text="egr.documento"></strong></span>
                                            <span class="text-gray-300">•</span>
                                            <span class="text-[#166534] font-medium" x-text="egr.programa"></span>
                                        </div>
                                    </div>
                                </label>
                            </template>
                            <div x-show="filteredEgresados.length === 0" class="p-6 text-center text-gray-400 text-xs">
                                No se encontraron egresados con ese criterio de búsqueda.
                            </div>
                        </div>

                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="confirmarEnvio = false" class="py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit" 
                                :disabled="tipoDestinatario === 'especifico' && selectedEgresados.length === 0"
                                :class="tipoDestinatario === 'especifico' && selectedEgresados.length === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:from-[#2e8b00] hover:to-[#247000] cursor-pointer shadow-md shadow-[#39A900]/25'"
                                class="flex-1 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] text-white text-xs font-bold rounded-xl transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            <span x-show="tipoDestinatario === 'especifico'" x-text="'Enviar a ' + selectedEgresados.length + ' egresado(s)'"></span>
                            <span x-show="tipoDestinatario === 'programa'">Enviar a egresados del programa</span>
                            <span x-show="tipoDestinatario === 'todos'">Enviar a todos los egresados</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal: Cancelar / Retirar Evento (Identidad SENA ERP) -->
    <div x-show="confirmarCancelacion" 
         style="display: none;" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.window.escape="confirmarCancelacion = false"
         class="fixed inset-0 z-[60] overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-14 sm:pt-20 p-4" 
         x-cloak>
        <div @click.away="confirmarCancelacion = false" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
             class="bg-white rounded-3xl max-w-md w-full shadow-2xl border border-gray-100 overflow-hidden transform">
            
            <!-- Encabezado con Identidad SENA ERP -->
            <div class="flex items-center justify-between border-b-2 border-red-500 px-6 py-4 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-600 to-red-700 text-white flex items-center justify-center text-base shadow-md shadow-black/20 flex-shrink-0">
                        <i class="fa-solid fa-calendar-xmark"></i>
                    </div>
                    <div>
                        <span class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider block">GESTIÓN DE EVENTOS · SIGE ERP</span>
                        <h3 class="text-base font-bold text-white tracking-tight mt-0.5">Cancelar Evento Institucional</h3>
                    </div>
                </div>
                <button @click="confirmarCancelacion = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Contenido y Formulario de Cancelación -->
            <div class="p-6 space-y-4 bg-white">
                <!-- Advertencia Institucional -->
                <div class="p-4 rounded-2xl bg-red-50/80 border border-red-200/80 flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-red-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-xs">
                        <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                    </div>
                    <div class="text-xs text-red-950 flex-1">
                        <div class="font-bold text-red-900">¿Deseas cancelar este evento institucional?</div>
                        <p class="text-red-700 text-[11px] mt-1 leading-relaxed">
                            El estado cambiará inmediatamente a <strong>"Cancelado"</strong> y se notificará automáticamente a los <strong id="modalCancelarAsistentes" class="font-extrabold text-red-900 underline">156</strong> asistentes registrados.
                        </p>
                    </div>
                </div>

                <!-- Tarjeta del Evento Seleccionado -->
                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex items-center justify-between text-xs">
                    <div class="overflow-hidden">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Evento Seleccionado</span>
                        <span id="modalCancelarTitulo" class="font-bold text-gray-800 text-xs truncate block mt-0.5">Feria laboral 2026</span>
                    </div>
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-extrabold bg-[#001A29] text-[#62E31D] flex-shrink-0 ml-3 uppercase">CEFA</span>
                </div>

                <form id="formCancelarEvento" action="{{ route('egresados.superadmin.eventos.cancelar', ['id' => 'EVT-012']) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-[11px] font-bold text-[#00131E] uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-comment-dots text-red-600"></i>
                            <span>Motivo de la Cancelación</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea name="motivo_cancelacion" required rows="2" 
                                  class="w-full px-3.5 py-2.5 text-xs bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-600 outline-none resize-none transition" 
                                  placeholder="Indique la justificación para registrar en el historial institucional y notificar a los egresados..."></textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="confirmarCancelacion = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                            Atrás
                        </button>
                        <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-xs font-bold rounded-xl transition shadow-md shadow-red-600/25 flex items-center justify-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-calendar-xmark text-xs"></i>
                            <span>Sí, cancelar evento</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
