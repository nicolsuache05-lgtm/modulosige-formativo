<!-- ============================================== -->
<!-- 3. DETALLE LATERAL DEL REPORTE (1/3 DEL GRID - STICKY) -->
<!-- ============================================== -->
<div class="lg:col-span-1">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 space-y-4 sticky top-20" 
         x-data="{ confirmarEliminar: false, activeId: 'REP_002', activeTitle: 'Reporte de empleabilidad ADSO' }">
        
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
               href="{{ route('egresados.superadmin.reportes.exportar', ['id' => 'REP_002', 'formato' => 'excel']) }}?title=Reporte%20de%20empleabilidad%20ADSO&program=ADSO" 
               download
               class="w-full py-2.5 bg-gradient-to-r from-[#39A900] to-[#2e8b00] hover:from-[#2e8b00] hover:to-[#247000] text-white text-xs font-bold rounded-xl transition shadow-md shadow-[#39A900]/25 flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-file-excel text-xs"></i>
                <span>Descargar Excel</span>
            </a>

            <!-- 2. Descargar PDF -->
            <button type="button" 
               id="btnActionPdf" 
               onclick="descargarReportePDF()" 
               class="w-full py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl transition shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-file-pdf text-red-500 text-xs"></i>
                <span id="btnPdfText">Descargar Reporte (PDF)</span>
            </button>

            <!-- 3. Ver Gráficas (Abre ventanita modal con gráficos e indicadores SENA ERP) -->
            <button type="button" 
               id="btnActionGraficas" 
               onclick="abrirModalGraficas()" 
               class="w-full py-2.5 bg-gradient-to-r from-[#00131E] via-[#001A29] to-[#002336] hover:from-[#001A29] hover:to-[#00283d] text-white border border-white/10 text-xs font-bold rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-chart-pie text-[#62E31D] text-xs"></i>
                <span>Ver Gráficas</span>
            </button>

            <!-- 4. Eliminar Reporte -->
            <button @click="confirmarEliminar = true" type="button" class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Eliminar Reporte</span>
            </button>
        </div>

        <!-- =============== MODALES FLOTANTES =============== -->
        
        <!-- Modal: Eliminar Reporte (Estilo SENA ERP) -->
        <div x-show="confirmarEliminar" 
             style="display: none;" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.window.escape="confirmarEliminar = false"
             class="fixed inset-0 z-[60] overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-start justify-center pt-14 sm:pt-20 p-4" 
             x-cloak>
            
            <div @click.away="confirmarEliminar = false" 
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
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                        <div>
                            <div class="text-[9.5px] font-extrabold text-[#62E31D] uppercase tracking-wider">GESTIÓN DE REPORTES · SIGE ERP</div>
                            <h3 class="text-base font-bold text-white tracking-tight">Confirmar Eliminación</h3>
                        </div>
                    </div>
                    <button @click="confirmarEliminar = false" type="button" class="text-white/70 hover:text-white p-2 rounded-xl hover:bg-white/10 transition cursor-pointer" title="Cerrar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Contenido y Advertencia Institucional -->
                <div class="p-6 space-y-4 bg-white">
                    <div class="p-4 rounded-2xl bg-red-50/80 border border-red-200/80 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-red-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                        </div>
                        <div class="text-xs text-red-950 flex-1">
                            <div class="font-bold text-red-900">¿Desea eliminar este reporte permanentemente?</div>
                            <p class="text-red-700 text-[11px] mt-1 leading-relaxed">
                                Esta acción borrará el registro del reporte seleccionado en la plataforma SIGE ERP. Los datos generados ya no estarán disponibles para su consulta.
                            </p>
                        </div>
                    </div>

                    <!-- Identificación del reporte a eliminar -->
                    <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100 flex items-center justify-between">
                        <div class="overflow-hidden">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Reporte Seleccionado</span>
                            <span id="modalEliminarTitulo" class="text-xs font-bold text-gray-800 truncate block mt-0.5" x-text="activeTitle">Reporte de empleabilidad ADSO</span>
                        </div>
                        <span id="modalEliminarId" class="px-2.5 py-1 rounded-lg text-[10px] font-extrabold bg-[#001A29] text-[#62E31D] flex-shrink-0 ml-3" x-text="activeId">REP_002</span>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" 
                                @click="confirmarEliminar = false" 
                                class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition cursor-pointer">
                            Cancelar
                        </button>
                        <form id="formEliminarReporte" action="{{ route('egresados.superadmin.reportes.destroy', ['id' => 'REP_002']) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-xs font-bold rounded-xl transition shadow-md shadow-red-600/25 flex items-center justify-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                                <span>Eliminar Reporte</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
