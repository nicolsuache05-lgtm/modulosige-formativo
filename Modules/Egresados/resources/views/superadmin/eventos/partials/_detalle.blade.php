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

        <!-- 2. Enviar Invitación (Abre Modal) -->
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
    
    <!-- Modal: Enviar Invitación (Identidad SENA ERP) -->
    <div x-show="confirmarEnvio" 
         style="display: none;" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-14 sm:pt-20 p-4" x-cloak>
        <div @click.away="confirmarEnvio = false" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
             class="bg-white rounded-3xl max-w-md w-full shadow-2xl border border-gray-100 overflow-hidden transform">
            
            <!-- Encabezado del Modal con Identidad SENA ERP -->
            <div class="flex items-center justify-between border-b-2 border-[#39A900] px-6 py-5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] text-white">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#39A900] to-[#2e8b00] text-white flex items-center justify-center text-lg shadow-md shadow-black/20 flex-shrink-0">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                    <div>
                        <span class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider block">CONVOCATORIA INSTITUCIONAL · SIGE ERP</span>
                        <h3 class="text-base sm:text-lg font-bold text-white tracking-tight mt-0.5">Enviar Invitación Masiva</h3>
                    </div>
                </div>
                <button @click="confirmarEnvio = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar ventana">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="p-6 bg-[#f8fafc]/80 space-y-4">
                <div class="bg-white p-4 rounded-2xl border border-gray-200/80 border-l-4 border-l-[#39A900] shadow-2xs space-y-3">
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Se enviará la invitación oficial por correo electrónico y se notificará en tiempo real en el <strong>Dashboard</strong> y centro de alertas de los egresados destinatarios.
                    </p>
                    <div class="p-3 rounded-xl bg-gray-50 border border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Programas Destinatarios</span>
                        <span id="modalInvitarProgramas" class="font-bold text-[#166534] text-xs block mt-0.5">ADSO - GAE</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-[#00131E] bg-[#EAF7EE] p-2.5 rounded-xl border border-[#BBF7D0]">
                        <i class="fa-solid fa-circle-check text-[#39A900] text-sm"></i>
                        <span class="text-[11px] font-medium text-[#166534]">Publicación inmediata en el Portal del Egresado</span>
                    </div>
                </div>

                <form id="formEnviarInvitacion" action="{{ route('egresados.superadmin.eventos.invitar', ['id' => 'EVT-012']) }}" method="POST">
                    @csrf
                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="confirmarEnvio = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            <span>Enviar Invitación</span>
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
