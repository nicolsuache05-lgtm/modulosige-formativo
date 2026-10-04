<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4" x-data="{ confirmarEnvio: false, confirmarCancelacion: false }">
    
    <!-- Cabecera del Detalle -->
    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Detalle del Evento</h3>
        <span id="detailStatusBadge" class="px-2.5 py-0.5 text-[10px] font-semibold rounded-md bg-blue-50 text-blue-700">PROGRAMADO</span>
    </div>
    
    <div>
        <h4 id="detailEventTitle" class="font-bold text-gray-900 text-sm font-editorial">Feria laboral 2026</h4>
        <p id="detailEventMeta" class="text-xs text-gray-500 mt-0.5">ID: EVT-012 | Tipo: Feria laboral</p>
        <p class="text-xs text-gray-600 mt-1"><strong>Fecha:</strong> <span id="detailEventDateTime">20/06/2026 | 09:00 AM - 04:00 PM</span></p>
        <p class="text-xs text-gray-600"><strong>Lugar:</strong> <span id="detailEventLocation">Auditorio Principal</span></p>
        <p class="text-xs text-gray-600"><strong>Programa:</strong> <span id="detailEventProgram">ADSO - GAE</span></p>
        <p class="text-xs text-gray-600"><strong>Responsable:</strong> <span id="detailEventResp">Coordinación Académica</span></p>
    </div>

    <!-- Descripción -->
    <div class="bg-gray-50 p-3 rounded-xl text-xs text-gray-600 space-y-1">
        <span class="text-[11px] font-bold text-gray-400 block uppercase tracking-wider mb-1">Descripción</span>
        <p id="detailEventDesc">Feria laboral dirigida a Egresados para conectar con empresas aliadas y conocer oportunidades de empleo y prácticas profesionales.</p>
    </div>

    <!-- Estadísticas -->
    <div class="bg-gray-50 p-3.5 rounded-xl space-y-2">
        <span class="text-[11px] font-bold text-gray-400 block uppercase tracking-wider">Estadísticas</span>
        <div class="flex justify-between text-xs text-gray-600"><span>Cupo total:</span> <span id="detailCupo" class="font-bold text-gray-900">200</span></div>
        <div class="flex justify-between text-xs text-gray-600"><span>Registros Confirmados:</span> <span id="detailRegistrados" class="font-bold text-gray-900">156</span></div>
        <div class="flex justify-between text-xs text-gray-600"><span>Pendientes confirmación:</span> <span id="detailPendientes" class="font-bold text-gray-900">12</span></div>
        <div class="flex justify-between text-xs text-gray-600"><span>Tasa confirmación:</span> <span id="detailRate" class="font-bold text-emerald-700">78%</span></div>
        
        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden mt-1">
            <div id="detailProgressBar" class="bg-emerald-600 h-full rounded-full transition-all duration-300" style="width: 78%"></div>
        </div>
    </div>

    <!-- =============== BOTONES FUNCIONALES =============== -->
    <div class="space-y-2 pt-2">
        
        <!-- 1. Ver Detalle Completo (Lleva a otra vista) -->
        <a id="btnActionShow" href="{{ route('egresados.superadmin.eventos.show', ['id' => 'EVT-012']) }}" class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Ver Detalle Completo
        </a>

        <!-- 2. Editar Evento (Lleva al formulario de edición) -->
        <a id="btnActionEdit" href="{{ route('egresados.superadmin.eventos.edit', ['id' => 'EVT-012']) }}" class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Editar Evento
        </a>

        <!-- 3. Enviar Invitación (Abre Modal) -->
        <button @click="confirmarEnvio = true" type="button" class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Enviar Invitación
        </button>

        <!-- 4. Exportar Listado (Excel) -->
        <a id="btnActionExportar" href="{{ route('egresados.superadmin.eventos.exportar', ['id' => 'EVT-012']) }}" class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Exportar listado (Excel)
        </a>

        <!-- 5. Cancelar Evento (Abre Modal de Peligro) -->
        <button @click="confirmarCancelacion = true" type="button" class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 mt-2 cursor-pointer shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Cancelar Evento
        </button>
    </div>

    <!-- =============== MODALES FLOTANTES =============== -->
    
    <!-- Modal: Enviar Invitación -->
    <div x-show="confirmarEnvio" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak>
        <div @click.away="confirmarEnvio = false" class="bg-white p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Enviar Invitación Masiva</h3>
            <p class="text-xs text-gray-500 mb-4">Se enviará un correo con la invitación y el enlace de registro a todos los egresados de los programas seleccionados (<span id="modalInvitarProgramas" class="font-semibold text-gray-700">ADSO - GAE</span>).</p>
            
            <form id="formEnviarInvitacion" action="{{ route('egresados.superadmin.eventos.invitar', ['id' => 'EVT-012']) }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex items-center gap-3">
                    <button type="button" @click="confirmarEnvio = false" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">Cerrar</button>
                    <button type="submit" class="flex-1 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer">Enviar Correos</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Cancelar Evento -->
    <div x-show="confirmarCancelacion" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak>
        <div @click.away="confirmarCancelacion = false" class="bg-white p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-100 text-center">
            <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">¿Cancelar este evento?</h3>
            <p class="text-xs text-gray-500 mb-5">El evento cambiará su estado a "Cancelado" y se enviará una notificación automática a los <span id="modalCancelarAsistentes" class="font-bold text-gray-800">156</span> asistentes registrados.</p>
            
            <form id="formCancelarEvento" action="{{ route('egresados.superadmin.eventos.cancelar', ['id' => 'EVT-012']) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Campo para justificar la cancelación -->
                <textarea name="motivo_cancelacion" required rows="2" class="w-full px-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-xl mb-4 focus:ring-red-500 resize-none outline-hidden" placeholder="Motivo de la cancelación..."></textarea>
                
                <div class="flex items-center gap-3">
                    <button type="button" @click="confirmarCancelacion = false" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">Atrás</button>
                    <button type="submit" class="flex-1 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer">Sí, cancelar evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
