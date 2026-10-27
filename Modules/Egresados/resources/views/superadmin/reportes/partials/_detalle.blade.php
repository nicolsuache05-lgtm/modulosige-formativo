<!-- ============================================== -->
<!-- 3. DETALLE LATERAL DEL REPORTE (1/3 DEL GRID - STICKY) -->
<!-- ============================================== -->
<div class="lg:col-span-1">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4 sticky top-20" 
         x-data="{ confirmarEliminar: false, confirmarEnvio: false, activeId: 'REP_002', activeTitle: 'Reporte de empleabilidad ADSO' }">
        
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Detalle del Reporte</h3>
            <span id="detailStatusBadge" class="px-2.5 py-0.5 text-[10px] font-semibold rounded-md bg-emerald-50 text-emerald-700">GENERADO</span>
        </div>
        
        <div>
            <h4 id="detailReportTitle" class="font-bold text-gray-900 text-sm">Reporte de empleabilidad ADSO</h4>
            <p id="detailReportMeta" class="text-xs text-gray-500 mt-0.5">ID: REP_002 | Fecha: 12/06/2026</p>
            <p class="text-xs text-gray-600 mt-1"><strong>Programa:</strong> <span id="detailReportProgram">ADSO</span></p>
            <p class="text-xs text-gray-600"><strong>Responsable:</strong> <span id="detailReportResp">Coordinación Académica</span></p>
        </div>

        <!-- Estadísticas -->
        <div class="bg-gray-50 p-3.5 rounded-xl space-y-2">
            <span class="text-[11px] font-bold text-gray-400 block uppercase tracking-wider">Estadísticas</span>
            <div class="flex justify-between text-xs text-gray-600"><span>Total de Egresados:</span> <span id="detailTotalEgresados" class="font-bold text-gray-900">350</span></div>
            <div class="flex justify-between text-xs text-gray-600"><span>Empleados:</span> <span id="detailEmpleados" class="font-bold text-gray-900">280</span></div>
            <div class="flex justify-between text-xs text-gray-600"><span>Desempleados:</span> <span id="detailDesempleados" class="font-bold text-gray-900">70</span></div>
            <div class="flex justify-between text-xs text-gray-600"><span>Tasa Empleabilidad:</span> <span id="detailRate" class="font-bold text-emerald-700">80%</span></div>
            <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden mt-1">
                <div id="detailProgressBar" class="bg-emerald-600 h-full rounded-full transition-all duration-500" style="width: 80%"></div>
            </div>
        </div>

        <!-- Filtros Aplicados -->
        <div class="bg-gray-50 p-3.5 rounded-xl space-y-1 text-xs text-gray-600">
            <span class="text-[11px] font-bold text-gray-400 block uppercase tracking-wider mb-1">Filtros Aplicados</span>
            <p>• Programa: <span id="detailFiltroProg">ADSO</span></p>
            <p>• Ficha: <span id="detailFiltroFicha">Todas</span></p>
            <p>• Estado Laboral: <span id="detailFiltroEstado">Todos</span></p>
            <p>• Región: <span id="detailFiltroRegion">Huila</span></p>
            <p>• Período: <span id="detailFiltroPeriodo">01/01/2026 - 12/06/2026</span></p>
        </div>

        <!-- =============== BOTONES FUNCIONALES =============== -->
        <div class="space-y-2 pt-2">
            
            <!-- 1. Descargar Excel -->
            <a id="btnActionExcel" 
               href="{{ route('egresados.superadmin.reportes.exportar', ['id' => 'REP_002', 'formato' => 'excel']) }}" 
               class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Descargar Excel
            </a>

            <!-- 2. Descargar PDF -->
            <a id="btnActionPdf" 
               href="{{ route('egresados.superadmin.reportes.exportar', ['id' => 'REP_002', 'formato' => 'pdf']) }}" 
               class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Descargar PDF
            </a>

            <!-- 3. Ver Gráficas (Lleva a una vista detallada como la de encuestas) -->
            <a id="btnActionGraficas" 
               href="{{ route('egresados.superadmin.reportes.graficas', ['id' => 'REP_002']) }}" 
               class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Ver Gráficas
            </a>

            <!-- 4. Enviar por Correo -->
            <button @click="confirmarEnvio = true" type="button" class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Enviar por Correo
            </button>

            <!-- 5. Eliminar Reporte -->
            <button @click="confirmarEliminar = true" type="button" class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 mt-2 cursor-pointer shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Eliminar Reporte
            </button>
        </div>

        <!-- =============== MODALES FLOTANTES =============== -->
        
        <!-- Modal: Enviar por Correo -->
        <div x-show="confirmarEnvio" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak>
            <div @click.away="confirmarEnvio = false" class="bg-white p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-1">Enviar Reporte</h3>
                <p class="text-xs text-gray-500 mb-4">El reporte seleccionado será enviado con los datos consolidados en formato PDF y Excel.</p>
                <form id="formEnviarCorreo" action="{{ route('egresados.superadmin.reportes.enviar', ['id' => 'REP_002']) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-600 uppercase mb-1">Destinatario</label>
                        <input type="email" name="email_destino" required class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none" placeholder="correo@sena.edu.co">
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="confirmarEnvio = false" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">Cancelar</button>
                        <button type="submit" class="flex-1 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition cursor-pointer shadow-sm">Enviar ahora</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal: Eliminar Reporte -->
        <div x-show="confirmarEliminar" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4" x-cloak>
            <div @click.away="confirmarEliminar = false" class="bg-white p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-100 text-center">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">¿Eliminar reporte?</h3>
                <p class="text-xs text-gray-500 mb-5">Esta acción borrará el registro del reporte seleccionado de manera permanente. Esta acción no se puede deshacer.</p>
                <div class="flex items-center gap-3">
                    <button type="button" @click="confirmarEliminar = false" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">Cancelar</button>
                    <form id="formEliminarReporte" action="{{ route('egresados.superadmin.reportes.destroy', ['id' => 'REP_002']) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition shadow-sm cursor-pointer">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
